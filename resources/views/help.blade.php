@extends('layouts.panel')

@section('content')

<div class="row">
  <div class="col-md-12">

          <div class="box box-solid">

              <div class="box-body">
                <div id="accordion01" class="box-group">

                  <div class="panel box box-primary">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-user"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse01">
                          Perfil e Configurações
                        </a>
                      </h4>
                    </div>

                    <div id="collapse01" class="panel-collapse collapse in">
                      <div class="box-body">

                        <div class="post pad">
                          <h3>Item 1</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                          <h3>Item 2</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                          <h3>Item 3</h3>
                          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="panel box box-success">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-lightbulb-o"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse02">
                          Estratégias e Indicadores
                        </a>
                      </h4>
                    </div>

                    <div id="collapse02" class="panel-collapse collapse">
                      <div class="box-body">
                        Blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá ...
                      </div>
                    </div>
                  </div>

                  <div class="panel box box-danger">
                    <div class="box-header with-border">
                      <h4 class="box-title">
                        <i class="fa fa-line-chart"></i>
                        <a data-toggle="collapse" data-parent="#accordion01" href="#collapse03">
                          Operações
                        </a>
                      </h4>
                    </div>

                    <div id="collapse03" class="panel-collapse collapse">
                      <div class="box-body">
                        Blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá blá ...
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
