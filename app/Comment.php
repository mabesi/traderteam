<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id', 'operation_id', 'content', 'like', 'dislike',
    ];

    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function operation()
    {
      return $this->belongsTo('App\Operation');
    }

    public function answers()
    {
      return $this->hasMany('App\Answer');
    }
}
