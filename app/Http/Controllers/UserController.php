<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Html;
use App\User;
use Validator;
use Hash;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function show($username) {
    	$posts = DB::table('posts')->where('creator', $username)->get();
    	$user = DB::table('users')->where('name', $username)->first();
    	return view('profile')->with('user',$user)->with('posts',$posts);
    } 

    public function settings() {
    	return view('settings');
    }

    public function changepw(Request $request) {
    	
    	
    	$this->validate($request, [
        	'oldpw' => 'required|min:6',
        	'password' => 'required|min:6|confirmed',
    	]);
    	$oldpw = DB::table('users')->where('name', Auth::user()->name)->value('password');
    	if (Hash::check($request->input('oldpw'), $oldpw))
		{
			$newpw = Hash::make($request->password);
			DB::table('users')->where('name', Auth::user()->name)->update(array('password' => $newpw));
			$confirmpw = "Your password has been successfully changed.";
			return view('settings',compact('confirmpw'));
		} else {
    		$errorpw = "The old password is not correct.";
    		return view('settings',compact('errorpw'));
    	}
    }


    public function changemail(Request $request) {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'newemail' => 'required|email|confirmed',
    		]);
    	$oldem = DB::table('users')->where('name', Auth::user()->name)->value('email');
    	if($oldem != $request->input('email')) {
    		$errorem = "The old email is not correct.";
    		return view('settings',compact('errorem'));
    	} else {
    		DB::table('users')->where('name', Auth::user()->name)->update(array('email' => $request->input('newemail')));	
 			$confirmem = "Your email has been successfully changed.";
			return view('settings',compact('confirmem'));   		
    	}
    }
}
