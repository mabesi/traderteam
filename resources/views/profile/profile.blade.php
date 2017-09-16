@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-lg-4">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              {!! getUserTypeLabel($user->type) !!}
              {!! getCofounderLabel($profile->cofounder) !!}

              {!! getUserAvatar('profile-user-img img-responsive img-circle',$user->name,$user) !!}

              <h3 class="profile-username text-center">{{ $user->name }}</h3>
              <div class="font-20 text-center">{!! getRankStars($user->rank) !!}</div>
              <div class="text-center text-muted">{{ getRankName($user->rank) }}</div>
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


        <div class="col-lg-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#operations" data-toggle="tab"><b>Operações</b></a></li>
              <li><a href="#strategies" data-toggle="tab"><b>Estratégias</b></a></li>
@if (isAdmin() || $user->id == getUserId())
              <li><a href="#settings" data-toggle="tab"><b>Configurações</b></a></li>
@endif
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

@if (isAdmin() || $user->id == getUserId())
              <div class="tab-pane" id="settings">

                <div class="box box-primary">
                  <div class="box-header with-border">
                    <h3 class="box-title">Informações do Perfil</h3>
                  </div>

                  <div class="box-body">
                  @include('profile.formprofile')
                </div>

                </div>

                <div class="box box-danger">
                  <div class="box-header with-border">
                    <h3 class="box-title">Alterar Senha</h3>
                  </div>

                  <div class="box-body">
                    @include('profile.changepassword')
                  </div>

                </div>

                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Configurações</h3>
                  </div>

                  <div class="box-body">
                    @include('profile.configurations')
                  </div>

                </div>
@endif

              </div><!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
