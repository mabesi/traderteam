@extends('layouts.panel')

@section('content')

  <div class="box box-primary">
    <div class="box-header with-border">

      <h3 class="no-padding no-margin" >

        {{ $configuration->name }}

        <span class="pull-right">
          {!! getItemAdminIcons($configuration,'configuration','True') !!}
        </span>

      </h3>
    </div>

    <div class="box-body">
      <div class="configuration-value font-16 text-bold">
        {{ $configuration->value }}
      </div>
      <div id='configuration-description'>{!! $configuration->content !!}</div>
    </div>

  </div>

@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
