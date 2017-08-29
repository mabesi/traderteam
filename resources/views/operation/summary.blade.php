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
    </div>
    <div class="box-body">

      <div class="col-md-3 text-right">
        <strong>Estratégia</strong>
      </div>
      <div class="col-md-9">
        <a href="{{ url('strategy/'.$operation->strategy->id) }}">{{ $operation->strategy->title }}</a>
      </div>

      <div class="col-md-3 text-right">
        <strong>Tempo Gráfico</strong>
      </div>
      <div class="col-md-9">
        {{ gtimeName($operation->gtime) }}
      </div>

      <div class="col-md-12 label bg-gray top-bottom-10 text-primary">
          <h4>PREVISÃO DA OPERAÇÃO</h4>
      </div>

      <div class="col-md-4">
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
      <div class="col-md-4">
        <div class="info-box">
          <span class="info-box-icon bg-olive">
            <i class="fa fa-money"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Alvo</span>
            <span class="info-box-number">{{ $operation->prevtarget }}</span>
            <span class="info-box-text">{{ $operation->prevReturn() }}% - {{ $operation->prevCapitalReturn() }}%</span>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="info-box">
          <span class="info-box-icon bg-orange">
            <i class="fa fa-life-ring"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Stop</span>
            <span class="info-box-number">{{ $operation->prevstop }}</span>
            <span class="info-box-text">{{ $operation->prevRisk() }}% - {{ $operation->prevCapitalRisk() }}%</span>
          </div>
        </div>
      </div>

      <div class="label bg-gray col-md-12 top-bottom-10 text-primary">
          <h4>REGISTRO DA OPERAÇÃO</h4>
      </div>

      <div class="col-md-6">
        <div class="info-box">
          <span class="info-box-icon bg-blue">
            <i class="fa fa-play-circle"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Entrada</span>
            <span class="info-box-number">{{ $operation->realentry }}12,20</span>
            <span class="info-box-text">{{ $operation->entrydate }}</span>
          </div>
        </div>
      </div>
@if ($operation->realexit == Null)
    <div class="col-md-6">
      <div class="info-box">
        <span class="info-box-icon bg-red">
          <i class="fa fa-life-ring"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Stop Atual</span>
          <span class="info-box-number">{{ $operation->currentstop }}8,50</span>
        </div>
      </div>
    </div>
@else
    <div class="col-md-6">
      <div class="info-box">
        <span class="info-box-icon bg-green">
          <i class="fa fa-money"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Saida {{ $operation->exitdate }}</span>
          <span class="info-box-number">{{ $operation->realexit }}22,60</span>
          <span class="info-box-text">{{ $operation->prevReturn() }}% - {{ $operation->prevCapitalReturn() }}%</span>
        </div>
      </div>
    </div>
@endif





      <div class="col-md-3 text-right">
        <strong></strong>
      </div>
      <div class="col-md-9">

      </div>

      <div class="col-md-3 text-right">
        <strong></strong>
      </div>
      <div class="col-md-9">

      </div>

      <div class="col-md-3 text-right">
        <strong></strong>
      </div>
      <div class="col-md-9">

      </div>

      <div class="col-md-3 text-right">
        <strong></strong>
      </div>
      <div class="col-md-9">

      </div>

      <div class="col-md-3 text-right">
        <strong></strong>
      </div>
      <div class="col-md-9">

      </div>

      <div class="col-md-3 text-right">
        <strong></strong>
      </div>
      <div class="col-md-9">

      </div>

    </div>


  </div>

  <div class="col-md-6">

  </div>
</div>
<div class="row">
  <div class="col-md-6">

  </div>
  <div class="col-md-6">

  </div>
</div>
@include('layouts.imagemodal')
@endsection

@push('scripts')
<script src="{{ asset("/js/img-helper.js") }}"></script>
@endpush
