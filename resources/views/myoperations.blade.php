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
              @include('layouts.operation.list')
            </div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
