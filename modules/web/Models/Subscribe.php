<?php

namespace Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table='subscribes';

    protected $fillable=[
        'email'
    ];
}
