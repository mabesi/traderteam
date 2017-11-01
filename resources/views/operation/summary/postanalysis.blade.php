@if ($operation->realexit != Null)
<div class="box box-solid"><!-- box pós operação -->
  <div class="box-header">
    <h3 class="box-title">ANÁLISE APÓS A OPERAÇÃO</h3>
  </div>

  <div class="box-body">
    <div id="accordion02" class="box-group">

@if ($postanalysis01 == Null && $postanalysis02 == Null)
  <div class="">
    A pós-análise para esta operação ainda não foi publicada!
  </div>
@else

  @if ($postanalysis01 != Null)
      <div class="panel box box-success">
        <div class="box-header with-border">
          <h4 class="box-title">
            <i class="fa fa-line-chart"></i>
            <a data-toggle="collapse" data-parent="#accordion02" href="#collapse03">
              Gráfico 01
            </a>
          </h4>
        </div>
        <div id="collapse03" class="panel-collapse collapse in">
          <div class="box-body">
            <div>
              <a href="#" class="azoom" title="Clique para aumentar!">
                <img class="img-max pad postimage01"
                src="{{ asset('/storage/operations/'.
                (isset($postimage01)?$operation->user_id.'/'.$operation->id.'/'.
                $postimage01:'../../img/loading.gif'))}}" />
              </a>
            </div>
            <div class="text-justify">
              {!! $postanalysis01 !!}
            </div>
          </div>
        </div>
      </div>
  @endif

  @if ($postanalysis02 != Null)
      <div class="panel box box-success">
        <div class="box-header with-border">
          <h4 class="box-title">
            <i class="fa fa-line-chart"></i>
            <a data-toggle="collapse" data-parent="#accordion02" href="#collapse04">
              Gráfico 02
            </a>
          </h4>
        </div>

        <div id="collapse04" class="panel-collapse collapse">
          <div class="box-body">
            <div>
              <a href="#" class="azoom" title="Clique para aumentar!">
                <img class="img-max pad postimage02"
                src="{{ asset('/storage/operations/'.
                (isset($postimage02)?$operation->user_id.'/'.$operation->id.'/'.
                $postimage02:'../../img/loading.gif'))}}" />
              </a>
            </div>
            <div class="text-justify">
              {!! $postanalysis02 !!}
            </div>
          </div>
        </div>
      </div>

  @endif
@endif

    </div>
  </div>
</div><!-- box pós operação -->
@endif
