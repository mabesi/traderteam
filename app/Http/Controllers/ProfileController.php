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
      $strategies = $user->strategies->sortBy('name')->take(10);
      $operations = $user->operations->sortByDesc('updated_at')->take(10);

      $data = [
        'viewname' => 'Meu Perfil',
        'viewtitle' => 'Meu Perfil',
        'user' => $user,
        'profile' => $profile,
        'strategies' => $strategies,
        'operations' => $operations,
        'profileView' => True,
      ];

      if ($data['profile']==Null){
        $data['warnings'] = ['Você ainda não criou o seu perfil. Aproveite para fazer isso agora...'];
        return view('profile.newprofile', $data);
      } else {
        return view('profile.profile', $data);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      return back();
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
      $userChanged = False;

      $user = User::find(getUserId());
      $avatarName = saveImage($request,'avatar','avatar',getUserId());
      if ($avatarName != false){
        $user->avatar = $avatarName;
        $userChanged = True;
      }

      if (isSuperAdmin() && $request->type){
        $user->type = $request->type;
        $userChanged = True;
      }

      if ((isAdmin() || $user->id == getUserId()) && $userChanged){
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

      $profile->city = special_ucwords($request->city);
      if (strlen($request->state)==2){
        $profile->state = strtoupper($request->state);
      } else {
        $profile->state = special_ucwords($request->state);
      }
      $profile->country = strtoupper($request->country);
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
      if ($id == 'edit'){
        return $this->modify();
      }

      $profile = Profile::find($id);
      $followingId = getFollowingId();
      //dd($followingId);
      $following = in_array($id,$followingId);

      if ($profile == Null){

        return redirect('/')->with('problems', ['O perfil informado não existe!']);

      } else {

        $user = $profile->user;
        $strategies = $user->strategies;
        $operations = $user->operations->take(12);

        $data = [
          'viewname' => 'Perfil',
          'viewtitle' => 'Perfil',
          'user' => $user,
          'profile' => $profile,
          'strategies' => $strategies,
          'operations' => $operations,
          'following' => $following,
          'profileView' => True,
        ];

        return view('profile.profile', $data);
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
      $profile = Profile::find($id);

      if (isAdmin() || $profile->user_id == getUserId()){

        $user = $profile->user;

        $data = [
          'viewname' => 'Editar Perfil',
          'viewtitle' => 'Editar Perfil',
          'user' => $user,
          'profile' => $profile,
          'profileView' => True,
        ];

        return view('profile.edit', $data);
      } else {
        return back()->with('warnings',['Acesso não autorizado!']);
      }
    }

    public function modify()
    {
        $profile = Profile::where('user_id', getUserId())->first();
        $user = User::find(getUserId());

        $data = [
          'viewname' => 'Editar Meu Perfil',
          'viewtitle' => 'Editar Meu Perfil',
          'user' => $user,
          'profile' => $profile,
          'profileView' => True,
        ];

        return view('profile.edit', $data);
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
      //$request->validate($profile->rules,$profile->messages);
      $request->validate($profile->rules);

      $userChanged = False;

      $user = User::find($profile->user->id);
      $avatarName = saveImage($request,'avatar','avatar',$user->id,getUserAvatarName($user),'default.png');

      if ($avatarName != false){
        $user->avatar = $avatarName;
        $userChanged = True;
      }

      if (isSuperAdmin() && $request->type){
        $user->type = $request->type;
        $userChanged = True;
      }

      if (isAdmin()){
        $user->confirmed = (boolean) $request->confirmed;
        $user->locked = (boolean) $request->locked;
        $userChanged = True;
      }

      if ((isAdmin() || $user->id == getUserId()) && $userChanged){
        $user->save();
      }

      $profile->occupation = special_ucwords($request->occupation);

      if ($request->mybirthdate) {
        $date = getMysqlDateFromBR($request->mybirthdate);
        $profile->birthdate = $date;
      } else {
        $profile->birthdate = Null;
      }

      $profile->city = special_ucwords($request->city);
      if (strlen($request->state)==2){
        $profile->state = strtoupper($request->state);
      } else {
        $profile->state = special_ucwords($request->state);
      }
      $profile->country = strtoupper($request->country);
      $profile->site = $request->site;
      $profile->facebook = $request->facebook;
      $profile->twitter = $request->twitter;
      $profile->description = $request->mydescription;

      if ($request->capital){
        $profile->capital = $request->capital;
      } else {
        $profile->capital = 100000.00;
      }

      if (isSuperAdmin()){
        $profile->cofounder = (boolean) $request->cofounder;
      }

      if ($profile->save()){
        return back()->with('informations', ['As informações foram atualizadas com sucesso!']);
      } else {
        return back()->with('problems', ['Erro ao salvar. As informações não foram atualizadas!']);
      }
    }

    public function configurations(Request $request, $id)
    {
      $profile = Profile::find($id);
      //$request->validate($profile->rules,$profile->messages);
      //$request->validate($profile->rules);

      $profile->sidebar_closed = (boolean) $request->sidebar_closed;

      if ($profile->save()){
        return back()->with('informations', ['As informações foram atualizadas com sucesso!']);
      } else {
        return back()->with('problems', ['Erro ao salvar. As informações não foram atualizadas!']);
      }
    }

    public function toogleSidebar(Request $request, $id)
    {
      $profile = Profile::find($id);
      //dd($profile);
      //$request->validate($profile->rules,$profile->messages);
      //$request->validate($profile->rules);

      if ($profile->user_id==getUserId()){

        $profile->sidebar_closed = !$profile->sidebar_closed;

        if ($profile->save()){
          return back();
        } else {
          return back()->with('problems', ['Erro ao alterar configuração. As informações não foram atualizadas!']);
        }

      } else {
        return back()->with('problems', ['Acesso não autorizado!']);
      }

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
