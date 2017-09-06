@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">

                <form class="form-inline" action="{{ url($path) }}" method="get">

                  <input type="text" name="strategy" class="form-control" size="20" placeholder="Pesquisar Estratégia"
                    value="{{ (isset($where['strategy'])?$where['strategy']:'') }}">

                  <input type="text" name="indicator" class="form-control" size="20" placeholder="Pesquisar Indicador"
                    value="{{ (isset($where['indicator'])?$where['indicator']:'') }}">

                  <button type="submit" class="btn btn-default">
                    <i class="fa fa-search"></i>
                  </button>

                  <a class="pull-right" href="{{ url($path) }}">
                    <button type="button" class="btn btn-sm btn-primary" name="button">Exibir Todas</button>
                    {{ nbsp(2) }}
                  </a>

                </form>

            </div>
            <div class="box-body">
              @include('strategy.list')
            </div>
            <div class="box-footer">
              {{ $strategies->appends($where)->links() }}
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
