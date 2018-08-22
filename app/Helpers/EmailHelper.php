<?php

function getAdminEmails()
{
  return ['pliniomabesi@gmail.com','pliniombs@yahoo.com.br'];
}

function sendRawEmail($to,$fromEmail,$fromName,$subject,$message)
{
  Mail::raw($message, function ($message) use ($to,$fromEmail, $fromName,$subject){
      $message->from($fromEmail, $fromName)
              ->to($to)
              ->subject($subject);
  });

  $failures = count(Mail::failures());

  return ($failures==0);
}

function sendBasicEmail($to,$fromEmail,$fromName,$subject,$message,$title=Null)
{
  $content = '<p class="text-justify">'.$message.'</p>';

  $data = array(
      'content' => $content,
  );

  if ($title!=Null){
    $data['title'] = $title;
  }

  Mail::send('emails.basic', $data, function ($message) use ($to,$fromEmail,$fromName,$subject){
      $message->from($fromEmail, $fromName)
              ->to($to)
              ->subject($subject);
  });

  $failures = count(Mail::failures());

  return ($failures==0);
}

function sendReportConclusionEmail($report)
{
  if ($report->finished){

    $data = array(
      'userName' => $report->user->name,
      'reportedName' => $report->reportedUser->name,
      'reasonName' => getReportReason($report->reason),
      'resolution' => $report->resolution,
    );

    $userEmail = $report->user->email;

    Mail::send('emails.report', $data, function ($message) use ($userEmail){
      $message->from('contato@traderteam.com.br', 'Trader Team')
      ->to($userEmail)
      ->subject('Solução de Denúncia');
    });

    $failures = count(Mail::failures());

    return ($failures==0);
  }
}

function sendContactEmail($to,$fromEmail,$fromName,$usermessage)
{
  $data = array(
      'name' => $fromName,
      'email' => $fromEmail,
      'usermessage' => $usermessage,
  );

  Mail::send('emails.contact', $data, function ($message) use ($to){
      $message->from('contato@traderteam.com.br', 'Trader Team')
              ->to($to)
              ->subject('[Fale Conosco]');
  });

  $failures = count(Mail::failures());

  return ($failures==0);
}

function sendConfirmationEmail($user)
{
  $hashToken = Hash::make($user->name.$user->email);
  $hashToken = strToHex($hashToken);

  $content = '<a href="'.url('user/'.$user->id.'/confirmation/'.$hashToken).'">Clique aqui</a> para confirmar seu email.';

  $data = array(
      'name' => $user->name,
      'content' => $content,
  );

  Mail::send('emails.confirmation', $data, function ($message) use ($user){
      $message->from('contato@traderteam.com.br', 'TraderTeam');
      $message->to($user->email)
              ->subject('Confirmação de email TraderTeam');
  });

  $failures = count(Mail::failures());

  return ($failures==0);
}

function strToHex($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}

function hexToStr($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}
