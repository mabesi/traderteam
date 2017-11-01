<?php

if (! function_exists('humanPastTime')) {
  function humanPastTime($dateTime,$popularTime=true)
  {
    /**
    *  % - Literal %
    *  Y - Year, at least 2 digits with leading zero (e.g 03)
    *  y - Year (e.g 3)
    *  M - Month, with leading zero (e.g 06)
    *  m - Month (e.g 6)
    *  D - Day, with leading zero (e.g 09)
    *  d - Day (e.g 9)
    *  a - Total number of days as a result of date_diff()
    *  H - Hours, with leading zero (e.g 08, 23)
    *  h - Hours (e.g 8, 23)
    *  I - Minutes, with leading zero (e.g 08, 23)
    *  i - Minutes (e.g 8, 23)
    *  S - Seconds, with leading zero (e.g 08, 23)
    *  s - Seconds (e.g 8, 23)
    *  R - Sign "-" when negative, "+" when positive
    *  r - Sign "-" when negative, empty when positive
    */

    $pastDateTime = new DateTime($dateTime);
    $yearPastDateTime = (int) $pastDateTime->format('Y');
    $monthPastDateTime = (int) $pastDateTime->format('m');

    $now = new DateTime();
    $yearNow = (int) $now->format('Y');
    $monthNow = (int) $now->format('m');
    $hourNow = (int) $now->format('H');

    $interval = $now->diff($pastDateTime);

    $years = (int) $interval->format('%y');
    $months = (int) $interval->format('%m');
    $days = (int) $interval->format('%d');
    $hours = (int) $interval->format('%h');
    $minutes = (int) $interval->format('%i');
    $seconds = (int) $interval->format('%s');

    if ($years > 0) {

      if ($years > 1){
        return $years.' anos';
      } else {
        if ($popularTime) {
          if ($yearNow == $yearPastDateTime + 1) {
            return 'Ano passado';
          }
        } else {
          $humanInterval = $years.' ano';
        }
      }

      if ($months > 0) {
        $humanInterval .= ' e '.$months.' '.($months==1?'mês':'meses');
      }

      return $humanInterval;

    } elseif ($months > 0) {

      if ($months > 1){
        return $months.' meses';
      } else {
        if ($popularTime) {
          if ($monthNow == $monthPastDateTime + 1 || $monthNow == $monthPastDateTime - 11) {
            return 'Mês passado';
          } else {
            return 'Dois meses';
          }
        } else {
          $humanInterval = $months.' mês';
        }
      }


      if ($days > 0) {
        $humanInterval .= ' e '.$days.' '.($days==1?'dia':'dias');
      }

      return $humanInterval;

    } elseif ($days > 0) {

      if ($popularTime) {
        if ($days == 1) {
          return 'Ontem';
        } elseif ($days == 2) {
          return 'Anteontem';
        } else {
          return $days.' dias';
        }
      } else {
        return $days.' '.($days==1?'dia':'dias');
      }

    } elseif ($hours > 0) {

      if ($hours >= $hourNow && $popularTime){
        return 'Ontem';
      } elseif ($hours > 1){
        return $hours.' horas';
      } else {
        $humanInterval = $hours.' hora';
      }

      if ($minutes > 0) {
        $humanInterval .= ' e '.$minutes.' '.($minutes>1?'minutos':'minuto');
      }

      return $humanInterval;

    } else {

      if ($minutes > 0) {
        return $minutes.' '.($minutes>1?'minutos':'minuto');
      } else {
        return $seconds.' '.($seconds>1?'segundos':'segundo');
      }

    }

    //return $interval->format('%Y anos %m m %d d %h h %i min %s seg');
  }
}

