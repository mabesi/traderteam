@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset('/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="nav-tabs-custom">

      <form class="form-horizontal"
      action="{{ url('/operation'.(isset($operation->id)?'/'.$operation->id:'')) }}"
      method="POST"
      enctype="multipart/form-data">

      <ul class="nav nav-tabs">
        <li><div class="pad"><button type="submit" class="btn pad btn-primary">{{ (isset($operation->id)?'Salvar':'Enviar') }} </button></div></li>
        <li class="active"><a href="#operation" data-toggle="tab">Operação</a></li>
        <li><a href="#preanalysis" data-toggle="tab">Pré-Análise</a></li>
        <li><a href="#postanalysis" data-toggle="tab">Pós-Análise</a></li>
      </ul>

      <div class="tab-content">


        <!-- /.tab-pane -->
        <div class="tab-pane active" id="operation">

          <div class="row">


            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Previsão da Operação</h3>
                </div>

                  {{ csrf_field() }}

                  @if (isset($operation->id))
                    <input type="hidden" name="_method" value="PUT">
                  @endif

                  <div class="form-group">
                   <label for="strategy" class="col-sm-3 control-label">Estratégia *</label>

                   <div class="col-sm-9">
                     <select id="strategy" name="strategy" class="form-control" data-placeholder="Informe qual a estratégia utilizada" style="width: 100%;">
                       <option value=""></option>
                       @foreach ($strategies as $strategy)
                         <option
                           value="{{ $strategy->id }}"
                           {{ ($strategy->id==(isset($operation->strategy_id)?$operation->strategy_id:'')?'selected':'') }} >
                           {{ $strategy->title }}
                         </option>
                       @endforeach
                     </select>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="stock" class="col-sm-3 control-label">Ativo *</label>

                   <div class="col-sm-9">
                     <input type="text" name="stock" class="form-control" id="stock"
                      value="{{ old('stock',isset($operation->stock)?$operation->stock:Null) }}"
                      placeholder="Sigla do Ativo (Ex: PETR4, VALE5, ITUB4)">
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="buyorsell" class="col-sm-3 control-label">Tipo de Operação *</label>

                   <div class="col-sm-9">
                     <div class="radio">
                       <label>
                         <input id="typeC" name="buyorsell" value="C" type="radio"
                          {{ ((isset($operation->buyorsell)?$operation->buyorsell:'')=='C'?'checked':'') }} >
                         Compra &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeV" name="buyorsell" value="V" type="radio"
                          {{ ((isset($operation->buyorsell)?$operation->buyorsell:'')=='V'?'checked':'') }} >
                         Venda &nbsp;&nbsp;
                       </label>
                     </div>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="type" class="col-sm-3 control-label">Real / Simulada *</label>

                   <div class="col-sm-9">
                     <div class="radio">
                       <label>
                         <input id="typeR" name="realorsimulated" value="R" type="radio"
                          {{ ((isset($operation->realorsimulated)?$operation->realorsimulated:'')=='C'?'checked':'') }} >
                         Real &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeS" name="realorsimulated" value="S" type="radio"
                          {{ ((isset($operation->realorsimulated)?$operation->realorsimulated:'')=='V'?'checked':'') }} >
                         Simulada &nbsp;&nbsp;
                       </label>
                     </div>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="type" class="col-sm-3 control-label">Tempo Gráfico *</label>

                   <div class="col-sm-9">
                     <div class="radio">
                       <label>
                         <input id="type1" name="gtime" value="1" type="radio"
                          {{ ((isset($operation->gtime)?$operation->gtime:'')=='1'?'checked':'') }} >
                         1 Hora &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="type4" name="gtime" value="4" type="radio"
                          {{ ((isset($operation->gtime)?$operation->gtime:'')=='4'?'checked':'') }} >
                         4 Horas &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeD" name="gtime" value="D" type="radio"
                          {{ ((isset($operation->gtime)?$operation->gtime:'')=='D'?'checked':'') }} >
                         Diário &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeS" name="gtime" value="S" type="radio"
                          {{ ((isset($operation->gtime)?$operation->gtime:'')=='S'?'checked':'') }} >
                         Semanal &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeM" name="gtime" value="M" type="radio"
                          {{ ((isset($operation->gtime)?$operation->gtime:'')=='M'?'checked':'') }} >
                         Mensal
                       </label>
                     </div>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="preventry" class="col-sm-3 control-label">Preço de Entrada *</label>

                   <div class="col-sm-9">
                     <input type="number" step=".01" name="preventry" class="form-control" id="preventry"
                      value="{{ old('preventry',isset($operation->preventry)?$operation->preventry:Null) }}" >
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="prevexit" class="col-sm-3 control-label">Preço de Saída *</label>

                   <div class="col-sm-9">
                     <input type="number" step=".01" name="prevexit" class="form-control" id="prevexit"
                      value="{{ old('prevexit',isset($operation->prevexit)?$operation->prevexit:Null) }}" >
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="prevstop" class="col-sm-3 control-label">Preço de Stop *</label>

                   <div class="col-sm-9">
                     <input type="number" step=".01" name="prevstop" class="form-control" id="prevstop"
                      value="{{ old('prevstop',isset($operation->prevstop)?$operation->prevstop:Null) }}" >
                   </div>
                 </div>

              </div>
            </div>

            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Registro da Operação</h3>
                </div>

                <div class="form-group">
                  <label for="entrydate" class="col-sm-3 control-label">Data de Entrada</label>

                  <div class="col-sm-9">
                    <input type="date" name="entrydate" class="form-control" id="entrydate"
                    value="{{ old('entrydate',isset($operation->entrydate)?getBRDateFromMysql($operation->entrydate):Null) }}"
                    data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="realentry" class="col-sm-3 control-label">Preço de Entrada</label>

                  <div class="col-sm-9">
                    <input type="number" step=".01" name="realentry" class="form-control" id="realentry"
                     value="{{ old('realentry',isset($operation->realentry)?$operation->realentry:Null) }}" >
                  </div>
                </div>

                <div class="form-group">
                  <label for="exitdate" class="col-sm-3 control-label">Data de Saída</label>

                  <div class="col-sm-9">
                    <input type="date" name="exitdate" class="form-control" id="exitdate"
                    value="{{ old('exitdate',isset($operation->exitdate)?getBRDateFromMysql($operation->exitdate):Null) }}"
                    data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                  </div>
                </div>

                <div class="form-group">
                  <label for="realexit" class="col-sm-3 control-label">Preço de Saída</label>

                  <div class="col-sm-9">
                    <input type="number" step=".01" name="realexit" class="form-control" id="realexit"
                     value="{{ old('realexit',isset($operation->realexit)?$operation->realexit:Null) }}" >
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>
        <!-- /.tab-pane -->

        <div class="tab-pane" id="preanalysis">
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Pré-Análise da Operação</h3>
            </div>


          </div>
        </div>

        <div class="tab-pane" id="postanalysis">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Pós-Análise da Operação</h3>
            </div>


          </div>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->

    </form>

    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@endsection

@push('scripts')
<script src="{{ asset("/js/img-helper.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/input-mask/jquery.inputmask.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/input-mask/jquery.inputmask.date.extensions.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/input-mask/jquery.inputmask.extensions.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.pt-BR.js") }}"></script>
<script src="{{ asset("/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script>
  $(function () {
    $('.textarea').wysihtml5();
    $('[data-mask]').inputmask();
  });
</script>
@endpush
