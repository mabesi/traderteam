@extends('layouts.panel')

@section('content')

<div class="row">
  <div class="col-md-12">

          <div class="box box-solid">

              <div class="box-body">
                <div id="accordion01" class="box-group">

                  <div class="panel box box-warning">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-newspaper-o"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse01">
                          Painel do Usuário
                        </a>
                      </h4>
                    </div>

                    <div id="collapse01" class="panel-collapse collapse in">
                      <div class="box-body">

                        <div class="post pad">
                          {!! (isset($helpUserPanel->content)?$helpUserPanel->content:'Conteúdo não encontrado. Verfique na seção Configurações o item HELP_USER_PANEL.') !!}
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel box box-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-user"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse02">
                          Perfil e Configurações
                        </a>
                      </h4>
                    </div>

                    <div id="collapse02" class="panel-collapse collapse">
                      <div class="box-body">

                        <div class="post pad">
                          {!! (isset($helpProfile->content)?$helpProfile->content:'Conteúdo não encontrado. Verfique na seção Configurações o item HELP_PROFILE.') !!}
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-lightbulb-o"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse03">
                          Estratégias e Indicadores
                        </a>
                      </h4>
                    </div>

                    <div id="collapse03" class="panel-collapse collapse">
                      <div class="box-body">
                        <h2>Indicadores</h2>
                        {!! (isset($helpIndicator->content)?$helpIndicator->content:'Conteúdo não encontrado. Verfique na seção Configurações o item HELP_INDICATOR.') !!}
                        <h2>Estratégias</h2>
                        {!! (isset($helpStrategy->content)?$helpStrategy->content:'Conteúdo não encontrado. Verfique na seção Configurações o item HELP_STRATEGY.') !!}
                      </div>
                    </div>
                  </div>

                  <div class="panel box box-danger">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-line-chart"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse04">
                          Operações
                        </a>
                      </h4>
                    </div>

                    <div id="collapse04" class="panel-collapse collapse">
                      <div class="box-body">
                        {!! (isset($helpOperation->content)?$helpOperation->content:'Conteúdo não encontrado. Verfique na seção Configurações o item HELP_OPERATION.') !!}
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
