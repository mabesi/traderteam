@foreach ($notices as $notice)
  @if (isAdmin() || !$notice->onlyadmin)

    <p class='text-justify font-14'>
      @if ($notice->onlyadmin)
      <i class="fa fa-exclamation-circle text-danger" title="Somente para Administradores"></i>
      @endif
      <a href="{{ url('notice/'.$notice->id) }}">
        {{ $notice->title }}
      </a>
      <small class="font-10 text-muted">{{ humanPastTime($notice->updated_at) }}</small>
    </p>

  @endif
@endforeach
