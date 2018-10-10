<?php

namespace Modules\User\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'title',
        'slug',
        'status',
    ];


    //Relations
    public function users(){
        return $this->hasMany('App\User');
    }

    public function permissions()
    {

        return $this->belongsToMany('Modules\User\Models\Permission', 'role_permissions',  'roles_id', 'permissions_id');

    }

}
