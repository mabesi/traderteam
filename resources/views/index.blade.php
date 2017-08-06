@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset("/adminlte2/plugins/iCheck/square/blue.css") }}">
  <link rel="stylesheet" href="{{ asset("/css/cover.css") }}">
@endpush

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-6 col-md-3">
      <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="..." alt="...">
        <div class="caption">
          <h3>Thumbnail label</h3>
          <p>Texto da imagem texto da imagem texto da imagem texto da imagem texto da imagem texto da imagem ...</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="..." alt="...">
        <div class="caption">
          <h3>Thumbnail label</h3>
          <p>Texto da imagem texto da imagem texto da imagem texto da imagem texto da imagem texto da imagem ...</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="..." alt="...">
        <div class="caption">
          <h3>Thumbnail label</h3>
          <p>Texto da imagem texto da imagem texto da imagem texto da imagem texto da imagem texto da imagem ...</p>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset("/adminlte2/plugins/iCheck/icheck.min.js") }}"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
@endpush
