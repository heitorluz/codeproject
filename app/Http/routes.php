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

Route::group(['prefix'=>'client'], function(){
    Route::get('/',         ['as'=>'client.index',   'uses'=>'ClientController@index']);
    Route::get('/{id}',     ['as'=>'client.show',    'uses'=>'ProjectController@client']);
    Route::post('/',        ['as'=>'client.store',   'uses'=>'ClientController@store']);
    Route::put('/{id}',     ['as'=>'client.update',  'uses'=>'ClientController@update']);
    Route::delete('/{id}',  ['as'=>'client.destroy', 'uses'=>'ClientController@destroy']);
});


Route::group(['prefix'=>'project'], function(){
    Route::get('/',         ['as'=>'project.index',   'uses'=>'ProjectController@index']);
    Route::get('/{id}',     ['as'=>'project.show',    'uses'=>'ProjectController@show']);
    Route::post('/',        ['as'=>'project.store',   'uses'=>'ProjectController@store']);
    Route::put('/{id}',     ['as'=>'project.update',  'uses'=>'ProjectController@update']);
    Route::delete('/{id}',  ['as'=>'project.destroy', 'uses'=>'ProjectController@destroy']);
});


