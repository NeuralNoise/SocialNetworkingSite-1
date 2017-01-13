<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
     public function post()
    {
        return $this->belongsTo('App\Comment');
    }

     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function userinfo()
    {
        return $this->hasMany('App\Userinfo','user_id','user_id');
    }
}
