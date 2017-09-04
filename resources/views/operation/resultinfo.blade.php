<div class="text-center">
@foreach (getMontlyUserResult(Null,$user->id) as $bar)

  <div class="progress vertical progress-sm no-margin">
    <div class="progress-bar progress-bar-{{ $bar['color'] }} font-10"
         aria-valuenow="14"
         aria-valuemin="0"
         aria-valuemax="120"
         style="height:{{ 30 + $bar['total'] }}%" >
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
    <span class="info-box-number">{{ getYearUserResult($user->id) }}%</span>
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
