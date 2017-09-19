@foreach ($notices as $notice)

  @if (isAdmin() || !$notice->onlyadmin)

    <div class="col-sm-10 col-offset-2 top-5">
      @if ($notice->onlyadmin)
      <i class="fa fa-exclamation-circle text-danger" title="Somente para Administradores"></i>
      @endif
      <a href="{{ url('notice/'.$notice->id) }}">
        {{ $notice->title }}
      </a>
    </div>

  @endif

@endforeach
