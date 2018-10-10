<?php

namespace Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;

class Artical extends Model
{
    protected $table='articals';

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'post_by',
        'title',
        'description',
        'status',
        'created_by',
        'updated_by',
    ];

    public function category(){

        return $this->belongsTo('Modules\Category\Models\Category','category_id');

    }


    public function user(){

        return $this->belongsTo('App\User','post_by');
    }

    public function comment(){

        return $this->hasMany('Modules\Web\Models\Comment','article_id');

    }

    public function vote(){

        return $this->hasMany('Modules\Web\Models\ArticleVote','article_id');

    }

    public function sendMail(){

        return $this->belongsTo('Modules\Article\Models\UserSendMail','article_id');

    }

}
