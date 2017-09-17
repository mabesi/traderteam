@extends('layouts.panel')

@section('content')

  <div class="box box-primary">
    <div class="box-header with-border">

      <h3 class="no-padding no-margin" >

        @if ($notice->onlyadmin)
        <i class="fa fa-exclamation-circle text-danger" title="Somente para Administradores"></i>
        @endif

        {{ $notice->title }}

        <span class="pull-right">
          {!! getItemAdminIcons($notice,'notice','True') !!}
        </span>

      </h3>
    </div>

    <div class="box-body">
      <div id='indicator-description' class="text-justify">{!! $notice->content !!}</div>
    </div>

  </div>

@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
