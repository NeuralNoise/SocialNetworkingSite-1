<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GoodluckController extends Controller
{
    function showGoodluck(){
    	return view('goodluck');
    }
}
