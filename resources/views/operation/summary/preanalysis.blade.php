<div class="box box-solid"><!-- box pré operação -->

  <div class="box-header">
    <h3 class="box-title">ANÁLISE ANTES DA OPERAÇÃO</h3>
  </div>

    <div class="box-body">
      <div id="accordion01" class="box-group">

        <div class="panel box box-danger">
          <div class="box-header with-border">
            <h4 class="box-title">
              <i class="fa fa-line-chart"></i>
              <a data-toggle="collapse" data-parent="#accordion01" href="#collapse01">
                Gráfico 01
              </a>
            </h4>
          </div>

          <div id="collapse01" class="panel-collapse collapse in">
            <div class="box-body">
              <div class="col-lg-4">
                <a href="#" class="azoom" title="Clique para aumentar!">
                  <img class="img-max pad preimage01"
                  src="{{ asset('/storage/operations/'.
                  (isset($preimage01)?$operation->user_id.'/'.$operation->id.'/'.
                  $preimage01:'../../img/loading.gif'))}}" />
                </a>
              </div>
              <div class="col-lg-8">
                {!! (isset($preanalysis01)?$preanalysis01:Null) !!}
              </div>
            </div>
          </div>
        </div>

        <div class="panel box box-danger">
          <div class="box-header with-border">
            <h4 class="box-title">
              <i class="fa fa-line-chart"></i>
              <a data-toggle="collapse" data-parent="#accordion01" href="#collapse02">
                Gráfico 02
              </a>
            </h4>
          </div>

          <div id="collapse02" class="panel-collapse collapse">
            <div class="box-body">
              <div>
                <a href="#" class="azoom" title="Clique para aumentar!">
                  <img class="img-max pad preimage02"
                  src="{{ asset('/storage/operations/'.
                  (isset($preimage02)?$operation->user_id.'/'.$operation->id.'/'.
                  $preimage02:'../../img/loading.gif'))}}" />
                </a>
              </div>
              <div>
                {!! (isset($preanalysis02)?$preanalysis02:Null) !!}
              </div>
            </div>
          </div>
        </div>

      </div>
  </div>
</div><!-- box pré operação -->
