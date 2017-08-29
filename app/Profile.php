<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $fillable = [
      'user_id', 'level', 'enabled', 'occupation',
      'birthdate', 'city', 'state', 'country', 'site',
      'facebook', 'twitter', 'description', 'status',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
