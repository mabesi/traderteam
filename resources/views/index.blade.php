@extends('layouts.panel')

@push('css')
@endpush

@section('content')

@php
  $totalStrategies=$user->strategies->count();
  $totalOperations=$user->operations->count();
  $totalFollowing=$user->following->count();
  $welcomeBox = session('welcome-box','');
@endphp

@if ($totalOperations==0)
<div class="box {{ $welcomeBox }}">
  <div class="box-header with-border">
    <h3 class="box-title font-16 text-bold text-primary">Olá {{ $user->name }}. Seja bem-vindo!</h3>
    <div class="box-tools pull-right">
      <!-- Collapse Button -->
      <button type="button" class="btn btn-box-tool" data-widget="collapse">
        <i class="fa fa-{{ ($welcomeBox==''?'minus':'plus') }}"></i>
      </button>
    </div>
    <!-- /.box-tools -->
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <p>Nossa comunidade é formada por pessoas apaixonadas pelo mercado financeiro e que gostam de compartilhar suas idéias.</p>
    <p>Esta é a sua Home, onde você terá acesso rápido e resumido às suas informações, aos <a href="{{ url('notice') }}">Avisos</a> da administração e notícias sobre o mercado.</p>
@if ($totalStrategies==0 && $totalOperations==0)
    <p>Você se cadastrou há {{ humanPastTime($user->created_at,False) }} e ainda não possui nehuma Estratégia criada, bem como nenhuma Operação.</p>
@elseif ($totalOperations==0)
    <p>Você já iniciou a criação de Estratégias mas ainda não possui nehuma Operação registrada.</p>
@endif

@if ($totalFollowing==0)
    <p>Além disso, você ainda não está seguindo nenhum usuário da comunidade.</p>
@endif
    <p>Estamos aqui para orientá-lo em sua jornada. Os passos básicos para utilizar o <b>TraderTeam</b> são:</p>
    <ol>
      <li>
        Atualizar o seu <a href="{{ url('profile/edit') }}">Perfil</a> para que os outros usuários o conheçam;
      </li>
      <li>
        Procurar <a href="{{ url('users') }}">Usuários</a> que você deseja seguir;
      </li>
      <li>
        Acompanhar <a href="{{ url('strategy') }}">Estratégias</a>, que utilizem ou não <a href="{{ url('indicator') }}">Indicadores</a>, e <a href="{{ url('operation') }}">Operações</a> de outros usuários para aprender e/ou colaborar;
      </li>
      <li>
        Acompanhar informações e os principais gráficos do <a href="{{ url('market') }}">Mercado Mundial</a> para se manter atualizado;
      </li>
      <li>
        Ler sobre as regras para <a href="{{ url('strategy-rules') }}">Definição de Estratégias</a> e para <a href="{{ url('operation-rules') }}">Registro de Operações</a>;
      </li>
      <li>
        Quando estiver pronto você poderá <a href="{{ url('strategy/create') }}">criar uma Estratégia</a>. Em seguida você poderá também <a href="{{ url('operation/create') }}">registrar uma Operação</a>.
      </li>
    </ol>
    <p>Para maiores detalhes utilize a <a href="{{ url('help') }}">Central de Ajuda</a> ou entre em contato através do <a href="{{ url('contact') }}" target="_blank">Fale Conosco.</a></p>
    <p>Nossa equipe estará sempre pronta e disposta a lhe ajudar no que for preciso.</p>
    <p>Atenciosamente, <b>TraderTeam</b>.</p>

  </div><!-- /.box-body -->
</div>
@php
  if ($welcomeBox!='collapsed-box'){
    session(['welcome-box' => 'collapsed-box']);
  }
@endphp

@endif

<div class="row">

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid bg-gray">
      <div class="box-header with-border bg-navy">
        <span class="font-20">Evolução de Resultados</span>
      </div>
      <div class="box-body">
        @include('operation.resultinfo')
      </div>
      <div class="box-footer">
        <a href="{{ url('myoperations') }}">Minhas Operações</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-yellow">
        <span class="font-20">Operações em Andamento</span>
        <a class="pull-right font-20 text-olive" title="Ver Todas"
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
          href="{{ url('myoperations?new=1&changed=1') }}"><i class="fa fa-th-list"></i>
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

  <div class="col-sm-6 col-lg-3">

    <div class="box box-solid">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Quadro de Avisos</span>
        <a class="pull-right font-20 text-warning" title="Ver Todos"
          href="{{ url('notice') }}"><i class="fa fa-th-list"></i>
        </a>
      </div>
      <div class="box-body">
        @include('notice.listmin')
      </div>
    </div>

  </div>
</div>

<div class="row">


  <div class="col-sm-5 col-lg-3">
    <div class="box box-solid">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Usuários (Seguindo)</span>
      </div>
      <div class="box-body">
        @include('user.list')
      </div>
      <div class="box-footer">
        <a href="{{ url('users') }}">Ver Todos</a> |
        <a href="{{ url('user/following') }}">Seguindo</a> |
        <a href="{{ url('user/myfollowers') }}">Seguidores</a>
      </div>
    </div>
  </div>

  <div class="col-sm-7 col-lg-5">
    <div class="box box-solid">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Operações (Seguindo)</span>
      </div>
      <div class="box-body">
        @include('operation.listmin')
      </div>
      <div class="box-footer">
        <a href="{{ url('operations/following') }}">Ver Todas</a> |
        <a href="{{ url('operations/following?new=1&changed=1') }}">Não Iniciadas</a> |
        <a href="{{ url('operations/following?started=1&moved=1') }}">Em Andamento</a> |
        <a href="{{ url('operations/following?stoped=1&closed=1&finished=1') }}">Encerradas</a>
      </div>
    </div>
  </div>

  <div class="col-sm-12 col-lg-4">
    <div class="box box-solid">
      <div class="box-header with-border bg-tt-green">
        <span class="font-20">Notícias <a class="font-16 text-aqua" href="http://www.infomoney.com.br/mercados/ultimas-noticias" target="_blank">(Infomoney)</a></span>
      </div>
      <div class="box-body">
        {!! feedRss('http://www.infomoney.com.br/mercados/rss',8) !!}
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
@endpush
