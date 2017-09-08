@php

$newOperations = App\Operation::getNewOperations($user->id);
$startedOperations = App\Operation::getStartedOperations($user->id);
$finishedOperations = App\Operation::getFinishedOperations($user->id);
$targetedOperations = App\Operation::getTargetedOperations($user->id);
$lucrativeOperations = App\Operation::getLucrativeOperations($user->id);
$breakEvenOperations = App\Operation::getBreakEvenOperations($user->id);
$lossyOperations = App\Operation::getLossyOperations($user->id);

if ($finishedOperations>0) {
  $targetedRate = $targetedOperations * 100 / $finishedOperations;
  $lucrativeRate = $lucrativeOperations * 100 / $finishedOperations;
  $breakEvenRate = $breakEvenOperations * 100 / $finishedOperations;
  $lossyRate = $lossyOperations * 100 / $finishedOperations;
} else {
  $targetedRate = 0;
  $lucrativeRate = 0;
  $breakEvenRate = 0;
  $lossyRate = 0;
}

$avgResult = nullToZero(App\Operation::getAvgResultOperations($user->id));

@endphp

<ul class="list-group list-group-unbordered">
  <li class="list-group-item no-padding">
    <div class="row top-bottom-10">
      <div class="col-xs-12 text-center text-bold font-15 text-navy">
        <a href="{{ url('operations/user/'.$user->id.'?new=1&changed=1') }}" class="">Não Iniciadas: {{ $newOperations }}</a> |
        <a href="{{ url('operations/user/'.$user->id.'?started=1&moved=1') }}" class="">Em Andamento: {{ $startedOperations }}</a> |
        <a href="{{ url('operations/user/'.$user->id.'?stoped=1&closed=1&finished=1') }}" class="">Finalizadas: {{ $finishedOperations }}</a>
      </div>
    </div>
  </li>
</ul>

<div class="row top-10">
  <div class="col-sm-5 text-bold text-navy">
    No Alvo ({{ $targetedOperations }})
  </div>
  <div class="col-sm-7">
    <div class="progress">
      <div class="progress-bar progress-bar-green progress-bar-striped" aria-valuenow="{{ $targetedRate }}" aria-valuemin="0" aria-valuemax="100"
       style="width:{{ $targetedRate }}%">
        <span class="font-10 text-bold">{{ formatRealNumber($targetedRate,1) }}%</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-5 text-bold text-navy">
    Lucrativas ({{ $lucrativeOperations }}) *
  </div>
  <div class="col-sm-7">
    <div class="progress">
      <div class="progress-bar progress-bar-blue progress-bar-striped" aria-valuenow="{{ $lucrativeRate }}" aria-valuemin="0" aria-valuemax="100"
       style="width:{{ $lucrativeRate }}%">
        <span class="font-10 text-bold">{{ formatRealNumber($lucrativeRate,1) }}%</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-5 text-bold text-navy">
    Com Prejuízo ({{ $lossyOperations }})
  </div>
  <div class="col-sm-7">
    <div class="progress">
      <div class="progress-bar progress-bar-red progress-bar-striped" aria-valuenow="{{ $lossyRate }}" aria-valuemin="0" aria-valuemax="100"
       style="width:{{ $lossyRate }}%">
        <span class="font-10 text-bold">{{ formatRealNumber($lossyRate,1) }}%</span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-5 text-bold text-navy">
    Média/Operação
  </div>
  <div class="col-sm-7">
    <span class="label bg-{{ getValueColor($avgResult) }} text-bold">{{ formatRealNumber($avgResult,1) }}%</span>
  </div>
</div>

<div class="row top-10">
  <div class="col-sm-12">
    <span class="text-muted">* Inclui as operações "No Alvo"</span>
  </div>
</div>
