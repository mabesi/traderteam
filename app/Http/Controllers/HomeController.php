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

        $users = User::take(10)->get();
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
    public function user()
    {
      $users = User::paginate(10);

      $data = [
        'users' => $users,
      ];

      return view('user.users',$data);
    }

}
