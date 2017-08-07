@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset("/css/cover.css") }}">
@endpush

@section('content')

<div id="rowlogo" class="row">
  <div class="col-sm-3">
  </div>
  <div class="col-sm-6">
    <img id="logo" src="{{ asset("/img/logo.png") }}" class="img-responsive" alt="Responsive image">
  </div>
  <div class="col-sm-3 ">
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <img id="home-banner" src="{{ asset("/img/sardinha-tubarao.png") }}" class="img-responsive" alt="Responsive image">
  </div>
</div>
<div class="container">

  <div class="row">

    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">

            <ul class="nav nav-pills nav-stacked">

              <li role="presentation" class="active">
                <a href="{{ route('login') }}" class="text-left">
                  <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login
                </a>
              </li>
              <li role="presentation" class="active">
                <a href="{{ route('register') }}" class="text-left">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Registrar
                </a>
              </li>
              <li role="presentation" class="active">
                <a href="#missao" class="text-left">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Missão, Visão e Valores
                </a>
              </li>
              <li role="presentation" class="active">
                <a href="#sobre" class="text-left">
                  <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Sobre o TraderTeam
                </a>
              </li>
              <li role="presentation" class="active">
                <a href="{{ route('login') }}" class="text-left">
                  <span class="glyphicon glyphicon-file" aria-hidden="true"></span> Política de Privacidade
                </a>
              </li>
              <li role="presentation" class="active">
                <a href="{{ route('login') }}" class="text-left">
                  <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Disclaimer
                </a>
              </li>
              <li role="presentation" class="active">
                <a href="#contato" class="text-left">
                  <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Contato
                </a>
              </li>
            </ul>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="{{ asset("/img/pesquisa.jpg") }}" alt="...">
        <div class="caption">
          <h3>Pesquise Oportunidades</h3>
          <p>Realize sua busca por papéis que considera próximos a pontos de compra ou venda, que sejam promessa de operações lucrativas...</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="{{ asset("/img/analise.jpg") }}" alt="...">
        <div class="caption">
          <h3>Analise os Riscos</h3>
          <p>Faça a análise dos papéis com base em sua estratégia de operação, respeitando os critérios adotados pela Comunidade TraderTeam...</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-md-3">
      <div class="thumbnail">
        <img src="{{ asset("/img/indicacao.jpg") }}" alt="...">
        <div class="caption">
          <h3>Compartilhe as Operações</h3>
          <p>Publique suas operações para que outros usuários acompanhem e aprendam junto com você...</p>
        </div>
      </div>
    </div>

  </div>

  <div class="row" id="sobre">
    <div class="col-sm-12  text-justify">
      <h2>Sobre o TraderTeam</h2>
      <p>O TraderTeam é uma comunidade formada por indivíduos com ideais convergentes no que se refere a investimentos de renda variável e aprendizado colaborativo.
      <p>Nosso público alvo são pessoas que operam no mercado financeiro com base em análise técnica, nas modalidades Day Trade ou Swing Trade, que possuem um ou mais estratégias de operação, e que desejam aperfeiçoar seu aprendizado constantemente por meio de trabalho em grupo.</p>

      <p>Técnicas utilizadas pelos membros da comunidade para evoluir no aprendizado e alcançar os resultados:</p>
      <ul>
        <li>Descrever por escrito as regras do método utilizado para entrar em uma operação;</li>
        <li>Registrar e divulgar a operação visualizada em uma forma padronizada pelo time;</li>
        <li>Registrar e divulgar o resultado da operação divulgada, em percentuais;</li>
        <li>Revisão periódica das operações realizadas, da evolução financeira e do método utilizado pelos membros do time.</li>
      </ul>

    </div>
  </div>

  <div class="row" id="missao">
    <div class="col-sm-12">
      <h2>Missão, Visão e Valores</h2>

      <div class="row">
        <div class="col-sm-6">
          <div class="panel panel-danger">
            <div class="panel-heading  text-center">MISSÃO</div>
            <div class="panel-body text-justify">
              Aperfeiçoar constantemente o modo de operação e as estratégias de análise para day trade e swing trade de cada um dos membros da comunidade.
            </div>
          </div>
          <div class="panel panel-info">
            <div class="panel-heading  text-center">VISÃO</div>
            <div class="panel-body text-justify">
              Ser um time de swing-traders e day-traders que desenvolve a disciplina e o aprendizado necessário para alcançar lucros constantes a longo prazo no mercado financeiro de ações à vista.
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="panel panel-success">
            <div class="panel-heading  text-center">VALORES</div>
            <div class="panel-body text-justify">
              <ul>
                <li><strong>Cooperação:</strong> demonstrar o ponto de vista pessoal por meio de críticas construtivas.</li>
                <li><strong>Honestidade:</strong> compartilhar operação real na qual seu dinheiro está envolvido.</li>
                <li><strong>Transparência:</strong> demonstrar o método utilizado e todos os registros das operações.</li>
                <li><strong>Cooperação:</strong> demonstrar o ponto de vista pessoal por meio de críticas construtivas.</li>
                <li><strong>Respeito:</strong> atuar com cuidado no uso de críticas ao método e resultado de um membro da equipe.</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row" id="contato">
    <div class="col-sm-12">
    <h2>Contato</h2>
    <p>Para dúvidas, críticas ou sugestões, envie sua mensagem para <a href="mailto:atendimento.vip@traderteam.com">atendimento.vip@traderteam.com</a></p>
    <a href="#top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Top</a>
    </div>
  </div>

</div>

<div class="row" id="footer">
  <div class="col-sm-12 text-center">
    COPYRIGHT 2017 <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span> Todos os direitos reservados.
  </div>
</div>

@endsection

@push('scripts')
@endpush
