@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset('/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')

<div class="row">
  <div class="col-md-12">

    <div class="box box-primary">

      <form class="form-horizontal pad"
          action="{{ url('/report'.(isset($report->id)?'/'.$report->id:'')) }}"
          method="POST" enctype="multipart/form-data">

      {{ csrf_field() }}

      @if (isset($report))
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" value="{{ $report->origin_url }}" name="origin_url" >
      @else
        <input type="hidden" value="{{ URL::previous() }}" name="origin_url" >
        <div class="form-group">
          <div class="col-sm-3">
          </div>
          <div class="col-sm-9">
            <p class="text-muted">
              As informações com asterisco (*) são obrigatórias.<br>
              Você será informado sobre o resultado da denúncia assim que a análise for concluída.<br>
              Para que a situação seja solucionada da melhor forma é importante que a descrição seja a mais detalhada possível.
            </p>
          </div>
        </div>
      @endif

        <div class="form-group">
          <label for="reported_id" class="col-sm-3 control-label">Denunciado</label>

          <div class="col-sm-9">
            @if ($reported->profile==Null)
            <strong >{{ $reported->name }}</strong>
            @else
            {!! getUserLine($reported) !!}
            @endif
            {!! nbsp(4).getUserAdminIcons($reported,False).nbsp(4) !!}
            <small class="text-muted">{{ getTotalOpenDenounces($reported).' denúncia(s) aberta(s)' }}</small>
            <input type="hidden" value="{{ $reported->id }}" name="reported_id" >
          </div>
        </div>

        <div class="form-group">
          <label for="indicators" class="col-sm-3 control-label">Motivo *</label>

          <div class="col-sm-9">
            @if (isset($report))
              <strong>{{ getReportReason($report->reason) }}</strong>
            @else
            <select id="reason" name="reason" class="form-control">
                <option value=""> -- Escolha um motivo:</option>
              @for ($i = 1; $i < 10; $i++)
                <option value="{{ $i }}" {{ ($i==(old('reason',isset($report->reason)?$report->reason:''))?'selected':'') }}>{{ getReportReason($i) }}</option>
              @endfor
            </select>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label for="description" class="col-sm-3 control-label">Descrição *</label>

          <div class="col-sm-9">
            @if (isset($report))
              <p class="text-justify">{{ $report->description }}</p>
            @else
            <textarea class="form-control" rows="6" name="description" id="description" >{{ old('description',(isset($report->description)?$report->description:'')) }}</textarea>
            @endif
          </div>
        </div>

        <div class="form-group">
          <label for="link" class="col-sm-3 control-label">Link da Ocorrência</label>

          <div class="col-sm-9">
             @if (isset($report))
             <a href="{{ $report->link }}" target="_blank">{{ $report->link }}</a>
             @else
             <input type="url" value="{{ old('link',isset($report->link)?$report->link:'') }}" name="link"
             class="form-control" id="link" maxlength="255" placeholder="Inclua o link/url da página onde ocorreu o fato">
             <br>
             <div class="text-muted">Caso o fato que gerou a denúncia tenha ocorrido em uma página diferente desta abaixo, copie e cole o endereço completo no campo Link da Ocorrência.</div>
             <div class="text-muted">Origem da denúncia: <a href="{{ URL::previous() }}" target="_blank">{{ URL::previous() }}</a></div>
             @endif
          </div>
        </div>


@if (isset($report))

        <div class="form-group">
          <label for="reported_id" class="col-sm-3 control-label">Denunciante</label>

          <div class="col-sm-9">
            @if ($report->user->profile==Null)
            <strong >{{ $report->user->name }}</strong>
            @else
            {!! getUserLine($report->user).nbsp(4).getReportUserIcon($report->user) !!}
            @endif
          </div>
        </div>

        <div class="form-group">
          <label for="reported_id" class="col-sm-3 control-label">Origem da Denúncia</label>

          <div class="col-sm-9">
            <a href="{{ $report->origin_url }}" target="_blank">{{ $report->origin_url }}</a>
          </div>
        </div>

        <div class="form-group">
          <label for="finished" class="col-sm-3 control-label">Encerrada</label>

          <div class="col-sm-9">
            <div class="checkbox">
              <label for="finished">
                <input type="checkbox" name="finished" value="1" {{ ($report->finished?(isSuperAdmin()?'CHECKED':'CHECKED DISABLED'):'') }}>
                <span class="text-muted">Administrador, marque esta opção para encerrar a denúncia!</span>
              </label>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="resolution" class="col-sm-3 control-label">Conclusão da Denúncia</label>

          <div class="col-sm-9">
            @if ($report->finished && isNotSuperAdmin())
              <strong>{{ $report->resolution }}</strong>
            @else
              <input type="text" value="{{ old('resolution',isset($report->resolution)?$report->resolution:Null) }}" name="resolution"
              class="form-control" id="resolution" maxlength="255">
            @endif
          </div>
        </div>

@endif

        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-primary">{{ (isset($report->id)?'Salvar':'Enviar') }} </button>
          </div>
        </div>
      </form>


      <br />
    </div>

  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
