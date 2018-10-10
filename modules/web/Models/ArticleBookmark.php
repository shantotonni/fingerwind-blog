<?php

namespace Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleBookmark extends Model
{
    protected $table='article_bookmarks';

    protected $fillable=[
        'article_id',
        'user_id',
        'ip',
        'bookmark',
        'created_by',
        'updated_by',
    ];

    public function article(){

        return $this->belongsTo('Modules\Article\Models\Artical','article_id');
    }


    public function user(){

        return $this->belongsTo('App\User','user_id');

    }
}
