<?php

namespace App\Http\Controllers;

use App\Operation;
use App\Strategy;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $strategies = Strategy::where('user_id',getUserId())
                    ->orderBy('title')
                    ->get();

      //dd($strategies);

      $data = [
        'viewname' => 'Nova Operação',
        'viewtitle' => 'Nova Operação Swing Trade',
        'errors' => null,
        'strategies' => $strategies,
      ];

      return view('operation', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $operation->image = saveImage($request,'image','indicators',$operation->acronym,$operation->image,'loaging.gif');

        $operation = new Indicator;

        $operation->name = $request->name;
        $operation->acronym = $request->acronym;
        $operation->description = $request->description;
        $operation->type = $request->type;

        $operation->image = saveImage($request,'image','indicators',$operation->acronym);

        $operation->save();

        //return redirect('indicator/'.$indicator->id.'/edit');
        return redirect('indicator');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function show(Operation $operation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit(Operation $operation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operation $operation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
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

      return view('operationrules', $data);
    }
}
