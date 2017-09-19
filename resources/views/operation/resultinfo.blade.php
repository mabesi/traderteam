@php

  $yearResult = getYearUserResult($user);

  if ($yearResult >= 30){
    $baseBar = 20;
  } elseif ($yearResult >= 20){
    $baseBar = 30;
  } elseif ($yearResult >= 0){
    $baseBar = 50;
  } elseif ($yearResult >= -20){
    $baseBar = 60;
  } elseif ($yearResult >= -50){
    $baseBar = 70;
  } elseif ($yearResult >= -50){
    $baseBar = 80;
  } else {
    $baseBar = 90;
  }

  $userResult = getUserResult($user);

@endphp

<div class="row">
  <div class="col-sm-12">
    <div class="text-center">
      @foreach (getMontlyUserResult(Null,$user,(getConfig('sidebar_closed')?12:10)) as $bar)

      <div class="progress vertical progress-sm no-margin">
        <div class="progress-bar progress-bar-{{ $bar['color'] }} font-10"
        aria-valuenow="14"
        aria-valuemin="0"
        aria-valuemax="120"
        style="height:{{ $baseBar + $bar['total'] }}%" >
        {{ $bar['month'] }}<br>{{ number_format($bar['result'],1) }}
      </div>
    </div>

    @endforeach
  </div>
  </div>
</div>

<div class="row">

  <div class="col-xs-6">
    <div class="text-center top-10">
      <span class="btn btn-{{ btnValueClass($yearResult) }} pad">
        <p class="font-18">Últimos 12 Meses</p>
        <p class="font-30 text-bold">{{ formatRealNumber($yearResult,1) }}%</p>
      </span>
    </div>
  </div>

  <div class="col-xs-6">
    <div class="text-center top-10">
      <span class="btn btn-{{ btnValueClass($userResult) }} pad">
        <p class="font-18">Resultado Geral</p>
        <p class="font-30 text-bold">{{ formatRealNumber($userResult,1) }}%</p>
      </span>
    </div>
  </div>

</div>
