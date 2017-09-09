@extends('layouts.panel')

@section('content')

  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary pad">
        <div class="boxbody top-10">
          @foreach ($notices as $notice)
            @if (isAdmin() || !$notice->onlyadmin)
              <div class="post no-padding">

                    <h4 class="no-margin">
                      @if ($notice->onlyadmin)
                      <i class="fa fa-exclamation-circle text-danger" title="Somente para Administradores"></i>
                      @endif
                      <a href="{{ url('notice/'.$notice->id) }}">
                        {{ $notice->title }}
                      </a>
                      <small class="font-12">{{ humanPastTime($notice->updated_at) }}</small>

                      <span class="pull-right font-16">
                        {!! getItemAdminIcons($notice,'notice','False') !!}
                      </span>
                    </h4>

                    <p>{!! (strlen($notice->content)>150?substr($notice->content, 0, 150).'...':$notice->content) !!}</p>

              </div>
            @endif
          @endforeach
        </div>

        <div class="box-footer">
          {{ $notices->links() }}
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
