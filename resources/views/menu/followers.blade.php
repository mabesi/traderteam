<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
  <!-- Menu toggle button -->
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-envelope-o"></i>
    <span class="label label-success">2</span>
  </a>
  <ul class="dropdown-menu">
    <li class="header">Você tem 2 novas mensagens</li>
    <li>
      <!-- inner menu: contains the messages -->
      <ul class="menu">
        <li><!-- start message -->
          <a href="#">
            <div class="pull-left">
              <!-- User Image -->
              <img src="{{ asset("/img/avatar/suporte02.png") }}" class="img-circle" alt="User Image">
            </div>
            <!-- Message title and timestamp -->
            <h4>
              Suporte TraderTeam
              <small><i class="fa fa-clock-o"></i> 5 mins</small>
            </h4>
            <!-- The message -->
            <p>Sua solicitação foi atendida.</p>
          </a>
        </li>
        <!-- end message -->
        <li><!-- start message -->
          <a href="#">
            <div class="pull-left">
              <!-- User Image -->
              <img src="{{ asset("/img/avatar/avatar01.png") }}" class="img-circle" alt="User Image">
            </div>
            <!-- Message title and timestamp -->
            <h4>
              Fulano de Tal
              <small><i class="fa fa-clock-o"></i> 20 mins</small>
            </h4>
            <!-- The message -->
            <p>Bizú de nova estratégia.</p>
          </a>
        </li>
        <!-- end message -->
      </ul>
      <!-- /.menu -->
    </li>
    <li class="footer"><a href="#">Ir para caixa de entrada</a></li>
  </ul>
</li>
<!-- /.messages-menu -->
