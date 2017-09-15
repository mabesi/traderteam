@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Operações Swing Trade - Regras para Registro</h3>
            </div>

            <div class="post pad">
              {!! (isset($operationRules->content)?$operationRules->content:'Conteúdo não encontrado. Verfique na seção Configurações o item OPERATION_RULES.') !!}

            <br />
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
