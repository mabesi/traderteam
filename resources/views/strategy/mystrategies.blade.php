@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Estratégias de Operação</h3>
            </div>

            @include('strategy.list')

            <br />
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
