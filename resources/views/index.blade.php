@extends('layouts.panel')

@push('css')
@endpush

@section('content')

@include('guidelines')

<div class="row">

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid bg-white">
      <div class="box-header with-border bg-tt-gray">
        <span class="font-20">Evolução de Resultados</span>
      </div>
      <div class="box-body">
        @include('operation.chartjs')
      </div>
      <div class="box-footer">
        <a href="{{ url('myoperations') }}">Minhas Operações</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">

    <div class="box box-solid">
      <div class="box-header with-border bg-yellow">
        <span class="font-20">Quadro de Avisos</span>
        <a class="pull-right font-20 text-olive" title="Ver Todos"
          href="{{ url('notice') }}">{{ nbsp(2) }}<i class="fa fa-th-list"></i>
        </a>
        @if (isAdmin())
        <a class="pull-right font-20 text-olive" title="Incluir Novo Aviso"
          href="{{ url('notice/create') }}"><i class="fa fa-plus-circle"></i>
        </a>
        @endif
      </div>
      <div class="box-body">
        @include('notice.listmin')
      </div>
    </div>

  </div>

  <div class="col-sm-6 col-lg-3">

    <div class="box box-solid">
      <div class="box-header with-border bg-olive">
        <span class="font-20">Operações em Andamento</span>
        <a class="pull-right font-20 text-yellow" title="Ver Todas"
          href="{{ url('myoperations?started=1&moved=1') }}"><i class="fa fa-th-list"></i>
        </a>
      </div>
      <div class="box-body">
        @include('operation.listmin-started')
      </div>
    </div>

  </div>

  <div class="col-sm-6 col-lg-3">

    <div class="box box-solid no-padding">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Operações Não Iniciadas</span>
        <a class="pull-right font-20 text-warning" title="Ver Todas"
          href="{{ url('myoperations?new=1&changed=1') }}">{{ nbsp(2) }}<i class="fa fa-th-list"></i>
        </a>
        <a class="pull-right font-20 text-warning" title="Incluir Nova Operação"
          href="{{ url('operation/create') }}"><i class="fa fa-plus-circle"></i>
        </a>
      </div>
      <div class="box-body">
        @include('operation.listmin-new')
      </div>
    </div>

    <div class="box box-solid">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Operações Finalizadas</span>
        <a class="pull-right font-20 text-warning" title="Ver Todas"
          href="{{ url('myoperations?stoped=1&closed=1&finished=1') }}"><i class="fa fa-th-list"></i>
        </a>
      </div>
      <div class="box-body">
        @include('operation.listmin-finished')
      </div>
    </div>

  </div>

</div>

<div class="row">


  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Usuários <small class="font-14">(Seguindo)</small></span>
        <a class="pull-right font-20 text-warning" title="Ver Todos"
          href="{{ url('users') }}"><i class="fa fa-th-list"></i>
        </a>
      </div>
      <div class="box-body">
        @include('user.list')
      </div>
      <div class="box-footer">
        <a href="{{ url('user/following') }}">Seguindo</a> |
        <a href="{{ url('user/myfollowers') }}">Seguidores</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Operações <small class="font-14">(Seguindo)</small></span>
        <a class="pull-right font-20 text-warning" title="Ver Todas"
          href="{{ url('operations/following') }}"><i class="fa fa-th-list"></i>
        </a>
      </div>
      <div class="box-body">
        @include('operation.listmin')
      </div>
      <div class="box-footer font-12">
        <a href="{{ url('operations/following?new=1&changed=1') }}">Não Iniciadas</a> |
        <a href="{{ url('operations/following?started=1&moved=1') }}">Em Andamento</a> |
        <a href="{{ url('operations/following?stoped=1&closed=1&finished=1') }}">Encerradas</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Operações <small class="font-14">(Curtidas)</small></span>
        <a class="pull-right font-20 text-warning" title="Ver Todas"
          href="{{ url('operations/liked') }}"><i class="fa fa-th-list"></i>
        </a>
      </div>
      <div class="box-body">
        @include('operation.listminliked')
      </div>
      <div class="box-footer font-12">
        <a href="{{ url('operations/liked?new=1&changed=1') }}">Não Iniciadas</a> |
        <a href="{{ url('operations/liked?started=1&moved=1') }}">Em Andamento</a> |
        <a href="{{ url('operations/liked?stoped=1&closed=1&finished=1') }}">Encerradas</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Notícias <a class="font-16 text-aqua" href="http://www.infomoney.com.br/mercados/ultimas-noticias" target="_blank">(Infomoney)</a></span>
      </div>
      <div class="box-body">
        {!! feedRss('http://www.infomoney.com.br/mercados/rss',6) !!}
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
@endpush
