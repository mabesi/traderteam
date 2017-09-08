@foreach ($operations as $operation)
<div class="top-bottom-5">
  @include('operation.lineview')

  <p><strong>{{ strtoupper(gtimeName($operation->gtime)) }}</strong> | Entrada: {{ $operation->preventry }} - Alvo: {{ $operation->prevtarget }} - Stop: {{ $operation->prevstop }} |
  Estratégia: <a href="{{ url('strategy/'.$operation->strategy->id) }}">{{ $operation->strategy->title }}</a>

    @if ($operation->user_id != getUserId() && !$profileView)
      <span class="font-12">
          {{ nbsp(2) }}
          @if ($operation->user->profile != Null)
            (<a class="user-line" href="{{ url('profile/'.$operation->user->id) }}">
              {!! getUserAvatar('img-circle','Avatar',$operation->user) !!} {{ $operation->user->name }}
            </a>)
          @else
            (<span class="user-line">
              {!! getUserAvatar('img-circle','Avatar',$operation->user) !!} {{ $operation->user->name }}
            </span>)
          @endif
      </span>
    @endif
  </p>

</div>
@endforeach
