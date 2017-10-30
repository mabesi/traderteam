@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary pad">
            <div class="box-header with-border">
              <h3 class="box-title">Informações do Perfil</h3>
            </div>

            @include('profile.formprofile')

            <br />
          </div>

          <div class="box box-danger pad">
            <div class="box-header with-border">
              <h3 class="box-title">Alterar Senha</h3>
            </div>

            @include('profile.changepassword')

            <br />
          </div>

          <div class="box box-success pad">
            <div class="box-header with-border">
              <h3 class="box-title">Configurações</h3>
            </div>
            <div class="pad">
              @include('profile.configurations')
            </div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
