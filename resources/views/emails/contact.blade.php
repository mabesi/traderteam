<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Fale Conosco</h2>

<div>
  <p>Nome: <strong>{{ $name }}</strong></p>
  <p>E-mail: <strong>{{ $email }}</strong></p>
@if (Auth::check())
  <p>Perfil: {!! getUserLink() !!}</p>
@endif
  <p>Criada em: <strong>{{ getBRDateTime() }}</strong></p>
  <p></p>
  <p>Assunto: <strong>{{ $subject }}</strong></p>
  <p class="text-justify">Mensagem: {{ $usermessage }}</p>
</div>

</body>
</html>
