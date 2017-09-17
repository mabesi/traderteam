<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  protected $fillable = [
    'reported_id',
    'origin_url',
    'reason',
    'description',
    'link',
    'resolution',
    'finished',
  ];

  public $rules = [
    'reported_id' => 'required|numeric|min:1',
    'reason' => 'required_with:description|numeric|between:1,10',
    'description' => 'required_with:reason|string|min:10',
    'origin_url' => 'url|required',
    'link' => 'url|nullable',
    'finished' => 'boolean',
    'resolution' => 'required_with:finished|nullable|string|min:5',
  ];

  public $messages = [
  ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }

  public function reportedUser()
  {
    return $this->belongsTo('App\User','reported_id');
  }
}
