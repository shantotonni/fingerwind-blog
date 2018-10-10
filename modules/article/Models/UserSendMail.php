<?php

namespace Modules\Article\Models;

use Illuminate\Database\Eloquent\Model;

class UserSendMail extends Model
{

    protected $table='user_send_mails';

    protected $fillable=[
        'article_id',
        'user_id',
        'subject',
        'email',
        'description',
    ];

    public function article(){

        return $this->belongsTo('Modules\Article\Models\Artical','article_id');

    }


    public function user(){

        return $this->belongsTo('App\User','user_id');

    }

}
