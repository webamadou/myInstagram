<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'ProfilesController@index')->name('home');

//Route::get('/', "HomeController@index")->name('root');
Auth::routes();

Route::get('/home', 'ProfilesController@index')->name('home');
Route::resource('profiles', 'ProfilesController');
Route::post('follow/{user}', 'FollowsController@store');
Route::resource('posts', 'PostsController');
Route::resource('comments', 'CommentsController');
//Route::get('profile/{user}', '')
