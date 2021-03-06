<?php

use Illuminate\Support\Facades\Auth;
use App\User;

function dpln($var)
{
  if (isSuperAdmin()){
    dd($var);
  }
}

function isSuperAdmin($user=Null)
{
  if($user==Null){
    $user = getUser();
  }
  if ($user->type=='S'){
    return True;
  } else {
    return False;
  }
}

function isAdmin($user=Null)
{
  if($user==Null){
    $user = getUser();
  }
  if ($user->type=='A' || isSuperAdmin()){
    return True;
  } else {
    return False;
  }
}

function isNotAdmin($user=Null)
{
  if($user==Null){
    $user = getUser();
  }
  if ($user->type=='U'){
    return True;
  } else {
    return False;
  }
}

function isNotSuperAdmin($user=Null)
{
  if($user==Null){
    $user = getUser();
  }
  if ($user->type!='S'){
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
  if (Auth::check()){
    return Auth::user()->name;
  } else {
    return '';
  }
}

function getUserEmail()
{
  if (Auth::check()){
    return Auth::user()->email;
  } else {
    return '';
  }
}

function getProfileId(){
  return Auth::user()->profile->id;
}

function lockUserById($id)
{
  $user = getUser($id);
  $user->locked = True;
  return $user->save();
}

function unlockUserById($id)
{
  $user = getUser($id);
  $user->locked = False;
  return $user->save();
}

function lockUser($user)
{
  $user->locked = True;
  return $user->save();
}

function unlockUser($user)
{
  $user->locked = False;
  return $user->save();
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

function getCofounderLabel($cofounder)
{
  if ($cofounder){
    $label = "<span class='label bg-blue' title='Cofundador TraderTeam'><i class='fa fa-institution'></i></span>";
  } else {
    $label = "";
  }

  return $label;
}

function getConfig($config)
{
  $profile = Auth::user()->profile;
  return $profile->$config;
}

function getConfiguration($name,$type='value')
{
  $configuration = App\Configuration::where('name',$name)->first();
  if (!$configuration==Null){
    if ($type=='value'){
      return $configuration->value;
    } elseif ($type=='content'){
      return $configuration->content;
    } else {
      return Null;
    }
  }
}

function getDefaultFees($sell=False)
{
  $brokerage = (float) getConfiguration('BROKERAGE_FEE');
  $brokerage *= 2;
  $retalRate = (float) getConfiguration('STOCKS_RENTAL_RATE');

  if ($sell){
    return $brokerage + $retalRate;
  } else {
    return $brokerage;
  }
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

function getInvestimentCapital($user=Null)
{
  if ($user==Null){
    $user = getUser();
  }

  if ($user->profile==Null){
    return 100000.00;
  } else {
    return $user->profile->capital;
  }
}

/**function getUserHitRate($userId=Null,$inTarget=False)
{
  $totalOperations = getStartedOperations($userId);

  $result = App\Operation::where('user_id',$userId)
                        ->whereDate('exitdate','>=',$dateLastYear)
                        ->sum('result');
  return $result;
}**/

function getYearUserResult($user=Null)
{
  if ($user==Null){
    $userId = getUserId();
  } else {
    $userId = $user->id;
  }

  $now = date('Y-m-d');
  $dateLastYear = alterDate($now,'Y-m-d',0,0,-1);
  $result = App\Operation::where('user_id',$userId)
                        ->whereDate('exitdate','>=',$dateLastYear)
                        ->sum('result');
  return $result;
}

function getMontlyUserResult($startDate=Null,$user=Null,$bars=12)
{
  if ($user==Null){
    $userId = getUserId();
  } else {
    $userId = $user->id;
  }

  $now = date('Y-m-d');

  if ($startDate==Null){
    $startDate = firstDayOfMonth(alterDate($now,'Y-m-d',0,-($bars-1),0));
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

function getUserResult($user=Null)
{
  if ($user==Null){
    $userId = getUserId();
  } else {
    $userId = $user->id;
  }

  return App\Operation::where('user_id',$userId)
              ->whereNotNull('exitdate')
              ->whereNotNull('realexit')
              ->sum('result');
}

function getUserAvailableCapital($user=Null)
{
  if ($user==Null){
    $capital = getInvestimentCapital();
    $lockedCapital = getUserLockedCapital();
  } else {
    $capital = getInvestimentCapital($user);
    $lockedCapital = getUserLockedCapital($user);
  }

  if ($capital > $lockedCapital){
    return $capital - $lockedCapital;
  } else {
    return 0;
  }
}

function getUserLockedCapital($user=Null)
{
  if ($user==Null){
    $userId = getUserId();
  } else {
    $userId = $user->id;
  }

  $totalLockedCapital = 0;

  $operations = App\Operation::where('user_id',$userId)
                        ->where(function($query){
                            $query->orWhere('status','I')
                                  ->orWhere('status','M');
                        })->get();

  foreach($operations as $operation){
    if ($operation->buyorsell=='C'){
      $totalLockedCapital += ($operation->amount * $operation->preventry) + getDefaultFees();
    } else {
      $totalLockedCapital += (($operation->amount * $operation->preventry) * 1.2) + getDefaultFees(True);
    }
  }

  return $totalLockedCapital;
}

function getStrategyResult($strategyId)
{
  return App\Operation::where('strategy_id',$strategyId)
              ->whereNotNull('realexit')
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

function getUserLink($user=Null,$stars=False)
{
  if ($user==Null){
    $user = Auth::user();
  }

  if ($user->profile == Null){
    $userLine = $user->name;
  } else {
    $userLine = '<a href="'.url('profile/'.$user->profile->id).'">'.$user->name.'</a>';
  }

  if ($stars){
    $userLine .= ' '.getRankStars($user->rank);
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
  if (isSuperAdmin($user)){
    return '';
  }

  $icons = '';

  if (isAdmin() || $user->id == getUserId()){

    if ($user->confirmed){
      $icons .= "<span title='E-mail Confirmado' class='text-info'><i class='fa fa-check-square-o'></i></span>";
    } else {
      $icons .= "<span title='E-mail Não Confirmado' class='text-gray'><i class='fa fa-square-o'></i></span>";
    }

    $icons .= nbsp(2);

    if ($user->profile!=Null){
      $icons .= "<a title='Editar Perfil de Usuário' class='text-primary edit-button' href='".url('profile/'.$user->profile->id.'/edit')."'><i class='fa fa-pencil'></i></a>".nbsp(2);
    }
  }

  if ($user->id != getUserId()){
    $icons .= getReportUserIcon($user);
    $icons .= nbsp(3);
  }

  if (isAdmin()){
    if ($user->locked){
      $icons .= "<a title='Desbloquear Usuário' class='text-danger' href='".url('user/'.$user->id.'/unlock')."'><i class='fa fa-lock'></i></a>";
    } else {
      $icons .= "<a title='Bloquear Usuário' class='text-green' href='".url('user/'.$user->id.'/lock')."'><i class='fa fa-unlock'></i></a>";
    }
    $icons .= nbsp(4);
    $icons .= "<a title='Deletar Usuário' class='text-danger delete-button' href='".url('user/'.$user->id)."' data-token='".csrf_token()."' data-resource='".$resource."' data-previous='".URL::previous()."'><i class='fa fa-trash'></i></a>";
  }


  return trim($icons);
}

function getReportUserIcon($user)
{
  if (isSuperAdmin($user)){
    return '';
  }
  if ($user->id != getUserId()){
    return "<a title='Denunciar Usuário' class='text-warning' href='".url('user/'.$user->id.'/report')."'><i class='fa fa-info'></i></a>";
  }
}

function getTotalOpenDenounces($user=Null)
{
  if ($user==Null){
    return App\Report::where('finished',False)->count();
  } else {
    return $user->denounces()->where('finished',False)->count();
  }
}

function getUserOpenReports($user=Null)
{
  if ($user==Null){
    $user = getUser();
  }

  return $user->reports()->where('finished',False)->count();
}

function hasOpenReport($reportedUser,$user=Null)
{
  if ($user==Null){
    $user = getUser();
  }

  $openReports = $user->reports()
                      ->where('finished',False)
                      ->where('reported_id',$reportedUser->id)
                      ->count();

  return ($openReports > 0);
}

function getItemAdminIcons($item,$itemType,$resource)
{
  $icons = '';

  if (isAdmin() || $item->user_id == getUserId()){
    $icons .= "<a title='Editar Registro' class='text-primary edit-button' href='".url($itemType.'/'.$item->id.'/edit')."'><i class='fa fa-pencil'></i></a>".nbsp(2);
    $icons .= "<a title='Deletar Registro' class='text-danger delete-button' href='".url($itemType.'/'.$item->id)."' data-token='".csrf_token()."' data-resource='".$resource."' data-previous='".URL::previous()."'><i class='fa fa-trash'></i></a>";
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

function getMsgDeleteException()
{
  $data = [
    'success' => false,
    'msg' => 'Ocorreu um erro de exceção ao tentar deletar o item.',
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

function updateUserLevel($user)
{
  $user->rank = getUserLevel($user);
  $user->save();
}

function getUserLevel($user)
{
  $followers = $user->followers->count();
  $operations = $user->operations->count();
  $result = getUserResult($user);

  if ($followers >= 500 && (($operations >= 1000 && $result>=500) || ($operations >= 500 && $result>=1000))){
    $level = 5; //Tubarão
  } elseif ($followers >= 100 && (($operations >= 500 && $result >= 100) || ($operations >= 250 && $result>=500))){
    $level = 4; //Estrategista
  } elseif ($followers >= 50 && (($operations >= 100 && $result >= 50) || ($operations >= 50 && $result>=100))){
    $level = 3; //Analista
  } elseif ($followers >= 1 && (($operations >= 20 && $result > 5) || ($operations >= 10 && $result>=20))){
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
    'P' => 'secondary text-danger',
    'N' => 'default text-green text-bold',
    'A' => 'warning text-bold',
    'I' => 'info text-bold',
    'M' => 'warning text-bold',
    'S' => 'danger text-bold',
    'E' => 'primary text-bold',
    'T' => 'success text-bold',
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
        $preImageFields = ' disabled';
        $postImageFields = ' disabled';
          break;
      case 'N':
      case 'A':
        $prevFields = '';
        $startFields = '';
        $stopField = ' disabled';
        $endFields = ' disabled';
        $postFields = ' disabled';
        $preImageFields = '';
        $postImageFields = ' disabled';
          break;
      case 'I':
      case 'M':
        $prevFields = ' readonly';
        $startFields = ' readonly';
        $stopField = '';
        $endFields = '';
        $postFields = ' disabled';
        $preImageFields = ' disabled';
        $postImageFields = ' disabled';
          break;
      case 'S':
      case 'E':
      case 'T':
        $prevFields = ' readonly';
        $startFields = ' readonly';
        $stopField = ' readonly';
        $endFields = ' readonly';
        $postFields = '';
        $preImageFields = ' disabled';
        $postImageFields = '';
          break;
      default:
        $prevFields = '';
        $startFields = ' disabled';
        $stopField = ' disabled';
        $endFields = ' disabled';
        $postFields = ' disabled';
        $preImageFields = ' disabled';
        $postImageFields = ' disabled';
  }

  $fieldStatus = [
    'strategy_id' => $prevFields,
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
    'fees' => $endFields,

    'preimage01' => $preImageFields,
    'preanalysis01' => $startFields,
    'preimage02' => $preImageFields,
    'preanalysis02' => $startFields,

    'postimage01' => $postImageFields,
    'postanalysis01' => $postFields,
    'postimage02' => $postImageFields,
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

function getLikedOperationId($userId=Null)
{
  if ($userId==Null){
    $operations = Auth::user()->operationsLiked;
  } else {
    $operations = App\User::find($userId)->operationsLiked;
  }

  $arrayId = Array();

  foreach ($operations as $operation){
    $arrayId[] = $operation->id;
  }

  return $arrayId;
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

function getReportReason($id)
{
  $reason = [
    1 => 'Perfil Falso / Clonado',
    2 => 'Comportamento Inadequado',
    3 => 'Infração de Regras',
    4 => 'Racismo e Preconceito',
    5 => 'Spam',
    6 => 'Assédio',
    7 => 'Segurança',
    8 => 'Conteúdo Impróprio',
    9 => 'Outros',
  ];

  return $reason[$id];
}

function getCommentsId($operation)
{
  $arrayId = Array();

  foreach ($operation->comments as $comment){
    $arrayId[] = $comment->id;
  }

  return $arrayId;
}

function hasNewAnswers($operation,$hours=2)
{
  $commentsId = getCommentsId($operation);

  if (count($commentsId)==0){
      return False;
  } else {

    $timestamp = strtotime("-".$hours." hours");
    $dateTime = date('Y-m-d H:i:s',$timestamp);
    $totalAnswers = App\Answer::whereIn('comment_id',$commentsId)
                                ->where('created_at', '>=', $dateTime)
                                ->count();
    if ($totalAnswers > 0){
      return True;
    } else {
      return False;
    }
  }
}

function hasNewComments($operation,$hours=2)
{
  $timestamp = strtotime("-".$hours." hours");
  $dateTime = date('Y-m-d H:i:s',$timestamp);

  $totalComments = $operation->comments->where('created_at', '>=', $dateTime)->count()>0;

  if ($totalComments > 0){
    return True;
  } else {
    return False;
  }
}

function hasNewCommentsOrAnswers($operation,$hours=2)
{
  if (hasNewComments($operation,$hours) || hasNewAnswers($operation,$hours)) {
    return True;
  } else {
    return False;
  }
}

function feedRss($link,$limit=10,$showDescription=False)
{
  return "Notícias...";

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
