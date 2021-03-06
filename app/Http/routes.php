<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	$posts = DB::table('posts')->orderBy('id', 'desc')->get();
    return view('welcome', compact('posts'));
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();


    //GET Routes
    Route::get('/home', 'HomeController@index');   
    Route::get('/home/me','HomeController@me');
    Route::get('/post/{id}','BlogController@show');
    Route::get('/post/{id}/delete','BlogController@delete');
    Route::get('/comment/{id}/delete','BlogController@deletecom');
    Route::get('/profile/{username}','UserController@show');
    Route::get('/admin','AdminController@index');
    Route::get('/settings', 'UserController@settings');
    //POST Routes
    Route::post('/home/publish','BlogController@publish');
    Route::post('/post/comment/{id}','BlogController@comment');
    Route::post('/settings/update/password', 'UserController@changepw');
    Route::post('/settings/update/email', 'UserController@changemail');

});
