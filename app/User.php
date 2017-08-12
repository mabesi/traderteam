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

    public function getAvatar($class="img-circle",$alt="Foto do Perfil")
    {
      $img = "<img src='".asset("/img/avatar/".$this->avatar)."'";
      $img .=" class='$class' alt='$alt' />";

      return $img;
    }

    public function memberSince()
    {
      $created = date_create(Auth::user()->created_at);
      return date_format($created,"M Y");
    }

    public function memberTime()
    {
      $created = date_create(Auth::user()->created_at);
      $now = date_create('Y-m-d H:i:s',time());

      return date_format(date_diff($created,$now),'%h horas %i minutos');
    }

}
