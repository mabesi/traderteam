<?php

use Illuminate\Support\Facades\Auth;

function getUserId()
{
  return Auth::user()->id;
}

function getUserName()
{
  return Auth::user()->name;
}

function getUserEmail()
{
  return Auth::user()->email;
}

function getUserAvatarName()
{
  return Auth::user()->avatar;
}

function indicatorType($type){
  $types = [
    'T' => 'Tendência',
    'V' => 'Volume',
    'O' => 'Oscilador',
    'M' => 'Misto',
  ];

  return $types[$type];
}

function getOperationCapital()
{
  return 5000.00;
}

function getInvestimentCapital()
{
  return 100000.00;
}

function getUserAvatar($class="img-circle",$alt="Foto do Perfil",$user=Null,$width=Null,$height=Null)
{
  $src = asset("/storage/avatar/".($user==Null?Auth::user()->avatar:$user->avatar));
  return getHtmlImage($src,$class,$alt,Null,Null,$width,$height);
}

function getLevelStars($level)
{
  $stars='';

  for ($i=0;$i<$level;$i++){
    $stars .= '<i class="fa fa-star"></i>';
  }

  return $stars;
}

function getHtmlImage($src,$class=Null,$alt=Null,$id=Null,$title=Null,$width=Null,$height=Null,$style=Null)
{
  $img = "<img src='".$src."'";

  if ($id != Null){
    $img .=" id='$id'";
  }

  if ($class != Null){
    $img .=" class='$class'";
  }

  if ($title != Null){
    $img .=" title='$title'";
  }

  if ($alt != Null){
    $img .=" alt='$alt'";
  }

  if ($width != Null){
    $img .=" width='$width'";
  }

  if ($height != Null){
    $img .=" height='$height'";
  }

  if ($style != Null){
    $img .=" style='$style'";
  }

  $img .=" />";

  return $img;
}

function operationBuyOrSell($type)
{
  $typeList = [
    'C' => 'Compra',
    'V' => 'Venda',
  ];

  return $typeList[$type];
}

function operationRealOrSimulated($type)
{
  $typeList = [
    'R' => 'Real',
    'S' => 'Simulada',
  ];

  return $typeList[$type];
}

function operationStatus($status)
{
  $statusList = [
    'P' => 'PLANEJAMENTO',
    'C' => 'CANCELADA',
    'N' => 'NOVA',
    'A' => 'ALTERADA',
    'I' => 'INICIADA',
    'M' => 'STOP MOVIDO',
    'S' => 'STOPADA',
    'E' => 'ENCERRADA',
    'T' => 'NO ALVO',
  ];

  return $statusList[$status];
}

function statusClass($status)
{
  //dd($status);

  $classList = [
    'P' => 'secondary',
    'C' => 'danger',
    'N' => 'info',
    'A' => 'warning',
    'I' => 'primary',
    'M' => 'warning',
    'S' => 'danger',
    'E' => 'primary',
    'T' => 'success',
  ];

  return $classList[$status];
}

function gtimeName($gtime)
{
  $gtimeList = [
    '1' => '60 Minutos',
    '4' => '4 Horas',
    'D' => 'Diário',
    'S' => 'Semanal',
    'M' => 'Mensal',
  ];

  return $gtimeList[$gtime];
}

function nbsp($qtd)
{
  $spaces = '';
  for ($i=0;$i<$qtd;$i++){
    $spaces .= '&nbsp;';
  }
  return $spaces;
}

function disabledIfIsSet($variable)
{
  if (isset($$variable)){
    return ' disabled';
  } else {
    return '';
  }
}

function disabledIfNotIsSet($variable)
{
  if (!isset($$variable)){
    return ' disabled';
  } else {
    return '';
  }
}

function lockOperationFields($field,$status)
{
  switch ($status) {
      case 'P':
        $prevFields = '';
        $startFields = ' disabled';
        $stopField = ' disabled';
        $endFields = ' disabled';
        $postFields = ' disabled';
          break;
      case 'N':
      case 'A':
        $prevFields = '';
        $startFields = '';
        $stopField = ' disabled';
        $endFields = ' disabled';
        $postFields = ' disabled';
          break;
      case 'I':
      case 'M':
        $prevFields = ' disabled';
        $startFields = ' disabled';
        $stopField = '';
        $endFields = '';
        $postFields = ' disabled';
          break;
      case 'C':
      case 'S':
      case 'E':
      case 'T':
        $prevFields = ' disabled';
        $startFields = ' disabled';
        $stopField = ' disabled';
        $endFields = ' disabled';
        $postFields = '';
          break;
      default:
        $prevFields = '';
        $startFields = ' disabled';
        $stopField = ' disabled';
        $endFields = ' disabled';
        $postFields = ' disabled';
  }

  $fieldStatus = [
    'strategy' => $prevFields,
    'stock' => $prevFields,
    'amount' => $prevFields,
    'buyorsell' => $prevFields,
    'realorsimulated' => $prevFields,
    'gtime' => $prevFields,
    'preventry' => $prevFields,
    'prevtarget' => $prevFields,
    'prevstop' => $prevFields,

    'entrydate' => $startFields,
    'realentry' => $startFields,

    'currentstop' => $stopField,

    'exitdate' => $endFields,
    'realexit' => $endFields,

    'preimage01' => $prevFields,
    'preanalysis01' => $prevFields,
    'preimage02' => $prevFields,
    'preanalysis02' => $prevFields,

    'postimage01' => $postFields,
    'postanalysis01' => $postFields,
    'postimage02' => $postFields,
    'postanalysis02' => $postFields,
  ];

  return $fieldStatus[$field];
}

function getChartWidth()
{
  return 580;
}

function getChartHeigth()
{
  return 420;
}

function getChartInterval($interval='S')
{
  $typeList = [
    '5' => '300',
    '15' => '900',
    '30' => '1800',
    '1' => '3600',
    '4' => '14400',
    'D' => '86400',
    'S' => 'week',
    'M' => 'month',
  ];

  return $typeList[$interval];
}

function feedRss($link,$limit=10,$showDescription=False)
{
  $rss = simplexml_load_file($link);
  $count = 0;
  $feed = '';

  foreach($rss->channel->item as $item){

    $feedDate = getDateTimeFromString($item->pubDate);
    $feedDate = humanPastTime($feedDate);

    $feed .= "<p class='text-justify'><a href='{$item->link}' target='_blank'>{$item->title}</a> <small>({$feedDate})</small></p>";

    if ($showDescription){
      $feed .= "<p>{$item->description}</p>";
    }

    $count++;
    if($count == $limit){
      break;
    }
  }
  return $feed;
}
