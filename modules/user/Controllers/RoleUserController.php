<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Modules\User\Models\Role;
use Modules\User\Models\RoleUser;
use Modules\User\Requests\RolesUsersRequest;

class RoleUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $pageTitle = "User Role List";

        // lists
        $data = RoleUser::join('roles', 'roles.id', '=', 'role_users.roles_id')
            ->join('users', 'users.id', '=', 'role_users.users_id')
            ->where('roles.slug', '!=', 'superadmin')
            ->select('role_users.id as ru_id', 'roles.title as r_title', 'users.username as username','role_users.status as ru_status')
            ->paginate(30);

        // drop-down - lists
        $role_lists = DB::table('roles')->where('roles.slug', '!=', 'superadmin')
            ->select('id', 'slug')->get();

        // drop-down - lists
        $user_lists = DB::table('users')
            ->select('id', 'username')->get();

        return view('user::users.role_user.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'role_lists'=>$role_lists,
            'user_lists' => $user_lists
        ]);
    }

    public function search_user_role(Request $request)
    {

        $pageTitle = "User Role List";
        $query = trim(Input::get('title'));

        // lists
        $data = RoleUser::where(function ($q) use ($query) {

            $q->orWhereHas('relUser', function ($q) use($query) {
                $q->where(function ($q) use($query){
                    $q->orWhere('username', 'like', "%$query%");
                });
            });

            $q->orWhereHas('relRole', function ($q) use($query) {
                $q->where(function ($q) use($query){
                    $q->orWhere('title', 'like', "%$query%");
                });
            });

        })->join('roles', 'roles.id', '=', 'role_users.roles_id')
            ->join('users', 'users.id', '=', 'role_users.users_id')
            ->where('roles.slug', '!=', 'superadmin')
            ->select('role_users.id as ru_id', 'roles.title as r_title', 'users.first_name as username','role_users.status as ru_status')
            ->paginate(30);

        // drop-down - lists
        $role_lists = DB::table('roles')->where('roles.slug', '!=', 'superadmin')
            ->select('id', 'slug')->get();

        // drop-down - lists
        $user_lists = DB::table('users')
            ->select('id', 'username')->get();


        return view('user::users.role_user.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'role_lists'=>$role_lists,
            'user_lists' => $user_lists

        ]);
    }

    public function store_role(RolesUsersRequest $request)
    {

        $input = $request->all();

        $roles_id = $input['roles_id'];
        $user_id = $input['users_id'];
        $status = $input['status'];

        $role_data = Role::where('id', '=', $roles_id)->exists();
        $user_data = User::where('id', '=', $user_id)->exists();

        if( $role_data && $user_data ){
            $input_data = [
                'roles_id'=> $roles_id,
                'users_id'=> $user_id,
                'status'=> $status,
                'updated_by'=> 0,
                'created_by' => Auth::user()->id
            ];


            $permission_exists = RoleUser::where('roles_id',$roles_id)->where('users_id',$user_id)->exists();

            if($permission_exists){

                Session::flash('info', 'This role already added!');

            }else{

                DB::beginTransaction();

                try {

                    if(RoleUser::create($input_data))
                    {

                    }

                    DB::commit();
                    Session::flash('message', 'Successfully added!');


                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', $e->getMessage());

                }

            }


        }else{
            Session::flash('info', 'This role already added!');
        }

        return redirect()->back();
    }


    public function edit($id)
    {
        $pageTitle = "Update User Role";
        $data = RoleUser::where('id',$id)->first();

        // drop-down - lists
        $role_lists = DB::table('roles')->where('roles.slug', '!=', 'superadmin')
            ->select('id', 'slug')->get();

        // drop-down - lists
        $user_lists = DB::table('users')
            ->select('id', 'username')->get();

        if(count($data) > 0)
        {

            $view = \Illuminate\Support\Facades\View::make('user::users.role_user.update',
                [
                    'data' => $data,
                    'pageTitle'=> $pageTitle,
                    'role_lists' => $role_lists,
                    'user_lists' => $user_lists
                ]);
            $contents = $view->render();

            $response['result'] = 'success';
            $response['content'] = $contents;

        }else{

            $response['result'] = 'error';

        }

        return $response;
    }

    public function update(RolesUsersRequest $request, $id)
    {

        $input = $request->all();
        $dataquery = RoleUser::where('id',$id)->first();

        if( !empty($dataquery))
        {

            $roles_id = $input['roles_id'];
            $user_id = $input['users_id'];
            $status = $input['status'];

            $input_data = [
                'roles_id'=> $roles_id,
                'users_id'=> $user_id,
                'status'=> $status,
                'updated_by'=> Auth::user()->id
            ];

            $model = RoleUser::where('id',$id)->first();
            DB::beginTransaction();
            try {
                $model->update($input_data);
                DB::commit();
                Session::flash('message', 'Successfully added!');


            }catch (\Exception $e) {
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This role already added!');
        }

        return redirect()->back();

    }

    public function delete_all(Request $request)
    {
        if ($pr_ids = Input::get('pr_ids')) {

            foreach ($pr_ids as $id) {
                $model = RoleUser::findOrFail($id);
                DB::beginTransaction();
                try {
                    $model->status = 'inactive';
                    $model->save();
                    DB::commit();
                    Session::flash('message', "Successfully Deleted.");

                } catch(\Exception $e) {
                    DB::rollback();
                    Session::flash('danger',$e->getMessage());

                }
            }

        }else{
            Session::flash('message', "Please select role what you delete");
        }

        return redirect()->back();
    }


    public function delete($id)
    {
        $dataquery = RoleUser::where('id',$id)->first();

        if( !empty($dataquery))
        {

            $status = 'inactive';
            $input_data = [
                'status'=> $status,
                'updated_by'=> Auth::user()->id
            ];

            $model = RoleUser::where('id',$id)->first();
            DB::beginTransaction();
            try {
                $model->update($input_data);
                DB::commit();
                Session::flash('message', 'Successfully added!');

            }catch (\Exception $e) {
                //If there are any exceptions, rollback the transaction`
                DB::rollback();
                Session::flash('danger', $e->getMessage());
            }

        }else{
            Session::flash('info', 'This role already inactivated!');
        }

        redirect()->back();
    }

}
