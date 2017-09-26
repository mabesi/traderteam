@extends('layouts.blank')

@push('css')
  <link rel="stylesheet" href="{{ asset("/adminlte/plugins/iCheck/square/blue.css") }}">
  <link rel="stylesheet" href="{{ asset('/css/loginlogout.css') }}">
@endpush

@section('content')
<body class="hold-transition login-page">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="register-logo">
            <a href="{{ route('home') }}"><img class="img-responsive" src="{{ asset('/img/logo.png') }}" alt="{{ config('app.name', 'Laravel <b>Admin</b>LTE') }}" /></a>
          </div>
              <div class="panel panel-default">
                <div class="panel-heading">Recuperar Senha</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Cadastrado</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar Link de Recuperação de Senha
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
