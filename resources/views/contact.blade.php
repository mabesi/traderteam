@extends('layouts.blank')

@push('css')
  <link rel="stylesheet" href="{{ asset("/css/cover.css") }}">
@endpush

@section('content')

@include('layouts.logo')

<div class="container">

  <div class="row">
    <div class="col-sm-12 text-justify">
      <h2>Fale Conosco</h2>

      <p>Formulário de contato</p>
      <p>Nome: __________</p>
      <p>Email: __________</p>
      <p>Mensagem: __________</p>
      <p>Enviar</p>

    </div>
  </div>

</div>
<br><br><br><br><br>
<div class="row" id="footer">
  <div class="col-sm-12 text-center">
    <strong>TraderTeam</strong><br>
    COPYRIGHT 2017 <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span> Todos os direitos reservados.
  </div>
</div>
@endsection

@push('scripts')
@endpush
