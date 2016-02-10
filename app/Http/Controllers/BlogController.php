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


    public function show($id) {
        $posts = DB::table('posts')->where('id', $id)->first();
        $comments = DB::table('comments')->where('postID', $id)->orderBy('id', 'desc')->get();
        return view('blog')->with('posts',$posts)->with('comments',$comments);
    }

    public function comment($id, Request $request) {
        $this->validate($request, [
            'textarea' => 'required',
        ]);

        DB::table('comments')->insert(
            ['postID'     => $id, 
             'comment'    => $request->input('textarea'), 
             'creator'    => Auth::user()->name,
             'created_at' => date("Y-m-d H:i:s"),
             'updated_at' => date("Y-m-d H:i:s")]);

        DB::table('posts')->where('id',$id)->increment('comments');
        $posts = DB::table('posts')->where('id', $id)->first();
        $comments = DB::table('comments')->where('postID', $id)->orderBy('id', 'desc')->get();
        return view('blog')->with('posts',$posts)->with('comments',$comments);
    }

    public function delete($id) {
        $posts = DB::table('posts')->where('id', $id)->first();   
        if(Auth::user()->name == $posts->creator) {
            DB::table('posts')->where('id',$id)->delete();           
        } 
        $all = true;
        $posts = DB::table('posts')->orderBy('id', 'desc')->get();
        return view('home', compact('posts'))->with('all',$all);
    }

    public function deletecom($id) {
        $com = DB::table('comments')->where('id',$id)->first();
        $pid = $com->postID;
        if(Auth::user()->name == $com->creator) {
            DB::table('posts')->where('id',$com->postID)->decrement('comments');            
            DB::table('comments')->where('id',$id)->delete();
        }
        $posts = DB::table('posts')->where('id', $pid)->first();
        $comments = DB::table('comments')->where('postID', $pid)->orderBy('id', 'desc')->get();
        return view('blog')->with('posts',$posts)->with('comments',$comments);
    }
}
