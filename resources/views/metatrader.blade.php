@extends('layouts.blank')

@push('css')
<style type="text/css">
.content { box-shadow: 0 0 20px rgba(0,0,0,0.5); position: fixed; width: 100%; top: 4px; bottom: 4px; }
</style>
@endpush

@section('content')

<div class="content">
  <!-- Web Terminal Code Start -->
  <iframe src="https://trade.mql5.com/trade?servers=CLEAR-PRD,CLEAR-DEMO,XPMT5-PRD,XPMT5-DEMO,Rico-Demo,Rico-Metatrader-PROD&amp;startup_mode=open_demo&startup_version=5&amp;lang=pt&amp;save_password=off"
   allowfullscreen="allowfullscreen" style="width: 100%; height: 100%; border: none;"></iframe>
  <!-- Web Terminal Code End -->
</div>

@endsection

@push('scripts')
@endpush
