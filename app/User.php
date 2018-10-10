<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\User\Models\Role;
use Modules\Web\Models\SocialProvider;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table='users';

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'gender',
        'phone',
        'address',
        'city',
        'country',
        'state',
        'zip_code',
        'date_of_birth',
        'type',
        'status',
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function socialProvider(){

        return $this->hasMany(SocialProvider::class);

    }

    public function can_access($permission = null){

        return !is_null($permission)  && $this->checkPermission($permission);
    }

    //check if the permission matches with any permission user has
    protected function checkPermission($perm){

        $permissions = $this->getAllPermissionFromAllRoles();

        $permissionArray = is_array($perm) ? $perm : [$perm];
        return array_intersect($permissions, $permissionArray);
    }

    //Get All permission slugs from all permission of all roles

    protected function getAllPermissionFromAllRoles(){

        $permissionsArray = array();
        $permissions = $this->relRole->load('permissions')->toArray();

        foreach ($permissions as $vales){
            $permissionsArray = array_merge($permissionsArray, $vales['permissions']);
        }

        $permissions = $permissionsArray; // make the array into $permissions

        return array_map('strtolower', array_unique(array_flatten(array_map(function($permission){
            return array_pluck(array($permission), 'route_url');
        }, $permissions))));
    }

    public function relRole()
    {
      return $this->belongsToMany('Modules\User\Models\Role', 'role_users', 'users_id','roles_id' );
    }

    public static function getUserRoleName($user) {
        if(count($user) > 0) {
            $user_role = Role::join('role_users', 'roles.id', '=', 'role_users.roles_id')->select('roles.*')->where('role_users.users_id', $user->id)->first();
            if(count($user_role)) {
                return $user_role->slug;
            }
        }

        return '';
    }

}
