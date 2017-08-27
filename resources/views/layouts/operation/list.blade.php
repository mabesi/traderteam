@foreach ($operations as $operation)
<div class="post">
  <h3><small class="label bg-{{ ($operation->buyorsell=='C'?'blue':'red') }}">{{$operation->buyorsell}}</small>
    <small class="label bg-{{ ($operation->realorsimulated=='R'?'black':'green') }}">{{$operation->realorsimulated}}</small>
    <a href="{{ url('operation/'.$operation->id.'/edit') }}"><strong>{{ $operation->stock }}</strong></a>
    <small class="btn pull-right btn-xs btn-{{ statusClass($operation->status) }}">{{ operationStatus($operation->status) }}</small></h3>
  <p>Tempo Gráfico: {{ $operation->gtime }} - Entrada: {{ $operation->preventry }} - Alvo: {{ $operation->prevtarget }} - Stop: {{ $operation->prevstop }}</p>
  <p>Estratégia: <a href="{{ url('strategy/'.$operation->strategy->id) }}">{{ $operation->strategy->title }}</a></p>
</div>
@endforeach
