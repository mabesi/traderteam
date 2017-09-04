@foreach ($strategies as $strategy)
<div class="post">
  <h3><a href="{{ url('strategy/'.$strategy->id) }}">{{ $strategy->title }}</a></h3>

  <p>
    <strong>Indicadores:</strong>
@foreach ($strategy->indicators as $indicator)
    {{ nbsp(1) }}
     <a href="{{ url('indicator/'.$indicator->id) }}">{{ $indicator->acronym}}</a>
@endforeach

    {{ nbsp(4) }}
    <strong>Resultado Geral: </strong>
    {{ getStrategyResult($strategy->id) }}
  </p>
</div>
@endforeach
