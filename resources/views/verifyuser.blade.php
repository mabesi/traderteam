@extends('layouts.blank')

@push('css')
  <link rel="stylesheet" href="{{ asset("/css/cover.css") }}">
@endpush

@section('content')

@include('layouts.logo')

@include('layouts.errors')

<div class="container">

@if (!$user->confirmed)
  <div class="row">
    <div class="col-sm-12 text-justify">
      <h2>Confirmação de E-mail</h2>

      <p>Caro usuário, você ainda não confirmou seu e-mail.</p>
      <p>Caso não tenha recebido o link de confirmação <a href="{{ url('user/'.$userId.'/send-confirmation') }}">clique aqui</a> para que o mesmo seja reenviado.</p>

    </div>
  </div>
@elseif ($confirmation)
<div class="row">
  <div class="col-sm-12 text-justify">
    <h2>Confirmação de E-mail</h2>
    <p>{{ $user->name }}, você confirmou seu email com sucesso.</p>
    <p><a href="{{ url('login') }}">Clique aqui</a> para efetuar login.</p>
  </div>
</div>
@elseif ($user->locked)
<div class="row">
  <div class="col-sm-12 text-justify">
    <h2>Conta Bloqueada</h2>

    <p>Caro usuário, sua conta encontra-se bloqueada.</p>
    <p>Para liberá-la por favor entre em contato com a administração através do <a href="{{ url('contact') }}">Fale Conosco</a>.</p>

  </div>
</div>
@endif
</div>

<br><br><br><br><br>
<div class="row" id="footer">
  <div class="col-sm-12 text-center">
    <strong>TraderTeam</strong><br>
    COPYRIGHT 2017 <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span> Todos os direitos reservados.
  </div>
</div>
@endsection

@push('scripts')
@endpush
