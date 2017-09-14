<div class="box box-solid top-10 bg-gray"><!-- registro da operação -->

  <div class="box-head">
    <div class="col-xs-12 label text-blue top-bottom-5">
      <h3>Registro da Operação</h3>
    </div>
  </div>

  <div class="box-body">

    <div class="col-xs-12">
      <div class="info-box bg-blue">
        <span class="info-box-icon">
          <i class="fa fa-play-circle"></i>
        </span>
        <div class="info-box-content">
          <span class="info-box-text">Entrada</span>
          <span class="info-box-number">{{ $operation->realentry }}</span>
          <span class="info-box-text">{{ getBRDateFromMysql($operation->entrydate) }}</span>
        </div>
      </div>
    </div>

    <div class="col-xs-12">

      @if ($operation->realexit == Null)
            <div class="info-box bg-red">
              <span class="info-box-icon">
                <i class="fa fa-life-ring"></i>
              </span>
              <div class="info-box-content">
                <span class="info-box-text">Stop Atual</span>
                <span class="info-box-number">{{ $operation->currentstop }}</span>
              </div>
            </div>
      @else
            <div
        @if (($operation->realexit >= $operation->realentry && $operation->buyorsell == 'C') || ($operation->realexit <= $operation->realentry && $operation->buyorsell == 'V'))
              class="info-box bg-green"
        @else
              class="info-box bg-red"
        @endif
            >
                <span class="info-box-icon">
                  <i class="fa fa-money"></i>
                </span>
              <div class="info-box-content">
                <span class="info-box-text">Saída {{ getBRDateFromMysql($operation->exitdate) }}</span>
                <span class="info-box-number">{{ $operation->realexit }}</span>
                <span class="info-box-text">{{ $operation->operationReturn() }}% / {{ $operation->capitalReturn() }}%</span>
              </div>
            </div>
      @endif

    </div>

  </div>
</div><!-- registro da operação -->
