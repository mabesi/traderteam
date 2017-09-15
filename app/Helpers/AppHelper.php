<?php

use Illuminate\Support\Facades\Auth;
use App\User;

function isSuperAdmin()
{
  if (Auth::user()->type=='S'){
    return True;
  } else {
    return False;
  }
}

function isAdmin()
{
  if (Auth::user()->type=='A' || isSuperAdmin()){
    return True;
  } else {
    return False;
  }
}

function isNotAdmin()
{
  if (Auth::user()->type=='U'){
    return True;
  } else {
    return False;
  }
}

function getUser($id=Null)
{
  if ($id==Null){
    return Auth::user();
  } else {
    return User::find($id);
  }
}

function getUserId()
{
  return Auth::id();
}

function getUserName()
{
  return Auth::user()->name;
}

function getUserEmail()
{
  return Auth::user()->email;
}

function getProfileId(){
  return Auth::user()->profile->id;
}

function getUserAvatarName($user=Null)
{
  if ($user==Null){
    return Auth::user()->avatar;
  } else {
    return $user->avatar;
  }
}

function getUserTypeLabel($type)
{
  $typeList = [
    'U' => 'Usuário',
    'A' => 'Administrador',
    'S' => 'Super Administrador',
  ];

  $colorList = [
    'U' => 'gray',
    'A' => 'red',
    'S' => 'black',
  ];

  $label = "<span class='label bg-$colorList[$type]' title='$typeList[$type]'>$type</span>";

  return $label;
}

