<?php

namespace Modules\Web\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleShare extends Model
{
    protected $table='article_shares';

    protected $fillable=[

        'site_name',
        'site_url',
        'ip_address',
        'shared_user_id',
        'article_id',

    ];
}
