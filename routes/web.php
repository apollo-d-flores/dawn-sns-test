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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//=====ログアウト中のページ=====
Route::get('/login', 'Auth\LoginController@login')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');

//======ログアウト======
Route::get('/logout', 'Auth\LoginController@logout');

//======ログイン中のページ=======
//top
Route::get('/top', 'PostsController@index');
Route::post('/post/create', 'PostsController@post_add');
Route::post('/post/edit', 'PostsController@post_edit');
Route::get('/post/delete/{id}', 'PostsController@post_delete');

//profile
Route::get('/profile', 'UsersController@profile');
Route::post('/profile/edit', 'UsersController@edit');

//search
Route::get('/search', 'UsersController@search');
Route::get('/search/result', 'UsersController@result');
Route::post('/search/result', 'UsersController@result');

//follow,follower
Route::get('/follow-list', 'FollowsController@followList');
Route::get('/follower-list', 'FollowsController@followerList');
Route::get('/other/profile/{id}', 'UsersController@otherUser');

Route::post('/follow/create', 'FollowsController@create');
Route::post('/follow/delete', 'FollowsController@delete');
