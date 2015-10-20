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
    Route::get('/{id}',     ['as'=>'client.show',    'uses'=>'ClientController@show']);
    Route::post('/',        ['as'=>'client.store',   'uses'=>'ClientController@store']);
    Route::put('/{id}',     ['as'=>'client.update',  'uses'=>'ClientController@update']);
    Route::delete('/{id}',  ['as'=>'client.destroy', 'uses'=>'ClientController@destroy']);
});


Route::group(['prefix'=>'project'], function(){

    Route::get('/{id}/note',              ['as'=>'project.index',   'uses'=>'ProjectNoteController@index']);
    Route::get('/{id}/note/{noteId}',     ['as'=>'project.show',    'uses'=>'ProjectNoteController@show']);
    Route::post('/{id}/note',             ['as'=>'project.store',   'uses'=>'ProjectNoteController@store']);
    Route::put('/{id}/note/{noteId}',     ['as'=>'project.update',  'uses'=>'ProjectNoteController@update']);
    Route::delete('/{id}/note/{noteId}',  ['as'=>'project.destroy', 'uses'=>'ProjectNoteController@destroy']);

    Route::get('/{id}/task',              ['as'=>'project.index',   'uses'=>'ProjectTaskController@index']);
    Route::get('/{id}/task/{taskId}',     ['as'=>'project.show',    'uses'=>'ProjectTaskController@show']);
    Route::post('/{id}/task',             ['as'=>'project.store',   'uses'=>'ProjectTaskController@store']);
    Route::put('/{id}/task/{taskId}',     ['as'=>'project.update',  'uses'=>'ProjectTaskController@update']);
    Route::delete('/{id}/task/{taskId}',  ['as'=>'project.destroy', 'uses'=>'ProjectTaskController@destroy']);

    Route::get('/{id}/members',           ['as'=>'project.members', 'uses'=>'ProjectController@members']);

    Route::get('/',         ['as'=>'project.index',   'uses'=>'ProjectController@index']);
    Route::get('/{id}',     ['as'=>'project.show',    'uses'=>'ProjectController@show']);
    Route::post('/',        ['as'=>'project.store',   'uses'=>'ProjectController@store']);
    Route::put('/{id}',     ['as'=>'project.update',  'uses'=>'ProjectController@update']);
    Route::delete('/{id}',  ['as'=>'project.destroy', 'uses'=>'ProjectController@destroy']);
});


