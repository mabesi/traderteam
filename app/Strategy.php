<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
