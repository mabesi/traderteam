@extends('layouts.panel')

@section('content')

<div class="row">
  <div class="col-lg-7">

    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="no-padding no-margin" >{{ $strategy->title }}

          @if ($strategy->user_id != getUserId())
            <span class="font-10">
              {{ nbsp(2) }}
              @if ($strategy->user->profile != Null)
                (<a class="user-line" href="{{ url('profile/'.$strategy->user_id) }}">
                  {!! getUserAvatar('img-circle','Avatar',$strategy->user) !!} {{ $strategy->user->name }}
                </a>)
              @else
                (<span class="user-line">
                  {!! getUserAvatar('img-circle','Avatar',$strategy->user) !!} {{ $strategy->user->name }}
                </span>)
              @endif
            </span>
          @endif

          <span class="pull-right">
            {!! getItemAdminIcons($strategy,'strategy','mystrategies') !!}
          </span>

        </h3>
      </div>
      <div class="box-body">

        {!! $strategy->description !!}

      </div>

      <div class="box-footer">

        <div class="row">
          <div class="col-md-6">
            <h4>Total de Operações
              <small class="label bg-blue }} font-16">
                {{ $strategy->operations->count() }}
              </small>
            </h4>
          </div>
          <div class="col-md-6">
            <h4>Resultado da Estratégia
              <small class="label bg-{{ getValueColor($strategy->getResult()) }} font-16">
                {{ formatRealNumber($strategy->getResult(),2) }}%
              </small>
            </h4>
          </div>
        </div>

      </div>

    </div>

  </div>
  <div class="col-lg-5">

    <div class="box box-danger">
      <div class="box-header with-border">
        <h3 class="no-padding no-margin">Indicadores Utilizados</h3>
      </div>
      <div class="box-body">


          @foreach ($strategy->indicators as $indicator)

          <div class="post">
          <a href="{{ url('indicator/'.$indicator->id) }}"><h4>{{ $indicator->name.' ('.$indicator->acronym.')' }}</h4></a>
          <p>Tipo de Indicador: <strong>{{ indicatorType($indicator->type) }}</strong></p>
          <div id='indicator-description'>{!! substr($indicator->description, 0, 150) !!}...</div>
          </div>

          @endforeach


      </div>
      <div class="box-footer">

      </div>
    </div>

  </div>
</div>

@include('layouts.imagemodal')
@endsection

@push('scripts')
<script src="{{ asset("/js/img-helper.js") }}"></script>
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
