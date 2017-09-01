@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                Relação de Usuários
              </h3>
            </div>
            <div class="box-body">
              @include('user.list')
            </div>
            <div class="box-footer">
              {{ $users->links() }}
            </div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
