@extends('layouts.panel')

@section('content')

<div class="row">
  <div class="col-md-12">

        <div class="pad font-20 text-muted">Termo de busca: <strong >{{ $q }}</strong></div>

          <div class="box box-solid">
              <div class="box-body">
                <div id="accordion01" class="box-group text-muted pad">

                  <div class="panel box box-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-group"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse01">
                          Usuários ({{ count($users) + count($profiles) }})
                        </a>
                      </h4>
                    </div>

                    <div id="collapse01" class="panel-collapse collapse in">
                      <div class="box-body no-padding">
                        <div class="container">
                          <div class="row">
                            <h4>Por Nome</h4>
                            @include('search.users')
                          </div>
                          <div class="row">
                            <h4>Por Informações do Perfil</h4>
                            @include('search.profiles')
                          </div>
                        </div>
                        <div class="box-footer">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-lightbulb-o"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse02">
                          Estratégias ({{ count($strategies) }}) e Indicadores ({{ count($indicators)}})
                        </a>
                      </h4>
                    </div>

                    <div id="collapse02" class="panel-collapse collapse">
                      <div class="box-body no-padding">
                        <div class="container">
                          <div class="row">
                            <h4>Estratégias ({{ count($strategies) }})</h4>
                            @include('search.strategies')
                          </div>
                          <div class="row">
                            <h4>Indicadores ({{ count($indicators)}})</h4>
                            @include('search.indicators')
                          </div>
                        </div>
                      </div>
                      <div class="box-footer">
                      </div>
                    </div>
                  </div>

                  <div class="panel box box-danger">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-line-chart"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse03">
                          Operações *
                        </a>
                      </h4>
                    </div>

                    <div id="collapse03" class="panel-collapse collapse">
                      <div class="box-body no-padding">
                        <h4>Para realizar esta pesquisa utilize a página de <a href="{{ url('operation') }}">Operações</a>.</h4>
                      </div>
                      <div class="box-footer">
                      </div>
                    </div>
                  </div>

                  <div class="panel box box-warning">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-bullhorn"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse04">
                          Avisos ({{ count($notices) }})
                        </a>
                      </h4>
                    </div>

                    <div id="collapse04" class="panel-collapse collapse">
                      <div class="box-body no-padding">
                        <div class="container">
                          <div class="row">
                            @include('search.notices')
                          </div>
                        </div>
                      </div>
                      <div class="box-footer">
                      </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>

  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@endsection
