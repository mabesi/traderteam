@extends('layouts.panel')

@section('content')

  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary">
        <div class="box-header with-border">
          <div class="row">

            <div class="col-xs-5 col-sm-3 col-md-2">

            <span class="font-16">Título <a href="?sort=name&dir={{ ($sort=='name'?$newDir:'desc') }}">
              <i class="fa fa-sort-alpha-{{ ($sort=='name'?$newDir:'desc') }}"></i></a></span>
            {{ nbsp(2) }}
            <span class="font-16">Estratégias <a href="?sort=strategies_count&dir={{ ($sort=='strategies_count'?$newDir:'desc') }}">
              <i class="fa fa-sort-amount-{{ ($sort=='strategies_count'?$newDir:'desc') }}"></i></a></span>
            {{ nbsp(4) }}

            </div>

            <div class="col-xs-7 col-sm-5 col-md-6">
              <form class="form-inline" action="{{ url($path) }}" method="get">

                <input type="text" name="indicator" class="form-control" size="18" placeholder="Pesquisar Indicador"
                  value="{{ (isset($where['indicator'])?$where['indicator']:'') }}">

                <button type="submit" class="btn btn-default">
                  <i class="fa fa-search"></i>
                </button>

              </form>
            </div>

            <div class="col-xs-12 col-sm-4 col-md-4">
              <span class="pull-right">
                <a href="{{ url('indicator') }}" class="btn btn-primary">Ver Todos</a>
                {{ nbsp(2) }}
                <a href="{{ url('indicator/create') }}" class="btn btn-success">Novo Indicador</a>
              </span>
            </div>

          </div>

        </div>
        <div class="boxbody top-10 pad">
          @foreach ($indicators as $indicator)
          <div class="post no-padding">
            <div class="row">
              <div class="col-sm-10">
                <h3 class="no-margin">
                  <a href="{{ url('indicator/'.$indicator->id) }}">
                    {{ $indicator->name.' ('.$indicator->acronym.')' }}
                  </a>
                  <span class="label bg-primary font-14" title="Estratégias Utilizando">{{ $indicator->strategies_count }}</span>
                  <span class="pull-right font-16">
                    {!! getItemAdminIcons($indicator,'indicator','False') !!}
                  </span>
                </h3>
                <p>Tipo de Indicador: <strong>{{ indicatorType($indicator->type) }}</strong></p>

                <p>{!! (strlen($indicator->description)>150?substr($indicator->description, 0, 350).'...':$indicator->description) !!}</p>

              </div>
              <div class="col-sm-2">
                {!! $indicator->getImage() !!}
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <div class="box-footer">
          {{ $indicators->appends($where)
                        ->appends(['sort' => $sort,'dir' => $dir])
                        ->links() }}
        </div>

      </div>

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

@include('layouts.imagemodal')
@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
<script src="{{ asset("/js/img-helper.js") }}"></script>
@endpush