function monthOfYear($dateTime,$longMonth=false,$upCase=false)
{
  $shortMonths = [
    '1' => 'Jan',
    '2' => 'Fev',
    '3' => 'Mar',
    '4' => 'Abr',
    '5' => 'Mai',
    '6' => 'Jun',
    '7' => 'Jul',
    '8' => 'Ago',
    '9' => 'Set',
    '10' => 'Out',
    '11' => 'Nov',
    '12' => 'Dez'
  ];

  $longMonths = [
    '1' => 'Janeiro',
    '2' => 'Fevereiro',
    '3' => 'Março',
    '4' => 'Abril',
    '5' => 'Maio',
    '6' => 'Junho',
    '7' => 'Julho',
    '8' => 'Agosto',
    '9' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro'
  ];

  $newDateTime = date_create($dateTime);
  $month = date_format($newDateTime,"n");

  if ($longMonth){
    $shortMonth = $longMonths[$month];
  } else {
    $shortMonth = $shortMonths[$month];
  }
  $year = date_format($newDateTime,"Y");

  if ($upCase) {
    return strtoupper($shortMonth)." de ".$year;
  } else {
    return $shortMonth." de ".$year;
  }
}

function birthday($birthdate,$longMonth=false,$upCase=false)
{
  $shortMonths = [
    '1' => 'Jan',
    '2' => 'Fev',
    '3' => 'Mar',
    '4' => 'Abr',
    '5' => 'Mai',
    '6' => 'Jun',
    '7' => 'Jul',
    '8' => 'Ago',
    '9' => 'Set',
    '10' => 'Out',
    '11' => 'Nov',
    '12' => 'Dez'
  ];

  $longMonths = [
    '1' => 'Janeiro',
    '2' => 'Fevereiro',
    '3' => 'Março',
    '4' => 'Abril',
    '5' => 'Maio',
    '6' => 'Junho',
    '7' => 'Julho',
    '8' => 'Agosto',
    '9' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro'
  ];

  $newDateTime = date_create($birthdate);
  $month = date_format($newDateTime,"n");

  if ($longMonth){
    $shortMonth = $longMonths[$month];
  } else {
    $shortMonth = $shortMonths[$month];
  }
  $day = date_format($newDateTime,"d");

  if ($upCase) {
    return $day.' de '.strtoupper($shortMonth);
  } else {
    return $day.' de '.$shortMonth;
  }
}

function isValidDate($date)
{
    $arrayDate = explode('/',$date);
    $day = $arrayDate[0];
    $month = $arrayDate[1];
    $year = $arrayDate[2];
    return checkdate($month, $day, $year);
}

function getDaysFrom($date)
{
    $currentDate = date('Y-m-d');
    $date = date('Y-m-d',$date);
    return daysBetweenDates($date, $currentDate);
}

function getDaysTo($date)
{
    $currentDate = date('Y-m-d');
    $date = date('Y-m-d',$date);
    return daysBetweenDates($currentDate,$date);
}

function getBRDate()
{
  //date_default_timezone_set('America/Sao_Paulo');
  return date('d/m/Y');
}

function getMysqlDate()
{
  //date_default_timezone_set('America/Sao_Paulo');
  return date('Y-m-d');
}

function getBRDateTime()
{
  //date_default_timezone_set('America/Sao_Paulo');
  return date('d/m/Y H:i:s');
}

function getMysqlDateFromBR($date)
{
    $arrayDate = explode('/',$date);
    $day = $arrayDate[0];
    $month = $arrayDate[1];
    $year = $arrayDate[2];

    return $year.'-'.$month.'-'.$day;
}

function getBRDateFromMysql($date=Null,$withTime=False)
{
  if ($date==Null){
    return '';
  }

  $arrayDateTime = explode(' ',$date);

  $arrayDate = explode('-',$arrayDateTime[0]);
  $year = $arrayDate[0];
  $month = $arrayDate[1];
  $day = $arrayDate[2];

  if ($withTime){
    $arrayTime = explode(':',$arrayDateTime[1]);
    $hour = $arrayTime[0];
    $minute = $arrayTime[1];
    $second = $arrayTime[2];
    return $day.'/'.$month.'/'.$year.' '.$hour.':'.$minute.':'.$second;
  }

  return $day.'/'.$month.'/'.$year;
}

