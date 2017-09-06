<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Strategy;
use App\Indicator;

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
      $strategies = Strategy::leftJoin('operations','strategies.id','=','operations.strategy_id')
                              ->select(DB::raw('strategies.*,sum(result) as sumresult'))
                              ->groupBy('strategies.id','strategies.title','strategies.description','strategies.user_id');


      if (count($userId) > 0){
        $strategies->whereIn('strategies.user_id',$userId);
      }

      $strategy = $request->query('strategy');
      $indicator = $request->query('indicator');

      $where = Array();

      if ($indicator != Null){
        $indicatorsId = Indicator::getIndicatorsId($indicator);
        $strategiesId = Strategy::getIndicatorsStrategiesId($indicatorsId);
        $strategies->whereIn('strategies.id',$strategiesId);
      }

      if ($strategy != Null){
        $strategies->where('title','like',"%$strategy%");
      }

      $strategies = $strategies->orderBy('title','asc')
                              ->paginate(6);

      $where['strategy'] = $strategy;
      $where['indicator'] = $indicator;

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