function getConfig($config)
{
  $profile = Auth::user()->profile;
  return $profile->$config;
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

function getUserHitRate($userId=Null,$inTarget=False)
{
  $totalOperations = getStartedOperations($userId);

  $result = App\Operation::where('user_id',$userId)
                        ->whereDate('exitdate','>=',$dateLastYear)
                        ->sum('result');
  return $result;
}

function getYearUserResult($userId=Null)
{
  if ($userId==Null){
    $userId = getUserId();
  }

  $now = date('Y-m-d');
  $dateLastYear = alterDate($now,'Y-m-d',0,0,-1);
  $result = App\Operation::where('user_id',$userId)
                        ->whereDate('exitdate','>=',$dateLastYear)
                        ->sum('result');
  return $result;
}

function getMontlyUserResult($startDate=Null,$userId=Null)
{
  if ($userId==Null){
    $userId = getUserId();
  }

  $now = date('Y-m-d');

  if ($startDate==Null){
    $startDate = firstDayOfMonth(alterDate($now,'Y-m-d',0,-11,0));
  } else {
    $startDate = firstDayOfMonth($startDate);
  }

  $currentDate = $startDate;
  $lastResult = 0;
  $currentResult = 0;

  $result = Array();
  $monthResult = 0;
  $month = 0;
  $year = 0;

  do{

    $objDate = new DateTime($currentDate);

    $month = $objDate->format('m');
    $year = $objDate->format('Y');

    $monthResult = App\Operation::where('user_id',$userId)
    ->whereDate('exitdate','>=',$startDate)
    ->whereMonth('exitdate',$month)
    ->whereYear('exitdate',$year)
    ->sum('result');

    $currentResult = $monthResult + $lastResult;

    if ($currentResult>$lastResult){
      $color = 'green';
    } elseif ($currentResult<$lastResult){
      $color = 'red';
    } else {
      $color = 'blue';
    }

    $result[] = ['month' => $objDate->format('M'),
                'year' => $year,
                'color' => $color,
                'total' => $currentResult,
                'result' => $monthResult];

    $currentDate = alterDate($currentDate,'Y-m-d',0,1,0);
    $lastResult = $currentResult;

  } while($currentDate <= $now);

  return $result;
}

function getUserResult($userId=Null)
{
  if ($userId==Null){
    $userId = getUserId();
  }

  return App\Operation::where('user_id',$userId)
              ->whereNotNull('exitdate')
              ->whereNotNull('realexit')
              ->sum('result');
}

function getStrategyResult($strategyId)
{
  return App\Operation::where('strategy_id',$strategyId)
              //->whereNotNull('exitdate')
              //->whereNotNull('realexit')
              ->sum('result');
}

function getUserAvatar($class="img-circle",$alt="Foto do Perfil",$user=Null,$width=Null,$height=Null)
{
  if ($user==Null){
    $user = getUser();
  }
  $src = asset("/storage/avatar/".$user->avatar);
  return getHtmlImage($src,$class,$alt,Null,Null,$width,$height);
}

function getUserLine($user=Null)
{
  if ($user==Null){
    $user = Auth::user();
  }

  $avatar = getUserAvatar('img-circle','Avatar',$user).' '.$user->name;

  if ($user->profile == Null){
    $userLine = '<span class="user-line">'.$avatar.'</span>';
  } else {
    $userLine = '<a class="user-line" href="'.url('profile/'.$user->profile->id).'">'.$avatar.'</a>';
  }

  return $userLine;
}

function getFieldOrQuestion($profile,$field,$initials=False)
{
  if ($profile==Null || $profile->$field==Null){
    return '<i class="fa fa-question text-gray"></i>';
  } else {
    if ($initials){
      return nameInitials($profile->$field,2,True);
    } else {
      return $profile->$field;
    }
  }
}

function getQuestionIcon()
{
  return '<i class="fa fa-question text-gray"></i>';
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

function getUserAdminIcons($user,$resource)
{
  if ($user->confirmed){
    $icons = "<span title='Confirmado' class='text-info'><i class='fa fa-check-square-o'></i></span>";
  } else {
    $icons = "<span title='Não Confirmado' class='text-gray'><i class='fa fa-square-o'></i></span>";
  }

  $icons .= nbsp(2);

  if (isAdmin() || $user->id == getUserId()){
    if ($user->profile!=Null){
      $icons .= "<a title='Editar Usuário' class='text-primary edit-button' href='".url('profile/'.$user->profile->id.'/edit')."'><i class='fa fa-pencil'></i></a>".nbsp(2);
    }
  }

  if (isAdmin()){
    $icons .= "<a title='Deletar Usuário' class='text-danger delete-button' href='".url('user/'.$user->id)."' data-token='".csrf_token()."' data-resource='".$resource."' data-previous='".URL::previous()."'><i class='fa fa-trash'></i></a>".nbsp(2);
    if ($user->locked){
      $icons .= "<a title='Desbloquear Usuário' class='text-warning' href='".url('user/'.$user->id.'/unlock')."'><i class='fa fa-lock'></i></a>";
    } else {
      $icons .= "<a title='Bloquear Usuário' class='text-green' href='".url('user/'.$user->id.'/lock')."'><i class='fa fa-unlock'></i></a>";
    }
  }


  return trim($icons);
}

function getItemAdminIcons($item,$itemType,$resource)
{
  $icons = '';

  if (isAdmin() || $item->user_id == getUserId()){
    $icons .= "<a class='text-primary edit-button' href='".url($itemType.'/'.$item->id.'/edit')."'><i class='fa fa-pencil'></i></a>".nbsp(2);
    $icons .= "<a class='text-danger delete-button' href='".url($itemType.'/'.$item->id)."' data-token='".csrf_token()."' data-resource='".$resource."' data-previous='".URL::previous()."'><i class='fa fa-trash'></i></a>";
  }

  return trim($icons);
}

function getMsgAccessForbidden()
{
  $data = [
    'success' => false,
    'msg' => 'O usuário não possui acesso a este item.',
  ];

  return $data;
}

function getMsgDeleteAccessForbidden()
{
  $data = [
    'success' => false,
    'msg' => 'O usuário não possui autorização para deletar este item.',
  ];

  return $data;
}

function getMsgDeleteError()
{
  $data = [
    'success' => false,
    'msg' => 'Ocorreu um erro ao deletar o item.',
  ];

  return $data;
}

function getMsgDeleteErrorVinculated()
{
  $data = [
    'success' => false,
    'msg' => 'Este item possui registros vinculados, por isso não pode ser deletado.',
  ];

  return $data;
}

function getMsgDeleteErrorLocked()
{
  $data = [
    'success' => false,
    'msg' => 'Este item está bloqueado, por isso não pode ser deletado.',
  ];

  return $data;
}

function getMsgDeleteSuccess()
{
  $data = [
    'success' => true,
    'msg' => 'O item foi deletado com sucesso.',
  ];

  return $data;
}

function getMsgAddSuccess()
{
  $data = [
    'success' => true,
    'msg' => 'O item foi incluído com sucesso.',
  ];

  return $data;
}

function getMsgAddError()
{
  $data = [
    'success' => false,
    'msg' => 'Ocorreu um erro ao incluir o item.',
  ];

  return $data;
}

function getUserLevel($user)
{
  $followers = $user->followers->count();
  $operations = $user->operations->count();
  $result = getUserResult($user->id);

  if ($followers >= 500 && (($operations >= 1000 && $result>=500) || ($operations >= 500 && $result>=1000))){
    $level = 5; //Tubarão
  } elseif ($followers >= 100 && (($operations >= 500 && $result >= 100) || ($operations >= 250 && $result>=500))){
    $level = 4; //Estrategista
  } elseif ($followers >= 50 && (($operations >= 100 && $result >= 50) || ($operations >= 50 && $result>=100))){
    $level = 3; //Analista
  } elseif ($followers >= 10 && (($operations >= 50 && $result > 10) || ($operations >= 10 && $result>=50))){
    $level = 2; //Operador
  } elseif ($operations > 0) {
    $level = 1; //Sardinha
  } else {
    $level = 0; //Observador
  }

  return $level;
}

function getRankName($rank)
{
  $rankList = [
    '0' => 'Observador',
    '1' => 'Sardinha',
    '2' => 'Operador',
    '3' => 'Analista',
    '4' => 'Estrategista',
    '5' => 'Tubarão',
  ];

  return $rankList[$rank];
}

function getRankStars($rank)
{
  $stars = '<span title="'.getRankName($rank).'" ';

  if ($rank == 0){
    return $stars.'class="text-gray"><i class="fa fa-star"></i></span>';
  } elseif ($rank == 5) {
    $stars .= 'class="label bg-black text-yellow">';
  } else {
    $stars .= 'class="text-yellow">';
  }

  for ($i=0;$i<$rank;$i++){
    $stars .= '<i class="fa fa-star"></i>';
  }

  $stars .= '</span>';

  return $stars;
}

function getValueColor($value)
{
  if ($value > 10){
    $color = 'green';
  } elseif ($value > 0){
    $color = 'teal';
  } elseif ($value < 0){
    $color = 'red';
  } else {
    $color = 'gray';
  }
  return $color;
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

function btnValueClass($value)
{
  if ($value > 0) {
    return "success";
  } elseif ($value < 0) {
    return "danger";
  } else {
    return "primary";
  }
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

function br($qtd)
{
  $br = '';
  for ($i=0;$i<$qtd;$i++){
    $br .= '<br>';
  }
  return $br;
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

function getChartInterval($interval='D')
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

function getFollowingId($userId=Null)
{
  if ($userId==Null){
    $users = Auth::user()->following;
  } else {
    $users = App\User::find($userId)->following;
  }

  $arrayId = Array();

  foreach ($users as $user){
    $arrayId[] = $user->id;
  }

  return $arrayId;
}

function getFollowersId($userId=Null)
{
  if ($userId==Null){
    $users = Auth::user()->followers;
  } else {
    $users = App\User::find($userId)->followers;
  }

  $arrayId = Array();

  foreach ($users as $user){
    $arrayId[] = $user->id;
  }

  return $arrayId;
}

function feedRss($link,$limit=10,$showDescription=False)
{
  return 'Notícias...';
  //$rss = simplexml_load_file($link);
  $count = 0;
  $feed = '';

  foreach($rss->channel->item as $item){

    $feedDate = getDateTimeFromString($item->pubDate);
    $feedDate = humanPastTime($feedDate);

    $feed .= "<p class='text-justify font-13'><a href='{$item->link}' target='_blank'>
              {$item->title}</a> <small class='text-muted'>({$feedDate})</small></p>";

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
