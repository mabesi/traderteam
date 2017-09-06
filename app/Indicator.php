<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Indicator extends Model
{
  protected $fillable = [
      'name', 'acronym', 'description', 'type', 'image',
  ];

  public function strategies()
  {
    return $this->belongsToMany('App\Strategy');
  }

  public function getImage($class="img-responsive pad")
  {
    $alt=$this->name;
    $src = asset("/storage/indicators/".$this->image);
    return getHtmlImage($src,$class,$alt,Null,$alt);
  }

  public static function getIndicatorsId($search)
  {
    $indicators = Indicator::where('acronym','like',"%$search%")
                        ->orWhere('name','like',"%$search%")
                        ->get();
    //dd($indicators);

    $indicatorsId = Array();

    foreach ($indicators as $indicator){
      $indicatorsId[] = $indicator->id;
    }

    //dd($indicatorsId);

    return $indicatorsId;
  }

}
