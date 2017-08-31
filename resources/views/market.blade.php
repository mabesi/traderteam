@extends('layouts.panel')

@push('css')
@endpush

@section('content')

<div class="row">
  <div class="col-xs-12">
    @include('layouts.tv-ticker')
  </div>
</div>
<div class="row">
  <div class="col-lg-4">
    @include('layouts.chart.ibov')
  </div>
  <div class="col-lg-4">
    @include('layouts.chart.sp500')
  </div>
  <div class="col-lg-4">
    @include('layouts.chart.dowjones')
  </div>
</div>
<div class="row">
  <div class="col-lg-4">
    @include('layouts.chart.dolar')
  </div>
  <div class="col-lg-4">
    @include('layouts.chart.euro')
  </div>
  <div class="col-lg-4">
    @include('layouts.chart.petroleodolar')
  </div>
</div>
<div class="row">
  <div class="col-lg-4">
    @include('layouts.chart.ourodolar')
  </div>
  <div class="col-lg-4">
    @include('layouts.chart.bitcoindolar')
  </div>
  <div class="col-lg-4">
    @include('layouts.chart.ethereumdolar')
  </div>
</div>

@endsection

@push('scripts')
@endpush
