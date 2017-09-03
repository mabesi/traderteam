@extends('layouts.panel')

@push('css')
@endpush

@section('content')

<div class="row">

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid bg-gray">
      <div class="box-header with-border bg-navy">
        <span class="font-20">Evolução de Resultados</span>
      </div>
      <div class="box-body">
        <div class="">
          {!! getHtmlImage('http://bvmf.bmfbovespa.com.br/InstDados/Indices/MLCXGRAFICO_MENSAL.gif','img-responsive') !!}
        </div>
        <div class="info-box top-10">
          <span class="info-box-icon bg-teal">
            <i class="fa fa-calendar"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Ultimos 12 Meses</span>
            <span class="info-box-number">15,47%</span>
          </div>

        </div>
        <div class="info-box">
          <span class="info-box-icon bg-green">
            <i class="fa fa-bar-chart"></i>
          </span>
          <div class="info-box-content">
            <span class="info-box-text">Resultado Geral</span>
            <span class="info-box-number">34,23%</span>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <a href="{{ url('operation') }}">Ver Estatísticas</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-yellow">
        <span class="font-20">Operações em Andamento</span>
      </div>
      <div class="box-body">
        @include('operation.listmin-started')
      </div>
      <div class="box-footer">
        <a href="{{ url('myoperations?stoped=1&closed=1&finished=1') }}">Ver Todas</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-olive">
        <span class="font-20">Operações Não Iniciadas</span>
      </div>
      <div class="box-body">
        @include('operation.listmin-new')
      </div>
      <div class="box-footer">
        <a href="{{ url('myoperations?new=1&changed=1') }}">Ver Todas</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-olive">
        <span class="font-20">Operações Finalizadas</span>
      </div>
      <div class="box-body">
        @include('operation.listmin-finished')
      </div>
      <div class="box-footer">
        <a href="{{ url('myoperations?stoped=1&closed=1&finished=1') }}">Ver Todas</a>
      </div>
    </div>
  </div>

</div>

<div class="row">


  <div class="col-sm-5 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-gray">
        <span class="font-20">Usuários (Seguindo)</span>
      </div>
      <div class="box-body">
        @include('user.list')
      </div>
      <div class="box-footer">
        <a href="{{ url('users') }}">Ver Todos</a> |
        <a href="{{ url('users?follow=following') }}">Seguindo</a> |
        <a href="{{ url('users?follow=followers') }}">Seguidores</a>
      </div>
    </div>
  </div>

  <div class="col-sm-7 col-lg-5">
    <div class="box box-solid">
      <div class="box-header with-border bg-gray">
        <span class="font-20">Operações (Seguindo)</span>
      </div>
      <div class="box-body">
        @include('operation.listmin')
      </div>
      <div class="box-footer">
        <a href="{{ url('operation') }}">Ver Todas</a> |
        <a href="{{ url('operation') }}">Não Iniciadas</a> |
        <a href="{{ url('operation') }}">Em Andamento</a> |
        <a href="{{ url('operation') }}">Encerradas</a>
      </div>
    </div>
  </div>

  <div class="col-sm-12 col-lg-4">
    <div class="box box-solid">
      <div class="box-header with-border bg-gray">
        <span class="font-20">Notícias <a class="font-16" href="http://www.infomoney.com.br/mercados/ultimas-noticias" target="_blank">(Infomoney)</a></span>
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
