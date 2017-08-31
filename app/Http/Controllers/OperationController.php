<?php

namespace App\Http\Controllers;

use App\User;
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
      $user = User::find(getUserId());
      $operations = $user->operations;

      $data = [
        'viewname' => 'Minhas Operações',
        'viewtitle' => 'Minhas Operações',
        'operations' => $operations,
        'errors' => null,
      ];

        return view('myoperations', $data);
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
        'status' => 'P',
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
        $operation->amount = $request->amount;
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
        'viewname' => 'Sumário da Operação',
        'viewtitle' => 'Sumário da Operação',
        'errors' => null,
        'operation' => $operation,
        'status' => $operation->status,
        'preanalysis01' => $preanalysis01,
        'preanalysis02' => $preanalysis02,
        'postanalysis01' => $postanalysis01,
        'postanalysis02' => $postanalysis02,
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

      return view('operation.summary', $data);

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
        'status' => $operation->status,
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
      if ($operation->status == 'N' || $operation->status == 'A' ){

        $preimage = explode('|||',$operation->preimage);

        $preanalysis01 = $request->preanalysis01;
        $preanalysis02 = $request->preanalysis02;

        $operation->preanalysis = $preanalysis01.'|||'.$preanalysis02;

        $preimage01 = saveImage($request,'preimage01','operations/'.getUserId(),'preimage01',Null,Null);
        if ($preimage01==False){
          $preimage01 = $preimage[0];
        }
        $preimage02 = saveImage($request,'preimage02','operations/'.getUserId(),'preimage02',Null,Null);
        if ($preimage02==False){
          $preimage02 = $preimage[1];
        }
        $operation->preimage = $preimage01.'|||'.$preimage02;

        if ($request->strategy != $operation->strategy_id ||
            $request->stock != $operation->stock ||
            $request->amount != $operation->amount ||
            $request->buyorsell != $operation->buyorsell ||
            $request->realorsimulated != $operation->realorsimulated ||
            $request->gtime != $operation->gtime ||
            $request->preventry != (float) $operation->preventry ||
            $request->prevtarget != (float) $operation->prevtarget ||
            $request->prevstop != (float) $operation->prevstop
            ){

          $operation->strategy_id = $request->strategy;
          $operation->stock = $request->stock;
          $operation->amount = $request->amount;
          $operation->buyorsell = $request->buyorsell;
          $operation->realorsimulated = $request->realorsimulated;
          $operation->gtime = $request->gtime;
          $operation->buyorsell = $request->buyorsell;
          $operation->realorsimulated = $request->realorsimulated;

          $operation->preventry = (float) $request->preventry;
          $operation->prevtarget = (float) $request->prevtarget;
          $operation->prevstop = (float) $request->prevstop;

          $operation->status = 'A';

        } elseif ($request->realentry){
           if ($request->entrydate){
             $operation->realentry = (float) $request->realentry;
             $entrydate = getMysqlDateFromBR($request->entrydate);
             $operation->entrydate = $entrydate;
             $operation->currentstop = $operation->prevstop;
             $operation->status = 'I';
           }
        }

      } elseif ($operation->status == 'I' || $operation->status == 'M') {

        if ($request->currentstop){
          if ($operation->currentstop != (float) $request->currentstop){
            $operation->currentstop = (float) $request->currentstop;
            $operation->status = 'M';
          }
        }

        if ($request->realexit){
          if ($request->exitdate){
            $operation->realexit = (float) $request->realexit;
            $exitdate = getMysqlDateFromBR($request->exitdate);
            $operation->exitdate = $exitdate;
            if (($operation->buyorsell=='C' && $operation->realexit <= $operation->currentstop) ||
                ($operation->buyorsell=='V' && $operation->realexit >= $operation->currentstop)
              ) {
              $operation->status = 'S';
            } elseif (($operation->buyorsell=='C' && $operation->realexit >= $operation->currentstop) ||
                  ($operation->buyorsell=='V' && $operation->realexit <= $operation->currentstop)
                ) {
                $operation->status = 'T';
            } else {
              $operation->status = 'E';
            }
          }
        }

      } elseif ($operation->status == 'C' || $operation->status == 'E' || $operation->status == 'T' ) {

        $postimage = explode('|||',$operation->postimage);

        $postanalysis01 = $request->postanalysis01;
        $postanalysis02 = $request->postanalysis02;
        $operation->postanalysis = $postanalysis01.'|||'.$postanalysis02;

        $postimage01 = saveImage($request,'postimage01','operations/'.getUserId(),'postimage01',Null,Null);
        if ($postimage01==False){
          $postimage01 = $postimage[0];
        }
        $postimage02 = saveImage($request,'postimage02','operations/'.getUserId(),'postimage02',Null,Null);
        if ($postimage02==False){
          $postimage02 = $postimage[1];
        }
        $operation->postimage = $postimage01.'|||'.$postimage02;
      }

      $operation->save();
      return redirect('operation/'.$operation->id);
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
