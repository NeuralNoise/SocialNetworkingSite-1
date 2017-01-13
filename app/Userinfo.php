<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo extends Model
{
    public function user(){
    	return $this->belongsTo('App\User','id','user_id');
    }

     public function posts()
    {
        return $this->hasMany('App\post','user_id','user_id');
    }
}
