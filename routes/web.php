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

  Route::get('market', 'HomeController@market')->name('market');

  Route::resource('profile', 'ProfileController');
  Route::resource('strategy', 'StrategyController');
  Route::resource('indicator', 'IndicatorController');
  Route::resource('operation', 'OperationController');

  Route::get('strategy-rules', 'StrategyController@rules');
  Route::get('strategy-statistics', 'StrategyController@statistics');
  Route::get('mystrategies', 'StrategyController@mystrategies');
  Route::get('beststrategies', 'StrategyController@best');
  Route::get('strategies/following', 'StrategyController@following');
  Route::get('strategies/user/{id}', 'StrategyController@user');

  Route::get('myoperations', 'OperationController@myoperations');
  Route::get('operations/following', 'OperationController@following');
  Route::get('operations/user/{id}', 'OperationController@user');
  Route::get('operation-rules', 'OperationController@rules');

  Route::get('users', 'UserController@users')->name('users');
  Route::delete('user/{id}', 'UserController@destroy');
  Route::get('user/{id}/followers', 'UserController@followers')->name('followers');
  Route::get('user/{id}/following', 'UserController@following')->name('following');
  Route::get('user/{id}/follow', 'UserController@follow')->name('follow');
  Route::get('user/{id}/unfollow', 'UserController@unfollow')->name('unfollow');
  Route::get('user/{id}/lock', 'UserController@lock')->name('lock');
  Route::get('user/{id}/unlock', 'UserController@unlock')->name('unlock');
  Route::get('user/myfollowers', 'UserController@myFollowers')->name('myfollowers');
  Route::get('user/following', 'UserController@myFollowing')->name('myfollowing');
  Route::post('user/{id}/changepassword', 'UserController@changePassword')->name('changepassword');
});
