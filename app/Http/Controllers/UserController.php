<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($id) {
    	$user = DB::table('users')->where('id',$id)->first();
    	$posts = DB::table('posts')->where('creator', $user->name)->get();
    	return view('profile')->with('user',$user)->with('posts',$posts);
    } 
}
