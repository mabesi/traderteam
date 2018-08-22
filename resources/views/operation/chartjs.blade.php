@php

  $yearResult = getYearUserResult($user);

  //$labels = '["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"]';

  $labels = Array();
  $results = Array();
  $bars = Array();
  $colors = Array();
  $borders = Array();

  $bars = getMontlyUserResult(Null,$user,(getConfig('sidebar_closed')?12:10));

  foreach ($bars as $bar){

    $labels[] = $bar['month'];
    $results[] = $bar['result'];
    if ($bar['result'] < 0){
      $colors[] = 'rgba(255, 99, 132, 0.2)';
      $borders[] = 'rgba(255,99,132,1)';
    } else {
      $colors[] = 'rgba(54, 162, 235, 0.2)';
      $borders[] = 'rgba(54, 162, 235, 1)';
    }
  }

  $labels = '["'.implode('","',$labels).'"]';
  $results = '['.implode(',',$results).']';
  $colors = '["'.implode('","',$colors).'"]';
  $borders = '["'.implode('","',$borders).'"]';

  $userResult = getUserResult($user);

@endphp

<script src="{{ asset("/js/chart.js") }}"></script>

<div class="row">
  <div class="col-sm-12">
    <div class="text-center">

      <canvas id="myChart" width="200" height="160"></canvas>
      <script>
      var ctx = document.getElementById("myChart").getContext('2d');
      var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: {!! $labels !!},
              legend: {
                display: false,
              },
              datasets: [{
                  label: 'Resultado',
                  data: {!! $results !!},
                  backgroundColor: {!! $colors !!},
                  borderColor: {!! $borders !!},
                  borderWidth: 1
              }]
          },
          options: {
              legend: {
    						display: false,
    					},
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero:true
                      }
                  }]
              }
          }
      });
      </script>


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
