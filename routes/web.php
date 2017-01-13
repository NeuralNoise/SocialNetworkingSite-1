	<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hellolaravel', function () {
    return ("Hello din");
});

//passing value of a variable
//passing 2 variables
// Route::get('/welcome', function () {
// 		$greeting = 'Mabuhay!!';
// 		$greeting2 = 'Eow po';
// 		// return view('greeting', array('greeting' =>$greeting,'greeting2' =>$greeting2));
// 		return view('greeting', compact('greeting','greeting2'));
//     // return 1+3;
// });

// Route::get('/welcome/filipino', function () {
//     return "<h1>Tuloy po kayo</h1>";
// });

Route::get('/home', function () {
    return view('home');
});


// Route::get('/articles', function () {
//     return view('articles/article_list');
// });

//slash or dot
// Route::get('/articles', function () {
//     return view('articles.article_list');
// });

// Route::get('/greeting', function () {
//         $greeting = 'Mabuhay!!';
//         $greeting2 = 'Eow po';
//         // return view('greeting', array('greeting' =>$greeting,'greeting2' =>$greeting2));
//         return view('greeting', compact('greeting','greeting2'));
//     // return 1+3;
// });


//----------ARTICLES---------
// calling functions in App/http/ArticlesController
Route::get('/articles', 'ArticlesController@showArticles');
Route::get('/articles/create', 'ArticlesController@create');
Route::post('/articles/create', 'ArticlesController@store');
Route::get('/articles/{id}','ArticlesController@showSingleArticle');
Route::get('/articles/{id}/delete','ArticlesController@deleteArticle');
Route::post('/setpreference','ArticlesController@setPreference');
// Route::get('/articles2', 'ArticlesController@showArticles');


//----------ITEM----------
// Route::get('/item_list', 'ItemController@showItems');
// Route::get('/item_home', 'ItemController@showHome');
// Route::get('/items/{id}', 'ItemController@showItemDetails');


//----------GOODLUCK----------
Route::get('/goodluck', 'GoodluckController@showGoodluck');


//----------SNS----------
// Route::get('/sns', 'SnsController@show_homepage');
// Route::get('/sns/signup', 'SnsController@show_signup');
// Route::post('/sns/signup', 'SnsController@signup_save');




Route::get('/template', function(){
    return view('articles/xtemplate');
});


Route::get('/home', 'HomeController@index');




Route::get('/phpversion', 'SnsController@getPhpVersion');




//----------SNS----------
Auth::routes();
///login -> /signup
// Route::get('/dashboard', 'SnsController@showDashboard');

// Route::get('/myprofile/edit', 'SnsController@editProfile');


Route::get('/myprofile', 'SnsController@showMyProfile');


Route::get('/addfriend/{id}', 'SnsController@sendFriendRequest');

Route::get('/post/like/{post_id}', 'PostController@likePost');
Route::get('/post/unlike/{post_id}', 'PostController@unlikePost');
Route::get('/post/delete/{post_id}', 'PostController@deletePost');

Route::get('/post/edit/{post_id}', 'PostController@editPost');

Route::post('/post/edit/{post_id}/save', 'PostController@saveEditPost');

Route::post('/post/comment/{post_id}', 'PostController@commentToPost');

// ----------
Route::post('/dashboard/createpost', 'PostController@createPost');

Route::get('/myprofile/{id}/delete', 'SnsController@deleteMyAccount');

Route::get('/accept/{id}', 'SnsController@acceptFriendRequest');

Route::get('/dashboard', 'SnsController@dashboard2');
Route::get('/dashboard2', 'SnsController@dashboard2');


Route::get('/myprofile', 'SnsController@showMyProfile2');

Route::get('/myprofile/{id}/edit', 'SnsController@editProfile2');

Route::get('/cancelRequest/{fid}', 'SnsController@cancelRequest');

Route::get('/unfriend/{id}', 'SnsController@unfriendUser');

Route::post('/myprofile/{id}/edit/save', 'SnsController@saveEditProfile');

// Route::get('/user/{id}', 'SnsController@showProfile');
Route::get('/user/{id}', 'SnsController@showOtherProfile');

Route::get('/comment/delete/{id}', 'SnsController@deleteComment');

Route::get('/comment/edit/{id}', 'SnsController@editComment');

Route::post('/comment/edit/{id}/save', 'SnsController@saveEditComment');




Route::get('/comments',function(){

	$posts = \App\Post::all()->sortByDesc('created_at');
	$users = \App\User::All();

	$currentuser = Auth::user();
	
	$mypost = $currentuser->posts()->get();
	
	$friendlist = $currentuser->friendlist()->get();
	$friendlist2 = $currentuser->friendlist2()->get();

	return view('sns_final/comments',compact('posts','users','mypost','friendlist','friendlist2'));

});





Route::get('/logout', 'Auth\LoginController@logout');

