<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Modules\User\Models\Role;
use Modules\User\Requests\RolesRequest;

class RoleController extends Controller
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
        $role_title = Input::get('title');
        $pageTitle = "List of Role Information";
        $data = Role::where('title', 'LIKE', '%'.$role_title.'%')->paginate(30);

        // drop-down - lists
        $role_lists = DB::table('roles')->where('roles.slug', '!=', 'superadmin')
            ->select('id', 'slug')->get();

        return view('user::users.role.index',[
            'data'=>$data,
            'pageTitle'=>$pageTitle,
            'role_lists'=>$role_lists,
        ]);
    }


    public function search_role()
    {

        $pageTitle = 'Role Information';
        $model = new Role();

        if($this->isGetRequest())
        {
            $title = Input::get('title');
            $model = $model->where('title', 'LIKE', '%'.$title.'%');
            $model = $model->orWhere('status', 'LIKE', '%'.$title.'%');
            $data = $model->paginate(30);

        }else{
            $data = Role::where('status', '!=', 'cancel')->paginate(30);
        }


        return view('user::users.role.index',[
            'pageTitle'=>$pageTitle,
            'data'=>$data,
        ]);
    }


    public function store_role(RolesRequest $request)
    {

        $input = $request->all();
        $role_title=strtolower($input['title']);
        $data= Role::where('title', '=', $role_title)->get();

        if( count($data) <=0)
        {
            //$input['slug'] = str_slug(strtolower($input['title']));
            $input_data = [
                'title'=> strtolower($input['title']),
                'slug'=> str_slug(strtolower($input['title'])),
                'status'=> $input['status'],
                'updated_by'=> 0,
            ];

            /* Transaction Start Here */
            DB::beginTransaction();
            try {
                if(Role::create($input_data))
                {

                }

                DB::commit();
                Session::flash('message', 'Successfully added!');

            } catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();

            }


        }else{
            Session::flash('info', 'This role already added!');

        }
        return redirect()->back();


    }


    public function show($slug)
    {
        $pageTitle = 'View Role Information';
        $data = Role::where('slug',$slug)->first();

        if(count($data) > 0)
        {

            $view = \Illuminate\Support\Facades\View::make('user::users.role.view',
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


    public function edit($slug)
    {
        $pageTitle = "Update Role Information";
        $data = Role::where('slug',$slug)->first();

        if(count($data) > 0)
        {

            $view = \Illuminate\Support\Facades\View::make('user::users.role.update',
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


    public function update(RolesRequest $request, $slug)
    {
        $input = $request->all();

        $data = str_slug(strtolower($input['title']));
        $dataquery = Role::where('slug',$data)->first();

        $statusquery = DB::table('roles')->select('status')->where('slug',$data)->first();

        if(!isset($statusquery)){

            if( count($dataquery) <=0)
            {
                $input['slug'] = str_slug(strtolower($input['title']));

                $model = Role::where('slug',$slug)->first();
                DB::beginTransaction();
                try {
                    $model->update($input);
                    DB::commit();
                    Session::flash('message', 'Successfully added!');


                }catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', $e->getMessage());
                }

            }else{
                Session::flash('info', 'This role already added!');
            }

        }else{

            $input['slug'] = str_slug(strtolower($input['title']));

            $model = Role::where('slug',$slug)->first();
            DB::beginTransaction();
            try {
                $model->update($input);
                DB::commit();
                Session::flash('message', 'Successfully added!');

            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }


        }

        return redirect()->back();

    }


    public function destroy($slug)
    {
        if($slug != null){
            $model = Role::where('slug',$slug)->first();
            DB::beginTransaction();
            try {
                if($model->status =='active'){
                    $model->status = 'cancel';
                }else{
                    $model->status = 'active';
                }

                if($model->save())
                {

                }

                DB::commit();
                Session::flash('message', "Successfully Deleted.");


            } catch(\Exception $e) {
                DB::rollback();
                Session::flash('danger',$e->getMessage());

            }
        }

        return redirect()->back();
    }


}