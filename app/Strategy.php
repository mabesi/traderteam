<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Strategy extends Model
{
    protected $fillable = [
      'title',
      'description',
      'indicators'
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function operations()
    {
      return $this->hasMany('App\Operation');
    }

    public function indicators()
    {
      return $this->belongsToMany('App\Indicator');
    }

    public static function getIndicatorsStrategiesId($indicatorsId)
    {
      $strategies = DB::table('indicator_strategy')
                          ->select('strategy_id')
                          ->whereIn('indicator_id',$indicatorsId)
                          ->groupBy('strategy_id')
                          ->get();

      $strategiesId = Array();

      foreach ($strategies as $strategy){
        $strategiesId[] = $strategy->strategy_id;
      }

      return $strategiesId;
    }

    function getResult()
    {
      return Operation::where('strategy_id',$this->id)
                  //->whereNotNull('exitdate')
                  //->whereNotNull('realexit')
                  ->sum('result');
    }

    function getIndicatorsId()
    {
      $indicators = $this->indicators->implode('id',',');
      return $indicators;
    }
}
