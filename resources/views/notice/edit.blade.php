@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset('/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Aviso aos Usuários</h3>
      </div>

      <form class="form-horizontal pad" action="{{ url('/notice'.(isset($notice->id)?'/'.$notice->id:'')) }}" method="POST" enctype="multipart/form-data">

      {{ csrf_field() }}

      @if (isset($notice->id))
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
        <label for="type" class="col-sm-3 control-label"><span class="label bg-red">Administradores</span></label>

        <div class="col-sm-9">
          <div class="checkbox">
            <label for="onlyadmin">
              <input type="checkbox" name="onlyadmin" value="1" {{ (isset($notice)?($notice->onlyadmin?'CHECKED':''):'') }}>
              <span class="text-muted">Marque esta opção caso o aviso seja apenas para administradores!</span>
            </label>
          </div>
        </div>
      </div>

        <div class="form-group">
          <label for="title" class="col-sm-3 control-label">Título *</label>

          <div class="col-sm-9">
            <input type="text" value="{{ old('title',isset($notice->title)?$notice->title:Null) }}" name="title"
             class="form-control" id="title" maxlength="100" >
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-sm-3 control-label">Conteúdo *</label>

          <div class="col-sm-9">
            <textarea class="textarea textarea-md form-control" name="content" id="content" >
      				{!! old('content',isset($notice->content)?$notice->content:Null) !!}
      			</textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary">{{ (isset($notice->id)?'Salvar':'Enviar') }} </button>
            {{ nbsp(2) }}
            <a class="btn btn-warning" href="{{ url('notice'.(isset($notice->id)?'/'.$notice->id:'')) }}">Cancelar</a>
          </div>
        </div>
      </form>


      <br />
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
<script src="{{ asset("/adminlte2/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.pt-BR.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script>
  $(function () {
    $('.textarea').wysihtml5();
  });
</script>
@endpush
