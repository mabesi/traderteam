<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
  protected $fillable = [
    'name',
    'value',
    'content',
  ];

  public $rules = [
    'name' => 'required|string|min:5|max:50',
    'value' => 'required_without:content|nullable|string|min:21',
    'content' => 'required_without:value|nullable|string|min:21',
  ];

  public $messages = [
    'name.required' => 'O campo Nome é obrigatório.',
    'name.string' => 'O campo Nome dever ser somente texto.',
    'name.min' => 'O campo Nome deve ter no mínimo 5 caracteres.',
    'name.max' => 'O campo Nome deve ter no máximo 50 caracteres.',
    'content.required' => 'O campo Conteúdo é obrigatório.',
    'content.string' => 'O campo Conteúdo deve ser somente texto.',
    'content.min' => 'O campo Conteúdo deve ter no mínimo 10 caracteres',
  ];

}
