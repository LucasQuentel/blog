<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function publish(Request $request) {
    	$this->validate($request, [
        	'title' => 'required|unique:posts|max:255',
        	'textarea' => 'required',
    	]);

    	DB::table('posts')->insert(
    		['title'     => $request->input('title'),
     		'post'       => $request->input('textarea'),
     		'creator'    => Auth::user()->name,
     		'comments'   => 0,
     		'created_at' => date("Y-m-d H:i:s"),
     		'updated_at' => date("Y-m-d H:i:s")]);

    	$posts = DB::table('posts')->orderBy('id', 'desc')->get();
        return view('home', compact('posts'));
    }   
}
