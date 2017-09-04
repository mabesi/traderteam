@extends('layouts.panel')

@section('content')

      <div class="row">
        <div class="col-md-12">

          <div class="box box-primary">
            <div class="box-header with-border">
              <div>
                <h3 class="box-title">
                  <span class="label bg-blue">C</span> Compra
                  <span class="label bg-red">V</span> Venda {{ nbsp(6) }}
                  <span class="label bg-black">R</span> Real
                  <span class="label bg-green">S</span> Simulada
                </h3>
                <a class="pull-right" href="{{ url($path.'?stoped=1&closed=1&finished=1') }}">
                  <button type="button" class="btn btn-sm btn-success" name="button">Finalizadas</button>
                  {{ nbsp(2) }}
                </a>
                <a class="pull-right" href="{{ url($path.'?started=1&moved=1') }}">
                  <button type="button" class="btn btn-sm btn-warning" name="button">Em Andamento</button>
                  {{ nbsp(2) }}
                </a>
                <a class="pull-right" href="{{ url($path.'?new=1&changed=1') }}">
                  <button type="button" class="btn btn-sm btn-info" name="button">Não Iniciadas</button>
                  {{ nbsp(2) }}
                </a>
                <a class="pull-right" href="{{ url($path) }}">
                  <button type="button" class="btn btn-sm btn-primary" name="button">Exibir Todas</button>
                  {{ nbsp(2) }}
                </a>
              </div>
              <div class="top-20 font-12">
                <form class="form-inline" action="{{ url($path) }}" method="get">

                    <input type="text" name="stock" class="form-control" size="10" placeholder="Código do Papel"
                      value="{{ (isset($where['stock'])?$where['stock']:'') }}">

                    <select id="buyorsell" name="buyorsell">
                      <option value="">Compra/Venda</option>
                      <option value="C" {{ (isset($where['buyorsell'])?($where['buyorsell']=='C'?'SELECTED':''):'') }}>Compra</option>
                      <option value="V" {{ (isset($where['buyorsell'])?($where['buyorsell']=='V'?'SELECTED':''):'') }}>Venda</option>
                    </select>

                    <select id="realorsimulated" name="realorsimulated">
                      <option value="">Real/Simulada</option>
                      <option value="R" {{ (isset($where['realorsimulated'])?($where['realorsimulated']=='R'?'SELECTED':''):'') }}>Real</option>
                      <option value="S" {{ (isset($where['realorsimulated'])?($where['realorsimulated']=='S'?'SELECTED':''):'') }}>Simulada</option>
                    </select>

                    <select id="strategy" name="strategy" data-placeholder="Estratégia" >
                      <option value="">=> Estratégia</option>
                      @foreach ($strategies as $strategy)
                        <option
                          value="{{ $strategy->id }}"
                          {{ (isset($where['strategy_id'])?(($where['strategy_id']==$strategy->id)?'SELECTED':''):'') }}>
                          {{ $strategy->title }}
                        </option>
                      @endforeach
                    </select>

                    <div class="form-group">
                      <label for="new">
                        <input id="new" type="checkbox" name="new" value="1" {{ (isset($where['new'])?($where['new']==1?'CHECKED':''):'') }}> Nova
                      </label>
                      <label for="changed">
                        <input id="changed" type="checkbox" name="changed" value="1" {{ (isset($where['changed'])?($where['changed']==1?'CHECKED':''):'') }}> Alterada
                      </label>
                      <label for="started">
                        <input id="started" type="checkbox" name="started" value="1" {{ (isset($where['started'])?($where['started']==1?'CHECKED':''):'') }}> Iniciada
                      </label>
                      <label for="moved">
                        <input id="moved" type="checkbox" name="moved" value="1" {{ (isset($where['moved'])?($where['moved']==1?'CHECKED':''):'') }}> Stop Movido
                      </label>
                      <label for="stoped">
                        <input id="stoped" type="checkbox" name="stoped" value="1" {{ (isset($where['stoped'])?($where['stoped']==1?'CHECKED':''):'') }}> Stopada
                      </label>
                      <label for="closed">
                        <input id="closed" type="checkbox" name="closed" value="1" {{ (isset($where['closed'])?($where['closed']==1?'CHECKED':''):'') }}> Encerrada
                      </label>
                      <label for="finished">
                        <input id="finished" type="checkbox" name="finished" value="1" {{ (isset($where['finished'])?($where['finished']==1?'CHECKED':''):'') }}> No Alvo
                      </label>
                    </div>

                  {{ nbsp(4) }}
                  <button type="submit" class="btn btn-default">
                    <i class="fa fa-search"></i>
                  </button>
                </form>
            </div>
            <div class="box-body">
              @include('operation.list')
            </div>
            <div class="box-footer">
              {{ $operations->appends($where)->links() }}
            </div>
          </div>

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

@endsection
