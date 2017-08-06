@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset("/adminlte2/plugins/iCheck/square/blue.css") }}">
@endpush


@section('content')
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="{{ route('home') }}">Laravel <b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="{{ route('register') }}" method="post">
      
      {{ csrf_field() }}

      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
        <input id="name" type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}" required>
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
        <input id="password" type="password" class="form-control" placeholder="Password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>

      <div class="form-group has-feedback">
        <input id="password-confirm" type="password" class="form-control" placeholder="Retype password" name="password_confirmation" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
        Google+</a>
    </div>

    <a href="login.html" class="text-center">I already have a membership</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->
@endsection

@push('scripts')
<script src="{{ asset("/adminlte2/plugins/iCheck/icheck.min.js") }}"></script>
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
