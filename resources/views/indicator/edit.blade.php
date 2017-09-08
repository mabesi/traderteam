@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset('/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Indicador de Análise Técnica</h3>
      </div>

      <form class="form-horizontal" action="{{ url('/indicator'.(isset($indicator->id)?'/'.$indicator->id:'')) }}" method="POST" enctype="multipart/form-data">

      {{ csrf_field() }}

      @if (isset($indicator->id))
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
          <label for="name" class="col-sm-3 control-label">Indicador *</label>

          <div class="col-sm-9">
            <input type="text" value="{{ old('name',isset($indicator->name)?$indicator->name:Null) }}" name="name" class="form-control" id="title" placeholder="Nome do Indicador (Ex: Exponencial Moving Average)">
          </div>
        </div>

        <div class="form-group">
          <label for="acronym" class="col-sm-3 control-label">Sigla *</label>

          <div class="col-sm-9">
            <input type="text" value="{{ old('acronym',isset($indicator->acronym)?$indicator->acronym:Null) }}" name="acronym" class="form-control" id="acronym" placeholder="Sigla/Acrônimo do Indicador (Ex: EMA)">
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-sm-3 control-label">Descrição *</label>

          <div class="col-sm-9">
            <textarea class="textarea textarea-md form-control" name="description" id="description" >
      				{!! old('description',isset($indicator->description)?$indicator->description:Null) !!}
      			</textarea>
          </div>
        </div>

        <div class="form-group">
          <label for="type" class="col-sm-3 control-label">Tipo de Indicador *</label>

          <div class="col-sm-9">
            <div class="radio">
              <label>
                <input id="typeO" name="type" value="O" type="radio" {{ ((isset($indicator->type)?$indicator->type:'')=='O'?'checked':'') }} >
                Oscilador
              </label>
            </div>
            <div class="radio">
              <label>
                <input id="typeT" name="type" value="T" type="radio" {{ ((isset($indicator->type)?$indicator->type:'')=='T'?'checked':'') }} >
                Tendência
              </label>
            </div>
            <div class="radio">
              <label>
                <input id="typeV" name="type" value="V" type="radio" {{ ((isset($indicator->type)?$indicator->type:'')=='V'?'checked':'') }} >
                Volume
              </label>
            </div>
            <div class="radio">
              <label>
                <input id="typeO" name="type" value="M" type="radio" {{ ((isset($indicator->type)?$indicator->type:'')=='M'?'checked':'') }} >
                Misto
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="avatar" class="col-sm-3 control-label">Imagem do Indicador</label>

          <div class="col-sm-6">
            <input id="image01" name="image" class="btn btn-primary imagepreview" type="file"
             accept="image/png,image/jpeg" >
            <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 500KB.</p>
          </div>

          <div class="col-sm-3">
            <a href="#" class="azoom">
              <img class="img-responsive pad image01"
               src="{{ asset('/storage/indicators/'.
                   (isset($indicator->image)?$indicator->image:'../../img/loading.gif'))}}" />
            </a>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary">{{ (isset($indicator->id)?'Salvar':'Enviar') }} </button>
            {{ nbsp(2) }}
            <a class="btn btn-warning" href="{{ url('indicator/'.$indicator->id) }}">Cancelar</a>
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
