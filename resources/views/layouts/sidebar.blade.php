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
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
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
        <li><a href="{{ url('profile') }}"><i class="fa fa-user"></i> <span>Meu Perfil</span></a></li>

        <li class="treeview">
          <a href="#"><i class="fa fa-lightbulb-o"></i> <span>Estratégias</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ url('strategy/create') }}">Nova Estratégia</a></li>
            <li><a href="{{ url('strategy') }}">Minhas Estratégias</a></li>
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
            <li><a href="{{ url('operation') }}">Minhas Operações</a></li>
            <li><a href="{{ url('operation-rules') }}">Regras para Registro</a></li>
          </ul>
        </li>

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

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
