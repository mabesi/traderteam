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
      @include('layouts.errors')
      <p>Utilize o formulário abaixo para nos enviar suas dúvidas, elogios, sugestões ou reclamações.</p>
      <p>Sua participação é muito importante para nós e nossa equipe estará sempre pronta e disposta a lhe auxiliar no que for necessário.</p>

      <form class="form-horizontal pad" action="{{ url('contact') }}" method="POST">

      {{ csrf_field() }}

      <div class="form-group">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
          <span class="text-muted font-12">
            Todos os campos são obrigatórios.
          </span>
        </div>
      </div>

        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Nome *</label>

          <div class="col-sm-10">
            <input type="text" value="{{ old('name',getUserName()) }}" name="name" class="form-control"
            maxlength="100" id="name" required>
          </div>
        </div>

        <div class="form-group">
          <label for="email_contact" class="col-sm-2 control-label">Email *</label>

          <div class="col-sm-10">
            <input type="email_contact" value="{{ old('email_contact',getUserEmail()) }}" name="email_contact" class="form-control"
            maxlength="50"  id="email_contact" required>
          </div>
        </div>

        <div class="form-group">
          <label for="message" class="col-sm-2 control-label">Mensagem *</label>

          <div class="col-sm-10">
            <textarea class="textarea form-control" rows="6" name="message" id="message" required>{!! old('message') !!}</textarea>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <small>Digite os caracteres abaixo no campo ao lado:</small><br>
            {!! captcha_img() !!}
            <input type="text" name="captcha" maxlength="10" id="captcha" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </div>
      </form>

    </div>
  </div>

</div>
<div class="row" id="footer">
  <div class="col-sm-12 text-center">
    <strong>TraderTeam</strong><br>
    COPYRIGHT 2017 <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span> Todos os direitos reservados.
  </div>
</div>
@endsection

@push('scripts')
@endpush
