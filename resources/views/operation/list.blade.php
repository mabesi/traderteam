@foreach ($operations as $operation)
<div class="pad">
  @include('operation.lineview')

  <p>Tempo Gráfico: {{ $operation->gtime }} - Entrada: {{ $operation->preventry }} - Alvo: {{ $operation->prevtarget }} - Stop: {{ $operation->prevstop }} -
  Estratégia: <a href="{{ url('strategy/'.$operation->strategy->id) }}">{{ $operation->strategy->title }}</a></p>

</div>
@endforeach
