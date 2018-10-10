<?php

namespace Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table='comments';

    protected $fillable=[
        'article_id',
        'user_id',
        'comment',
    ];

    public function article(){

        return $this->belongsTo('Modules\Article\Models\Artical','article_id');

    }

    public function user(){

        return $this->belongsTo('App\User','user_id');

    }
}
