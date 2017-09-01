<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Operation;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (Auth::check()) {

        $users = User::take(12)->get();
        $operations = Operation::orderBy('updated_at','desc')->take(10)->get();

        $data = [
          'users' => $users,
          'operations' => $operations,
        ];

        return view('index',$data);

      } else {

        return view('home');

      }
    }

    public function terms()
    {
      return view('terms');
    }

    public function market()
    {
      return view('market');
    }

    public function user(Request $request)
    {
      $totalUsers = User::count();

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

      if  ($request->has('search')){
        $search = $request->query('search');
        $users = $users->where('name','like',"%$search%");
      }

      $users = $users->paginate(12);

      //dd($sort);
      $newDir = ($dir=='asc'?'desc':'asc');

      $data = [
        'totalUsers' => $totalUsers,
        'users' => $users,
        'sort' => $sort,
        'dir' => $dir,
        'newDir' => $newDir,
      ];

      //return 'Teste';
      return view('user.users',$data);
    }

}
