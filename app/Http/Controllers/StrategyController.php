<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Strategy;

class StrategyController extends Controller
{

    private $indicators = [
      'Volume','MMA','MME','MACD','BB','ATR','ADL','ADX','Williams',
      'Momentum','Estocástico','Fibonacci','Keltner','HiLo','SAR','Aroon',
      'IMD','OHLC','Candlestick','Heikin-Ashi','Renko','TRIX',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data = [
        'viewname' => 'Minhas Estratégias',
        'viewtitle' => 'Minhas Estratégias',
        'errors' => null,
      ];

        return view('mystrategies', $data);
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
}
