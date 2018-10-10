<?php

namespace Modules\User\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Modules\User\Models\Role;
use Modules\User\Models\RolePermission;
use Modules\User\Requests\RolePermissionRequest;

class RolePermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $pageTitle = "Permission Role List";

        // lists
        $data = DB::table('role_permissions')
            ->join('permissions', 'permissions.id', '=', 'role_permissions.permissions_id')
            ->join('roles', 'roles.id', '=', 'role_permissions.roles_id')
            ->where('roles.slug', '!=', 'superadmin')
            ->select('role_permissions.id', 'permissions.title as p_title', 'roles.title as r_title', 'role_permissions.roles_id', 'role_permissions.status')
            ->paginate(30);

        // drop-down - lists
        $role_lists = DB::table('roles')->where('roles.slug', '!=', 'superadmin')
            ->select('id', 'slug')->get();

        return view('user::users.role_permission.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'role_lists'=>$role_lists,

        ]);

    }

    public function search_permission_role(Route $route, Request $request)
    {

        $pageTitle = "Role based Permission :: Lists";

        $q_title = Input::get('query');

        //search result
        $data = DB::table('role_permissions')
            ->join('permissions', 'permissions.id', '=', 'role_permissions.permissions_id')
            ->join('roles', 'roles.id', '=', 'role_permissions.roles_id')
            ->where('permissions.title', 'LIKE', '%' . $q_title . '%')
            ->orWhere('roles.title', 'LIKE', '%' . $q_title . '%')
            ->select('role_permissions.id', 'permissions.title as p_title', 'roles.title as r_title', 'role_permissions.roles_id', 'role_permissions.status')
            ->paginate(30);

        // drop-down - lists
        $role_lists = DB::table('roles')->where('roles.slug', '!=', 'superadmin')
            ->select('id', 'slug')->get();

        return view('user::users.role_permission.index', [
            'data' => $data,
            'pageTitle'=> $pageTitle,
            'role_lists'=>$role_lists,

        ]);
    }

    public function create(Request $request)
    {

        $pageTitle = "Add Permission Role";

        //retrieve role data from roles table
        $role_value = Input::get('roles_id');
        $role_data = Role::findOrFail($role_value);
        $role_title = $role_data->title;
        $role_id = $role_data->id;

        // whereExists() with role-permisison table
        $exists_permission = DB::table('permissions')
            ->whereExists(function ($query) use($role_value){
                $query->select(DB::raw(1))
                    ->from('role_permissions')
                    ->whereRaw('role_permissions.permissions_id = permissions.id')
                    ->WhereRaw('role_permissions.roles_id = ?', [$role_value]);
            })
            ->select('permissions.title', 'permissions.id')->get();


        //whereNotExists() with role-permisison tables
        $not_exists_permission = DB::table('permissions')
            ->whereNotExists(function ($query) use($role_value){
                $query->select(DB::raw(1))
                    ->from('role_permissions')
                    ->whereRaw('role_permissions.permissions_id = permissions.id')
                    ->WhereRaw('role_permissions.roles_id = ?', [$role_value]);
            })
            ->select('permissions.title', 'permissions.id')->get();

        return view('user::users.role_permission.create', [
            'pageTitle'=> $pageTitle,
            'role_id'=>$role_id,
            'exists_permission' => $exists_permission,
            'not_exists_permission' => $not_exists_permission,
            'role_name'=>$role_title,
            'role_value'=>$role_value
        ]);

    }

    public function store(RolePermissionRequest $request)
    {

        DB::beginTransaction();
        $input = $request->all();

        // delete all role permission with role id
        RolePermission::where('roles_id','=',$input['roles_id'])->delete();

        if(isset($input['permissions_id'])){

            $permissions_id = $input['permissions_id'];

            foreach ($permissions_id as $p_id)
            {

                $model = new RolePermission();
                $model->roles_id = $input['roles_id'];
                $model->permissions_id = $p_id;
                $model->status = 'active';
                /* Transaction Start Here */
                try {
                    $model->save();
                    DB::commit();
                    Session::flash('message', 'Successfully added!');

                } catch (\Exception $e) {
                    //If there are any exceptions, rollback the transaction`
                    DB::rollback();
                    Session::flash('danger', $e->getMessage());
                }

            }

        }

        return redirect()->route('user.index.role.permission');

    }

    public function show($id)
    {
        $pageTitle = 'View Permission Role';

        //view data according to ID
        $data = DB::table('role_permissions')
            ->join('permissions', 'permissions.id', '=', 'role_permissions.permissions_id')
            ->join('roles', 'roles.id', '=', 'role_permissions.roles_id')
            ->where('roles.id', $id)
            ->select('role_permissions.id', 'permissions.title as p_title', 'roles.title as r_title', 'role_permissions.roles_id', 'role_permissions.status')
            ->first();

        return view('user::users.role_permission.view', [
            'data' => $data,
            'pageTitle'=> $pageTitle
        ]);
    }

    public function destroy_all(Request $request)
    {
        if($pr_ids = Input::get('pr_ids'))
        {
            foreach ($pr_ids as $id) {
                $model = RolePermission::findOrFail($id);
                DB::beginTransaction();
                try {
                    $model->delete();
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

    public function destroy(Request $request, $id)
    {

        if($pr_ids = Input::get('pr_ids'))
        {
            foreach ($pr_ids as $id) {
                $model = RolePermission::findOrFail($id);
                DB::beginTransaction();
                try {
                    $model->delete();
                    DB::commit();
                   Session::flash('message', "Successfully Deleted.");


                } catch(\Exception $e) {
                    DB::rollback();
                   Session::flash('danger',$e->getMessage());

                }
            }
        }else{

            $model = RolePermission::findOrFail($id);

            DB::beginTransaction();
            try {
                $model->delete();
                DB::commit();
                Session::flash('message', "Successfully Deleted.");

            } catch(\Exception $e)
            {
                DB::rollback();
                Session::flash('danger',$e->getMessage());

            }
        }

        return redirect()->back();
    }
}
