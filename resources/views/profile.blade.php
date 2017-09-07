@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">

              {!! getUserAvatar('profile-user-img img-responsive img-circle',Auth::user()->name,$user) !!}

              <h3 class="profile-username text-center">{{ $user->name }} <span class="text-yellow">{!! getLevelStars($profile->level) !!}</span></h3>
              <center class="text-muted font-12 text-center">Membro desde {{ $user->memberSince() }}</center>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-sm-6">
                      <b>Seguidores</b> <a href="{{ url('user/'.$user->id.'/followers') }}" class="pull-right">{{ $user->followers->count() }}</a>
                    </div>
                    <div class="col-sm-6">
                      <b>Seguindo</b> <a href="{{ url('user/'.$user->id.'/following') }}" class="pull-right">{{ $user->following->count() }}</a>
                    </div>
                  </div>
                </li>

                <li class="list-group-item">
                  <div class="row">
                    <div class="col-sm-6">
                      <b>Estratégias</b> <a href="{{ url('strategies/user/'.$user->id) }}" class="pull-right">{{ $user->strategies->count() }}</a>
                    </div>
                    <div class="col-sm-6">
                      <b>Operações</b> <a href="{{ url('operations/user/'.$user->id) }}" class="pull-right">{{ $user->operations->count() }}</a>
                    </div>
                  </div>
                </li>

              </ul>

@if ($user->id != getUserId())
  @if ($following)
              <a href="{{ url('user/'.$user->id.'/unfollow') }}" class="btn btn-danger btn-block"><b>Deixar de Seguir</b></a>
  @else
              <a href="{{ url('user/'.$user->id.'/follow') }}" class="btn btn-primary btn-block"><b>Seguir</b></a>
  @endif
@endif
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <div class="box box-solid">

              <div class="box-body">
                <div id="accordion01" class="box-group">

                  <div class="panel box box-info">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-pie-chart"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse01">
                          Estatísticas de Operações
                        </a>
                      </h4>
                    </div>

                    <div id="collapse01" class="panel-collapse collapse in">
                      <div class="box-body bg-gray">
                        @include('operation.statisticinfo')
                      </div>
                    </div>
                  </div>

                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-line-chart"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse02">
                          Evolução de Resultados
                        </a>
                      </h4>
                    </div>

                    <div id="collapse02" class="panel-collapse collapse">
                      <div class="box-body bg-gray">
                        @include('operation.resultinfo')
                      </div>
                    </div>
                  </div>

                  <div class="panel box box-danger">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-user"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse03">
                          Sobre Mim
                        </a>
                      </h4>
                    </div>

                    <div id="collapse03" class="panel-collapse collapse">
                      <div class="box-body">
                        @include('profile.personalinfo')
                      </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>

        </div> <!-- /.col -->


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
                @include('operation.list')
                <div class="post top-5 with-border">
                  <a href="{{ url('operations/user/'.$user->id) }}" class="">Ver Todas</a>
                </div>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="strategies">
                @include('strategy.list')
                <div class="post top-5 with-border">
                  <a href="{{ url('strategies/user/'.$user->id) }}" class="">Ver Todas</a>
                </div>
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

                  <div class="box-body">
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
