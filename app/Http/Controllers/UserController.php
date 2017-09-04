<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserController extends Controller
{

  public function users(Request $request)
  {
    //$totalUsers = User::count();

    if ($request->has('sort')){
      $sort = $request->query('sort');
      $dir = $request->query('dir');
    } else {
      $sort = 'name';
      $dir = 'asc';
    }

    //dd($sort);
    //$users = User::withCount('operations')->orderBy('operations_count','desc')->paginate(12);
    $users = User::leftJoin('profiles','users.id','=','profiles.user_id')
                  ->withCount('strategies')
                  ->withCount('operations')
                  ->withCount('followers')
                  ->orderBy($sort,$dir);

    if ($request->has('follow')){

      $follow = $request->query('follow');

      if ($follow == 'followers'){
        $followId = getFollowersId();
      } elseif ($follow == 'following'){
        $followId = getFollowingId();
      } else {
        $followId = Null;
      }
      if ($followId != Null){
        $users->whereIn('users.id', $followId);
      }
    } else {
      $follow = Null;
    }

    if  ($request->has('search')){
      $search = $request->query('search');
      $users->where('name','like',"%$search%");
    }

    $totalUsers = $users->count();
    $users = $users->paginate(12);

    //dd($sort);
    $newDir = ($dir=='asc'?'desc':'asc');

    $data = [
      'totalUsers' => $totalUsers,
      'users' => $users,
      'sort' => $sort,
      'dir' => $dir,
      'newDir' => $newDir,
      'follow' => $follow,
    ];

    //return 'Teste';
    return view('user.users',$data);
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

}
