<h3>
  <small class="label bg-{{ ($operation->buyorsell=='C'?'blue':'red') }}">{{$operation->buyorsell}}</small>
  <small class="label bg-{{ ($operation->realorsimulated=='R'?'black':'green') }}">{{$operation->realorsimulated}}</small>
  <a href="{{ url('operation/'.$operation->id) }}"><strong>{{ $operation->stock }}</strong></a>

  <span class="pull-right">
    <small class="btn btn-xs btn-{{ statusClass($operation->status) }}">
      {{ operationStatus($operation->status) }}
    </small>
    {{ nbsp(2) }}
    <small>
      <a href="{{ url('operation/'.$operation->id.'/edit') }}"><i class="fa fa-pencil"></i></a>
    </small>
    {{ nbsp(1) }}
    <small>
      <a class="text-danger" href="{{ url('operation/'.$operation->id.'/delete') }}"><i class="fa fa-trash"></i></a>
    </small>
  </span>
</h3>
