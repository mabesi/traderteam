@foreach ($indicators as $indicator)
    <div class="col-sm-10 col-offset-2 top-5">
        <a href="{{ url('indicator/'.$indicator->id) }}">
          {{ $indicator->name.' ('.$indicator->acronym.')' }}
        </a>
    </div>
@endforeach
