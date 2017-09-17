@extends('layouts.panel')

@section('content')

  <div class="row">
    <div class="col-md-12">

      <div class="box box-primary pad">
        <div class="boxbody top-10">
          @foreach ($reports as $report)
              <div class="post no-padding">

                    <h4 class="no-margin">

                      {!! getUserLine($report->reportedUser) !!}
                      {{ nbsp(4) }}

                      <a href="{{ url('report/'.$report->id.'/edit') }}">
                        {{ getReportReason($report->reason) }}
                      </a>

                      {{ nbsp(4) }}
                      @if ($report->finished)
                      <span class="text-navy">ENCERRADA</span>
                      @else
                      <span class="text-danger">ABERTA</span>
                      @endif
                      {{ nbsp(2) }}

                      <small class="font-12">{{ humanPastTime($report->updated_at) }}</small>

                      @if (isSuperAdmin())
                      <span class="pull-right font-16">
                        {!! getItemAdminIcons($report,'report','False') !!}
                      </span>
                      @endif
                    </h4>

              </div>
          @endforeach
        </div>

        <div class="box-footer">
          {{ $reports->links() }}
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
