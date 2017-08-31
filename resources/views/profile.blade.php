@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              {!! getUserAvatar('profile-user-img img-responsive img-circle',Auth::user()->name,$user) !!}

              <h3 class="profile-username text-center">{{ $user->name }}</h3>

              <p class="text-muted text-center">Membro desde {{ $user->memberSince() }}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-md-6">
                      <b>Seguidores</b> <a class="pull-right">27</a>
                    </div>
                    <div class="col-md-6">
                      <b>Seguindo</b> <a class="pull-right">18</a>
                    </div>
                  </div>
                </li>
                <li class="list-group-item">
                </li>
                <li class="list-group-item">
                  <b>Estratégias</b> <a class="pull-right">5</a>
                </li>
                <li class="list-group-item">
                  <b>Operações</b> <a class="pull-right">34</a>
                </li>
                <li class="list-group-item">
                  <b>Resultado Geral</b> <a class="pull-right">22,67%</a>
                </li>
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Seguir</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Sobre Mim</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-birthday-cake margin-r-5"></i> {{ humanPastTime($profile->birthdate) }}</strong>
              <p class="text-muted">
                Aniversário em {{ birthday($profile->birthdate,true) }}
              </p>

              <strong><i class="fa fa-briefcase margin-r-5"></i> Ocupação</strong>
              <p class="text-muted">
                {{ $profile->occupation }}
              </p>

              <strong><i class="fa fa-map-marker margin-r-5"></i> Localização</strong>
              <p class="text-muted">
                {{ $profile->city.(isset($profile->state)?', ':'').$profile->state.(isset($profile->country)?' - ':'').$profile->country }}
              </p>

              <strong><i class="fa fa-commenting margin-r-5"></i> Quem Sou Eu?</strong>
              <p class="text-muted text-justify">
                {!! $profile->description !!}
              </p>

              <strong><i class="fa fa-globe margin-r-5"></i> Site</strong>
              <p class="text-muted text-justify">
                {!! $profile->site !!}
              </p>

              <strong><i class="fa  fa-facebook-square margin-r-5"></i> Facebook</strong>
              <p class="text-muted text-justify">
                {!! $profile->facebook !!}
              </p>

              <strong><i class="fa  fa-twitter-square margin-r-5"></i> Twitter</strong>
              <p class="text-muted text-justify">
                {!! $profile->twitter !!}
              </p>

              <strong><i class="fa  fa-money margin-r-5"></i> Capital de Investimento</strong>
              <p class="text-muted text-justify">
                {{ formatCurrency($profile->capital) }}
              </p>

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#operations" data-toggle="tab">Operações</a></li>
              <li><a href="#strategies" data-toggle="tab">Estratégias</a></li>
              <li><a href="#settings" data-toggle="tab">Configurações</a></li>
            </ul>
            <div class="tab-content">

              <!-- /.tab-pane -->
              <div class="tab-pane active" id="operations">

                @include('layouts.operation.list')
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="strategies">
                @include('layouts.strategy.list')
              </div>

              <div class="tab-pane" id="settings">
                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Informações do Perfil</h3>
                  </div>

                  @include('layouts.formprofile')

                </div>

                <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title">Alterar Senha</h3>
                  </div>
                  <form class="form-horizontal">
                    <div class="form-group">
                      <label for="password" class="col-sm-3 control-label">Senha Atual</label>

                      <div class="col-sm-9">
                        <input type="password" name="password" class="form-control" id="password">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="confirmPassword" class="col-sm-3 control-label">Nova Senha</label>

                      <div class="col-sm-9">
                        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="confirmPassword" class="col-sm-3 control-label">Confirme a Senha</label>

                      <div class="col-sm-9">
                        <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-danger">Enviar</button>
                      </div>
                    </div>
                  </form>
                </div>


              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
