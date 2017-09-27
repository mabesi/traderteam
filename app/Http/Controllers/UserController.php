<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
  public function show(Request $request,$id)
  {
    $user = User::find($id);

    if ($user->profile!=Null){
      return redirect('profile/'.$user->profile->id);
    } else {
      return back()->with('problems',['O perfil do usuário não foi encontrado!']);
    }
  }

  public function users(Request $request,$userId=Array(),$follow=Null,$mainUser=Null)
  {
    $users = User::leftJoin('profiles','users.id','=','profiles.user_id');

    if (count($userId) > 0){
      $users->whereIn('users.id',$userId);
    }

    if ($request->has('sort')){
      $sort = $request->query('sort');
      $dir = $request->query('dir');
    } else {
      $sort = 'created_at';
      $dir = 'desc';
    }

    $users->withCount('strategies')
            ->withCount('operations')
            ->withCount('followers')
            ->orderBy($sort,$dir);

    if  ($request->has('search')){
      $search = $request->query('search');
      $users->where('name','like',"%$search%");
    }

    $totalUsers = $users->count();
    $users = $users->paginate(12);

    $newDir = ($dir=='asc'?'desc':'asc');

    if ($follow!=Null && $mainUser!=Null){

      if ($follow == "Seguindo"){
        $followLabel = getUserLine($mainUser).' está '.$follow;
      } elseif ($follow == "Seguidores") {
        $followLabel = $follow.' de '.getUserLine($mainUser);
      }
    } elseif ($follow!=Null){
      $followLabel = $follow;
      $user = Null;
    } else {
      $followLabel = "Geral";
      $user = Null;
    }

    $users->appends(['sort' => $sort,'dir' => $dir]);

    $data = [
      'totalUsers' => $totalUsers,
      'users' => $users,
      'sort' => $sort,
      'dir' => $dir,
      'newDir' => $newDir,
      'followLabel' => ' - '.$followLabel,
      'user' => $mainUser,
      'currentPage' => $users->url($users->currentPage()),
    ];

    //return 'Teste';
    return view('user.users',$data);
  }

  public function followers(Request $request,$id)
  {
    $userIds = getFollowersId($id);
    $user = User::find($id);
    return $this->users($request,$userIds,"Seguidores",$user);
  }

  public function following(Request $request,$id)
  {
    $userIds = getFollowingId($id);
    $user = User::find($id);
    return $this->users($request,$userIds,"Seguindo",$user);
  }

  public function myFollowers(Request $request)
  {
    $userId = getFollowersId();
    return $this->users($request,$userId,"Meus Seguidores");
  }

  public function myFollowing(Request $request)
  {
    $userId = getFollowingId();
    return $this->users($request,$userId,"Estou Seguindo");
  }

  public function follow($id)
  {
    Auth::user()->following()->attach($id);
    return back();
  }

  public function unfollow($id)
  {
    Auth::user()->following()->detach($id);
    return back();
  }

  public function lock($id)
  {
    $user = User::find($id);

    if (isAdmin()){
      if($user != Null){
        $user->locked = True;
        if ($user->save()){
          return back();
        } else {
          return back()->with('problems', ['Erro inesperado. O usuário não foi bloqueado!']);
        }
      }
    } else {
      return back()->with('problems', ['Acesso não permitido. O usuário não foi bloqueado!']);
    }
  }

  public function unlock($id)
  {
    $user = User::find($id);

    if (isAdmin()){
      if($user != Null){
        $user->locked = False;
        if ($user->save()){
          return back();
        } else {
          return back()->with('problems', ['Erro inesperado. O usuário não foi desbloqueado!']);
        }
      }
    } else {
      return back()->with('problems', ['Acesso não permitido. O usuário não foi desbloqueado!']);
    }
  }

  public function verifyUser()
  {
    $user = getUser();

    $data = [
      'user' => $user,
      'userId' => $user->id;
    ];

    Auth::logout();

    return view('verifyuser',$data);
  }

  public function confirmation($id,$token)
  {
    $user = User::find($id);
    $hashToken = Hash::make($user->name.$user->email);

    if (Hash::check($user->name.$user->email,hexToStr($token))){

      $data = [
        'user' => $user,
        'confirmation' => True,
      ];
      $user->confirmed = True;
      $user->save();

    } else {

      $data = [
        'user' => $user,
        'confirmation' => False,
      ];

    }

    return view('verifyuser',$data);
  }

  public function sendConfirmation($id)
  {
    $user = getUser($id);
    sendConfirmationEmail($user);
    return back()->with('informations',['O link de confirmação foi reenviado para o email cadastrado!']);
  }

  public function destroy($id)
  {
    $user = User::find($id);

    if (isAdmin()){

      $avatar = $user->avatar;
      $operationDirectory = 'operations/'.$id;

      try{

        if ($user->delete()){

          deleteAvatar($avatar);
          deleteDir($operationDirectory);

          $data = getMsgDeleteSuccess();

        } else {
          $data = getMsgDeleteError();
        }
      } catch (Exception $e){
        $data = getMsgDeleteException();
      }
    } else {
      $data = getMsgDeleteAccessForbidden();
    }
    return response()->json($data);
  }

  public function changePassword(Request $request,$id)
  {
    //$request->validate([
    //  'newpassword' => 'required|confirmed|min:8',
    //]);

    $user = User::find($id);

    if ($request->password==Null || $request->newpassword==Null || $request->newpassword_confirmation==Null){
      return back()->with('warnings', ['Por favor preencha todos os campos!']);
    } else {

      $password = $request->password;

      if (!Hash::check($password,Auth::user()->password)){
        return back()->with('problems', ['Senha atual incorreta!']);
      }

      $newpassword = $request->newpassword;
      $newpassword_confirmation = $request->newpassword_confirmation;

      if ($newpassword == $newpassword_confirmation){

        $user->password = Hash::make($newpassword);

        if (isAdmin() || $user->id == getUserId()){

          $user->save();
          return back()->with('informations', ['A senha foi alterada com sucesso!']);

        } else {
          return back()->with('problems', ['Falha ao alterar a senha. Acesso proibido!']);
        }

      } else {
        return back()->with('problems', ['A nova senha não confere com a confirmação!']);
      }
    }
  }

}
