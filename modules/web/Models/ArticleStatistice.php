<?php

namespace Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleStatistice extends Model
{
    protected $table='article_statistices';

    protected $fillable=[
        'article_id',
        'article_rank_value',
        'fb_share',
        'twitter_share',
        'linkedIn_share',
        'share_by_email',
        'share_by_username',
        'share_ip',
    ];
}
