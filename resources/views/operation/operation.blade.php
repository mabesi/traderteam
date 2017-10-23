@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset('/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
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
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li><div class="pad">
          <button type="submit" class="btn btn-lg pad btn-primary">{{ (isset($operation->id)?'Salvar':'Enviar') }}</button>
          {{ nbsp(2) }}
@if (isset($operation))
          <a href="{{ url('operation/'.$operation->id) }}" class="btn btn-lg pad btn-warning">Cancelar</a>
@else
          <a href="{{ route('home') }}" class="btn btn-lg pad btn-warning">Cancelar</a>
@endif
        </div></li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li class="active"><a class="btn btn-info" href="#operation" data-toggle="tab"><b>Operação</b></a></li>
        <li><a class="btn btn-danger" href="#preanalysis" data-toggle="tab"><b>Pré-Análise</b></a></li>
        <li><a class="btn btn-success" href="#postanalysis" data-toggle="tab"><b>Pós-Análise</b></a></li>
      </ul>

      <div class="tab-content pad">

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
                    <input type="hidden" value="{{ $operation->user_id }}" name="user_id" >
                  @else
                    <input type="hidden" value="{{ getUserId() }}" name="user_id" >
                  @endif

                  <div class="form-group">
                   <label for="strategy" class="col-sm-3 control-label">Estratégia *</label>

                   <div class="col-sm-9">
                     <select id="strategy_id" name="strategy_id" class="form-control" data-placeholder="Informe qual a estratégia utilizada"
                      style="width: 100%;" {{ lockOperationFields('strategy_id',$status) }} required>
                       <option value=""></option>
                       @foreach ($strategies as $strategy)
                         <option
                           value="{{ $strategy->id }}"
                           {{ ($strategy->id==(old('strategy_id',isset($operation->strategy_id)?$operation->strategy_id:''))?'selected':'') }} >
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
                      placeholder="Sigla do Ativo (Ex: PETR4, VALE5, ITUB4)"
                      {{ lockOperationFields('stock',$status) }} required>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="amount" class="col-sm-3 control-label">Quantidade *</label>

                   <div class="col-sm-9">
                     <input type="number" step="1" name="amount" class="form-control" id="amount"
                      value="{{ old('amount',isset($operation->amount)?$operation->amount:Null) }}"
                      {{ lockOperationFields('amount',$status) }} required>
                      <small class="text-muted">Somente você pode ver esta informação!</small>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="buyorsell" class="col-sm-3 control-label">Tipo de Operação *</label>

                   <div class="col-sm-9">
                     <div class="radio">
                       <label>
                         <input id="typeC" name="buyorsell" value="C" type="radio"
                          {{ ((isset($operation->buyorsell)?$operation->buyorsell:'C')=='C'?'checked':'') }}
                          {{ lockOperationFields('buyorsell',$status) }} required>
                         Compra &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeV" name="buyorsell" value="V" type="radio"
                          {{ ((isset($operation->buyorsell)?$operation->buyorsell:'')=='V'?'checked':'') }}
                          {{ lockOperationFields('buyorsell',$status) }} >
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
                          {{ ((isset($operation->realorsimulated)?$operation->realorsimulated:'R')=='R'?'checked':'') }}
                          {{ lockOperationFields('realorsimulated',$status) }} required>
                         Real &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeS" name="realorsimulated" value="S" type="radio"
                          {{ ((isset($operation->realorsimulated)?$operation->realorsimulated:'')=='S'?'checked':'') }}
                          {{ lockOperationFields('realorsimulated',$status) }} >
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
                          {{ ((isset($operation->gtime)?$operation->gtime:'')=='1'?'checked':'') }}
                          {{ lockOperationFields('gtime',$status) }} required>
                         1 Hora &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="type4" name="gtime" value="4" type="radio"
                          {{ ((isset($operation->gtime)?$operation->gtime:'')=='4'?'checked':'') }}
                          {{ lockOperationFields('gtime',$status) }} >
                         4 Horas &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeD" name="gtime" value="D" type="radio"
                          {{ ((isset($operation->gtime)?$operation->gtime:'D')=='D'?'checked':'') }}
                          {{ lockOperationFields('gtime',$status) }} >
                         Diário &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeS" name="gtime" value="S" type="radio"
                          {{ ((isset($operation->gtime)?$operation->gtime:'')=='S'?'checked':'') }}
                          {{ lockOperationFields('gtime',$status) }} >
                         Semanal &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeM" name="gtime" value="M" type="radio"
                          {{ ((isset($operation->gtime)?$operation->gtime:'')=='M'?'checked':'') }}
                          {{ lockOperationFields('gtime',$status) }} >
                         Mensal
                       </label>
                     </div>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="preventry" class="col-sm-3 control-label">Preço de Entrada *</label>

                   <div class="col-sm-9">
                     <input type="number" step=".001" name="preventry" class="form-control" id="preventry"
                      value="{{ old('preventry',isset($operation->preventry)?number_format($operation->preventry,2):Null) }}"
                      {{ lockOperationFields('preventry',$status) }} required>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="prevtarget" class="col-sm-3 control-label">Preço do Alvo *</label>

                   <div class="col-sm-9">
                     <input type="number" step=".001" name="prevtarget" class="form-control" id="prevtarget"
                      value="{{ old('prevtarget',isset($operation->prevtarget)?number_format($operation->prevtarget,2):Null) }}"
                      {{ lockOperationFields('prevtarget',$status) }} required>
                   </div>
                 </div>

                 <div class="form-group">
                   <label for="prevstop" class="col-sm-3 control-label">Preço de Stop *</label>

                   <div class="col-sm-9">
                     <input type="number" step=".001" name="prevstop" class="form-control" id="prevstop"
                      value="{{ old('prevstop',isset($operation->prevstop)?number_format($operation->prevstop,2):Null) }}"
                      {{ lockOperationFields('prevstop',$status) }} required>
                   </div>
                 </div>

                 @if (isset($operation))
                 <div class="form-group">
                   <label for="prevstop" class="col-sm-3 control-label">Risco/Retorno</label>

                   <div class="col-sm-9">
                     @include('operation.riskreturn')
                   </div>
                 </div>
                 @endif

              </div>
            </div>

            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Registro da Operação</h3>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-9">
                    @if (isset($operation->realentry) && isset($operation->amount))
                    <p>Valor da Operação: <strong>{{ formatCurrency($operation->amount*$operation->realentry) }}</strong> | Saldo Atual: <strong>{{ formatCurrency(getUserAvailableCapital($operation->user)) }}</strong></p>
                    @elseif (isset($operation->preventry) && isset($operation->amount))
                    <p>Valor da Operação: <strong>{{ formatCurrency($operation->amount*$operation->preventry) }}</strong> | Saldo Atual: <strong>{{ formatCurrency(getUserAvailableCapital($operation->user)) }}</strong></p>
                    @endif
                  </div>
                </div>

                <div class="form-group">
                  <label for="entrydate" class="col-sm-3 control-label">Data de Entrada</label>

                  <div class="col-sm-9">
                    <input type="date" name="entrydate" class="form-control" id="entrydate"
                    value="{{ old('entrydate',isset($operation->entrydate)?getBRDateFromMysql($operation->entrydate):Null) }}"
                    data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""
                    {{ lockOperationFields('entrydate',$status) }} >
                  </div>
                </div>

                <div class="form-group">
                  <label for="realentry" class="col-sm-3 control-label">Preço de Entrada</label>

                  <div class="col-sm-9">
                    <input type="number" step=".001" name="realentry" class="form-control" id="realentry"
                     value="{{ old('realentry',isset($operation->realentry)?$operation->realentry:Null) }}"
                     {{ lockOperationFields('realentry',$status) }} >
                  </div>
                </div>

                <div class="form-group">
                  <label for="currentstop" class="col-sm-3 control-label">Stop Atual</label>

                  <div class="col-sm-9">
                    <input type="number" step=".001" name="currentstop" class="form-control" id="currentstop"
                      value="{{ old('currentstop',isset($operation->currentstop)?$operation->currentstop:Null) }}"
                      {{ lockOperationFields('currentstop',$status) }} >
                  </div>
                </div>

                <div class="form-group">
                  <label for="exitdate" class="col-sm-3 control-label">Data de Saída</label>

                  <div class="col-sm-9">
                    <input type="date" name="exitdate" class="form-control" id="exitdate"
                    value="{{ old('exitdate',isset($operation->exitdate)?getBRDateFromMysql($operation->exitdate):Null) }}"
                    data-inputmask="'alias': 'dd/mm/yyyy'" data-mask=""
                    {{ lockOperationFields('exitdate',$status) }} >
                  </div>
                </div>

                <div class="form-group">
                  <label for="realexit" class="col-sm-3 control-label">Preço de Saída</label>

                  <div class="col-sm-9">
                    <input type="number" step=".001" name="realexit" class="form-control" id="realexit"
                     value="{{ old('realexit',isset($operation->realexit)?$operation->realexit:Null) }}"
                     {{ lockOperationFields('realexit',$status) }} >
                  </div>
                </div>

                <div class="form-group">
                  <label for="fees" class="col-sm-3 control-label">Taxas</label>

                  <div class="col-sm-9">
                    <input type="number" step=".01" min="5.0" name="fees" class="form-control" id="fees"
                     value="{{ old('fees',isset($operation->fees)?$operation->fees:Null) }}"
                     {{ lockOperationFields('fees',$status) }} >
                     <small class="text-muted">Mínimo: R$ 5,00. Caso não seja informado será utilizado o valor padrão.<br>
                          Padrão: R$ {{ getConfiguration('BROKERAGE_FEE') }} x2
                           (+ Aluguel: R$ {{ getConfiguration('STOCKS_RENTAL_RATE') }} para vendas)</small>
                  </div>
                </div>

                <div class="form-group">
                  <br>
                    <label for="status" class="col-sm-3 control-label"><br>Status</label>
                    <div class="col-sm-9">
                      <br />
                      <button type="button" class="btn btn-lg btn-block btn-{{ statusClass($status) }} ">
                        {{ operationStatus($status) }}
                      </button>
                    </div>
                </div>


              </div>
            </div>

          </div>
        </div><!-- end operation-->
        <!-- /.tab-pane -->

        <!-- /.tab-pane -->
        <div class="tab-pane" id="preanalysis">

              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Análise Antes da Operação</h3>
                </div>

                <div class="box-body">
                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                        <div class="row">
                          <label for="preimage01" class="col-md-3 control-label">Gráfico 1</label>
                          <div class="col-md-9">
                            <input id="preimage01" name="preimage01" class="btn btn-danger imagepreview" type="file"
                             accept="image/png,image/jpeg" max-size="512000"
                             {{ lockOperationFields('preimage01',$status) }} >
                            <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 500KB.</p>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <a href="#" class="azoom" title="Clique para aumentar!">
                              <img class="img-max pad preimage01"
                               src="{{ asset('/storage/operations/'.
                                   (isset($preimage01)?$operation->user_id.'/'.$operation->id.'/'.$preimage01:'../../img/loading.gif'))}}" />
                            </a>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="box">
                        <div class="box-header">
                          <label for="preanalysis01" class="control-label">Análise do Gráfico 1</label>
                        </div>
                        <div class="box-body">
                          <textarea class="textarea textarea-md form-control" name="preanalysis01" id="preanalysis01" rows="15"
                            {{ lockOperationFields('preanalysis01',$status) }} >
                            {!! old('preanalysis01',isset($preanalysis01)?$preanalysis01:Null) !!}
                          </textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                        <div class="row">
                          <label for="preimage02" class="col-md-3 control-label">Gráfico 2</label>

                          <div class="col-md-9">
                            <input id="preimage02" name="preimage02" class="btn btn-danger imagepreview" type="file"
                             accept="image/png,image/jpeg" max-size="512000"
                             {{ lockOperationFields('preimage02',$status) }} >
                            <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 500KB.</p>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <a href="#" class="azoom" title="Clique para aumentar!">
                              <img class="img-max pad preimage02"
                               src="{{ asset('/storage/operations/'.
                                   (isset($preimage02)?$operation->user_id.'/'.$operation->id.'/'.$preimage02:'../../img/loading.gif'))}}" />
                            </a>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="box">
                        <div class="box-header">
                          <label for="preanalysis02" class="control-label">Análise do Gráfico 2</label>
                        </div>
                        <div class="box-body">
                          <textarea class="textarea textarea-md form-control" name="preanalysis02" id="preanalysis02" rows="15"
                          {{ lockOperationFields('preanalysis02',$status) }} >
                            {!! old('preanalysis02',isset($preanalysis02)?$preanalysis02:Null) !!}
                          </textarea>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div> <!-- end box body -->

              </div><!-- end box-->
        </div><!-- end preanalysis-->

        <div class="tab-pane" id="postanalysis">

          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Análise Após a Operação</h3>
            </div>

            <div class="box-body">
              <div class="row">
                <div class="col-md-6">

                  <div class="form-group">
                    <div class="row">
                      <label for="postimage01" class="col-md-3 control-label">Gráfico 1</label>
                      <div class="col-md-9">
                        <input id="postimage01" name="postimage01" class="btn btn-success imagepreview" type="file"
                         accept="image/png,image/jpeg" max-size="512000"
                         {{ lockOperationFields('postimage01',$status) }} >
                        <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 500KB.</p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <a href="#" class="azoom" title="Clique para aumentar!">
                          <img class="img-max pad postimage01"
                           src="{{ asset('/storage/operations/'.
                               (isset($postimage01)?$operation->user_id.'/'.$operation->id.'/'.$postimage01:'../../img/loading.gif'))}}" />
                        </a>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="box">
                    <div class="box-header">
                      <label for="postanalysis01" class="control-label">Análise do Gráfico 1</label>
                    </div>
                    <div class="box-body">
                      <textarea class="textarea textarea-md form-control" name="postanalysis01" id="postanalysis01" rows="15"
                        {{ lockOperationFields('postanalysis01',$status) }} >
                        {!! old('postanalysis01',isset($postanalysis01)?$postanalysis01:Null) !!}
                      </textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">

                  <div class="form-group">
                    <div class="row">
                      <label for="postimage02" class="col-md-3 control-label">Gráfico 2</label>

                      <div class="col-md-9">
                        <input id="postimage02" name="postimage02" class="btn btn-success imagepreview" type="file"
                         accept="image/png,image/jpeg" max-size="512000"
                         {{ lockOperationFields('postimage02',$status) }} >
                        <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 500KB.</p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <a href="#" class="azoom" title="Clique para aumentar!">
                          <img class="img-max pad postimage02"
                           src="{{ asset('/storage/operations/'.
                               (isset($postimage02)?$operation->user_id.'/'.$operation->id.'/'.$postimage02:'../../img/loading.gif'))}}" />
                        </a>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-md-6">
                  <div class="box">
                    <div class="box-header">
                      <label for="postanalysis02" class="control-label">Análise do Gráfico 2</label>
                    </div>
                    <div class="box-body">
                      <textarea class="textarea textarea-md form-control" name="postanalysis02" id="postanalysis02"
                        {{ lockOperationFields('postanalysis02',$status) }} >
                        {!! old('postanalysis02',isset($postanalysis02)?$postanalysis02:Null) !!}
                      </textarea>
                    </div>
                  </div>
                </div>
                </div>
              </div> <!-- end box body -->

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

@include('layouts.imagemodal')

@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
<script src="{{ asset("/js/img-helper.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/input-mask/jquery.inputmask.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/input-mask/jquery.inputmask.extensions.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.pt-BR.js") }}"></script>
<script src="{{ asset("/adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js") }}"></script>
<script>
  $(function () {
    $('.textarea').wysihtml5();
    //$('[data-mask]').inputmask();
  });
</script>
@endpush
