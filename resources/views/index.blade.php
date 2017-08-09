@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset("/css/cover.css") }}">
@endpush

@section('content')

<div id="rowlogo" class="row">
  <div class="col-xs-1 col-sm-3">
  </div>
  <div class="col-xs-10 col-sm-6">
    <img id="logo" src="{{ asset("/img/logo.png") }}" class="img-responsive" alt="Responsive image">
  </div>
  <div class="col-xs-1 col-sm-3">
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

              <li role="presentation" >
                <a href="{{ route('login') }}" class="text-left">
                  <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Login
                </a>
              </li>
              <li role="presentation" >
                <a href="{{ route('register') }}" class="text-left">
                  <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Registrar
                </a>
              </li>
              <li role="presentation" >
                <a href="#sobre" class="text-left">
                  <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> Sobre o TraderTeam
                </a>
              </li>
              <li role="presentation" >
                <a href="#missao" class="text-left">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> Missão, Visão e Valores
                </a>
              </li>
              <li role="presentation" >
                <a href="#disclaimer" class="text-left">
                  <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> Disclaimer
                </a>
              </li>
              <li role="presentation" >
                <a href="#privacidade" class="text-left">
                  <span class="glyphicon glyphicon-file" aria-hidden="true"></span> Política de Privacidade
                </a>
              </li>
              <li role="presentation" >
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
          <p>Faça a análise dos papéis com base em sua estratégia de operação, respeitando os critérios adotados pela Comunidade <strong>TraderTeam</strong>...</p>
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
    <div class="col-sm-8  text-justify">
      <h2>Sobre o TraderTeam</h2>
      <p>O <strong>TraderTeam</strong> é uma comunidade formada por investidores, não profissionais, com ideais convergentes no que se refere a investimentos de renda variável e aprendizado colaborativo.
      <p>Nosso público alvo são pessoas que operam no mercado financeiro com base em análise técnica, nas modalidades Day Trade ou Swing Trade, que possuem um ou mais estratégias de operação, e que desejam aperfeiçoar seu aprendizado constantemente por meio de trabalho em grupo.</p>

      <p>Técnicas utilizadas pelos membros da comunidade para evoluir no aprendizado e alcançar os resultados:</p>
      <ul>
        <li>Descrever por escrito as regras do método utilizado para entrar em uma operação;</li>
        <li>Registrar e divulgar a operação visualizada em uma forma padronizada pelo time;</li>
        <li>Registrar e divulgar o resultado da operação compartilhada, em percentuais;</li>
        <li>Revisão periódica das operações realizadas, da evolução financeira e do método utilizado pelos membros do time.</li>
      </ul>

    </div>
    <div class="col-sm-4 text-right">
      <br><br>
      <iframe frameborder="0" scrolling="no" height="255" width="304" allowtransparency="true" marginwidth="0" marginheight="0" src="https://sslindrates.forexprostools.com/index.php?force_lang=12&pairs_ids=166;27;172;175;176;177;168;170;178;179;&header-text-color=%23FFFFFF&curr-name-color=%230059b0&inner-text-color=%23000000&green-text-color=%232A8215&green-background=%23B7F4C2&green-background=%23B7F4C2&red-text-color=%23DC0001&red-background=%23FFE2E2&inner-border-color=%23CBCBCB&border-color=%23cbcbcb&bg1=%23F6F6F6&bg2=%23ffffff&open=hide&high=hide&low=hide&last_update=hide"></iframe><br /><span style="font-size: 11px;color: #333333;text-decoration: none;"> Índices Mundiais fornecidos por <a href="https://br.investing.com/" rel="nofollow" target="_blank" style="font-size: 11px;color: #06529D; font-weight: bold;" class="underline_link">Investing.com Brasil</a>.</span>
    </div>
  </div>

  <a href="#top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Top</a>

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

  <a href="#top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Top</a>

  <div class="row" id="disclaimer">
    <div class="col-sm-12 text-justify">
      <h2>Disclaimer</h2>
      <p>As análises e operações compartilhadas neste site não configuram, em hipótese alguma, recomendações ou indicações de investimento. Todo conteúdo publicado destina-se, exclusivamente, ao estudo de métodos e estratégias de investimento, visando unicamente a evolução individual dos investidores através da colaboração em grupo.</p>
      <p>O <strong>TraderTeam</strong> e sua equipe de manutenção se isentam de qualquer responsabilidade, direta ou indiretamente, por qualquer prejuízo financeiro derivado de investimentos realizados a partir das análises aqui publicadas. Cada investidor, usuário deste site, é o único responsável por suas atitudes e pela decisão sobre como utilizar as informações aqui divulgadas pelos outros usuários.</p>
    </div>
  </div>

  <a href="#top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Top</a>

  <div class="row" id="privacidade">
    <div class="col-sm-12 text-justify">
      <h2>Política de Privacidade</h2>
      <p>A política de privacidade da comunidade <strong>TraderTeam</strong> foi concebida com vistas a garantir aos nossos usuários segurança e privacidade dos dados coletados.</p>
      <p>Nós prestamos o compromisso de armazenar as informações obtidas com toda a segurança e sigilo possíveis, incluindo a utilização de processo de criptografia de dados confidenciais, além de não fornecer as referidas informações a quem quer que seja, exceto em caso de determinação judicial. Os dados pessoais fornecidos voluntariamente pelo usuário tem a finalidade única e exclusiva de permitir que o mesmo seja identificado e tenha acesso ao site e respectivas sessões.</p>
      <p>As análises estatísticas, desenvolvidas pela comunidade <strong>TraderTeam</strong>, sobre operações publicadas não serão objeto de comercialização junto a terceiros, sendo seu único objetivo o compartilhamento de resultados de estudos a fim de contribuir com o aprendizado da própria comunidade.</p>
      <p>Nossa política de privacidade está sujeita a alterações, sem aviso prévio, devido à dinâmica da Web e das constantes atualizações do site, sendo assim recomenda-se o seu acompanhamento periódico.</p>
    </div>
  </div>

  <a href="#top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Top</a>

  <div class="row" id="contato">
    <div class="col-sm-12">
      <h2>Contato</h2>
      <p>Para dúvidas, críticas ou sugestões, envie sua mensagem para <a href="mailto:atendimento.vip@traderteam.com">atendimento.vip@traderteam.com</a></p>
    </div>
  </div>

  <a href="#top"><span class="glyphicon glyphicon-menu-up" aria-hidden="true"></span> Top</a>

</div>

<div class="row" id="footer">
  <div class="col-sm-12 text-center">
    <strong>TraderTeam</strong><br>
    COPYRIGHT 2017 <span class="glyphicon glyphicon-copyright-mark" aria-hidden="true"></span> Todos os direitos reservados.
  </div>
</div>

@endsection

@push('scripts')
@endpush
