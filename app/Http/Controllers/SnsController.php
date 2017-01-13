<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SnsController extends Controller
{
    function getPhpVersion(){
        return view('sns_final/phpversion');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    function showDashboard(Request $request){
        $login_user = Auth::user(); //id of the current user
        $id =$login_user->id;
        $post_obj= \App\Post::where('user_id',"$login_user->id")->get(); //show my post
        
        $all_post = \App\Post::All();//show other people post arrange by time and date

        $users = DB::table('users')
            ->leftJoin('posts', 'users.id', '=', 'posts.user_id')
            ->orderBy('posts.updated_at', 'desc')
            ->get();

        $friendRequest_sent = DB::table('users')
            ->leftJoin('friendlists', 'users.id', '=', 'friendlists.friend_id')
            ->where('friendlists.user_id',"$id")
            ->get();

        $friendRequest_get = DB::table('users')
            ->leftJoin('friendlists', 'users.id', '=', 'friendlists.user_id')
            ->where([['friendlists.friend_id',"$id"],['friendlists.accepted',0]])
            ->get();

        $friendRequest_accept = DB::table('users')
            ->leftJoin('friendlists', 'users.id', '=', 'friendlists.user_id')
            ->where([['friendlists.friend_id',"$id"],['friendlists.accepted',1]])
            ->get();    

        $posts = DB::table('posts')->get();
        
        $userAdded = DB::table('friendlists')
            ->orwhere([['friendlists.user_id',"$id"],['friendlists.accepted',1]])
            ->get(['friend_id as id'])->toarray(); //get id of friends the user added
    
        $userAccepted = DB::table('friendlists')
            ->orwhere([['friendlists.friend_id',"$id"],['friendlists.accepted',1]])
            ->get(['user_id as id'])->toarray(); // get id of friend the user accepted
    
        $dbposts[]=$userAdded;
        $dbposts[]=$userAccepted;
        $getUsersId[]='';
        foreach ($dbposts as $post ){
            foreach ($post as $key)
            {   
                foreach ($key as $aw => $de)
                    {
                        $getUsersId[]=$de;//get index $dbposts[id]
                    }
            }
        }



        $myfriends= DB::table('users')
                ->whereIn('users.id',$getUsersId)
                ->get();

        $friendCount = $myfriends->count();
        // dd($friendCount);
        $request->session()->put('friendCount', $friendCount);
        
        $getUsersId[]=$id; //add current user's id to array $wow

        $dashboardPost = DB::table('users')
            ->leftjoin('posts','posts.user_id','=','users.id')
            ->leftjoin('poststats','posts.id','=','poststats.post_id')
            ->whereIn('users.id',$getUsersId)
            ->orderBy('posts.created_at','desc')
            ->get();
   

        $loadComments =  DB::table('comments')
            ->leftjoin('users','users.id','=','comments.user_id')
            ->leftjoin('posts','posts.id','=','comments.post_id')
            // ->orderBy('updated_at','desc') 
            ->get();
        // dd($loadComments);

               // $all_users = \App\User::All();//show all users except current user
        $all_users = DB::table('users')
            ->select('*', 'users.id as id')
            ->whereNotIn('users.id',$getUsersId)
            ->get();

        return view('sns_final/dashboard',
            compact('id','post_obj','all_users','all_post','users',
                'friendRequest_sent','friendRequest_get','myfriends',
                'friendCount','dashboardPost','posts','friendRequest_accept',
                'loadComments'));
   
    }


        function dashboard2(Request $request){
            $posts = \App\Post::all()->sortByDesc('created_at');
            $users = \App\User::all();

            // $friendship = \App\Friendlist::all();

            $currentuser = Auth::user();
            // $mypost = $currentuser->posts()->get();

            // $myfriends = $currentuser->friendlist()->get();
            $sentFriend = collect($currentuser->friendlist()
                ->where('accepted',1)
                ->get());
            $receiveFriend = collect($currentuser->friendlist2()
                ->where('accepted',1)
                ->get());

            $myfriends = $sentFriend->merge($receiveFriend);
            $myfriendsid= $myfriends->pull('user_id');
            $friendCount = count($myfriends);

            // dd(count($currentuser->userinfo));

            $myinfo =$currentuser->userinfo()->orderBy('updated_at','desc')->latest()->first();

            $myFriendRequests = $currentuser->friendlist2()->where('accepted',0)->get();



            if(count($myfriends) < 9 )
              {$take = count($myfriends); }
            elseif(count($myfriends) >= 9)
             {$take = 9;}
         

            // foreach($posts as $post){
            //     $post = $post->wherein('user_id',[1,2,3])->get();
            //     dd($post);
            // }

            // dd($myFriendRequests);
            

         //   foreach ($posts as $post)
         //    {  echo $post->id;
         //     echo $post->showComments()->comment_body;
         // }
         

    
            return view('sns_final/comments',compact('posts','currentuser','myfriends','users','friendCount','myinfo','myFriendRequests','take'));
        }


        function editProfile2($id){


        $currentuser = Auth::user();
        // $myinfo = $currentuser->userinfo();

        $myinfo =$currentuser->userinfo()->orderBy('updated_at','desc')->latest()->first();

        // dd($myinfo);
   

        if($currentuser->id == $id)

          { return view('sns_final/editaccount',compact('currentuser','myinfo'));}
        else

            { return redirect('dashboard2');}

        }

        function saveEditProfile(Request $request, $id){

            $currentuser = Auth::user();
            $saveProfile = new \App\Userinfo();

            $saveAtUser = \App\User::find($id);
            $saveAtUser->name = $request ->get('firstname');
            $saveAtUser->save();


            $saveProfile -> user_id = $id;
            // $save -> avatar = get('avatar');
            $saveProfile -> fname = $request ->get('firstname');
            $saveProfile -> lname =  $request ->get('lastname');
            $saveProfile -> birthday =  $request ->get('birthday');
            $saveProfile -> gender =  $request ->get('gender');
            $saveProfile -> description= $request ->get('description');

            


            $avatar = $request ->get('avatar');
           if($saveProfile->userinfo != null){
                       $saveProfile ->avatar = $currentuser->userinfo()
                           ->orderBy('updated_at','desc')
                           ->latest()
                           ->first()->avatar;}

            $file = $request->file('avatar');

            if (!is_null($file)){
                $fileName = $id.'_'.$file->getClientOriginalName();
                $request->file('avatar')->move("images/userpic/", $fileName);
                $saveProfile ->avatar = $fileName;
            }
            else{

                if(is_null($currentuser->userinfo) || $currentuser->userinfo->isEmpty())

                   { $saveProfile->avatar = 'noavatar.png'; }
                else{

                   { $saveProfile->avatar = $currentuser->userinfo()->latest()->first()->avatar;
                   }
                }
            
            }


            $saveProfile->save();
            return redirect('myprofile');
        }

       function showMyProfile(Request $request){

        $currentuser= Auth::user();

        // $friendCount = $request->session()->get('friendCount');
        $friendCount = $request->session()->get('friendCount');

        $myinfo = DB::table('users')
            ->where('users.id','=',"$login_user->id")
            ->get();

        $loadComments =  DB::table('comments')
            ->leftjoin('users','users.id','=','comments.user_id')
            ->leftjoin('posts','posts.id','=','comments.post_id')
            // ->orderBy('updated_at','desc') 
            ->get();

        // dd($myinfo);

                 $sentFriend = collect($currentuser->friendlist()
                ->where('accepted',1)
                ->get());
            $receiveFriend = collect($currentuser->friendlist2()
                ->where('accepted',1)
                ->get());

            $myfriends = $sentFriend->merge($receiveFriend);
            $friendCount =count($myfriends);

        $post_obj= \App\Post::where('user_id',"$login_user->id")
            ->get();
        $postCount = $post_obj->count(); 


        // $post_obj= $post_obj->get('$post_obj');
        // // dd($post_obj);
        return view('sns_final/profile',compact('post_obj','login_user','myinfo',
            'friendCount','postCount','loadComments','myfriends','friendCount'));
    }


    function showProfile($id){

            $users = \App\User::all();
            $currentuser = Auth::user();
            $posts = \App\Post::all()->sortByDesc('created_at');

        if($currentuser->id == $id){
              $currentuser = Auth::user();
        }else{
             $currentuser = \App\User::find($id);
        }

         $myposts = $currentuser->posts()
                ->orderBy('created_at','desc')
                ->get();


            $nineposts =   $currentuser->posts()
                            ->wherenotnull('img_src')
                            ->orwhere('img_src','!=','')
                            ->orderBy('created_at','desc')
                            ->get();

            $nineposts = $nineposts->take(9);  



             // dd($nineposts);   

            $sentFriend = collect($currentuser->friendlist()
                ->where('accepted',1)
                ->get());
            $receiveFriend = collect($currentuser->friendlist2()
                ->where('accepted',1)
                ->get());

            $myfriends = $sentFriend->merge($receiveFriend);
           

           // dd(count($myfriends));

            if((count($myfriends)) < 9)
                { $ninefriends = $myfriends->random(count($myfriends))->all();}
            else{$ninefriends = $myfriends->random(count($myfriends))->all();}
        




            if (count($currentuser->userinfo) == 0)
                { $myavatar = 'noavatar.png'; }
            else 
                { $myinfo = $currentuser->userinfo->last(); 
                    $myavatar =   $currentuser->userinfo->last()->avatar; }
            



             return view('sns_final/profile2',compact('myposts','currentuser','myfriends','myinfo','myavatar','nineposts','ninefriends'));

        // }else{
        //     $profileId= $id;
        //     $currentuser = Auth::user();


        //     $login_user = Auth::user();
        //     $user_info = \App\User::find($profileId);
        //     $user_post= \App\Post::where('user_id',"$profileId");
        //     $user_post=$user_post->get();
            
        //     $myinfo =$currentuser->userinfo()->orderBy('updated_at','desc')->latest()->first();
        //     $userAdded = DB::table('friendlists')
        //         ->orwhere([['friendlists.user_id',"$login_user->id"],['friendlists.friend_id',"$profileId"],['friendlists.accepted',1]])
        //         ->get(); //get id of friends the user added
       
        //     $userAccepted = DB::table('friendlists')
        //         ->orwhere([['friendlists.friend_id',"$login_user->id"],['friendlists.user_id',"$profileId"],['friendlists.accepted',1]])
        //         ->get(); // get id of friend the user accepted
            
        //     $iFfriend= ($userAdded->count()) + ($userAccepted->count()); //check if friend

        //     $userSentRequest = DB::table('friendlists')
        //         ->where([['friendlists.friend_id',"$login_user->id"],['friendlists.user_id',"$profileId"],['friendlists.accepted',0]])
        //         ->count();

        //     // dd($userSentRequest);
        //             return view('sns_final/otherProfile',compact('user_info','user_post','iFfriend','currentuser','myinfo'));
            
        

    }

        function showMyProfile2(){

            $users = \App\User::all();
            $currentuser = Auth::user();
            $posts = \App\Post::all()->sortByDesc('created_at');

            $myposts = $currentuser->posts()
                ->orderBy('created_at','desc')
                ->get();

            $nineposts =   $currentuser->posts()
                            ->wherenotnull('img_src')
                            ->orwhere('img_src','!=','')
                            ->orderBy('created_at','desc')
                            ->get();

            $nineposts = $nineposts->where('user_id',$currentuser->id)->take(9);  


             // dd($nineposts);   

            $sentFriend = collect($currentuser->friendlist()
                ->where('accepted',1)
                ->get());
            $receiveFriend = collect($currentuser->friendlist2()
                ->where('accepted',1)
                ->get());

            $myfriends = $sentFriend->merge($receiveFriend);
            $friendCount =count($myfriends);


            if(count($myfriends) < 9 )
              {$take = count($myfriends); }
            elseif(count($myfriends) >= 9)
             {$take = 9;}
         


           // dd(count($myfriends));
            if(!($myfriends->isEmpty()))
            {
                if((count($myfriends)) < 9)
                    { $ninefriends = $myfriends->random(count($myfriends))->all();}
                else{$ninefriends = $myfriends->random(count($myfriends))->all();}
            }




            if (count($currentuser->userinfo) == 0)
                { $myavatar = 'noavatar.png'; }
            else 
                { $myinfo = $currentuser->userinfo->last(); 
                    $myavatar =   $currentuser->userinfo->last()->avatar; }
            



             return view('sns_final/profile2',compact('myposts','currentuser','myfriends','myinfo','myavatar','nineposts','ninefriends','friendCount','take'));


        }




       function showOtherProfile($id){ //id is the id of visited profile
        $profileId= $id;
        $currentuser = Auth::user();


        $login_user = Auth::user();
        $user_info = \App\User::find($profileId);
        $user_post= \App\Post::where('user_id',"$profileId");
        $user_post=$user_post->get();
        
        $myinfo =$currentuser->userinfo()->orderBy('updated_at','desc')->latest()->first();
        $userAdded = DB::table('friendlists')
            ->orwhere([['friendlists.user_id',$login_user->id],['friendlists.friend_id',"$profileId"],['friendlists.accepted',1]])
            ->get(); //get id of friends the user added
   
        $userAccepted = DB::table('friendlists')
            ->orwhere([['friendlists.friend_id',$login_user->id],['friendlists.user_id',"$profileId"],['friendlists.accepted',1]])
            ->get(); // get id of friend the user accepted
        
        $iFfriend= ($userAdded->count()) + ($userAccepted->count()); //check if friend

        $meSentRequest= DB::table('friendlists')
            ->where([['friendlists.user_id',$currentuser->id],['friendlists.friend_id',$profileId],['friendlists.accepted',0]])
            ->count();

        $thisuserSentRequest = DB::table('friendlists')
            ->where([['friendlists.friend_id',"$login_user->id"],['friendlists.user_id',"$profileId"],['friendlists.accepted',0]])
            ->count();

       
        if($id == $currentuser->id){
            return redirect('myprofile');
        }else{
                return view('sns_final/otherProfile',compact('user_info','user_post','iFfriend','currentuser','myinfo','meSentRequest','thisuserSentRequest'));
        }
    }

    function sendFriendRequest($id){

        $user_info = \App\User::find($id);
        $login_user = Auth::user();

        $friend_request = new \App\Friendlist();
        $friend_request -> user_id = $login_user->id;
        $friend_request -> friend_id = $user_info->id;
        $friend_request -> accepted = 0;
        $friend_request -> save();

        // return $user_info->id .":" .$login_user->id ;
        return back();  
    }

    function acceptFriendRequest($id){
        $user_info = \App\User::find($id);
        $login_user = Auth::user();

        DB::table('friendlists')
            ->where([['user_id', "$user_info->id"],['friend_id', "$login_user->id"]])
            ->update(['accepted' => 1]);


         DB::table('friendlists')
            ->where([['user_id', $id],['friend_id',$login_user->id]])
            ->update(['accepted' => 1]);

        // return $user_info->id;
         return back();

    }

    function setAvatar(){
        request() -> file('avatar') -> store('avatars');
        return back();
    }

    // function editProfile(){
    //     $login_user = Auth::user();

    //     dd($userInfo);
    //     return $login_user->id .":". $userInfo->name;
    // }
   
    function showComments(){
        
        $posts = DB::table('posts')->orderBy('body','desc')->get();
        dd($posts);

        return view('sns_final/comments',compact('posts'));

   }

   function unfriendUser($id){

        $currentuser = Auth::user();
        $deleteUser = \App\Friendlist::where([['user_id',$currentuser->id],['friend_id',$id],['accepted',1]])
            ->orWhere([['friend_id',$currentuser->id],['user_id',$id],['accepted',1]])
            ;
        
        $deleteUser->delete();

        return back();

   }

   function deleteComment($id){
        $currentuser = Auth::user();
        $deleteComment = \App\Comment::where('id',$id)
            ->delete();
        return back();
           }

    function postToFriend(){

        return back();
    }       

    function editComment($id){ //comment id
        $comment = \App\Comment::find($id);
        $currentuser = Auth::user();
        $myinfo =$currentuser->userinfo()->orderBy('updated_at','desc')->latest()->first();


        return view('sns_final/editcomment',compact('currentuser','comment','myinfo'));
    }

    function saveEditComment(Request $request, $id){
        $comment = \App\Comment::find($id);
        $comment->comment_body = $request->get('comment_body');
        $comment->save();
        return back();

    }

    function cancelRequest($fid){
         $currentuser = Auth::user();
        $request = \App\Friendlist::where([['user_id',$currentuser->id],['friend_id',$fid]]);
        
        $request->delete();
         return back();
    }

    function deleteMyAccount($id){
        $deleteAccount = \App\User::find($id);
        $deleteAccount -> delete();
       
 return back();
    }

   
}
