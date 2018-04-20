@extends('frontend.model')

@push('css')
<style>
.circle-content {
  border: solid 0px #000;
  width: 100%;
  text-align: center;
  margin: auto;
}

.circle-content li {
  padding: 2%;
  margin: 0 5px;
  border-radius: 30%;
  -moz-border-radius: 30%; 
  -webkit-border-radius: 30%;
  display: inline-block;
  vertical-align: middle;
  text-align: center;
  width: 200px;
  height: 200px;
  background-color: #8fd361;
  color: #314920;
}
</style>
@endpush

@section('content')

@include('layouts.errors')

  <!-- /.preloader -->
  <div id="preloader"></div>
  <div id="top"></div>

  <!-- /.parallax full screen background image -->
  <div class="fullscreen landing parallax" style="background-image:url('{{ asset('backyard/images/bg.jpg') }}');" data-img-width="2000" data-img-height="1333" data-diff="100">

      <div class="overlay">
          <div class="container">
              <div class="row">
                <div class="col-md-3">
                  <!-- /.logo -->
                  <div class="logo wow fadeInDown "> <a href=""><img src="{{ asset('backyard/images/logo.png') }}" alt="logo"></a></div>
                </div>
                <div class="col-md-9">
                  <div class="wow fadeInRight "><img class="site-name" src="{{ asset('backyard/images/site-name.png') }}" alt="logo"></div>
                </div>
              </div>
              <div class="row">
                  <div class="col-md-8">

                      <!-- /.main title -->
                      <h1 class="wow fadeInLeft">
                          Um time de traders contra o imprevisível!
                      </h1>

                      <!-- /.header paragraph -->
                      <div class="landing-text wow fadeInLeft">
                          <p>Traders independentes podem fazer sucesso individualmente. Porém, ao unir forças como um grande time que busca e compartilha
                            os mesmos objetivos, o limite passa a ser a fronteira do desconhecido!</p>
                      </div>

                      <!-- /.header button -->
                      <div class="head-btn wow fadeInLeft">
                          <a href="#howto" class="btn btn-default">Como funciona?</a>
                          <a href="#mission" class="btn btn-default">Missão, Visão e Valores</a>
                      </div>

                  </div>

                  <!-- /.signup form -->
                  <div class="col-md-4">

                      <div class="signup-header wow fadeInRight">
                          <h3 class="form-title text-center">Login</h3>

                          <form class="form-header" action="{{ route('login') }}" method="post">

                              {{ csrf_field() }}

                              <div class="form-group">
                                <input id="email" type="email" name="email" class="form-control input-lg" placeholder="Email" value="{{ old('email')}}" required>
                                @if ($errors->has('email'))
                                    <span class="help-block font-12">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <input id="password" type="password" class="form-control input-lg" placeholder="Senha" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block font-12">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group last">
                                  <input type="submit" class="btn btn-warning btn-block btn-lg" value="Entrar">
                              </div>

                              <p class="privacy">
                                <a href="{{ route('register') }}">Registrar-se</a> |
                                <a href="{{ route('password.request') }}">Lembrar senha</a>
                              </p>
                          </form>

                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- NAVIGATION -->
  <div id="menu">
      <nav class="navbar-wrapper navbar-default" role="navigation">
          <div class="container">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-backyard">
                      <span class="sr-only">Toggle navigation</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand site-name" href="#top"><img src="{{ asset('backyard/images/logo2.png') }}" alt="logo 2"></a>
              </div>

              <div id="navbar-scroll" class="collapse navbar-collapse navbar-backyard navbar-right">
                  <ul class="nav navbar-nav">
                      <li><a href="#about">Sobre</a></li>
                      <li><a href="#howto">Como Funciona</a></li>
                      <li><a href="#disclaimer">Disclaimer</a></li>
                      <li><a href="#privacy">Privacidade</a></li>
                      <li><a href="#contact">Contato</a></li>
                  </ul>
              </div>
          </div>
      </nav>
  </div>

  <!-- /.intro section -->
  <div id="about" class="top-bottom-40">
      <div class="container top-20">
          <div class="row">

              <!-- /.intro image -->
              <div class="col-md-5 intro-pic wow slideInLeft">
                  <img src="{{ asset('backyard/images/global-team.jpg') }}" alt="image" class="img-responsive top-40 radius-40">
              </div>

              <!-- /.intro content -->
              <div class="col-md-7 wow slideInRight">

                  <h2 class="top-40">SOBRE O TRADERTEAM</h2>

                  <p>O <strong>TraderTeam</strong> é uma comunidade formada por investidores não profissionais, com ideais convergentes no que se refere a investimentos de renda variável e aprendizado colaborativo.
                  <p>Nosso público alvo são pessoas que operam no mercado financeiro com base em análise técnica, na modalidade Swing Trade, que possuem uma ou mais estratégias de operação, e que desejam aperfeiçoar
                     seu aprendizado constantemente por meio de trabalho em grupo, através das seguintes técnicas:</p>
                  <ul>
                    <li>Descrição e divulgação das regras do método utilizado para entrar em uma operação</li>
                    <li>Registro e divulgação das análises e das operações visualizadas em uma forma padronizada pelo time</li>
                    <li>Revisão periódica das operações realizadas, da evolução financeira e do método utilizado pelos membros do time</li>
                    <li>Participação ativa na comunidade, através de comentários com críticas, dúvidas e sugestões em análises publicadas</li>
                  </ul>

              </div>
          </div>
      </div>
  </div>

    <!-- /.pricing section -->
    <div id="howto">
        <div class="container top-40">
            <div class="text-center">

                <!-- /.pricing title -->
                <h2 class="wow fadeInLeft">COMO FUNCIONA</h2>
                <div class="title-line wow fadeInRight"></div>
            </div>
            <div class="row package-option">

                <!-- /.package 1 -->
                <div class="col-sm-6 col-md-3">
                    <div class="price-box wow fadeInUp">
                        <div class="text-center">
                          <img class="img-90 top-10 radius-5" src="{{ asset("/backyard/images/pesquisa.jpg") }}" alt="...">
                        </div>
                        <div class="pad text-center">
                          <h3>Pesquise Oportunidades</h3>
                          <p>Realize sua busca por papéis que considera próximos a pontos de compra ou venda,
                             que sejam promessa de operações lucrativas</p>
                        </div>
                    </div>
                </div>

                <!-- /.package 2 -->
                <div class="col-sm-6 col-md-3">
                  <div class="price-box wow fadeInDown">
                      <div class="text-center">
                        <img class="img-90 top-10 radius-5" src="{{ asset("/backyard/images/analise.jpg") }}" alt="...">
                      </div>
                      <div class="pad text-center">
                        <h3>Analise os Riscos Envolvidos</h3>
                        <p>Faça a análise dos papéis com base em sua estratégia de operação,
                           respeitando os critérios adotados pela comunidade <strong>TraderTeam</strong></p>
                      </div>
                  </div>
                </div>

                <!-- /.package 3 -->
                <div class="col-sm-6 col-md-3">
                  <div class="price-box wow fadeInUp">
                    <div class="text-center">
                      <img class="img-90 top-10 radius-5" src="{{ asset("/backyard/images/indicacao.jpg") }}" alt="...">
                    </div>
                    <div class="pad text-center">
                      <h3>Compartilhe suas Operações</h3>
                      <p>Publique suas operações para que outros usuários acompanhem seu progresso e aprendam junto com seus erros e acertos</p>
                      </div>
                    </div>
                </div>

                <!-- /.package 4 -->
                <div class="col-sm-6 col-md-3">
                  <div class="price-box wow fadeInDown">
                    <div class="text-center">
                      <img class="img-90 top-10 radius-5" src="{{ asset("/backyard/images/opiniao.jpg") }}" alt="...">
                    </div>
                    <div class="pad text-center">
                      <h3>Opine, Comente e Critique</h3>
                      <p>Participe ativamente da comunidade expondo seus comentários, opiniões e críticas em operações de outros usuários</p>
                      </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

  <!-- /.download section -->
  <div id="more">
      <div class="action fullscreen parallax" style="background-image:url('{{ asset('backyard/images/bg.jpg') }}');" data-img-width="2000" data-img-height="1333" data-diff="100">
          <div class="overlay">
              <div class="container">
                  <div class="col-md-10 col-md-offset-1 col-sm-12 text-center">

                      <!-- /.download title -->
                      <h2 class="wow fadeInRight">O QUE MAIS HÁ?</h2>
                      <p class="wow fadeInLeft font-20">Além das análises de operações compartilhadas pela comunidade você terá acesso a:</p>
                      <ul class="circle-content wow fadeInLeft font-16">
                        <li><strong>PAINEL DE CONTROLE</strong><br />Para acompanhar sua evolução a partir do registro de suas operações</li>
                        <li><strong>AS MELHORES ESTRATÉGIAS</strong><br />Baseadas na estatística de sucesso das operações publicadas</li>
                        <li><strong>NOTÍCIAS E AVISOS</strong><br />Notícias obre o mercado financeiro e avisos da equipe de administração</li>
                        <li><strong>GRÁFICOS E COTAÇÕES</strong><br />Veja os gráficos e cotações dos principais índices do mercado mundial</li>
                      </ul>

                      <p class="wow fadeInLeft font-12">O registro no TraderTeam é gratuito. Você não paga nenhum tipo de taxa ou assinatura.</p>
                      <!-- /.download button -->
                      <div class="download-cta wow fadeInLeft">
                          <a href="{{ url('register') }}" class="btn-secondary">Quero me registrar</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>

  <!-- /.feature section -->
  <div id="mission">
      <div class="container top-bottom-20">
          <div class="row">
              <div class="col-md-10 col-md-offset-1 col-sm-12 text-center feature-title top-20">

                  <!-- /.feature title -->
                  <h2>MISSÃO, VISÃO E VALORES</h2>
                  <p>Conheça os princípios que norteiam o caminho da comunidade <strong>TraderTeam</strong>.</p>
              </div>
          </div>
          <div class="row row-feat">
              <div class="col-md-3 text-center">

                  <!-- /.feature image -->
                  <div class="feature-img wow fadeInLeft">
                      <img src="{{ asset('backyard/images/missao-visao-valores.jpg') }}" alt="image" class="img-responsive wow fadeInLeft">
                  </div>
              </div>

              <div class="col-md-9">

                <div class="col-md-5">
                  <div class="feat-list">
                    <i class="pe-7s-map pe-5x pe-va wow fadeInUp"></i>
                    <div class="inner">
                        <h4>Missão</h4>
                        <p>Aperfeiçoar constantemente o modo de operação e as estratégias de análise para Swing Trade de cada um dos membros da comunidade
                        </p>
                    </div>
                  </div>
                  <div class="feat-list">
                    <i class="pe-7s-look pe-5x pe-va wow fadeInUp"></i>
                    <div class="inner">
                        <h4>Visão</h4>
                        <p>Ser um time de Swing-Traders que utiliza a disciplina e o aprendizado para alcançar lucros constantes a longo prazo no mercado financeiro
                        </p>
                    </div>
                  </div>
                </div>

                <div class="col-md-7">
                  <div class="col-sm-12 feat-list">
                      <i class="pe-7s-like pe-5x pe-va wow fadeInUp"></i>
                      <div class="inner">
                          <h4>Valores</h4>
                            <p><strong>Cooperação</strong> - demonstrar o ponto de vista pessoal por meio de críticas construtivas</p>
                            <p><strong>Honestidade</strong> - compartilhar operações reais nas quais seu dinheiro está envolvido</p>
                            <p><strong>Transparência</strong> - demonstrar o método utilizado e todos os registros das operações</p>
                            <p><strong>Cooperação</strong> - demonstrar o ponto de vista pessoal por meio de críticas construtivas</p>
                            <p><strong>Respeito</strong> - atuar com cuidado no uso de críticas ao método e resultado de um membro da equipe</p>
                    </div>
                  </div>
                </div>

              </div>
          </div>
      </div>
  </div>

    <!-- /.client section -->
    <div id="buyorsell">
        <div class="container">
          <div class="text-center">

              <!-- /.pricing title -->
              <h2 class="wow fadeInLeft">COMPRAR OU VENDER?</h2>
              <div class="title-line wow fadeInRight"></div>
          </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                  <div class="text-center">
                    <img class="img-80 top-10" src="{{ asset("/backyard/images/bullxbears.png") }}" alt="...">
                  </div>
                  <p>Por que decidir sozinho se você pode contar com o apoio de toda uma comunidade apaixonada pelo mercado financeiro
                     e pela análise técnica, online 24 horas por dia, 7 dias por semana, o ano inteiro?</p>
                </div>
            </div>
        </div>
    </div>

  <div id="disclaimer">
    <div class="container top-bottom-40">
        <div class="row">

            <!-- /.feature content -->
            <div class="col-md-9 wow fadeInLeft">
                <h2>DISCLAIMER</h2>
                <p class="font-14">As análises e operações compartilhadas neste site não configuram, em hipótese alguma, recomendações ou indicações de investimento. Todo conteúdo publicado destina-se, exclusivamente, ao estudo de métodos e estratégias de investimento, visando unicamente a evolução individual dos investidores através da colaboração em grupo.</p>
                <p class="font-14">O <strong>TraderTeam</strong> e sua equipe de manutenção se isentam de qualquer responsabilidade, direta ou indiretamente, por qualquer prejuízo financeiro derivado de investimentos realizados a partir das análises aqui publicadas. Cada investidor, usuário deste site, é o único responsável por suas atitudes e pela decisão sobre como utilizar as informações aqui divulgadas pelos outros usuários.</p>
            </div>

            <!-- /.feature image -->
            <div class="col-md-3 feature-2-pic wow fadeInRight">
                <img src="{{ asset('backyard/images/disclaimer.png') }}" alt="Disclaimer" class="img-responsive">
            </div>
        </div>

    </div>
  </div>

  <div id="privacy">
    <div class="container top-bottom-40">
        <div class="row">

            <!-- /.feature image -->
            <div class="col-md-3 feature-2-pic wow fadeInRight">
              <img src="{{ asset('backyard/images/cadeado.png') }}" alt="Disclaimer" class="img-responsive">
            </div>

            <!-- /.feature content -->
            <div class="col-md-9 wow fadeInLeft">
                <h2>POLÍTICA DE PRIVACIDADE</h2>
                <p class="font-14">A política de privacidade da comunidade <strong>TraderTeam</strong> foi concebida com vistas a garantir aos nossos usuários segurança e privacidade dos dados coletados.</p>
                <p class="font-14">Nós prestamos o compromisso de armazenar as informações obtidas com toda a segurança e sigilo possíveis, incluindo a utilização de processo de criptografia de dados confidenciais, além de não fornecer as referidas informações a quem quer que seja, exceto em caso de determinação judicial. Os dados pessoais fornecidos voluntariamente pelo usuário tem a finalidade única e exclusiva de permitir que o mesmo seja identificado e tenha acesso ao site e respectivas sessões.</p>
                <p class="font-14">As análises estatísticas, desenvolvidas pela comunidade <strong>TraderTeam</strong>, sobre operações publicadas não serão objeto de comercialização junto a terceiros, sendo seu único objetivo o compartilhamento de resultados de estudos a fim de contribuir com o aprendizado da própria comunidade.</p>
                <p class="font-14">Nossa política de privacidade está sujeita a alterações, sem aviso prévio, devido à dinâmica da Web e das constantes atualizações do site, sendo assim recomenda-se o seu acompanhamento periódico.</p>
            </div>

        </div>

    </div>
  </div>

  <!-- /.contact section -->
  <div id="contact">
      <div class="contact fullscreen parallax" style="background-image:url('{{ asset('backyard/images/bg.jpg') }}');" data-img-width="2000" data-img-height="1334" data-diff="100">
          <div class="overlay">
              <div class="container">
                  <div class="row contact-row">

                      <!-- /.address and contact -->
                      <div class="col-sm-5 contact-left wow fadeInUp">
                          <h2><span class="highlight">FALE</span> CONOSCO</h2>
                          <ul class="ul-address">
                              <li><i class="pe-7s-mail"></i>Envie suas dúvidas, críticas ou elogios
                              </li>
                              <li><i class="pe-7s-id"></i>Nossa equipe estará sempre pronta e disposta a lhe auxiliar no que for preciso
                              </li>
                          </ul>

                      </div>

                      <!-- /.contact form -->
                      <div class="col-sm-7 contact-right">

                        <form id="contact-form" class="form-horizontal pad" action="{{ url('contact') }}" method="POST">

                        {{ csrf_field() }}

                              <div class="form-group">
                                <input type="text" value="{{ old('name',getUserName()) }}" name="name" class="form-control wow fadeInUp"
                                maxlength="100" id="name" placeholder="Nome *" required>
                                @if ($errors->has('name'))
                                    <span class="help-block font-12">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="form-group">
                                <input type="email" value="{{ old('email-contact',getUserEmail()) }}" name="email_contact" class="form-control wow fadeInUp"
                                maxlength="60"  id="email_contact" placeholder="E-mail *" required>
                                @if ($errors->has('email_contact'))
                                    <span class="help-block font-12">
                                        <strong>{{ $errors->first('email_contact') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="form-group">
                                <textarea class="form-control input-message wow fadeInUp" rows="6" name="message" id="message" placeholder="Mensagem *" required>{!! old('message') !!}</textarea>
                                @if ($errors->has('message'))
                                    <span class="help-block font-12">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="form-group">
                                <small>Digite os caracteres abaixo no campo ao lado:</small><br>
                                <div class="col-xs-5 col-sm-4">
                                  {!! captcha_img() !!}
                                </div>
                                <div class="col-xs-7 col-sm-8">
                                  <input type="text" name="captcha" maxlength="10" id="captcha" required>
                                </div>
                                @if ($errors->has('captcha'))
                                    <span class="help-block font-12">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="form-group">
                                  <input type="submit" name="submit" value="Enviar" class="btn btn-success wow fadeInUp" />
                              </div>
                          </form>

                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
