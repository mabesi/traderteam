<?php

namespace App\Http\Controllers;

use App\User;
use App\Operation;
use App\Comment;
use App\Answer;
use App\Strategy;
use App\Configuration;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      return $this->operations($request,Null,"Todas");
    }

    protected function operations($request,$userId=Null,$owner="Todas",$operationId=Null)
    {

      if ($operationId!=Null){
        $strategies = Strategy::orderBy('title')
                                ->get();
        $operations = Operation::whereIn('id',$operationId);
      } elseif ($userId==Null){
        $strategies = Strategy::orderBy('title')
                                ->get();
        $operations = new Operation;
      } else {
        $strategies = Strategy::whereIn('user_id',$userId)
                                ->orderBy('title')
                                ->get();
        $operations = Operation::whereIn('user_id',$userId);
      }

      $stock = $request->query('stock');
      $status = $request->query('status');
      $buyorsell = $request->query('buyorsell');
      $realorsimulated = $request->query('realorsimulated');
      $strategy = $request->query('strategy');
      $new = $request->query('new');
      $changed = $request->query('changed');
      $started = $request->query('started');
      $moved = $request->query('moved');
      $stoped = $request->query('stoped');
      $closed = $request->query('closed');
      $finished = $request->query('finished');

      $where = Array();

      if ($stock != Null){
        $where['stock'] = $stock;
      }
      if ($status != Null){
        $where['status'] = $status;
      }
      if ($buyorsell != Null){
        $where['buyorsell'] = $buyorsell;
      }
      if ($realorsimulated != Null){
        $where['realorsimulated'] = $realorsimulated;
      }
      if ($strategy != Null){
        $where['strategy_id'] = $strategy;
      }

      $orWhere = Array();
      $statusWhere = Array();

      if ($new==1){
        $orWhere[] = ['status' => 'N'];
        $statusWhere['new'] = 1;
      }
      if ($changed==1){
        $orWhere[] = ['status' => 'A'];
        $statusWhere['changed'] = 1;
      }
      if ($started==1){
        $orWhere[] = ['status' => 'I'];
        $statusWhere['started'] = 1;
      }
      if ($moved==1){
        $orWhere[] = ['status' => 'M'];
        $statusWhere['moved'] = 1;
      }
      if ($stoped==1){
        $orWhere[] = ['status' => 'S'];
        $statusWhere['stoped'] = 1;
      }
      if ($closed==1){
        $orWhere[] = ['status' => 'E'];
        $statusWhere['closed'] = 1;
      }
      if ($finished==1){
        $orWhere[] = ['status' => 'T'];
        $statusWhere['finished'] = 1;
      }

      $operations = $operations->where($where)
                                ->where(function($query) use ($orWhere){
                                  foreach($orWhere as $item){
                                    $query->orWhere($item);
                                  }
                                })
                                ->orderBy('updated_at','desc')
                                ->paginate(10);

      $where = array_merge($where,$statusWhere);
      //dd($where);

      $data = [
        'viewname' => 'Lista de Operações ('.$owner.')',
        'viewtitle' => 'Lista de Operações ('.$owner.')',
        'operations' => $operations,
        'strategies' => $strategies,
        'where' => $where,
        'path' => $request->path(),
        'profileView' => False,
      ];

      return view('operation.operations', $data);
    }

    public function myoperations(Request $request)
    {
      $userId[] = getUserId();
      if (count($userId)==0){
        $userId = Array(0);
      }
      return $this->operations($request,$userId,"Minhas Operações");
    }

    public function following(Request $request)
    {
      $userId = getFollowingId();
      if (count($userId)==0){
        $userId = Array(0);
      }
      return $this->operations($request,$userId,"Seguindo");
    }

    public function liked(Request $request)
    {
      $operationId = getLikedOperationId();
      if (count($operationId)==0){
        $operationId = Array(0);
      }
      return $this->operations($request,Null,"Curtidas",$operationId);
    }

    public function user(Request $request,$id)
    {
      $userId[] = $id;
      return $this->operations($request,$userId,"Usuário");
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

      $data = [
        'viewname' => 'Nova Operação',
        'viewtitle' => 'Nova Operação Swing Trade',
        'strategies' => $strategies,
        'status' => 'P',
      ];

      return view('operation.operation', $data);
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

        $request->validate($operation->rules,$operation->messages);

        $operation->user_id = $request->user_id;

        $operation->strategy_id = $request->strategy_id;
        $operation->stock = strtoupper($request->stock);
        $operation->amount = $request->amount;
        $operation->buyorsell = $request->buyorsell;
        $operation->realorsimulated = $request->realorsimulated;
        $operation->gtime = $request->gtime;
        $operation->buyorsell = $request->buyorsell;
        $operation->realorsimulated = $request->realorsimulated;

        $operation->preventry = (float) $request->preventry;
        $operation->prevtarget = (float) $request->prevtarget;
        $operation->prevstop = (float) $request->prevstop;

        if ($operation->buyorsell=='C'){
          if ($operation->prevtarget <= $operation->preventry){
            return back()->with('warnings',['O preço do alvo deve ser maior que o preço de entrada!']);
          } elseif ($operation->prevstop >= $operation->preventry){
            return back()->with('warnings',['O preço do stop deve ser menor que o preço de entrada!']);
          }
        } else {
          if ($operation->prevtarget >= $operation->preventry){
            return back()->with('warnings',['O preço do alvo deve ser mmenor que o preço de entrada!']);
          } elseif ($operation->prevstop <= $operation->preventry){
            return back()->with('warnings',['O preço do stop deve ser maior que o preço de entrada!']);
          }
        }

        $operation->preanalysis = "|||";
        $operation->preimage = "|||";
        $operation->postanalysis = "|||";
        $operation->postimage = "|||";

        $operation->status = 'N';

        if ($operation->save()){
          return redirect('operation/'.$operation->id.'/edit')->with('informations',['A operação foi incluída com sucesso!']);
        } else {
          return back()->with('problems',['Ocorreu um erro ao salvar a operação!']);
        }
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
        'operation' => $operation,
        'status' => $operation->status,
        'preanalysis01' => $preanalysis01,
        'preanalysis02' => $preanalysis02,
        'postanalysis01' => $postanalysis01,
        'postanalysis02' => $postanalysis02,
        'profileView' => False,
        'operationView' => True,
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

      $data['user'] = $operation->user;

      return view('operation.summary', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $operation = Operation::find($id);
      if ($operation==Null) {
        return redirect('operation');
      }
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

      return view('operation.operation', $data);
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
      //dd($request->exitdate.' - '.$request->entrydate);
      $request->validate($operation->rules,$operation->messages);

      $operationDir = 'operations/'.$operation->user_id.'/'.$operation->id;
      $defaultImage = '../../loading.gif';

      if ($operation->status == 'N' || $operation->status == 'A' ){

        $preimage = explode('|||',$operation->preimage);

        $oldImage01 = $preimage[0];

        if ($oldImage01==''){
          $oldImage01 = Null;
        }

        $oldImage02 = $preimage[1];

        if ($oldImage02==''){
          $oldImage02 = Null;
        }

        $preanalysis01 = $request->preanalysis01;
        $preanalysis02 = $request->preanalysis02;

        $operation->preanalysis = $preanalysis01.'|||'.$preanalysis02;

        $preimage01 = saveImage($request,'preimage01',$operationDir,
                                'preimage01',$oldImage01,$defaultImage);
        if ($preimage01==False){
          $preimage01 = $preimage[0];
        }
        $preimage02 = saveImage($request,'preimage02',$operationDir,
                                'preimage02',$oldImage02,$defaultImage);
        if ($preimage02==False){
          $preimage02 = $preimage[1];
        }
        $operation->preimage = $preimage01.'|||'.$preimage02;

        if ($request->strategy_id != $operation->strategy_id ||
            $request->stock != $operation->stock ||
            $request->amount != $operation->amount ||
            $request->buyorsell != $operation->buyorsell ||
            $request->realorsimulated != $operation->realorsimulated ||
            $request->gtime != $operation->gtime ||
            $request->preventry != (float) $operation->preventry ||
            $request->prevtarget != (float) $operation->prevtarget ||
            $request->prevstop != (float) $operation->prevstop
            ){

          $operation->strategy_id = $request->strategy_id;
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

          if ($operation->buyorsell=='C'){
            if ($operation->prevtarget <= $operation->preventry){
              return back()->with('warnings',['O preço do alvo deve ser maior que o preço de entrada!']);
            } elseif ($operation->prevstop >= $operation->preventry){
              return back()->with('warnings',['O preço de stop deve ser menor que o preço de entrada!']);
            }
          } else {
            if ($operation->prevtarget >= $operation->preventry){
              return back()->with('warnings',['O preço do alvo deve ser mmenor que o preço de entrada!']);
            } elseif ($operation->prevstop <= $operation->preventry){
              return back()->with('warnings',['O preço de stop deve ser maior que o preço de entrada!']);
            }
          }

          $operation->status = 'A';

        } elseif ($request->realentry){
           if ($request->entrydate){

             $operation->realentry = (float) $request->realentry;

             if (($operation->amount * $operation->realentry) > getUserAvailableCapital($operation->user)){
               $request->session()->flash('warnings',['Capital disponível insuficiente para iniciar a operação!']);
             } else {
               $entrydate = getMysqlDateFromBR($request->entrydate);
               $operation->entrydate = $entrydate;
               $operation->currentstop = $operation->prevstop;

               if ($operation->buyorsell=='C'){
                 if ($operation->prevtarget <= $operation->preventry){
                   return back()->with('warnings',['O preço do alvo deve ser maior que o preço de entrada!']);
                 } elseif ($operation->prevstop >= $operation->preventry){
                   return back()->with('warnings',['O preço de stop deve ser menor que o preço de entrada!']);
                 }
               } else {
                 if ($operation->prevtarget >= $operation->preventry){
                   return back()->with('warnings',['O preço do alvo deve ser mmenor que o preço de entrada!']);
                 } elseif ($operation->prevstop <= $operation->preventry){
                   return back()->with('warnings',['O preço de stop deve ser maior que o preço de entrada!']);
                 }
               }

               $operation->status = 'I';
             }
           } else {
             $request->session()->flash('warnings',['Para iniciar a operação é necessário informar o valor e a data de entrada!']);
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
            $today = getMysqlDate();

            if ($operation->exitdate <= $operation->entrydate){
              return back()->with('warnings',['A data de saída deve ser posterior à data de entrada!']);
            } elseif ($operation->exitdate > $today){
              return back()->with('warnings',['A data de saída não pode ser posterior à data atual!']);
            }

            if ($request->fees){
              $operation->fees = (float) $request->fees;
            } else {
              $sellOperation = ($operation->buyorsell=='V');
              $operation->fees = getDefaultFees($sellOperation);
            }

            if (($operation->buyorsell=='C' && $operation->realexit <= $operation->currentstop) ||
                ($operation->buyorsell=='V' && $operation->realexit >= $operation->currentstop)
              ) {
              $operation->status = 'S';
            } elseif (($operation->buyorsell=='C' && $operation->realexit >= $operation->prevtarget) ||
                  ($operation->buyorsell=='V' && $operation->realexit <= $operation->prevtarget)
                ) {
                $operation->status = 'T';
            } else {
              $operation->status = 'E';
            }

          }

        }

      } elseif ($operation->status == 'S' || $operation->status == 'E' || $operation->status == 'T' ) {

        $postimage = explode('|||',$operation->postimage);

        $oldImage01 = $postimage[0];
        if ($oldImage01==''){
          $oldImage01 = Null;
        }

        $oldImage02 = $postimage[1];
        if ($oldImage02==''){
          $oldImage02 = Null;
        }

        $postanalysis01 = $request->postanalysis01;
        $postanalysis02 = $request->postanalysis02;
        $operation->postanalysis = $postanalysis01.'|||'.$postanalysis02;

        $postimage01 = saveImage($request,'postimage01',$operationDir,
                                'postimage01',$oldImage01,$defaultImage);
        if ($postimage01==False){
          $postimage01 = $postimage[0];
        }
        $postimage02 = saveImage($request,'postimage02',$operationDir,
                                'postimage02',$oldImage02,$defaultImage);
        if ($postimage02==False){
          $postimage02 = $postimage[1];
        }
        $operation->postimage = $postimage01.'|||'.$postimage02;
      }

      if (!$operation->save()){
        return back()->with('problems',['Ocorreu um erro ao salvar a operação.']);
      }

      //dd($operation);

      if ($operation->status == 'S' || $operation->status == 'E' || $operation->status == 'T'){

        $operation->result = $operation->capitalReturn();

        if ($operation->save()){

          $profile = $operation->user->profile;
          $profile->capital += $operation->profit();

          if ($profile->save()){
            $request->session()->flash('informations',['O capital de investimento foi atualizado com sucesso.']);
          } else {
            $request->session()->flash('warnings',['Ocorreu um erro ao atualizar o capital de investimento.']);
          }

          return redirect('operation/'.$operation->id)->with('informations',['A operação foi salva com sucesso.']);

        } else {
          return back()->with('problems',['Ocorreu um erro ao salvar a operação.']);
        }
      } else {

        return redirect('operation/'.$operation->id)->with('informations',['A operação foi salva com sucesso.']);

      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operation $operation)
    {
      if (isAdmin() || $strategy->user_id = getUserId()){

        $directory = 'operations/'.$operation->user_id.'/'.$operation->id;

        if (isNotAdmin() && $operation->status != 'N' && $operation->status != 'A'){
          $data = getMsgDeleteErrorLocked();
        } elseif ($operation->delete()){
          deleteDir($directory);
          $data = getMsgDeleteSuccess();
        } else {
          $data = getMsgDeleteError();
        }

      } else {
        $data = getMsgDeleteAccessForbidden();
      }
      return response()->json($data);
    }

    public function rules()
    {

      $operationRules = Configuration::where('name','OPERATION_RULES')->first();

      $data = [
        'operationRules' => $operationRules,
        'viewname' => 'Regras',
        'viewtitle' => 'Regras',
      ];

      return view('operation.rules', $data);
    }

    public function like($id)
    {
      $user = getUser();
      $operation = Operation::find($id);
      if ($user->id != $operation->user_id){
        $user->operationsLiked()->attach($id);
      }
      return back();
    }

    public function dislike($id)
    {
      $user = getUser();
      $operation = Operation::find($id);
      if ($user->id != $operation->user_id){
        $user->operationsLiked()->detach($id);
      }
      return back();
    }

    public function addComment(Request $request,$id)
    {
      $comment = new Comment;

      $comment->user_id = getUserId();
      $comment->operation_id = $id;

      $comment->content = $request->content;

      if ($comment->save()){
        return redirect('operation/'.$id.'?comment='.$comment->id);

        return redirect('operation/'.$answer->comment->operation_id.'?comment='.$answer->comment->id);
      } else {
        return back()->with('problems',['Ocorreu um erro ao salvar o comentário!']);
      }
    }

    public function removeComment($id)
    {
      $comment = Comment::find($id);

      if (isAdmin() || $comment->user_id==getUserId()){
        if ($comment->delete()){
          $message = getMsgDeleteSuccess();
        } else {
          $message = getMsgDeleteError();
        }
      } else {
        $message = getMsgDeleteAccessForbidden();
      }
      return response()->json($message);
    }

    public function addAnswer(Request $request,$id)
    {
      $answer = new Answer;

      $answer->user_id = getUserId();
      $answer->comment_id = $id;

      $answer->content = $request->content;

      if ($answer->save()){
        return redirect('operation/'.$answer->comment->operation_id.'?comment='.$answer->comment->id);
      } else {
        return back()->with('problems',['Ocorreu um erro ao salvar a resposta!']);
      }
    }

    public function removeAnswer($id)
    {
      $answer = Answer::find($id);

      if (isAdmin() || $answer->user_id==getUserId()){
        if ($answer->delete()){
          $message = getMsgDeleteSuccess();
        } else {
          $message = getMsgDeleteError();
        }
      } else {
        $message = getMsgDeleteAccessForbidden();
      }
      return response()->json($message);
    }

}
