<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

  public function users(Request $request,$userId=Array(),$follow=Null,$user=Null)
  {
    //$totalUsers = User::count();
    //$
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

    //dd($sort);
    //$users = User::withCount('operations')->orderBy('operations_count','desc')->paginate(12);
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

    //dd($sort);
    $newDir = ($dir=='asc'?'desc':'asc');

    if ($follow!=Null && $user!=Null){

      $followLabel = $follow;

    } else {
      $followLabel = '';
      $user = Null;
    }

    $users->appends(['sort' => $sort,'dir' => $dir]);

    $data = [
      'totalUsers' => $totalUsers,
      'users' => $users,
      'sort' => $sort,
      'dir' => $dir,
      'newDir' => $newDir,
      'followLabel' => $followLabel,
      'user' => $user,
      'currentPage' => $users->url($users->currentPage()),
    ];

    //return 'Teste';
    return view('user.users',$data);
  }

  public function followers(Request $request,$id)
  {
    $userId = getFollowersId($id);
    $user = User::find($userId);
    return $this->users($request,$userId,"Seguidores",$user);
  }

  public function following(Request $request,$id)
  {
    $userId = getFollowingId($id);
    $user = User::find($userId);
    return $this->users($request,$userId,"Seguindo",$user);
  }

  public function myFollowers(Request $request)
  {
    $userId = getFollowersId();
    return $this->users($request,$userId,"Meus Seguidores");
  }

  public function myFollowing(Request $request)
  {
    $userId = getFollowingId();
    return $this->users($request,$userId,"Me Seguindo");
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

}
