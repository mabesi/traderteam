<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Strategy;
use App\Operation;
use App\Indicator;
use App\Configuration;

class StrategyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      return $this->strategies($request);
    }

    public function strategies($request,$userId=Array(),$owner="Geral",$minResult=Null,$minOperations=Null)
    {
      $path = $request->path();

      if ($request->has('sort')){
        $sort = $request->query('sort');
        $dir = $request->query('dir');
      } elseif($path == 'beststrategies'){
        $sort = 'sumresult';
        $dir = 'desc';
      } else {
        $sort = 'title';
        $dir = 'asc';
      }

      $strategies = Strategy::leftJoin('operations','strategies.id','=','operations.strategy_id')
                              ->select(DB::raw('strategies.*,sum(result) as sumresult'))
                              ->withCount('operations')
                              ->groupBy('strategies.id','strategies.title','strategies.description','strategies.user_id','strategies.created_at','strategies.updated_at');

      if ($minResult!=Null){
        $strategies->havingRaw('sum(result) >= '.$minResult);
      }

      if ($minOperations!=Null){
        $strategies->has('operations','>=',$minOperations);
      }

      if ($userId!=Null && count($userId) > 0){
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

      $strategies = $strategies->orderBy($sort,$dir)
                              ->paginate(6);

      $where['strategy'] = $strategy;
      $where['indicator'] = $indicator;

      $newDir = ($dir=='asc'?'desc':'asc');

      $data = [
        'viewname' => 'Lista de Estratégias ('.$owner.')',
        'viewtitle' => 'Lista de Estratégias ('.$owner.')',
        'strategies' => $strategies,
        'where' => $where,
        'path' => $path,
        'sort' => $sort,
        'dir' => $dir,
        'newDir' => $newDir,
        'profileView' => False,
      ];

      return view('strategy.strategies', $data);
    }

    public function mystrategies(Request $request)
    {
      $userId[] = getUserId();
      return $this->strategies($request,$userId,"Minhas Estratégias");
    }

    public function best(Request $request)
    {
      $strategyResultOperations = Operation::select(DB::raw('sum(result) as result, strategy_id'))
                                  ->groupBy('strategy_id')
                                  ->havingRaw('sum(result) > 0')
                                  ->get();

      $avgStrategyResult = round($strategyResultOperations->avg('result'));

      $strategyTotalOperations = Operation::select(DB::raw('count(*) as operations, strategy_id'))
                                  ->groupBy('strategy_id')
                                  ->havingRaw('count(*) > 0')
                                  ->get();

      $avgOperations = round($strategyTotalOperations->avg('operations'));

      return $this->strategies($request,Null,"Melhores Estratégias",$avgStrategyResult,$avgOperations);
    }

    public function following(Request $request)
    {
      $userId = getFollowingId();
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
      $indicators = Indicator::all();

      $data = [
        'viewname' => 'Nova Estratégia',
        'viewtitle' => 'Nova Estratégia',
        'indicators' => $indicators->sortBy('name'),
        'indicatorsId' => '',
      ];

      return view('strategy.edit', $data);
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

      if ($strategy->save()){
        $strategy->indicators()->attach($request->indicators);
        return redirect('strategy/'.$strategy->id)->with('informations', ['A estratégia foi salva com sucesso!']);
      } else {
        return back()->with('problems', ['Erro inesperado. A estratégia não foi salva!']);
      }
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
        'indicators' => $strategy->indicators->sortBy('name'),
        'strategy' => $strategy,
      ];

      return view('strategy.strategy', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $strategy = Strategy::find($id);
      $indicators = Indicator::all();

      $data = [
        'viewname' => 'Editar Estratégia',
        'viewtitle' => 'Editar Estratégia',
        'indicators' => $indicators->sortBy('name'),
        'indicatorsId' => $strategy->indicators->implode('id',','),
        'strategy' => $strategy,
      ];

      return view('strategy.edit', $data);
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

      if (isAdmin() || $strategy->user_id = getUserId()){
        if ($strategy->save()){
          $strategy->indicators()->detach();
          $strategy->indicators()->attach($request->indicators);
          return redirect('strategy/'.$strategy->id)->with('informations', ['A estratégia foi salva com sucesso!']);
        } else {
          return back()->with('problems', ['Erro inesperado. A estratégia não foi salva!']);
        }
      } else {
        return back()->with('problems', ['Acesso não permitido. A estratégia não foi salva!']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $strategy = Strategy::find($id);

      if ($strategy->has('operations')){
        $message = getMsgDeleteErrorVinculated();
      } else {
        if (isAdmin() || $strategy->user_id = getUserId()){
          if ($strategy->delete()){
            $message = getMsgDeleteSuccess();
          } else {
            $message = getMsgDeleteError();
          }
        } else {
          $message = getMsgDeleteAccessForbidden();
        }
      }
      return response()->json($message);
    }

    public function rules()
    {
      $strategyRules = Configuration::where('name','STRATEGY_RULES')->first();

      $data = [
        'strategyRules' => $strategyRules,
        'viewname' => 'Regras',
        'viewtitle' => 'Regras',
      ];

      return view('strategy.rules', $data);
    }

    public function statistics()
    {
      return "Estatísticas de Estratégias";
    }
}
