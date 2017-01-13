<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friendlist extends Model
{
     public function user(){
        return $this->hasMany('App\User','id','user_id');
    }

    public function friend(){
        return $this->hasMany('App\User','id','friend_id');
    }

}
