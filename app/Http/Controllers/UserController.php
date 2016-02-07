<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($username) {
    	$posts = DB::table('posts')->where('creator', $username)->get();
    	$user = DB::table('users')->where('name', $username)->first();
    	return view('profile')->with('user',$user)->with('posts',$posts);
    } 
}
