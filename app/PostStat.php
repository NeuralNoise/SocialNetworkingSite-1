<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poststat extends Model
{
    public function posts(){
        return $this->hasOne('\App\posts','id','post_id');
    }

}
