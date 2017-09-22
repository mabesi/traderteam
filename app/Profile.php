<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
  protected $fillable = [
      'user_id', 'occupation', 'birthdate',
      'city', 'state', 'country', 'site','facebook', 'twitter',
      'description', 'capital', 'cofounder'
  ];

  public $rules = [
    'occupation' => 'string|nullable|between:3,50',
    'birthdate' => 'date_format:d/m/Y',
    'city' => 'required_with:state,country|string|between:2,60',
    'state' => 'required_with:city,country|string|between:2,50',
    'country' => 'required_with:city,state|string|size:2',
    'site' => 'url|nullable|max:50',
    'facebook' => 'url|nullable|max:50',
    'twitter' => 'url|nullable|max:50',
    'description' => 'string',
    'capital' => 'numeric|nullable|between:1000,100000000',
    'avatar' => 'image|max:200|mimes:jpeg,jpg,png',
  ];

  public $mymessages = [
    'title.required' => 'O campo Título é obrigatório.',
    'title.string' => 'O campo Título dever ser somente texto.',
    'title.min' => 'O campo Título deve ter no mínimo 5 caracteres.',
    'title.max' => 'O campo Título deve ter no máximo 100 caracteres.',
    'content.required' => 'O campo Conteúdo é obrigatório.',
    'content.string' => 'O campo Conteúdo deve ser somente texto.',
    'content.min' => 'O campo Conteúdo deve ter no mínimo 10 caracteres',
    'onlyadmin.boolean' => 'O campo Só para Administradores deve ser do tipo Sim/Não.',
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
