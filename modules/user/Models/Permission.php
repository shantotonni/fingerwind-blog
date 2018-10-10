<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $fillable = [
        'title',
        'route_url',
        'description',
        'created_by',
        'updated_by'
    ];

    //TODO:: relations
    public function roles()
    {
        return $this->belongsToMany('Modules\User\Models\Role', 'role_permissions', 'permissions_id',  'roles_id');

    }

}
