<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Indicator;
use App\User;
use Illuminate\Support\Facades\Storage;

class IndicatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $indicators = Indicator::all();

      $data = [
        'viewname' => 'Indicadores',
        'viewtitle' => 'Indicadores Técnicos',
        'errors' => null,
        'indicators' => $indicators,
      ];

      //dd($data['indicators']);

      return view('indicators', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data = [
        'viewname' => 'Novo Indicador',
        'viewtitle' => 'Novo Indicador',
        'errors' => null,
      ];

      return view('indicator', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $indicator = new Indicator;

      $indicator->name = $request->name;
      $indicator->acronym = $request->acronym;
      $indicator->description = $request->description;
      $indicator->type = $request->type;

      $indicator->image = saveImage($request,'image','indicators',$indicator->acronym);

      $indicator->save();

      //return redirect('indicator/'.$indicator->id.'/edit');
      return redirect('indicator');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function show(Indicator $indicator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function edit(Indicator $indicator)
    {
      $data = [
        'viewname' => 'Novo Indicador',
        'viewtitle' => 'Novo Indicador',
        'errors' => null,
        'indicator' => $indicator,
      ];

      return view('indicator', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Indicator $indicator)
    {
      $indicator->name = $request->name;
      $indicator->acronym = $request->acronym;
      $indicator->description = $request->description;
      $indicator->type = $request->type;

      $indicator->image = saveImage($request,'image','indicators',$indicator->acronym,$indicator->image,'loaging.gif');

      $indicator->save();

      //return redirect('indicator/'.$indicator->id.'/edit');
      return redirect('indicator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Indicator  $indicator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Indicator $indicator)
    {
        dd($indicator);
    }
}
