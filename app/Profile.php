<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $fillable = [
      'user_id', 'level', 'enabled', 'avatar', 'ocupation',
      'birthdate', 'city', 'state', 'country', 'site',
      'facebook', 'twitter', 'description', 'capital', 'status',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
