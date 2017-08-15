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

//Route::middleware('auth')->group(function(){});

//Route::get('/profile', 'ProfileController@index')->middleware('auth');

Route::resource('profile', 'ProfileController');
Route::resource('strategy', 'StrategyController');
