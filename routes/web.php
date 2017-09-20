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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/index2', 'HomeController@index2');

Route::get('/terms', 'HomeController@terms')->name('terms');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@sendContact');
Route::get('user/verify', 'UserController@verifyUser')->middleware('auth');
Route::get('user/{id}/send-confirmation', 'UserController@sendConfirmation');
Route::get('user/{id}/confirmation/{token}', 'UserController@confirmation');

Route::middleware(['auth','VerifyUser'])->group(function(){

  Route::get('market', 'HomeController@market')->name('market');
  Route::get('help', 'HomeController@help')->name('help');
  Route::get('search', 'HomeController@search')->name('search');

  Route::resource('profile', 'ProfileController');
  Route::resource('strategy', 'StrategyController');
  Route::resource('indicator', 'IndicatorController');
  Route::resource('operation', 'OperationController');
  Route::resource('notice', 'NoticeController');
  Route::resource('configuration', 'ConfigurationController');
  Route::resource('report', 'ReportController');

  Route::get('strategy-rules', 'StrategyController@rules');
  Route::get('strategy-statistics', 'StrategyController@statistics');
  Route::get('mystrategies', 'StrategyController@mystrategies');
  Route::get('beststrategies', 'StrategyController@best');
  Route::get('strategies/following', 'StrategyController@following');
  Route::get('strategies/user/{id}', 'StrategyController@user');

  Route::get('myoperations', 'OperationController@myoperations');
  Route::get('operations/following', 'OperationController@following');
  Route::get('operations/liked', 'OperationController@liked');
  Route::get('operations/user/{id}', 'OperationController@user');
  Route::get('operation-rules', 'OperationController@rules');
  // Like nas Operações
  Route::get('operation/{id}/like', 'OperationController@like');
  Route::get('operation/{id}/dislike', 'OperationController@dislike');
  // Comentários de Operações
  Route::post('operation/{id}/addcomment', 'OperationController@addComment');
  Route::delete('comment/{id}', 'OperationController@removeComment');
  Route::post('comment/{id}/addanswer', 'OperationController@addAnswer');
  Route::delete('answer/{id}', 'OperationController@removeAnswer');

  Route::get('users', 'UserController@users')->name('users');
  Route::delete('user/{id}', 'UserController@destroy');
  // Seguir - Deixar de Seguir - Seguindo Usuários
  Route::get('user/{id}/follow', 'UserController@follow');
  Route::get('user/{id}/unfollow', 'UserController@unfollow');
  Route::get('user/{id}/followers', 'UserController@followers');
  Route::get('user/{id}/following', 'UserController@following');
  Route::get('user/myfollowers', 'UserController@myFollowers')->name('myfollowers');
  Route::get('user/following', 'UserController@myFollowing')->name('myfollowing');
  // Bloqueio - Liberação de Usuários
  Route::get('user/{id}/lock', 'UserController@lock');
  Route::get('user/{id}/unlock', 'UserController@unlock');
  // Denúncia
  Route::get('user/{id}/report', 'ReportController@userReport');
  // Alteração de Senha
  Route::post('user/{id}/changepassword', 'UserController@changePassword');

  Route::post('profile/{id}/configurations', 'ProfileController@configurations');
  Route::get('profile/{id}/toogle-sidebar', 'ProfileController@toogleSidebar');
});
