<div class="font-14 top-5">

  <small class="label bg-{{ ($operation->buyorsell=='C'?'blue':'red') }}">{{$operation->buyorsell}}</small>
  <small class="label bg-{{ ($operation->realorsimulated=='R'?'black':'green') }}">{{$operation->realorsimulated}}</small>
  <a class="font-18" href="{{ url('operation/'.$operation->id) }}"><strong>{{ $operation->stock }}</strong></a>
  {{ nbsp(2) }}
  <small class="btn btn-xs font-10 btn-{{ statusClass($operation->status) }}">
    {{ operationStatus($operation->status) }}
  </small>
  {{ nbsp(2) }}
  <small class="font-10 text-muted">{{ humanPastTime($operation->updated_at) }}</small>

@if ($operation->user_id != getUserId())
  <span class="font-12 pull-right">
      {!! getUserLink($operation->user) !!}
  </span>
@endif
</div>
