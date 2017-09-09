<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
  protected $fillable = [
    'title',
    'content',
    'onlyadmin',
  ];

  public $rules = [
    'title' => 'required|string|min:5|max:100',
    'content' => 'required|string|min:21',
    'onlyadmin' => 'boolean',
  ];

  public $messages = [
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
