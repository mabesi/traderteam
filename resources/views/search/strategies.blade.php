@foreach ($strategies as $strategy)
    <div class="col-sm-10 col-offset-2 top-5">
        <a href="{{ url('strategy/'.$strategy->id) }}">{{ $strategy->title }}</a>
    </div>
@endforeach
