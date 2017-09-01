@extends('layouts.panel')

@push('css')
@endpush

@section('content')

<div class="row">
  <div class="col-md-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-green">
        <span class="font-24">Usuários</span>
      </div>
      <div class="box-body">
        @include('user.list')
      </div>
      <div class="box-footer">
        <a href="{{ url('user') }}">Ver Todos</a>
      </div>
    </div>
  </div>

  <div class="col-md-5">
    <div class="box box-solid">
      <div class="box-header with-border bg-red">
        <span class="font-24">Operações</span>
      </div>
      <div class="box-body">
        @include('operation.listmin')
      </div>
      <div class="box-footer">
        <a href="{{ url('operation') }}">Ver Todas</a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="box box-solid">
      <div class="box-header with-border bg-blue">
        <span class="font-24">Notícias <a class="font-12 text-teal" href="http://www.infomoney.com.br/mercados/ultimas-noticias" target="_blank">(Infomoney)</a></span>
      </div>
      <div class="box-body">
        {!! feedRss('http://www.infomoney.com.br/mercados/rss') !!}
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
@endpush
