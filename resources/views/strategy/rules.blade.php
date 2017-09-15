@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Estratégias de Operação - Regras de Definição</h3>
            </div>

            <div class="post pad">
              {!! (isset($strategyRules->content)?$strategyRules->content:'Conteúdo não encontrado. Verfique na seção Configurações o item STRATEGY_RULES.') !!}

            <br />
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
