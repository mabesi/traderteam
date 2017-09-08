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

        $following = getFollowingId();

        $users = Auth::user()->leftJoin('profiles','users.id','=','profiles.user_id')
                      ->whereIn('users.id', $following)
                      ->orderBy('rank','desc')
                      ->take(12)
                      ->get();

        $operations = Operation::whereIn('user_id', $following)
                                ->orderBy('updated_at','desc')
                                ->take(12)
                                ->get();

        $newOperations = Operation::where('user_id',getUserId())
                                ->whereIn('status',['N','A'])
                                ->orderBy('updated_at','desc')
                                ->take(8)
                                ->get();

        $startedOperations = Operation::where('user_id',getUserId())
                                ->whereIn('status',['I','M'])
                                ->orderBy('updated_at','desc')
                                ->take(8)
                                ->get();

        $finishedOperations = Operation::where('user_id',getUserId())
                                ->whereIn('status',['S','E','T'])
                                ->orderBy('updated_at','desc')
                                ->take(8)
                                ->get();

        $data = [
          'users' => $users,
          'operations' => $operations,
          'newOperations' => $newOperations,
          'startedOperations' => $startedOperations,
          'finishedOperations' => $finishedOperations,
          'user' => Auth::user(),
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
}
