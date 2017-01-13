<?php

namespace App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   

    public function user()
    {
    	return $this->belongsTo('\App\User');
    }

    public function userinfo(){
        return $this->belongsTo('\App\userinfo','user_id','user_id');
    }

    public function comments()
    {
    	return $this->hasMany('\App\Comment','post_id');
    }

    public function poststat(){
        return $this->hasOne('\App\PostStat','post_id','post_id');
    }

    public function like(){
        $likes = DB::table('poststats')->where('post_id',$this->id)
        ->count();

        if($likes == 0){
            $likes='';
        }

        return $likes;

    }

    public function islike(){
        $currentuser = Auth::user();

        $unlike = DB::table('poststats')
            ->where([['post_id',$this->id],['user_id',$currentuser->id]])
            ->count();

        return $unlike;

    }

    public function countComment()
    {
        $commentCount = DB::table('comments')
            ->where('post_id',$this->id)
            ->count();
        if($commentCount == 0){
            $commentCount='';
        }

        return $commentCount;
    }

    public function whoLike()
    {
        $whoLike = DB::table('poststats')
            ->where(['post_id',$this->id]);

        return $whoLike;


    }

    
}

