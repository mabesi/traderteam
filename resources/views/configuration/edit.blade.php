@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Configuração</h3>
      </div>

      <form class="form-horizontal pad"
          action="{{ url('/configuration'.(isset($configuration->id)?'/'.$configuration->id:'')) }}"
          method="POST" enctype="multipart/form-data">

      {{ csrf_field() }}

      @if (isset($configuration->id))
        <input type="hidden" name="_method" value="PUT">
      @endif

      <div class="form-group">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-9">
          <p class="text-muted">
            As informações com asterisco (*) são obrigatórias.<br>
            ** Obrigatório somente se o outro campo não for preenchido.
          </p>
        </div>
      </div>

        <div class="form-group">
          <label for="name" class="col-sm-3 control-label">Nome *</label>

          <div class="col-sm-9">
@if (isSuperAdmin())
            <input type="text" value="{{ old('name',isset($configuration->name)?$configuration->name:Null) }}" name="name" class="form-control" id="name" maxlength="50" >
@else
            <strong>{{ (isset($configuration->name)?$configuration->name:'') }}</strong>
            <input type="hidden" value="{{ old('name',isset($configuration->name)?$configuration->name:'') }}" name="name" >
@endif
          </div>
        </div>

        <div class="form-group">
          <label for="value" class="col-sm-3 control-label">Valor **</label>

          <div class="col-sm-9">
            <input type="text" value="{{ old('value',isset($configuration->value)?$configuration->value:Null) }}" name="value"
             class="form-control" id="value" maxlength="50" >
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-sm-3 control-label">Conteúdo **</label>

          <div class="col-sm-9">
            <textarea class="textarea textarea-lg form-control" name="content" id="content" >
      				{!! old('content',isset($configuration->content)?$configuration->content:Null) !!}
      			</textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary">{{ (isset($configuration->id)?'Salvar':'Enviar') }} </button>
            {{ nbsp(2) }}
            <a class="btn btn-warning" href="{{ url('configuration'.(isset($configuration->id)?'/'.$configuration->id:'')) }}">Cancelar</a>
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
<script src="{{ asset("/js/form-helper.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.pt-BR.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script>
  $(function () {
    $('.textarea').wysihtml5();
  });
</script>
@endpush
