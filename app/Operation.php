<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
  protected $fillable = [
      'user_id', 'strategy_id', 'stock', 'gtime', 'buyorsell', 'realorsimulated',
      'preventry', 'prevtarget', 'prevstop', 'realentry', 'realexit',
      'entrydate', 'exitdate', 'preanalysis', 'preimage',
      'postanalysis', 'postimage',
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
}
