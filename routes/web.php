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

//Route::get('/', function () {
  //return view('welcome');
  //return view('index');
//});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/terms', 'HomeController@terms')->name('terms');

Route::middleware('auth')->group(function(){
  Route::resource('profile', 'ProfileController');
  Route::resource('strategy', 'StrategyController');
  Route::resource('indicator', 'IndicatorController');
  Route::resource('operation', 'OperationController');
  Route::get('strategy-rules', 'StrategyController@rules');
  Route::get('operation-rules', 'OperationController@rules');
});
