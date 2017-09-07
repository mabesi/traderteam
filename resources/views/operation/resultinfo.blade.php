@php

  $yearResult = getYearUserResult($user->id);

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

@endphp

<div class="text-center">
@foreach (getMontlyUserResult(Null,$user->id) as $bar)

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

<div class="info-box top-10">
  <span class="info-box-icon bg-teal">
    <i class="fa fa-calendar"></i>
  </span>
  <div class="info-box-content">
    <span class="info-box-text">Últimos 12 Meses</span>
    <span class="info-box-number">{{ $yearResult }}%</span>
  </div>

</div>
<div class="info-box">
  <span class="info-box-icon bg-green">
    <i class="fa fa-bar-chart"></i>
  </span>
  <div class="info-box-content">
    <span class="info-box-text">Resultado Geral</span>
    <span class="info-box-number">{{ getUserResult($user->id) }}%</span>
  </div>
</div>
