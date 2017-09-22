<div class="font-20">
  <small title="C: Compra / V: Venda" class="label bg-{{ ($operation->buyorsell=='C'?'blue':'red') }}">{{$operation->buyorsell}}</small>
  <small title="R: Operação Real / S: Operação Simulada" class="label bg-{{ ($operation->realorsimulated=='R'?'black':'green') }}">{{$operation->realorsimulated}}</small>
  <a class="font-26" href="{{ url('operation/'.$operation->id) }}"><strong>{{ $operation->stock }}</strong></a>
  {{ nbsp(1) }}
  @include('operation.riskreturn')
  {{ nbsp(1) }}
  <small class="btn btn-xs btn-{{ statusClass($operation->status) }}">
    {{ operationStatus($operation->status) }}
  </small>
  {{ nbsp(1) }}
  <small class="font-10">{{ humanPastTime($operation->updated_at) }}</small>

  <span class="btn btn-default btn-xs font-14 pull-right top-5">
  @if ($operation->user_id==getUserId())
    <i class="fa fa-thumbs-up text-navy"></i> {{ $operation->likers->count() }}
  @else
    @if ($operation->likers->contains('id',getUserId()))
    <a href="{{ url('operation/'.$operation->id.'/dislike') }}" title="Dislike">
      <i class="fa fa-thumbs-up text-aqua"></i> {{ $operation->likers->count() }}
    </a>
    @else
    <a href="{{ url('operation/'.$operation->id.'/like') }}" title="Like">
      <i class="fa fa-thumbs-up text-blue"></i> {{ $operation->likers->count() }}
    </a>
    @endif
  @endif
  </span>

@if ($operation->user_id==getUserId() || isAdmin())
  <span class="pull-right">
    {!! getItemAdminIcons($operation,'operation',(isset($operationView)?'True':'False')).nbsp(4) !!}
  </span>
@endif

</div>
