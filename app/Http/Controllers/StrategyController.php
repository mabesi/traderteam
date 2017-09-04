<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Strategy;

class StrategyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $user = User::find(getUserId());
      $strategies = $user->strategies;

      $data = [
        'viewname' => 'Minhas Estratégias',
        'viewtitle' => 'Minhas Estratégias',
        'strategies' => $strategies,
        'errors' => null,
      ];

        return view('strategy.mystrategies', $data);
    }

    public function strategies($request,$userId=Array(),$owner="Todas")
    {
      //dd(Strategy::first()->indicators);

      if (count($userId) > 0){
        $strategies = Strategy::whereIn('user_id',$userId);
      }

      $title = $request->query('title');
      $indicator = $request->query('indicator');

      $where = Array();

      if ($title != Null){
        $strategies->where('title','like',"%$title%");
      }

      //dd($where);

      //User::leftJoin('indicators','users.id','=','profiles.user_id')

      $strategies = $strategies->where($where)
                                ->orderBy('title','asc')
                                ->paginate(5);

      $where['title'] = $title;

      $data = [
        'viewname' => 'Lista de Estratégias ('.$owner.')',
        'viewtitle' => 'Lista de Estratégias ('.$owner.')',
        'strategies' => $strategies,
        'where' => $where,
        'path' => $request->path(),
        'profileView' => False,
      ];

      return view('strategy.strategies', $data);
    }

    public function mystrategies(Request $request)
    {
      $userId[] = getUserId();
      return $this->strategies($request,$userId,"Minhas Estratégias");
    }

    public function beststrategies(Request $request)
    {
      //$userId[] = getUserId();
      //return $this->strategies($request,$userId,"Minhas Estratégias");
      return "Melhores Estratégias";
    }

    public function following(Request $request)
    {
      $userId = getFollowingId();
      //dd($userId);
      return $this->strategies($request,$userId,"Seguindo");
    }

    public function user(Request $request,$id)
    {
      $userId[] = $id;
      return $this->strategies($request,$userId,"Usuário");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
        'viewname' => 'Nova Estratégia',
        'viewtitle' => 'Nova Estratégia',
        'errors' => null,
        'indicators' => $this->indicators,
      ];

      sort($data['indicators']);

      return view('strategy', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $strategy = new Strategy;

      $strategy->user_id = getUserId();
      $strategy->title = $request->title;
      $strategy->description = $request->description;
      $strategy->indicators = implode(',',$request->indicators);

      $strategy->save();

      return redirect('strategy/'.$strategy->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $strategy = Strategy::find($id);

      $data = [
        'viewname' => 'Estratégia',
        'viewtitle' => 'Estratégia',
        'errors' => null,
        'indicators' => $this->indicators,
        'strategy' => $strategy,
      ];

      sort($data['indicators']);

      return view('strategy', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
      $strategy = Strategy::find($id);

      $strategy->title = $request->title;
      $strategy->description = $request->description;
      $strategy->indicators = implode(',',$request->indicators);

      $strategy->save();

      return redirect('strategy/'.$strategy->id);
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

    public function rules()
    {
      $data = [
        'viewname' => 'Regras',
        'viewtitle' => 'Regras',
        'errors' => null,
      ];

      return view('strategyrules', $data);
    }

    public function statistics()
    {
      return "Estatísticas de Estratégias";
    }
}
