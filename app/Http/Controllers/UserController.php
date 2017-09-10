<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{

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

    if($user != Null){
      $user->locked = True;
      $user->save();
    }

    return back();
  }

  public function unlock($id)
  {
    $user = User::find($id);

    if($user != Null){
      $user->locked = False;
      $user->save();
    }

    return back();
  }

  public function destroy($id)
  {
    $user = User::find($id);

    if (isAdmin()){
      if ($user->delete()){
        $data = getMsgDeleteSuccess();
      } else {
        $data = getMsgDeleteError();
      }
    } else {
      $data = getMsgAccessForbidden();
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

      //dd($password.' - '.bcrypt($password).' - '.Auth::user()->password);
      //dd(Hash::make($password).' - '.Auth::user()->password);

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
