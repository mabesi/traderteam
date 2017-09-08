@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="row">

                <div class="col-md-3">

                  <span class="font-16">Título <a href="?sort=title&dir={{ ($sort=='title'?$newDir:'desc') }}">
                    <i class="fa fa-sort-alpha-{{ ($sort=='title'?$newDir:'desc') }}"></i></a></span>
                  {{ nbsp(4) }}
                  <span class="font-16">Resultado <a href="?sort=sumresult&dir={{ ($sort=='sumresult'?$newDir:'desc') }}">
                    <i class="fa fa-sort-amount-{{ ($sort=='sumresult'?$newDir:'desc') }}"></i></a></span>

                </div>

                <div class="col-md-6">
                  <form class="form-inline" action="{{ url($path) }}" method="get">

                    <input type="text" name="strategy" class="form-control" size="20" placeholder="Pesquisar Estratégia"
                      value="{{ (isset($where['strategy'])?$where['strategy']:'') }}">

                    <input type="text" name="indicator" class="form-control" size="20" placeholder="Pesquisar Indicador"
                      value="{{ (isset($where['indicator'])?$where['indicator']:'') }}">

                    <button type="submit" class="btn btn-default">
                      <i class="fa fa-search"></i>
                    </button>

                  </form>
                </div>

                <div class="col-md-3 text-right">
                  <a class="" href="{{ url($path) }}">
                    <button type="button" class="btn btn-sm btn-primary" name="button">Exibir Todas</button>
                    {{ nbsp(2) }}
                  </a>
                  <a class="" href="{{ url('strategy/create') }}">
                    <button type="button" class="btn btn-sm btn-success" name="button">Nova Estratégia</button>
                    {{ nbsp(2) }}
                  </a>
                </div>
              </div>

            </div>
            <div class="box-body">
              @include('strategy.list')
            </div>
            <div class="box-footer">
              {{ $strategies->appends($where)
                            ->appends(['sort' => $sort,'dir' => $dir])
                            ->links() }}
            </div>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
