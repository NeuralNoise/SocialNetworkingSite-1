<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticlesController extends Controller
{		
    function showArticles(Request $request){
    	// $article1 = \App\Article::find(1);
    	// $article2 = \App\Article::find(2);
        // $all_articles = \App\Article::All();
    	// $categories= array('cat1','cat2','cat3');
    	// return view('articles/article_list',compact('article1','article2','all_articles','categories'));

        // return 'function showArticles';
           // dd($all_articles);
        $all_articles = \App\Article::All();
        $preference = $request -> session() -> get('preference_select', 'default_preference'); //preference_select-> name of select box
        return view('articles/article_home',compact('all_articles','preference'));
    }

    function setPreference(Request $request){
        $preference = $request -> get('preference_select');
        $request -> session()->put('preference_select',$preference);
        return redirect('articles');
        // return "you set preference to $preference";
    }

    function showArticlesLayout(){
    	return view('articles/article_list');
    }
    
    function showSingleArticle($id){
        $article = \App\Article::find($id);
        return view('articles/single_article',compact('article'));
    }

    function create(){
        return view('articles/article_new');
    }

    function store(Request $request){
        $title = $request->title;
        $content = $request->content;
        // dd($request);

        $rules=array(
            'title' => 'required| min:3 | max:10 |alpha_num',
            'content' =>'required');
        $this->validate($request,$rules);

        //store to database
        $article_obj = new \App\Article();
        $article_obj -> title = $title;
        $article_obj -> content = $content;
        $article_obj -> save();
        return redirect('articles');
    }

    function deleteArticle($id){
        $article_to_delete = \App\Article::find($id);
        $article_to_delete ->delete();
        return redirect('articles');
    }


}

