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

Route::auth();

Route::get('/home', ['as'=>'home','uses'=>'HomeController@index']);

Route::get('/crear',['as'=>'video.crear','middleware'=>'auth','uses'=>'VideoController@CreateVideo']);
Route::post('/procesar',['as'=>'video.save','middleware'=>'auth','uses'=>'VideoController@saveVideo']);
Route::get('/miniatura/{filename}',['as'=>'imageVideo','uses'=>'VideoController@getImagen']);
Route::get('video/{id}','VideoController@getVideoPage')->name('video.details');
Route::get('/videofile/{filename}','VideoController@getVideo');
Route::get('/video/delete/{id}',['as'=>'deleteVideo','middleware'=>'auth','uses'=>'VideoController@delete']);
Route::post('/comment',['as'=>'comment','middleware'=>'auth','uses'=>'CommentController@store']);
Route::get('/delete/{id}',['as'=>'delete','middleware'=>'auth','uses'=>'CommentController@delete']);
//editar video
Route::get('/edit/{id}',['as'=>'edit','middleware'=>'auth','uses'=>'VideoController@edit']);
Route::post('update/{id}',['as'=>'update','middleware'=>'auth','uses'=>'VideoController@update']);
