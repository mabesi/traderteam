@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Estratégias de Operação</h3>
            </div>

            @foreach (Auth::user()->strategies as $strategy)
            <div class="post">
              <h3><a href="{{ url('strategy/'.$strategy->id) }}">{{ $strategy->title }}</a></h3>
              <p>{!! $strategy->description !!}</p>
              <p><strong>Indicadores:</strong> {{ $strategy->indicators }}</p>
            </div>
            @endforeach

            <br />
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
