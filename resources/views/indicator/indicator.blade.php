@extends('layouts.panel')

@section('content')

<div class="row">
  <div class="col-md-7 col-lg-6">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="no-padding no-margin" >{{ $indicator->name.' ('.$indicator->acronym.')' }}

          <span class="pull-right">
            {!! getItemAdminIcons($indicator,'indicator','True') !!}
          </span>

        </h3>
      </div>
      <div class="box-body">

        <p>Tipo de Indicador: <strong>{{ indicatorType($indicator->type) }}</strong></p>
        <div id='indicator-description'>{!! $indicator->description !!}</div>

      </div>

      <div class="box-footer">
        <a href="{{ url('strategy?indicator='.$indicator->acronym) }}">
          <h4>Estratégias Utilizando
            <small class="label bg-blue }} font-16">
              {{ $indicator->strategies->count() }}
            </small>
          </h4>
        </a>
      </div>

    </div>

  </div>

  <div class="col-md-5 col-lg-6">

    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="no-padding no-margin">Imagem de Exemplo</h3>
      </div>
      <div class="box-body">

        {!! $indicator->getImage('img-max pad') !!}

      </div>
      <div class="box-footer">

      </div>
    </div>

  </div>
</div>

@include('layouts.imagemodal')
@endsection

@push('scripts')
<script src="{{ asset("/js/img-helper.js") }}"></script>
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
