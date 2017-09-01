<div class="font-20">
  <small class="label bg-{{ ($operation->buyorsell=='C'?'blue':'red') }}">{{$operation->buyorsell}}</small>
  <small class="label bg-{{ ($operation->realorsimulated=='R'?'black':'green') }}">{{$operation->realorsimulated}}</small>
  <a class="font-20" href="{{ url('operation/'.$operation->id) }}"><strong>{{ $operation->stock }}</strong></a>
  {{ nbsp(2) }}
  <small class="btn btn-xs font-10 btn-{{ statusClass($operation->status) }}">
    {{ operationStatus($operation->status) }}
  </small>
  {{ nbsp(2) }}
  <small class="font-12">{{ humanPastTime($operation->updated_at) }}</small>

  <span class="font-12 pull-right">
      <a href="{{ url('profile/'.$operation->user->id) }}">{{ $operation->user->name }}</a>
  </span>
</div>
