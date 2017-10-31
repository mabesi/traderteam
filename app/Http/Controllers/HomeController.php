<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Profile;
use App\Indicator;
use App\Strategy;
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
        $this->middleware('auth')->except('index','index2','terms','contact','sendContact');
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
        //return view('home');
        return view('frontend.index');
      }
    }

    public function index2()
    {
      return view('home');
    }

    public function userPanel()
    {
      $following = getFollowingId();

      $users = Auth::user()->following->sortByDesc('rank');

      $test = $users->splice(10);

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

    public function sendContact(Request $request)
    {
      $request->validate([
        'name' => 'required|string|min:3|max:100',
        'email_contact' => 'required|email|max:60',
        'message' => 'required|string|min:10|max:1000',
        'captcha' => 'required|captcha'
      ],[
        'captcha.captcha' => 'Validação do captcha incorreta!',
      ]);

      $name = $request->name;
      $email = $request->email_contact;
      $message = $request->message;

      $to = getAdminEmails();

      if (sendContactEmail($to,$email,$name,$message)){
        return back()->with('informations',['Sua mensagem foi enviada com sucesso!']);
      } else {
        return back()->with('problems',['Ocorreu um erro ao enviar a mensagem!']);
      }
    }

    public function market()
    {
      return view('market');
    }

    public function metatrader()
    {
      return view('metatrader');
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
      $search = trim($request->q);

      if (strlen($search) < 3){

        $request->session()->flash('warnings',['Para a maior parte dos itens o termo de busca deve conter pelo menos 3 caracteres']);

        $indicators = Indicator::where('acronym',$search)
                                ->get();

        $users = [];
        $profiles = [];
        $strategies = [];
        $notices = [];

      } else {

        $indicators = Indicator::where('acronym',$search)
                                ->orWhere('name','like',"%$search%")
                                ->get();

        $users = User::where('name','like',"%$search%")
                      ->orWhere('email',$search)
                      ->get();

        $profiles = Profile::where('occupation','like',"%$search%")
                            ->orWhere('city',$search)
                            ->get();

        $strategies = Strategy::where('title','like',"%$search%")
                              ->get();

        if (isAdmin()){
          $notices = Notice::where('title','like',"%$search%")->get();
        } else {
          $notices = Notice::where('title','like',"%$search%")
                            ->where('onlyadmin',False)->get();
        }
      }


      $data = [
        'viewname' => 'Pesquisa',
        'viewtitle' => 'Pesquisa',
        'q' => $search,
        'users' => $users,
        'profiles' => $profiles,
        'indicators' => $indicators,
        'strategies' => $strategies,
        'notices' => $notices,
      ];

      return view('search.search',$data);
    }
}
