@extends('layouts.blank')

@push('css')
  <link rel="stylesheet" href="{{ asset("/adminlte/plugins/iCheck/square/blue.css") }}">
  <link rel="stylesheet" href="{{ asset('/css/loginlogout.css') }}">
@endpush

@section('content')
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{ route('home') }}"><img class="img-responsive" src="{{ asset('/img/logo.png') }}" alt="{{ config('app.name', 'Laravel <b>Admin</b>LTE') }}" /></a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Preencha os campos abaixo para se registrar</p>

    <form action="{{ route('register') }}" method="post">

      {{ csrf_field() }}

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
        <input id="name" type="text" class="form-control" placeholder="Nome + Sobrenome" maxlength="30"
                name="name" value="{{ old('name') }}" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

        @if ($errors->has('name'))
            <span class="help-block">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
        <input id="email" type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
        <input id="password" type="password" class="form-control" placeholder="Senha (min: 8 caracteres)" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group has-feedback">
        <input id="password-confirm" type="password" class="form-control" placeholder="Repita a senha" name="password_confirmation" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <small>Digite os caracteres abaixo no campo ao lado:</small><br>
        {!! captcha_img() !!}
        <input type="text" name="captcha" maxlength="10" id="captcha" required><br>
        @if ($errors->has('captcha'))
            <span class="label text-danger font-14">
                <strong>{{ $errors->first('captcha') }}</strong>
            </span>
        @endif
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="terms" value="1" required> Eu concordo com os <a href="{{ url('/terms') }}" target="_blank">Termos</a>
            </label>
            @if ($errors->has('terms'))
                <span class="label text-danger">
                    <strong>{{ $errors->first('terms') }}</strong>
                </span>
            @endif
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="{{ route('login') }}" class="text-center">Já tenho uma conta. Quero me logar.</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection

@push('scripts')
<script src="{{ asset("/adminlte/plugins/iCheck/icheck.min.js") }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
@endpush
