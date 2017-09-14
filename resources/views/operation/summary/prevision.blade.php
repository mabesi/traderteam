<div class="box box-solid top-10"><!-- previsão da operação -->

  <div class="box-head">
    <div class="col-xs-12 label text-blue top-bottom-5">
      <h3>Previsão da Operação</h3>
    </div>
  </div>
  <div class="box-body bg-gray">

    <div class="col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua">
          <i class="fa fa-play-circle"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Entrada</span>
          <span class="info-box-number">{{ $operation->preventry }}</span>
        </div>
      </div>
    </div>

    <div class="col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-orange">
          <i class="fa fa-life-ring"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Stop</span>
          <span class="info-box-number">{{ $operation->prevstop }}</span>
          <span class="font-12">{{ $operation->prevRisk() }}%</span>
          <span class="font-12">{{ $operation->prevCapitalRisk() }}%</span>
        </div>
      </div>
    </div>

    <div class="col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-olive">
          <i class="fa fa-money"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Alvo</span>
          <span class="info-box-number">{{ $operation->prevtarget }}</span>
          <span class="font-12">{{ $operation->prevReturn() }}%</span>
          <span class="font-12">{{ $operation->prevCapitalReturn() }}%</span>
        </div>
      </div>
    </div>

  </div>
</div><!-- previsão da operação -->
