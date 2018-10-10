<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Mockery\Exception;
use Modules\User\Models\Permission;
use Modules\User\Requests\PermissionRequest;

class PermissionController extends Controller
{

    //Get and Post method
    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pageTitle = "Permission List";
        $title = strtolower(Input::get('title'));

        $data = Permission::where('title', 'LIKE', '%'.$title.'%')->orderBy('id', 'DESC')->paginate(30);

        return view('user::users.permission.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,

        ]);
    }

    public function search_permission()
    {

        $pageTitle = 'Permission Information';
        $model = new Permission();

        if($this->isGetRequest())
        {
            $title = trim(Input::get('title'));
            $model = $model->where('title', 'LIKE', '%'.$title.'%');
            $model = $model->orWhere('route_url', 'LIKE', '%'.$title.'%');
            $data = $model->paginate(30);

        }else{
            $data = Permission::where('status', '!=', 'cancel')->paginate(30);
        }

        return view('user::users.permission.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
        ]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $title = strtolower($input['title']);
        $title_upper_case = ucwords($title);
        $route_url= str_slug(strtolower($input['title']));

        $description=$input['description'];

        $permission_exists = Permission::where('route_url',$route_url)->exists();

        if($permission_exists){
            Session::flash('info',' Already Exists.');
        }else{

            $input_data = [
                'title'=> $title_upper_case,
                'route_url'=>$route_url,
                'description'=> $description,
                'updated_by'=> 0,
            ];

            DB::beginTransaction();
            try {
                Permission::create($input_data);
                DB::commit();
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                DB::rollback();
                Session::flash('danger', $e->getMessage());

            }
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $pageTitle = 'View Permission';
        $data = Permission::where('id',$id)->first();

        if(count($data) > 0)
        {

            $view = \Illuminate\Support\Facades\View::make('user::users.permission.view',
                [
                    'data' => $data,
                    'pageTitle'=>$pageTitle
                ]);
            $contents = $view->render();

            $response['result'] = 'success';
            $response['content'] = $contents;

        }else{

            $response['result'] = 'error';

        }

        return $response;
    }

    public function edit($id)
    {
        $pageTitle = 'Update Permission Informations';
        $data = Permission::where('id',$id)->first();

        if(count($data) > 0)
        {

            $view = \Illuminate\Support\Facades\View::make('user::users.permission.update',
                [
                    'data' => $data,
                    'pageTitle'=>$pageTitle
                ]);
            $contents = $view->render();

            $response['result'] = 'success';
            $response['content'] = $contents;

        }else{

            $response['result'] = 'error';

        }

        return $response;
    }

    public function update(PermissionRequest $request, $id)
    {
        $input = $request->all();

        $route_url = $input['route_url'];
        $description=$input['route_url'];
        $permission_exists = Permission::where('id',$id)->exists();

        if(count($permission_exists)<2 ){
            $model = Permission::where('id',$id)->first();
            $title = Input::get('title');
            $input['title'] = $title;
            $input['route_url'] = $input['route_url'];
            $input['description'] = $description;

            ;
            DB::beginTransaction();
            try {
                $model->update($input);
                DB::commit();
                Session::flash('message', "Successfully Updated");

            }
            catch ( Exception $e ){
                DB::rollback();
                Session::flash('danger', $e->getMessage());

            }
        }else{
            Session::flash('info', 'This permission already added!');
        }

        return redirect()->back();
    }


    public function destroy($id)
    {
        $model = Permission::where('id',$id)->first();

        DB::beginTransaction();
        try {
            $model->delete();
            DB::commit();
            Session::flash('message', "Successfully Deleted.");

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('danger',$e->getMessage());
        }

        return redirect()->back();
    }


    public function route_in_permission()
    {

        $routeCollection = Route::getRoutes();


        foreach ($routeCollection as $value) {
            $routes_list[] = Str::lower($value->uri());
        }

        //store all permission into permission table
        foreach ($routes_list as $route)
        {
            $permission_exists = Permission::where('route_url','=',$route)->exists();
            if(!$permission_exists){
                $model = new Permission();
                $model->title = $route;
                $model->route_url = $route;
                $model->description = $route;
                DB::beginTransaction();
                try {
                    $model->save();
                    DB::commit();
                    Session::flash('message', "Route : ".$route. " is successfully added.");

                } catch(\Exception $e) {
                    DB::rollback();
                    Session::flash('danger',$e->getMessage());

                }
            }
            else{
                Session::flash('info', "Route : ".$route." already exists. No new route found");
            }
        }

        return redirect()->back();

    }


}
