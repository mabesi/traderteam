<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\User;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $profile = Profile::where('user_id', getUserId())->first();
      $user = User::find(getUserId());
      $strategies = $user->strategies;
      $operations = $user->operations;

      $data = [
        'viewname' => 'Meu Perfil',
        'viewtitle' => 'Meu Perfil',
        'user' => $user,
        'profile' => $profile,
        'strategies' => $strategies,
        'operations' => $operations,
      ];

      if ($data['profile']==Null){
        $data['warnings'] = ['Você ainda não criou o seu perfil. Aproveite para fazer isso agora...'];
        return view('newprofile', $data);
      } else {
        return view('profile', $data);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $profile = new Profile;

      $user = User::find(getUserId());
      $avatarName = saveImage($request,'avatar','avatar',getUserId());
      if ($avatarName != false){
        $user->avatar = $avatarName;
        $user->save();
      }

      $profile->user_id = getUserId();
      //Level: 1: Iniciante, 2: Operador, 3: Analista, 4: Estragetista, 5: Tubarão
      $profile->level = 1;
      $profile->enabled = true;

      $profile->occupation = $request->occupation;

      if ($request->mybirthdate) {
        $profile->birthdate = getMysqlDate($request->mybirthdate);
      }

      $profile->city = $request->city;
      $profile->state = $request->state;
      $profile->country = $request->country;
      $profile->site = $request->site;
      $profile->facebook = $request->facebook;
      $profile->twitter = $request->twitter;
      $profile->description = $request->mydescription;

      if ($request->capital){
        $profile->capital = $request->capital;
      }

      //Status: 0: , 1: , 2: , 3:
      $profile->status = 0;

      $profile->save();

      return redirect('profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $profile = Profile::where('user_id', $id)->first();

      if ($profile == Null){

        return redirect('/')->with('errors', ['O perfil informado não existe!']);

      } else {

        $user = $profile->user;
        $strategies = $user->strategies;
        $operations = $user->operations;

        $data = [
          'viewname' => 'Perfil',
          'viewtitle' => 'Perfil',
          'user' => $user,
          'profile' => $profile,
          'strategies' => $strategies,
          'operations' => $operations,
        ];

        return view('profile', $data);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $profile = Profile::find($id);
      $user = User::find($profile->user->id);
      $avatarName = saveImage($request,'avatar','avatar',getUserId(),getUserAvatarName(),'default.png');

      if ($avatarName != false){
        $user->avatar = $avatarName;
        $user->save();
      }

      $profile->occupation = $request->occupation;

      if ($request->mybirthdate) {
        $date = getMysqlDateFromBR($request->mybirthdate);
        $profile->birthdate = $date;
      }

      $profile->city = $request->city;
      $profile->state = $request->state;
      $profile->country = $request->country;
      $profile->site = $request->site;
      $profile->facebook = $request->facebook;
      $profile->twitter = $request->twitter;
      $profile->description = $request->mydescription;

      if ($request->capital){
        $profile->capital = $request->capital;
      }

      $profile->save();

      return redirect('profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
