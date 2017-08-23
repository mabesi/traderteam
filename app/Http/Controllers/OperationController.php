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

        $operation = new Operation;

        $operation->user_id = getUserId();

        $operation->strategy_id = $request->strategy;
        $operation->stock = $request->stock;
        $operation->buyorsell = $request->buyorsell;
        $operation->realorsimulated = $request->realorsimulated;
        $operation->gtime = $request->gtime;
        $operation->buyorsell = $request->buyorsell;
        $operation->realorsimulated = $request->realorsimulated;

        $operation->preventry = (float) $request->preventry;
        $operation->prevtarget = (float) $request->prevtarget;
        $operation->prevstop = (float) $request->prevstop;

        if ($request->realentry){
          $operation->realentry = (float) $request->realentry;
        }

        if ($request->entrydate){
           $entrydate = getMysqlDateFromBR($request->entrydate);
           $operation->entrydate = $entrydate;
        }

        if ($request->realexit){
          $operation->realexit = (float) $request->realexit;
        }

        if ($request->exitdate){
          $exitdate = getMysqlDateFromBR($request->exitdate);
          $operation->exitdate = $exitdate;
        }

        $preanalysis01 = $request->preanalysis01;
        $preanalysis02 = $request->preanalysis02;

        $operation->preanalysis = $preanalysis01.'|||'.$preanalysis02;

        $preimage01 = saveImage($request,'preimage01','operations/'.getUserId(),'preimage01',Null,Null);
        if ($preimage01==False){
          $preimage01 = '';
        }
        $preimage02 = saveImage($request,'preimage02','operations/'.getUserId(),'preimage02',Null,Null);
        if ($preimage02==False){
          $preimage02 = '';
        }
        $operation->preimage = $preimage01.'|||'.$preimage02;

        $postanalysis01 = $request->postanalysis01;
        $postanalysis02 = $request->postanalysis02;
        $operation->postanalysis = $postanalysis01.'|||'.$postanalysis02;

        $postimage01 = saveImage($request,'postimage01','operations/'.getUserId(),'postimage01',Null,Null);
        if ($postimage01==False){
          $postimage01 = '';
        }
        $postimage02 = saveImage($request,'postimage02','operations/'.getUserId(),'postimage02',Null,Null);
        if ($postimage02==False){
          $postimage02 = '';
        }

        $operation->postimage = $postimage01.'|||'.$postimage02;

        $operation->status = 'N';

        $operation->save();

        return redirect('operation/'.$operation->id.'/edit');

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
      $strategies = Strategy::where('user_id',getUserId())
                    ->orderBy('title')
                    ->get();

      $preanalysis = explode('|||',$operation->preanalysis);
      $preanalysis01 = $preanalysis[0];
      $preanalysis02 = $preanalysis[1];

      //dd($preanalysis);

      $preimage = explode('|||',$operation->preimage);
      $preimage01 = $preimage[0];
      $preimage02 = $preimage[1];

      $postanalysis = explode('|||',$operation->postanalysis);
      $postanalysis01 = $postanalysis[0];
      $postanalysis02 = $postanalysis[1];

      $postimage = explode('|||',$operation->postimage);
      $postimage01 = $postimage[0];
      $postimage02 = $postimage[1];

      $data = [
        'viewname' => 'Editar Operação',
        'viewtitle' => 'Editar Operação',
        'errors' => null,
        'operation' => $operation,
        'preanalysis01' => $preanalysis01,
        'preanalysis02' => $preanalysis02,
        'postanalysis01' => $postanalysis01,
        'postanalysis02' => $postanalysis02,
        'strategies' => $strategies,
      ];

      if ($preimage01 != ''){
        $data['preimage01'] = $preimage01;
      }
      if ($preimage02 != ''){
        $data['preimage02'] = $preimage02;
      }
      if ($postimage01 != ''){
        $data['postimage01'] = $postimage01;
      }
      if ($postimage02 != ''){
        $data['postimage02'] = $postimage02;
      }

      return view('operation', $data);
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
