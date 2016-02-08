<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = DB::table('posts')->orderBy('id', 'desc')->get();
        $all = true;
        return view('home', compact('posts'))->with('all',$all);
    }


    public function me() {
        $posts = DB::table('posts')->where('creator', Auth::user()->name)->orderBy('id','desc')->get();
        $all = false;
        return view('home', compact('posts'))->with('all',$all);
    }
}
