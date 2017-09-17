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
    {{ $operation->amount.nbsp(4) }} <small class="text-muted"><--- Só você pode ver isto!</small>
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
