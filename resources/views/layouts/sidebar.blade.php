  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="image text-center img-responsive">
          <img src="{{ asset("/img/logo-mini.png") }}" alt="TraderTeam Logo Mini">
        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="{{ route('search') }}" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
              <span class="input-group-btn">
                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">Menu</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>

        <li class="treeview">
          <a href="#"><i class="fa fa-user"></i> <span>Usuários</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('profile') }}">Meu Perfil</a></li>
            <li><a href="{{ url('profile/edit') }}">Editar Meu Perfil</a></li>
            <li><a href="{{ url('users') }}">Lista de Usuários</a></li>
            <li><a href="{{ url('user/following') }}">Estou Seguindo</a></li>
            <li><a href="{{ url('user/myfollowers') }}">Meus Seguidores</a></li>
            <li><a href="{{ url('users?sort=rank&dir=desc') }}">Top Ranking</a></li>
            <li><a href="{{ url('users?sort=followers_count&dir=desc') }}">Top Seguidores</a></li>
            <li><a href="{{ url('users?sort=operations_count&dir=desc') }}">Top Operações</a></li>
            <li><a href="{{ url('users?sort=strategies_count&dir=desc') }}">Top Estratégias</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-lightbulb-o"></i> <span>Estratégias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('strategy/create') }}">Nova Estratégia</a></li>
            <li><a href="{{ url('mystrategies') }}">Minhas Estratégias</a></li>
            <li><a href="{{ url('strategy') }}">Lista de Estratégias</a></li>
            <li><a href="{{ url('beststrategies') }}">Melhores Estratégias</a></li>
            <li><a href="{{ url('strategies/following') }}">Estratégias Seguindo</a></li>
            <li><a href="{{ url('strategy-rules') }}">Regras de Definição</a></li>
            <li><a href="{{ url('indicator') }}">Indicadores</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-line-chart"></i> <span>Operações</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('operation/create') }}">Nova Operação</a></li>
            <li><a href="{{ url('myoperations') }}">Minhas Operações</a></li>
            <li><a href="{{ url('operation') }}">Lista de Operações</a></li>
            <li><a href="{{ url('myoperations?new=1&changed=1') }}">=> Não Iniciadas</a></li>
            <li><a href="{{ url('myoperations?started=1&moved=1') }}">=> Em Andamento</a></li>
            <li><a href="{{ url('myoperations?stoped=1&closed=1&finished=1') }}">=> Finalizadas</a></li>
            <li><a href="{{ url('operations/following') }}">Operações Seguindo</a></li>
            <li><a href="{{ url('operation-rules') }}">Regras para Registro</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#"><i class="fa fa-bullhorn"></i> <span>Avisos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
@if (isAdmin())
            <li><a href="{{ url('notice/create') }}">Novo Aviso</a></li>
@endif
            <li><a href="{{ url('notice') }}">Lista de Avisos</a></li>
          </ul>
        </li>

@if (false)
        <li class="treeview">
          <a href="#"><i class="fa fa-envelope"></i> <span>Mensagens</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Nova Mensagem</a></li>
            <li><a href="#">Caixa de Entrada</a></li>
          </ul>
        </li>
@endif

        <li><a href="{{ route('market') }}"><i class="fa fa-globe"></i> <span>Mercado Mundial</span></a></li>

        <li><a href="{{ route('help') }}"><i class="fa fa-question-circle"></i> <span>Ajuda</span></a></li>

        <li><a href="{{ route('contact') }}" target="_blank"><i class="fa fa-commenting"></i> <span>Fale Conosco</span></a></li>
        <li>{{ nbsp(1) }}</li>

@if (isAdmin())
        <li class="treeview">
          <a href="#"><i class="fa fa-gear text-yellow"></i> <span>Administração</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            @if (isSuperAdmin())
            <li><a href="{{ url('configuration/create') }}">Nova Configuração</a></li>
            @endif
            <li><a href="{{ url('configuration') }}">Lista de Configurações</a></li>
            <li><a href="{{ url('report') }}">Lista de Denúncias</a></li>
          </ul>
        </li>
@endif

        <li><a class="text-olive font-11" href="{{ url('/profile/'.getProfileId().'/toogle-sidebar') }}"
                title="Clique para manter a barra lateral aberta/recolhida">
                    <i class="fa fa-arrow-circle-{{ (getConfig('sidebar_closed')?'right':'left') }}"></i>
                    <span>
                      {{ (getConfig('sidebar_closed')?'Manter Aberto':'Manter Recolhido') }}
                    </span>
              </a>
        </li>

      </ul>

      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
