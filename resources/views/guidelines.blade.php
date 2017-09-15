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
