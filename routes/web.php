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
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::post('/contact', 'HomeController@sendContact');
Route::get('user/verify', 'UserController@verifyUser')->middleware('auth');
Route::get('user/{id}/send-confirmation', 'UserController@sendConfirmation');
Route::get('user/{id}/confirmation/{token}', 'UserController@confirmation');

Route::get('testmail', function () {

  $user = getUser();
  if (sendConfirmationEmail($user)){
    return 'Confirmação enviada com sucesso!';
  } else {
    return 'Erro ao enviar confirmação';
  }

});

Route::get('sendmail', function () {
    $data = array(
        'name' => "TraderTeam",
    );
    Mail::send('emails.welcome', $data, function ($message) {
        $message->from('pliniomabesi@gmail.com', 'Plinio TraderTeam');
        $message->to(['pliniomabesi@gmail.com','pliniombs@yahoo.com.br','helberbgs@hotmail.com','fredms_av@yahoo.com.br'])
                ->subject('Teste de envio de email do site TraderTeam');
    });
    return "O email foi enviado com sucesso";
});

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
  Route::get('operation/{id}/like', 'OperationController@like');
  Route::get('operation/{id}/dislike', 'OperationController@dislike');
  Route::post('operation/{id}/addcomment', 'OperationController@addComment');
  Route::delete('comment/{id}', 'OperationController@removeComment');
  Route::post('comment/{id}/addanswer', 'OperationController@addAnswer');
  Route::delete('answer/{id}', 'OperationController@removeAnswer');

  Route::get('users', 'UserController@users')->name('users');
  Route::delete('user/{id}', 'UserController@destroy');
  Route::get('user/{id}/followers', 'UserController@followers')->name('followers');
  Route::get('user/{id}/following', 'UserController@following')->name('following');
  Route::get('user/{id}/follow', 'UserController@follow');
  Route::get('user/{id}/unfollow', 'UserController@unfollow');
  Route::get('user/{id}/lock', 'UserController@lock')->name('lock');
  Route::get('user/{id}/unlock', 'UserController@unlock')->name('unlock');
  Route::get('user/myfollowers', 'UserController@myFollowers')->name('myfollowers');
  Route::get('user/following', 'UserController@myFollowing')->name('myfollowing');
  Route::post('user/{id}/changepassword', 'UserController@changePassword');

  Route::post('profile/{id}/configurations', 'ProfileController@configurations');
  Route::get('profile/{id}/toogle-sidebar', 'ProfileController@toogleSidebar');
});
