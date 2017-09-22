@extends('layouts.panel')

@section('content')

  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary pad">
        <div class="boxbody top-10">
          @foreach ($configurations as $configuration)
              <div class="post no-padding">

                    <h4 class="no-margin">
                      <a href="{{ url('configuration/'.$configuration->id) }}">
                        {{ $configuration->name }}
                      </a>

                      @if ($configuration->value!=Null)
                      {{ nbsp(2) }}
                      <span>{{ $configuration->value }}</span>
                      {{ nbsp(2) }}
                      @endif

                      <small class="font-12">{{ humanPastTime($configuration->updated_at) }}</small>

                      <span class="pull-right font-16">
                        {!! getItemAdminIcons($configuration,'configuration','False') !!}
                      </span>
                    </h4>

                    <p>
                    @if ($configuration->content!=Null)
                      {!! (strlen($configuration->content)>150?substr($configuration->content, 0, 150).'...':$configuration->content) !!}
                    @endif
                    </p>

              </div>
          @endforeach
        </div>

        <div class="box-footer">
          {{ $configurations->links() }}
        </div>

      </div>

    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
@endsection

@push('scripts')
<script src="{{ asset("/js/form-helper.js") }}"></script>
@endpush
