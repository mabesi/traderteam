<div class="font-20">
  <small class="label bg-{{ ($operation->buyorsell=='C'?'blue':'red') }}">{{$operation->buyorsell}}</small>
  <small class="label bg-{{ ($operation->realorsimulated=='R'?'black':'green') }}">{{$operation->realorsimulated}}</small>
  <a class="font-26" href="{{ url('operation/'.$operation->id) }}"><strong>{{ $operation->stock }}</strong></a>
  {{ nbsp(1) }}
  <span class="font-12 label bg-{{ ($operation->riskReturn()>=3?'green':($operation->riskReturn()>=1?'orange':'maroon')) }}">
    {{ $operation->riskReturn() }}
  </span>
  {{ nbsp(1) }}
  <span class="font-14">
    %O:{{ $operation->prevRisk() }}/{{ $operation->prevReturn() }}
    {{ nbsp(1) }}
    %C:{{ $operation->prevCapitalRisk() }}/{{ $operation->prevCapitalReturn() }}
  </span>
@if ($operation->status=='E' || $operation->status=='S' || $operation->status=='T')
  {{ nbsp(1) }}
  <span class="font-14 label bg-{{ ($operation->result==0?'gray':($operation->result>0?'green':'red')) }}">
    {{ $operation->result }}%
  </span>
@endif
  {{ nbsp(1) }}
  <small class="btn btn-xs btn-{{ statusClass($operation->status) }}">
    {{ operationStatus($operation->status) }}
  </small>
  {{ nbsp(1) }}
  <small class="font-10">{{ humanPastTime($operation->updated_at) }}</small>

@if ($operation->user_id==getUserId() || isAdminOrSuperAdmin())
  <span class="pull-right">
    {{ nbsp(2) }}
    <small>
      <a href="{{ url('operation/'.$operation->id.'/edit') }}"><i class="fa fa-pencil"></i></a>
    </small>
  @if ($operation->status == 'N' || $operation->status == 'A' || isAdminOrSuperAdmin())
    {{ nbsp(1) }}
    <small>
      <a class="text-danger" href="{{ url('operation/'.$operation->id.'/delete') }}"><i class="fa fa-trash"></i></a>
    </small>
  @endif
  </span>
@endif
</div>
