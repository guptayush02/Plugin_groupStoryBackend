<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', 'UserController@signUp');

Route::get('/login', 'UserController@login');

Route::get('/story_post', 'UserController@storyPost');

Route::get('/get_story', 'UserController@getStory');

Route::get('/story', 'UserController@story');