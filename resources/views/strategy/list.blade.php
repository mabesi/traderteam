@foreach ($strategies as $strategy)
<div class="post">
  <div class="row">
    <div class="col-sm-8 col-lg-4">
      <div class="font-20">
        <a href="{{ url('strategy/'.$strategy->id) }}">{{ $strategy->title }}</a>
      </div>
    </div>

    <div class="col-sm-2 col-lg-1">
@if ($profileView)
      <small class="label bg-{{ getValueColor($strategy->getResult()) }} font-14">
        {{ formatRealNumber($strategy->getResult(),2) }}%
@else
      <small class="label bg-{{ getValueColor($strategy->sumresult) }} font-14">
        {{ formatRealNumber($strategy->sumresult,2) }}%
@endif
      </small>
    </div>

    <div class="col-sm-2 col-lg-2">
      <div class="font-14 text-bold">
        Operações: {{ $strategy->operations_count }}</a>
      </div>
    </div>

    <div class="col-sm-12 col-lg-5">
      <div>
        <strong>Indicadores:</strong>
        @foreach ($strategy->indicators as $indicator)
        {{ nbsp(1) }}
        <a href="{{ url('indicator/'.$indicator->id) }}">{{ $indicator->acronym}}</a>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endforeach
