<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
  protected $fillable = [
      'user_id', 'strategy_id', 'stock', 'amount', 'gtime', 'buyorsell', 'realorsimulated',
      'preventry', 'prevtarget', 'prevstop', 'realentry', 'realexit','currentstop',
      'entrydate', 'exitdate', 'preanalysis', 'preimage', 'postanalysis', 'postimage',
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

    return number_format($risk,2);
  }

  public function prevReturn()
  {
    $gain = abs($this->preventry - $this->prevtarget);
    $return = $gain * 100 / $this->preventry;

    return number_format($return,2);
  }

  public function riskReturn(){
    $risk = abs($this->preventry - $this->prevstop);
    $return = abs($this->prevtarget - $this->preventry);
    return number_format($return/$risk,1);
  }

  public function prevCapitalRisk()
  {
    $operationCapital = operationCapital();
    $investimentCapital = investimentCapital();
    $capitalRisk = $this->prevRisk() * $operationCapital / 100;
    $investimentCapitalRisk = $capitalRisk * 100 / $investimentCapital;

    return number_format($investimentCapitalRisk,2);
  }

  public function prevCapitalReturn()
  {
    $operationCapital = operationCapital();
    $investimentCapital = investimentCapital();
    $capitalReturn = $this->prevReturn() * $operationCapital / 100;
    $investimentCapitalReturn = $capitalReturn * 100 / $investimentCapital;

    return number_format($investimentCapitalReturn,2);
  }

}
