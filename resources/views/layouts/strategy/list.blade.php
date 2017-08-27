@foreach ($strategies as $strategy)
<div class="post">
  <h3><a href="{{ url('strategy/'.$strategy->id) }}">{{ $strategy->title }}</a></h3>
  <p>{!! $strategy->description !!}</p>
  <p><strong>Indicadores:</strong> {{ $strategy->indicators }}</p>
</div>
@endforeach
