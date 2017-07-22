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

Route::get('/home', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index');

Route::group(['prefix'=>'admin','middleware'=>['auth','role:admin']],function(){
  //Route Diisi disini....
  Route::resource('konsumens', 'KonsumensController');
  Route::resource('furniturs', 'FurnitursController');
});
