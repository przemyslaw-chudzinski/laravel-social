<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['auth']],function(){
  Route::resource('/users','UsersController',['except' => ['index','store','create']]);
  Route::post('/friends/{id}','FriendsController@invite');
  Route::patch('/friends/{id}','FriendsController@accept');
  Route::delete('/friends/{id}','FriendsController@destroy');
  Route::get('/users/{id}/friends','FriendsController@index');
  Route::get('/search','SearchController@users');
  Route::resource('/posts','PostsController',['except' => ['index','show','create']]);
  Route::get('/wall','WallsController@index');
  Route::resource('/comments','CommentsController',['except' => ['index','create','show']]);
  Route::post('/likes','LikesController@add');
  Route::delete('/likes','LikesController@destroy');
  Route::get('/notifications','NotificationsController@index');
  Route::patch('/notifications/{id}','NotificationsController@update');
});
