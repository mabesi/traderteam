<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
      return $this->hasOne('App\Profile');
    }

    public function operations()
    {
      return $this->hasMany('App\Operation');
    }

    public function strategies()
    {
      return $this->hasMany('App\Strategy');
    }

    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    public function answers()
    {
      return $this->hasMany('App\Answer');
    }

    public function followers()
    {
      return $this->belongsToMany('App\User','followers','user_id','follower_id');
    }

    public function following()
    {
      return $this->belongsToMany('App\User','followers','follower_id','user_id');
    }

    public function operationsLiked()
    {
      return $this->belongsToMany('App\Operation');
    }

    public function getAvatar($class="img-circle",$alt="Foto do Perfil")
    {
      return getUserAvatar($class,$alt);
    }

    public function memberSince()
    {
      return monthOfYear(Auth::user()->created_at);
    }

    public function memberTime()
    {
      return humanPastTime(Auth::user()->created_at);
    }

}
