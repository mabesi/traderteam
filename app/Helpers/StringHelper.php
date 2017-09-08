<?php

if (! function_exists('special_ucwords')) {
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
