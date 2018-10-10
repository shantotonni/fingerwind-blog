<?php

namespace Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleVote extends Model
{
    protected $table='article_votes';

    protected $fillable=[
        'article_id',
        'user_id',
        'ip',
        'vote',
        'created_by',
        'updated_by',
    ];


}
