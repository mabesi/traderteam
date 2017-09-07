<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Operation extends Model
{
  protected $fillable = [
      'user_id', 'strategy_id', 'stock', 'amount', 'gtime', 'buyorsell', 'realorsimulated',
      'preventry', 'prevtarget', 'prevstop', 'realentry', 'realexit','currentstop',
      'entrydate', 'exitdate','result', 'preanalysis', 'preimage', 'postanalysis', 'postimage',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function strategy()
  {
    return $this->belongsTo('App\Strategy');
  }

  public function comments()
  {
    return $this->hasMany('App\Comment');
  }

  public function likers()
  {
    return $this->belongsToMany('App\User');
  }

  public function prevRisk()
  {
    $stop = abs($this->preventry - $this->prevstop);
    $risk = $stop * 100 / $this->preventry;

    return number_format($risk,1);
  }

  public function prevReturn()
  {
    $gain = abs($this->preventry - $this->prevtarget);
    $return = $gain * 100 / $this->preventry;

    return number_format($return,1);
  }

  public function riskReturn(){
    $risk = abs($this->preventry - $this->prevstop);
    $return = abs($this->prevtarget - $this->preventry);
    return number_format($return/$risk,1);
  }

  public function prevCapitalRisk()
  {
    if ($this->user->profile){
      $capital = $this->user->profile->capital;
    } else {
      $capital = getInvestimentCapital();
    }

    $operationCapital = $this->amount * $this->preventry;

    $capitalRisk = $this->prevRisk() * $operationCapital / 100;
    $investimentCapitalRisk = $capitalRisk * 100 / $capital;

    return number_format($investimentCapitalRisk,1);
  }

  public function prevCapitalReturn()
  {
    if ($this->user->profile){
      $capital = $this->user->profile->capital;
    } else {
      $capital = getInvestimentCapital();
    }

    $operationCapital = $this->amount * $this->preventry;

    $capitalReturn = $this->prevReturn() * $operationCapital / 100;
    $investimentCapitalReturn = $capitalReturn * 100 / $capital;

    return number_format($investimentCapitalReturn,1);
  }

  public function operationReturn()
  {
    if ($this->status == 'S' || $this->status == 'E' || $this->status == 'T'){

      $entry = $this->realentry;
      $exit = $this->realexit;

      if ($this->buyorsell == 'C'){
        $result = ($exit - $entry) * 100 / $entry;
      }else{
        $result = ($entry - $exit) * 100 / $entry;
      }

      return number_format($result,1);
    }
    return 0;
  }

  public function capitalReturn()
  {
    if ($this->status == 'S' || $this->status == 'E' || $this->status == 'T'){

      if ($this->user->profile){
        $capital = $this->user->profile->capital;
      } else {
        $capital = getInvestimentCapital();
      }

      $entry = $this->realentry;
      $exit = $this->realexit;

      if ($this->buyorsell == 'C'){
        $result = ($exit - $entry) * $this->amount;
      }else{
        $result = ($entry - $exit) * $this->amount;
      }

      $capitalResult = $result * 100 / $capital;

      return number_format($capitalResult,2);
    }
    return 0;
  }

  public static function getTotalOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $totalOperations = Operation::where('user_id',$userId)
                                    ->count();
    return $totalOperations;
  }

  public static function getNewOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $totalOperations = Operation::where('user_id',$userId)
                                    ->where(function($query){
                                      $query->orWhere('status','N')
                                            ->orWhere('status','A');
                                    })
                                    ->count();
    return $totalOperations;
  }

  public static function getFinishedOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $totalOperations = Operation::where('user_id',$userId)
                                    ->where(function($query){
                                      $query->orWhere('status','S')
                                            ->orWhere('status','E')
                                            ->orWhere('status','T');
                                    })
                                    ->count();
    return $totalOperations;
  }

  public static function getAvgBuyOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $avgOperations = Operation::where('user_id',$userId)
                                ->where(function($query){
                                  $query->orWhere('status','S')
                                        ->orWhere('status','E')
                                        ->orWhere('status','T');
                                })
                                ->where('buyorsell','C')
                                ->select(DB::raw('avg((realexit - realentry)*100/realentry) As avgResult'))
                                ->first();

    return $avgOperations->avgResult;
  }

  public static function getAvgSellOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $avgOperations = Operation::where('user_id',$userId)
                                ->where(function($query){
                                  $query->orWhere('status','S')
                                        ->orWhere('status','E')
                                        ->orWhere('status','T');
                                })
                                ->where('buyorsell','V')
                                ->select(DB::raw('avg((realentry - realexit)*100/realentry) As avgResult'))
                                ->first();

    return $avgOperations->avgResult;
  }

  public static function getAvgResultOperations($userId=Null)
  {
    $buyAvg = Operation::getAvgBuyOperations($userId);
    $sellAvg = Operation::getAvgSellOperations($userId);

    if($buyAvg!=Null){
      if($sellAvg!=Null){
        return ($buyAvg + $sellAvg) / 2;
      } else {
        return $buyAvg;
      }
    } elseif ($sellAvg!=Null){
      return $sellAvg;
    } else {
      return Null;
    }
  }

  public static function getStartedOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $totalOperations = Operation::where('user_id',$userId)
                                    ->where(function($query){
                                      $query->orWhere('status','I')
                                            ->orWhere('status','M');
                                    })
                                    ->count();
    return $totalOperations;
  }

  public static function getTargetedOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $totalOperations = Operation::where('user_id',$userId)
                                    ->whereNotNull('exitdate')
                                    ->whereNotNull('realexit')
                                    ->where('status','T')
                                    ->count();
    return $totalOperations;
  }

  public static function getLucrativeOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $totalOperations = Operation::where('user_id',$userId)
                                    ->whereNotNull('exitdate')
                                    ->whereNotNull('realexit')
                                    ->where('result','>',0)
                                    ->count();
    return $totalOperations;
  }

  public static function getLossyOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $totalOperations = Operation::where('user_id',$userId)
                                    ->whereNotNull('exitdate')
                                    ->whereNotNull('realexit')
                                    ->where('result','<',0)
                                    ->count();
    return $totalOperations;
  }

  public static function getBreakEvenOperations($userId=Null)
  {
    if ($userId==Null){
      $userId = getUserId();
    }

    $totalOperations = Operation::where('user_id',$userId)
                                    ->whereNotNull('exitdate')
                                    ->whereNotNull('realexit')
                                    ->where('result','=',0)
                                    ->count();
    return $totalOperations;
  }

}
