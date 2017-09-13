<?php

function sendConfirmationEmail($user) {

  $hashToken = Hash::make($user->name.$user->email);

  $hashToken = strToHex($hashToken);

  $content = '<a href="'.url('user/'.$user->id.'/confirmation/'.$hashToken).'">Clique aqui</a> para confirmar seu email.';

  $data = array(
      'name' => $user->name,
      'content' => $content,
  );

  Mail::send('emails.confirmation', $data, function ($message) use ($user){
      $message->from('pliniomabesi@gmail.com', 'TraderTeam');
      $message->to($user->email)
              ->subject('Confirmação de email TraderTeam');
  });

  return True;
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
