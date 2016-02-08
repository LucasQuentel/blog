<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use DB;
use Config;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index() {
    	if(!in_array(Auth::user()->name, Config::get('global.admins'))) {
        	$posts = DB::table('posts')->orderBy('id', 'desc')->get();
        	$all = true;
        	return view('home', compact('posts'))->with('all',$all);
    	} else {
    		return view('admin.index');
    	}	
    }
}
