<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;
// use User;
// use File;
// use    Symfony\Component\HttpFoundation\Request;

class PostController extends Controller
{		
	// public function createPost(Request $request)
	// {
	// 	//validation

	// 	$post = new Post();
	// 	$post->body = $request['body'];
	// 	$request -> user() -> posts() -> save($post);
	// 	return redirect('dashboard')
	// }


        public function __construct()
        {
            $this->middleware('auth');
        }


	   function createPost(Request $request){

        $user = Auth::user();

        $post_obj = new \App\Post();
        $post_obj ->body = $request ->get('post_body');
        $post_obj ->user_id = $user->id;
      
        $img_src = $request ->get('image');
       
        $post_obj ->img_src =$img_src;
        $file = $request->file('image');

        if (!is_null($file)){

            // Image::make($file->getRealPath())->resize(200, 200)->save("images/userpost");

            $fileName = $user->id.'_'.$file->getClientOriginalName();
            $request->file('image')->move("images/userpost/", $fileName);
            $post_obj ->img_src = $fileName;

        }
        if(($post_obj->img_src != '') OR ($post_obj->body != '')){
                // dd($file);
                 $post_obj -> save();
             }

        // $post_stat = new \App\PostStat();
        // $post_stat ->user_id = $user->id;
        // $post_stat ->post_id = $post_obj->id;

        // dd($post_obj);
         //make a row in poststat 
        return back();
                // return redirect('dashboard');
    }

     function likePost($post_id){
         $currentuser = Auth::user();

        $post_stat = new \App\PostStat();
        $post_stat ->user_id = $currentuser->id;
        $post_stat ->post_id = $post_id;
        $post_stat ->save();

        // $likePost = DB::table('posts')
        //     ->leftJoin('poststats', 'posts.id', '=', 'poststats.post_id')
        //     ->where('post_id','=',"$post_id")
        //     ->get();

        // foreach($likePost as $like){
            
        //     $like = new \App\Poststat();
        //     $like -> user_id = $like->user_id;
        //     $like -> post_id = $post_id;
        //     $like->save();
        // }



         //dd($likePost);
            // return $likePost;
        // return "success";
        //return back();
    }

    function unlikePost($post_id){
        $currentuser = Auth::user();

        $like = DB::table('poststats')->where([['post_id',$post_id],['user_id',$currentuser->id]]);
        $like->delete();

        return back();


    }

    function deletePost($post_id){
        $deletePost = DB::table('posts')
            ->where('posts.id','=',"$post_id")
            ->delete();

        return back();
    }

    function commentToPost(Request $request, $post_id){
        $user = Auth::user();
        $comment_body = $request ->get('comment_body');
        $comment_obj = new \App\Comment();
        $comment_obj -> user_id = $user->id;
        $comment_obj -> post_id = $post_id;
        $comment_obj -> comment_body = $comment_body;

            // dd( $comment_obj);
        $comment_obj -> save();
        return back();
    }

     function editPost($post_id){
        $post = \App\Post::find($post_id);
        $currentuser = Auth::user();
        $myinfo =$currentuser->userinfo()->orderBy('updated_at','desc')->latest()->first();


        return view('sns_final/editpost',compact('currentuser','comment','myinfo','post'));


    }

    function saveEditPost(Request $request, $post_id){
        $post = \App\Post::find($post_id);

        if(($request->get('post_body') != '') || $request->get('post_body') != null)

       { $post->body = $request->get('post_body');}



       //  if(($request->get('post_image') != '') || $request->get('post_image') != null)

       // { $post->img_src = $request->get('post_body');}.



        $img_src = $request ->get('post_image');
       
        
        $file = $request->file('post_image');

        if (!is_null($file)){

            // Image::make($file->getRealPath())->resize(200, 200)->save("images/userpost");

            $fileName = $post->user->id.'_'.$file->getClientOriginalName();
            $request->file('post_image')->move("images/userpost/", $fileName);
            $post ->img_src = $fileName;

        }else{
            $post->img_src = $post->img_src;
        }




        $post->save();

        return redirect('dashboard2');
        

    }




}