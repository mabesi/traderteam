@foreach ($operations as $operation)
<div class="top-bottom-5">
  @include('operation.lineview')

  <p><strong>{{ strtoupper(gtimeName($operation->gtime)) }}</strong> - Entrada: {{ $operation->preventry }} - Alvo: {{ $operation->prevtarget }} - Stop: {{ $operation->prevstop }} -
  Estratégia: <a href="{{ url('strategy/'.$operation->strategy->id) }}">{{ $operation->strategy->title }}</a>

    @if ($operation->user_id != getUserId() && !$profileView)
      <span class="font-12">
          {{ nbsp(2) }}(<a class="user-line" href="{{ url('profile/'.$operation->user->id) }}">{!! getUserAvatar('img-circle','Avatar',$operation->user) !!} {{ $operation->user->name }}</a>)
      </span>
    @endif
  </p>

</div>
@endforeach
