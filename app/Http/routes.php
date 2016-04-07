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
//use \Auth;

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
        'middleware' => ['auth', 'confirmed']
    ]);

    Route::post('candidate', [
        'uses' => 'CandidateController@store',
        'as' => 'candidate.store',
        'middleware' => ['auth', 'confirmed']
    ]);
    Route::get('candidate/{id}', [
        'uses' => 'CandidateController@show',
        'as' => 'candidate.show',
        'middleware' => ['confirmed']
    ]);
    Route::get('search', [
        'uses' => 'SearchController@results',
        'as' => 'search.results',
    ]);

    Route::post('comment', [
        'uses' => 'CommentController@store',
        'as' => 'search.results',
        'middleware' => ['auth', 'confirmed']
    ]);




    Route::get('home', function(){
        if (Auth::check() && Auth::user()->confirmed == 1){
            $app = app();
            $controller = $app->make('App\Http\Controllers\CandidateController');
            return $controller->callAction('show', $parameters = [Auth::user()->id]);
        }else{
            return redirect()->route('home');
        }
    });





//    admin
//    routes
    Route::group(['prefix' => 'admin',
        'middleware' => 'auth'
    ], function(){

        Route::get('/', [
            'uses' => 'AdminController@index',
            'as' => 'admin.main',

        ]);

        Route::get('/users', [
            'uses' => 'AdminController@getUsersList',
            'as' => 'admin.users',
        ]);

        Route::get('user/{id}', [
            'uses' => 'AdminController@user',
            'as' => 'admin.user',

        ]);

        Route::get('comments', [
            'uses' => 'AdminController@getTable',
            'as' => 'admin.comments',
        ]);

        Route::post('comment/change', [
            'uses' => 'AdminController@postCommentStatus',
            'as' => 'admin.comment.change',
        ]);

        Route::post('user/change', [
            'uses' => 'AdminController@postUserRole',
            'as' => 'admin.user.change',
        ]);

        Route::post('test', function(){
            return "WORKS";
        });





    });










});
