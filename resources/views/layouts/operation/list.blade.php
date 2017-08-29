@foreach ($operations as $operation)
<div class="post">
  <h3>
    <small class="label bg-{{ ($operation->buyorsell=='C'?'blue':'red') }}">{{$operation->buyorsell}}</small>
    <small class="label bg-{{ ($operation->realorsimulated=='R'?'black':'green') }}">{{$operation->realorsimulated}}</small>
    <a href="{{ url('operation/'.$operation->id.'/edit') }}"><strong>{{ $operation->stock }}</strong></a>
    <small class="btn pull-right btn-xs btn-{{ statusClass($operation->status) }}">{{ operationStatus($operation->status) }}</small>
  </h3>

  <p class="text-muted">{{ humanPastTime($operation->created_at) }} atrás
     - RI: {{ $operation->prevRisk() }}%
     - RE: {{ $operation->prevReturn() }}%
     - RI/RE: <span class="label bg-{{ ($operation->riskReturn()>=3?'green':($operation->riskReturn()>=1?'orange':'maroon')) }}">
               {{ $operation->riskReturn() }}
             </span>
     {{ nbsp(4) }}
     RIC: {{ $operation->prevCapitalRisk() }}%
     - REC: {{ $operation->prevCapitalReturn() }}%
  </p>

  <p>Tempo Gráfico: {{ $operation->gtime }} - Entrada: {{ $operation->preventry }} - Alvo: {{ $operation->prevtarget }} - Stop: {{ $operation->prevstop }} -
  Estratégia: <a href="{{ url('strategy/'.$operation->strategy->id) }}">{{ $operation->strategy->title }}</a></p>

</div>
@endforeach
