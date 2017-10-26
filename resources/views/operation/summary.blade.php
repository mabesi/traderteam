@extends('layouts.panel')

@push('css')
  <link rel="stylesheet" href="{{ asset('/adminlte2/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush

@section('content')

<div class="row">

  <div class="col-md-5 col-lg-4">

    <div class="box">

      <div class="box-header">
        @include('operation.lineview')
      </div>

      <div class="box-body top-10">

        @include('operation.summary.info')

        <div class="row top-20">
          <div class="col-lg-12">
            @include('operation.summary.prevision')
          </div>
          <div class="col-lg-12">
            @include('operation.summary.register')
          </div>
        </div>

      </div>
    </div>
  </div> <!-- fim col -->

  <div class="col-md-7 col-lg-8">
    @include('operation.summary.postanalysis')
    @include('operation.summary.preanalysis')
  </div> <!-- fim col -->

</div><!-- fim row -->
<div class="row">
  <div class="col-lg-12">
    @include('operation.comments')
  </div>
</div>

@include('layouts.imagemodal')
@endsection

@push('scripts')
<script src="{{ asset("/js/img-helper.js") }}"></script>
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
