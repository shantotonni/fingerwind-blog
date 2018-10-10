<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_users';

    protected $fillable = [
        'roles_id',
        'users_id',
        'remember_token',
        'status',
        'created_by',
        'updated_by'
    ];

    public function relRole(){

        return $this->belongsTo('Modules\User\Models\Role', 'roles_id', 'id');
    }

    public function relUser(){

        return $this->belongsTo('App\User', 'users_id', 'id');
    }
}
