@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset('/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')

<div class="row">
  <div class="col-md-6">

    <div class="box">

      <div class="box-header">
        @include('operation.lineview')
      </div>

    <div class="box-body">

      <div class="row">
        <div class="col-md-3">
          <strong>Operação</strong>
        </div>
        <div class="col-md-9">
          {{ operationBuyOrSell($operation->buyorsell).' - '.operationRealOrSimulated($operation->realorsimulated) }}
        </div>
      </div>

@if ($operation->user_id == getUserId())
      <div class="row">
        <div class="col-md-3">
          <strong>Quantidade</strong>
        </div>
        <div class="col-md-9">
          {{ $operation->amount }}
        </div>
      </div>
@endif

      <div class="row">
        <div class="col-md-3">
          <strong>Tempo Gráfico</strong>
        </div>
        <div class="col-md-9">
          {{ gtimeName($operation->gtime) }}
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <strong>Criada a</strong>
        </div>
        <div class="col-md-9">
          {{ humanPastTime($operation->created_at) }}
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <strong>Estratégia</strong>
        </div>
        <div class="col-md-9">
          <a href="{{ url('strategy/'.$operation->strategy->id) }}">{{ $operation->strategy->title }}</a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-3">
          <strong>Criada por</strong>
        </div>
        <div class="col-md-9">
          @include('user.lineview')
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">

          <div class="box box-solid top-10">
            <div class="box-head">
              <div class="col-xs-12 label text-blue top-bottom-5">
                <h3>Previsão da Operação</h3>
              </div>
            </div>
            <div class="box-body bg-gray">

              <div class="col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-aqua">
                    <i class="fa fa-play-circle"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Entrada</span>
                    <span class="info-box-number">{{ $operation->preventry }}</span>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-orange">
                    <i class="fa fa-life-ring"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Stop</span>
                    <span class="info-box-number">{{ $operation->prevstop }}</span>
                    <span class="font-12">{{ $operation->prevRisk() }}%</span>
                    <span class="font-12">{{ $operation->prevCapitalRisk() }}%</span>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="info-box">
                  <span class="info-box-icon bg-olive">
                    <i class="fa fa-money"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Alvo</span>
                    <span class="info-box-number">{{ $operation->prevtarget }}</span>
                    <span class="font-12">{{ $operation->prevReturn() }}%</span>
                    <span class="font-12">{{ $operation->prevCapitalReturn() }}%</span>
                  </div>
                </div>
              </div>


            </div>

          </div>
        </div>
        <div class="col-lg-6">

          <div class="box box-solid top-10 bg-gray">
            <div class="box-head">
              <div class="col-xs-12 label text-blue top-bottom-5">
                <h3>Registro da Operação</h3>
              </div>
            </div>
            <div class="box-body">
              <div class="col-xs-12">
                <div class="info-box bg-blue">
                  <span class="info-box-icon">
                    <i class="fa fa-play-circle"></i>
                  </span>
                  <div class="info-box-content">
                    <span class="info-box-text">Entrada</span>
                    <span class="info-box-number">{{ $operation->realentry }}</span>
                    <span class="info-box-text">{{ getBRDateFromMysql($operation->entrydate) }}</span>
                  </div>
                </div>
              </div>
              <div class="col-xs-12">

                @if ($operation->realexit == Null)
                      <div class="info-box bg-red">
                        <span class="info-box-icon">
                          <i class="fa fa-life-ring"></i>
                        </span>
                        <div class="info-box-content">
                          <span class="info-box-text">Stop Atual</span>
                          <span class="info-box-number">{{ $operation->currentstop }}</span>
                        </div>
                      </div>
                @else
                  @if (($operation->realexit >= $operation->realentry && $operation->buyorsell == 'C') || ($operation->realexit <= $operation->realentry && $operation->buyorsell == 'V'))
                      <div class="info-box bg-green">
                  @else
                        <div class="info-box bg-red">
                  @endif
                          <span class="info-box-icon">
                            <i class="fa fa-money"></i>
                          </span>
                        <div class="info-box-content">
                          <span class="info-box-text">Saída {{ getBRDateFromMysql($operation->exitdate) }}</span>
                          <span class="info-box-number">{{ $operation->realexit }}</span>
                          <span class="info-box-text">{{ $operation->operationReturn() }}% / {{ $operation->capitalReturn() }}%</span>
                        </div>
                      </div>
                @endif


              </div>
            </div>
          </div>

        </div>
      </div>


    </div>
  </div>
</div> <!-- fim col -->

  <div class="col-md-6">

      <div class="box box-solid">

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
    </div>

@if ($operation->realexit != Null)
      <div class="box box-solid">
        <div class="box-header">
          <h3 class="box-title">ANÁLISE APÓS A OPERAÇÃO</h3>
        </div>

          <div class="box-body">
            <div id="accordion02" class="box-group">

              <div class="panel box box-success">
                <div class="box-header with-border">
                  <h4 class="box-title">
                    <i class="fa fa-line-chart"></i>
                    <a data-toggle="collapse" data-parent="#accordion02" href="#collapse03">
                      Gráfico 01
                    </a>
                  </h4>
                </div>

                <div id="collapse03" class="panel-collapse collapse">
                  <div class="box-body">
                    <div>
                      <a href="#" class="azoom" title="Clique para aumentar!">
                        <img class="img-max pad postimage01"
                        src="{{ asset('/storage/operations/'.
                        (isset($postimage01)?$operation->user_id.'/'.$operation->id.'/'.
                        $postimage01:'../../img/loading.gif'))}}" />
                      </a>
                    </div>
                    <div>
                      {!! (isset($postanalysis01)?$postanalysis01:Null) !!}
                    </div>
                  </div>
                </div>
              </div>

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
                    <div>
                      {!! (isset($postanalysis02)?$postanalysis02:Null) !!}
                    </div>
                  </div>
                </div>
              </div>
@endif

            </div>
        </div>
    </div>

  </div> <!-- fim col -->

</div><!-- fim row -->


@include('layouts.imagemodal')
@endsection

@push('scripts')
<script src="{{ asset("/js/img-helper.js") }}"></script>
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
