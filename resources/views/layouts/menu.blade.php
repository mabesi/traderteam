  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>TT</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ config('app.name', 'Laravel <b>Admin</b> LTE') }}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

          @if (false)
            @include('menu.messages')
            @include('menu.notifications')
            @include('menu.tasks')
          @endif

          @if (getTotalOpenDenounces()>0 && isAdmin())
            <li class="no-padding">
              <a href="{{ url('report') }}" title="Existem denúncias abertas!"><i class="fa fa-info-circle text-warning font-16 no-margin"></i></a>
            </li>
          @endif

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              {!! getUserAvatar('user-image') !!}
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                {!! getUserAvatar() !!}

                <p>
                  {{ Auth::user()->name }}
                  <small>Membro desde {{ Auth::user()->memberSince() }}</small>
                </p>
              </li>
              <!-- Menu Body
              <li class="user-body">

              </li>
              -->
              <!-- Menu Footer-->
              <li class="user-footer">
                  <div class="pull-left">
                    <a href="{{ url('/profile') }}" class="btn btn-default btn-flat text-primary">Meu Perfil</a>
                  </div>
                  <div class="pull-right">

                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat text-danger"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Sair
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                  </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
