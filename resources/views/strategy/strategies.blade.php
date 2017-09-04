@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">

                <form class="form-inline" action="{{ url($path) }}" method="get">

                  <input type="text" name="title" class="form-control" size="20" placeholder="Pesquisar Estratégias"
                    value="{{ (isset($where['title'])?$where['title']:'') }}">

                  <input type="text" name="indicator" class="form-control" size="20" placeholder="Pesquisar Indicadores"
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

            @include('strategy.list')

            <br />
          </div>
          <div class="box-footer">
            {{ $strategies->appends($where)->links() }}
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
