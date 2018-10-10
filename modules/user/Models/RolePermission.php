<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $table = 'role_permissions';

    protected $fillable = [
        'roles_id',
        'permissions_id',
        'status',
        'created_by',
        'updated_by',
    ];


    //TODO :: Relations
    public function relRole(){
        return $this->belongsTo('Modules\User\Models\Role', 'roles_id', 'id');
    }
    public function relPermission(){
        return $this->belongsTo('Modules\User\Models\Permission', 'permissions_id', 'id');
    }

    public function permissions()
    {
        return $this->belongsToMany('Modules\User\Models\Role', 'role_permissions','roles_id', 'permissions_id');

    }
}
