@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/select2/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Estratégia de Operação em Bolsa</h3>
      </div>

      <form class="form-horizontal pad" action="{{ url('/strategy'.(isset($strategy->id)?'/'.$strategy->id:'')) }}" method="POST">

      {{ csrf_field() }}

      @if (isset($strategy->id))
        <input type="hidden" name="_method" value="PUT">
      @endif

      <div class="form-group">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-9">
          <p class="text-muted">
            As informações com asterisco (*) são obrigatórias.
          </p>
        </div>
      </div>

        <div class="form-group">
          <label for="title" class="col-sm-3 control-label">Estratégia *</label>

          <div class="col-sm-9">
            <input type="text" value="{{ old('title',isset($strategy->title)?$strategy->title:Null) }}" name="title" class="form-control" id="title" placeholder="Nome da estratégia">
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-sm-3 control-label">Descrição *</label>

          <div class="col-sm-9">
            <textarea class="textarea textarea-md form-control" name="description" id="description" >{!! old('description',isset($strategy->description)?$strategy->description:Null) !!}</textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="indicators" class="col-sm-3 control-label">Indicadores</label>

          <div class="col-sm-9">
            <select id="indicators" name="indicators[]" class="form-control select2" multiple="multiple" data-placeholder="Informe quais indicadores utiliza" style="width: 100%;">
              @foreach ($indicators as $indicator)
                <option value="{{ $indicator->id }}" {{ (strContains($indicatorsId,$indicator->id)?'selected':'') }}>{{ $indicator->acronym }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary">{{ (isset($strategy->id)?'Salvar':'Enviar') }} </button>
            {{ nbsp(2) }}
            <a class="btn btn-warning" href="{{ url('strategy'.(isset($strategy->id)?'/'.$strategy->id:'')) }}">Cancelar</a>
          </div>
        </div>
      </form>


      <br />
    </div>

  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@endsection

@push('scripts')
<script src="{{ asset("/adminlte/plugins/select2/select2.full.min.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.pt-BR.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script>
  $(function () {
    $('.select2').select2();
    $('.textarea').wysihtml5();
  });
</script>
@endpush
