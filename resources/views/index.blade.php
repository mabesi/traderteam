@extends('layouts.panel')

@push('css')
@endpush

@section('content')

Vc está logado e na index... <br>
Usuário: {{ Auth::user() }} <br><br>

Membro a: {{ humanPastTime(Auth::user()->created_at) }} <br />

Notícias

<div class="pad col-lg-4">
  {!! feedRss('http://www.infomoney.com.br/mercados/rss') !!}
</div>

@endsection

@push('scripts')
@endpush
