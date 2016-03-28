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

Route::group(['middleware' => ['web']], function () {

//    Route::get('/', function () {
//        return view('welcome');
//    });

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', [
       'uses' => 'HomeController@index',
       'as' => 'home',
    ]);
    Route::get('register/confirm/{confirm_code}', 'Auth\AuthController@confirmEmail');

    Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('candidate/create', [
        'uses' => 'CandidateController@create',
        'as' => 'candidate.create',
    ]);
    Route::post('candidate', [
        'uses' => 'CandidateController@store',
        'as' => 'candidate.store',
    ]);
    Route::get('candidate/{id}', [
        'uses' => 'CandidateController@show',
        'as' => 'candidate.show',
    ]);
    Route::get('search', [
        'uses' => 'SearchController@results',
        'as' => 'search.results',
    ]);

    Route::post('comment', [
        'uses' => 'CommentController@store',
        'as' => 'search.results',
        'middleware' => 'auth'
    ]);



});
