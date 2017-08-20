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
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li><div class="pad"><button type="submit" class="btn btn-lg pad btn-primary">{{ (isset($operation->id)?'Salvar':'Enviar') }} </button></div></li>
        <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
        <li class="active"><a class="btn btn-info" href="#operation" data-toggle="tab">Operação</a></li>
        <li><a class="btn btn-danger" href="#preanalysis" data-toggle="tab">Pré-Análise</a></li>
        <li><a class="btn btn-success" href="#postanalysis" data-toggle="tab">Pós-Análise</a></li>
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
                          {{ ((isset($operation->buyorsell)?$operation->buyorsell:'C')=='C'?'checked':'') }} >
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
                          {{ ((isset($operation->realorsimulated)?$operation->realorsimulated:'R')=='R'?'checked':'') }} >
                         Real &nbsp;&nbsp;
                       </label>
                       <label>
                         <input id="typeS" name="realorsimulated" value="S" type="radio"
                          {{ ((isset($operation->realorsimulated)?$operation->realorsimulated:'')=='S'?'checked':'') }} >
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
                          {{ ((isset($operation->gtime)?$operation->gtime:'D')=='D'?'checked':'') }} >
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

                <div class="form-group">
                  <br>
                  <label for="status" class="col-sm-3 control-label"><br>Status</label>

                  <div class="col-sm-9">
                    <h1 id="status">{{ (isset($operationstatus)?$operationstatus:'CONCEPÇÃO') }}</h1>
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
                          <label for="previmage01" class="col-md-3 control-label">Gráfico 1</label>
                          <div class="col-md-9">
                            <input id="previmage01" name="previmage01" class="btn btn-danger imagepreview" type="file"
                             accept="image/png,image/jpeg" >
                            <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 500KB.</p>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <a href="#" class="azoom" title="Clique para aumentar!">
                              <img class="img-max pad previmage01"
                               src="{{ asset('/storage/indicators/'.
                                   (isset($indicator->image)?$indicator->image:'../../img/loading.gif'))}}" />
                            </a>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="box">
                        <div class="box-header">
                          <label for="prevanalysis01" class="control-label">Análise do Gráfico 1</label>
                        </div>
                        <div class="box-body">
                          <textarea class="textarea textarea-md form-control" name="prevanalysis01" id="prevanalysis01" rows="15">
                            {!! old('prevanalysis01',isset($prevanalysis01)?$prevanalysis01:Null) !!}
                          </textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">

                      <div class="form-group">
                        <div class="row">
                          <label for="previmage02" class="col-md-3 control-label">Gráfico 2</label>

                          <div class="col-md-9">
                            <input id="previmage02" name="previmage01" class="btn btn-danger imagepreview" type="file"
                             accept="image/png,image/jpeg" >
                            <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 500KB.</p>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <a href="#" class="azoom" title="Clique para aumentar!">
                              <img class="img-max pad previmage02"
                               src="{{ asset('/storage/indicators/'.
                                   (isset($indicator->image)?$indicator->image:'../../img/loading.gif'))}}" />
                            </a>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="box">
                        <div class="box-header">
                          <label for="prevanalysis02" class="control-label">Análise do Gráfico 2</label>
                        </div>
                        <div class="box-body">
                          <textarea class="textarea textarea-md form-control" name="prevanalysis02" id="prevanalysis02" rows="15">
                            {!! old('prevanalysis02',isset($prevanalysis02)?$prevanalysis02:Null) !!}
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
                         accept="image/png,image/jpeg" >
                        <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 500KB.</p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <a href="#" class="azoom" title="Clique para aumentar!">
                          <img class="img-max pad postimage01"
                           src="{{ asset('/storage/indicators/'.
                               (isset($indicator->image)?$indicator->image:'../../img/loading.gif'))}}" />
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
                      <textarea class="textarea textarea-md form-control" name="postanalysis01" id="postanalysis01" rows="15">
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
                         accept="image/png,image/jpeg" >
                        <p class="help-block">Imagens permitidas: jpeg, jpg e png. Tamanho máximo: 500KB.</p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        <a href="#" class="azoom" title="Clique para aumentar!">
                          <img class="img-max pad postimage02"
                           src="{{ asset('/storage/indicators/'.
                               (isset($indicator->image)?$indicator->image:'../../img/loading.gif'))}}" />
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
                      <textarea class="textarea textarea-md form-control" name="postanalysis02" id="postanalysis02">
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
