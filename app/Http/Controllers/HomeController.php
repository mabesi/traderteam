<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Operation;
use App\Notice;
use App\Configuration;

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

        $user = getUser();
        $data = [
          'user' => $user,
          'confirmation' => False,
        ];

        if (!$user->confirmed || $user->locked){
          Auth::logout();
          return view('verifyuser',$data);
        } else {
          return $this->userPanel();
        }

      } else {
        return view('home');
      }
    }

    public function userPanel()
    {
      $following = getFollowingId();

      //$users = Auth::user()->leftJoin('profiles','users.id','=','profiles.user_id')
        //            ->whereIn('users.id', $following)

      $users = Auth::user()->following->sortByDesc('rank');

      $test = $users->splice(10);

      //dd($users);

      $operationsFollowing = Operation::whereIn('user_id', $following)
                              ->orderBy('updated_at','desc')
                              ->take(12)
                              ->get();

      $operationsLiked = Auth::user()->operationsLiked()
                              ->orderBy('updated_at','desc')
                              ->take(12)
                              ->get();

      $newOperations = Operation::where('user_id',getUserId())
                              ->whereIn('status',['N','A'])
                              ->orderBy('updated_at','desc')
                              ->take(5)
                              ->get();

      $startedOperations = Operation::where('user_id',getUserId())
                              ->whereIn('status',['I','M'])
                              ->orderBy('updated_at','desc')
                              ->take(8)
                              ->get();

      $finishedOperations = Operation::where('user_id',getUserId())
                              ->whereIn('status',['S','E','T'])
                              ->orderBy('updated_at','desc')
                              ->take(5)
                              ->get();

      $notices = Notice::orderBy('updated_at','desc')
                              ->take(6)
                              ->get();

      $data = [
        'users' => $users,
        'operationsFollowing' => $operationsFollowing,
        'operationsLiked' => $operationsLiked,
        'newOperations' => $newOperations,
        'startedOperations' => $startedOperations,
        'finishedOperations' => $finishedOperations,
        'notices' => $notices,
        'user' => Auth::user(),
      ];

      return view('index',$data);
    }

    public function terms()
    {
      return view('terms');
    }

    public function contact()
    {
      return view('contact');
    }

    public function market()
    {
      return view('market');
    }

    public function help()
    {
      $helpUserPanel = Configuration::where('name','HELP_USER_PANEL')->first();
      $helpProfile = Configuration::where('name','HELP_PROFILE')->first();
      $helpIndicator = Configuration::where('name','HELP_INDICATOR')->first();
      $helpStrategy = Configuration::where('name','HELP_STRATEGY')->first();
      $helpOperation = Configuration::where('name','HELP_OPERATION')->first();

      $data = [
        'helpUserPanel' => $helpUserPanel,
        'helpProfile' => $helpProfile,
        'helpIndicator' => $helpIndicator,
        'helpStrategy' => $helpStrategy,
        'helpOperation' => $helpOperation,
        'viewname' => 'Ajuda',
        'viewtitle' => 'Ajuda',
      ];

      return view('help',$data);
    }

    public function search(Request $request)
    {
      $search = $request->q;

      $data = [
        'viewname' => 'Pesquisa',
        'viewtitle' => 'Pesquisa',
        'q' => $search,
      ];

      return view('search',$data);
    }
}
