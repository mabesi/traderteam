@foreach ($operations as $operation)
<div class="top-bottom-5">
  @include('operation.lineview')

  <p>{{ gtimeName($operation->gtime) }} - Entrada: {{ $operation->preventry }} - Alvo: {{ $operation->prevtarget }} - Stop: {{ $operation->prevstop }} -
  Estratégia: <a href="{{ url('strategy/'.$operation->strategy->id) }}">{{ $operation->strategy->title }}</a></p>

</div>
@endforeach
