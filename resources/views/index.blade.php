@extends('layouts.panel')

@push('css')
@endpush

@section('content')

@include('layouts.tv-ticker')

Vc está logado e na index... <br>
Usuário: {{ Auth::user() }} <br><br>

Membro a: {{ humanPastTime(Auth::user()->created_at) }} <br />


@endsection

@push('scripts')
@endpush
