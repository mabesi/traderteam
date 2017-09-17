@extends('layouts.panel')

@section('content')

  <div class="box box-primary">
    <div class="box-header with-border">

      <h3 class="no-padding no-margin" >

        {{ $report->name }}

        <span class="pull-right">
          {!! getItemAdminIcons($report,'report','True') !!}
        </span>

      </h3>
    </div>

    <div class="box-body">
      <div class="report-value font-16 text-bold">
        {{ $report->value }}
      </div>
      <div class="top-20" id='report-description'>{!! $report->content !!}</div>
    </div>

  </div>

@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