function getDateTimeFromString($date)
{
  return date("d-m-Y H:i:s", strtotime($date));
}

function getPHPDate($date)
{
    $arrayDate = explode('/',$date);
    $day = $arrayDate[0];
    $month = $arrayDate[1];
    $year = $arrayDate[2];

    if ($year<2000){
        $year = $year + 2000;
    }

    $timestamp = mktime(0,0,0,$month,$day,$year);

    return date('m-d-Y', $timestamp);
}

function diffDate($d1, $d2, $type='', $sep='-')
{
    $d1 = explode($sep, $d1);
    $d2 = explode($sep, $d2);

    switch ($type)
    {
        case 'A':
            $X = 31536000;
            break;
        case 'M':
            $X = 2592000;
            break;
        case 'D':
            $X = 86400;
            break;
        case 'H':
            $X = 3600;
            break;
        case 'MI':
            $X = 60;
            break;
        default:
            $X = 1;
    }

    $t2 = mktime(0, 0, 0, $d2[1], $d2[2], $d2[0]);
    $t1 = mktime(0, 0, 0, $d1[1], $d1[2], $d1[0]);

    return floor($t2 - $t1) / $X;
}

function daysBetweenDates($date1,$date2){
    return diffDate($date1, $date2,'D');
}

function firstDayOfMonth($date=null,$useCurrentDate=true)
{
    if (!$date){
        if ($useCurrentDate){
            $date = date('Y-m-d');
        }else{
            return false;
        }
    }

    $anoMesDia = explode('-',$date);

    $year = $anoMesDia[0];
    $month = $anoMesDia[1];

    $timestamp = mktime(0,0,0,$month,1,$year);

    return date('Y-m-d', $timestamp);
}

function lastDayOfMonth($date=null,$useCurrentDate=true)
{
    if (!$date){
        if ($useCurrentDate){
            $date = date('Y-m-d');
        }else{
            return false;
        }
    }

    $anoMesDia = explode('-',$date);

    $year = $anoMesDia[0];
    $month = $anoMesDia[1];

    $timestamp = mktime(0,0,0,$month,1,$year);
    $date = date('Y-m-d', $timestamp);

    return alterDate($date,'Y-m-d',0,1,0);
}

function monthsBetweenDates($date1,$date2)
{
    $anoMesDia1 = explode('-',$date1);
    $anoMesDia2 = explode('-',$date2);

    $mes1 = $anoMesDia1[1];
    $ano1 = $anoMesDia1[0];
    $mes2 = $anoMesDia2[1];
    $ano2 = $anoMesDia2[0];

    if ($ano1 == $ano2){
        return $mes2 - $mes1;
    }elseif($ano1 < $ano2){
        $mesesAno1 = 12 - $mes1;
        $mesesAno2 = $mes2;
        return $mesesAno1 + $mesesAno2 + (12 * ($ano2 - $ano1 -1));
    }else{
        $mesesAno2 = 12 - $mes2;
        $mesesAno1 = $mes1;
        return -1 * ($mesesAno2 + $mesesAno1 + (12 * ($ano1 - $ano2 -1)));
    }
}

function alterDate($date,$format,$days=0,$months=0,$years=0,$withTime=False)
{
    $anoMesDia = explode('-',$date);

    $year = $anoMesDia[0];
    $month = $anoMesDia[1];
    $day = $anoMesDia[2];

    if ($withTime){
      $hours = date('g');
      $minutes = date('i');
      $seconds = date('s');
      $timestamp = mktime($hours,$minutes,$seconds,$month+$months,$day+$days,$year+$years);
    } else {
      $timestamp = mktime(0,0,0,$month+$months,$day+$days,$year+$years);
    }

    return date($format, $timestamp);
}
