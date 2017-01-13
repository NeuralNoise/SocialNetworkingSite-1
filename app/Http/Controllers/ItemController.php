<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    function showItems(){
    
    	$all_items = \App\Item::All();
    	return view('item/item_list',compact('all_items'));
    }

     function showHome(){
    
    	$all_items = \App\Item::All();
    	// dd($all_items); 
    	// die & dump - display array
    	// dd($all_items[0]); 
    	return view('item/item_home',compact('all_items'));
    }

    function showItemDetails($id){
    	$item = \App\Item::find($id);
    	// dd($item);
    	return view('item/item_single_item',compact('item'));
        // return $id;
    }
}
