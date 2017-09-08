@foreach ($strategies as $strategy)
<div class="post">
  <div class="row">
@if ($profileView)
    <div class="col-sm-8 col-lg-6">
@else
  <div class="col-sm-8 col-lg-4">
@endif
      <div class="font-16">
        <a href="{{ url('strategy/'.$strategy->id) }}">{{ $strategy->title }}</a>
        {{ nbsp(2) }}
        {!! getItemAdminIcons($strategy,'strategy','False') !!}

        @if ($strategy->user_id != getUserId() && !$profileView)
          <span class="font-10">
            {{ nbsp(2) }}
            @if ($strategy->user->profile != Null)
              (<a class="user-line" href="{{ url('profile/'.$strategy->user_id) }}">
                {!! getUserAvatar('img-circle','Avatar',$strategy->user) !!} {{ $strategy->user->name }}
              </a>)
            @else
              (<span class="user-line">
                {!! getUserAvatar('img-circle','Avatar',$strategy->user) !!} {{ $strategy->user->name }}
              </span>)
            @endif
          </span>
        @endif


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

@if (!$profileView)
    <div class="col-sm-2 col-lg-2">
      <div class="font-14 text-bold">
        Operações: {{ $strategy->operations_count }}</a>
      </div>
    </div>
@endif

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
