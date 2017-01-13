<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts()
    {
        return $this->hasMany('App\post','user_id','id');
    }

    public function friendlist(){
        return $this->belongsToMany('App\User','Friendlists','user_id','friend_id');
    }

    public function friendlist2(){
       return $this->belongsToMany('App\User','Friendlists','friend_id','user_id');

    }

    public function userinfo()
    {
        return $this->hasMany('App\Userinfo','user_id','id');
    }

    public function userinfoExist()
    {
        $userinfoExist = DB::table('userinfos')
            ->where('user_id',$this->id)
            ->count();

        return $userinfoExist;
    }

    public function recentActivities(){
        $updatedAccount = $this ->userinfo->sortByDesc('created_at');

        $like = DB::table('poststats')
            ->where('user_id',$this->id)
            ->latest()
            ->get();

        $updatedAccount = DB::table('comments')
            ->where('user_id',$this->id)
            ->latest()
            ->get(); 

     
        $updatedAccount1 = DB::table('friendlists as added')
            ->where([['added.user_id',$this->id],['accepted',1]])
            ->get(); 

         $updatedAccount2 = DB::table('friendlists as accepted')
            ->select('*', 'accepted.user_id as friend_id', 'accepted.friend_id as user_id')
            ->where([['accepted.friend_id',$this->id],['accepted',1]])
            ->get();     
            
        // $updatedAccount = $this->friendlist
        //     ->where('accepted',1)
        //     ->sortByDesc('created_at');

        $friends = $updatedAccount1->merge($updatedAccount2);

        $wow = $friends->merge($like)->sortByDesc('created_at'); 

        return $wow;
    }




 // <!-- {{dd($currentuser->userinfo->sortByDesc('created_at')) }} -->

}

