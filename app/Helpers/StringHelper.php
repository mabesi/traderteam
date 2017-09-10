<?php

function special_ucwords($string)
{
  $words = explode(' ', strtolower(trim(preg_replace("/\s+/", ' ', $string))));
  $return[] = ucfirst($words[0]);

  unset($words[0]);

  foreach ($words as $word)
  {
    if (!preg_match("/^([dn]?[aeiou][s]?|em)$/i", $word))
    {
      $word = ucfirst($word);
    }
    $return[] = $word;
  }

  return implode(' ', $return);
}

function nameInitials($string,$maxwords=1,$link=False)
{
  $words = explode(' ', strtolower(trim(preg_replace("/\s+/", ' ', $string))));

  if (count($words)>$maxwords){
    foreach ($words as $word)
    {
      if (!preg_match("/^([dn]?[aeiou][s]?|em)$/i", $word))
      {
        $letters[] = substr($word,0,1);
      }
    }

    $initials = implode('',$letters);
  } else {
    return $string;
  }

  if ($link && count($words)>$maxwords){
    return '<a title="'.$string.'" href="#">'.strtoupper($initials).'</a>';
  } else {
    return strtoupper($initials);
  }
}

function strContains($strComplete,$str)
{
  $strComplete = (string) $strComplete;
  $str = (string) $str;

  if (strpos($strComplete,$str)===False){
    return false;
  } else {
    //dd($strComplete.' - '.$str);
    return true;
  }
}
