@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                <span class="label bg-blue">C</span> Compra
                <span class="label bg-red">V</span> Venda {{ nbsp(8) }}
                <span class="label bg-black">R</span> Real
                <span class="label bg-green">S</span> Simulada
              </h3>
            </div>
            <div class="box-body">

              @foreach (Auth::user()->operations as $operation)
              <div class="post">
                <h3><small class="label bg-{{ ($operation->buyorsell=='C'?'blue':'red') }}">{{$operation->buyorsell}}</small>
                  <small class="label bg-{{ ($operation->realorsimulated=='R'?'black':'green') }}">{{$operation->realorsimulated}}</small>
                  <a href="{{ url('operation/'.$operation->id.'/edit') }}"><strong>{{ $operation->stock }}</strong></a>
                  <small class="btn btn-xs btn-{{ statusClass($operation->status) }}">{{ operationStatus($operation->status) }}</small></h3>
                <p>Tempo Gráfico: {{ $operation->gtime }}</p>
                <p>Entrada: {{ $operation->preventry }} - Alvo: {{ $operation->prevtarget }} - Stop: {{ $operation->prevstop }}</p>
              </div>
              @endforeach
            </div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
