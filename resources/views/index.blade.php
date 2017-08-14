@extends('layouts.panel')

@push('css')
@endpush

@section('content')

Usuário: {{ Auth::user() }} <br><br>
Vc está logado e na index... <br><br>

Membro a: {{ humanPastTime(Auth::user()->created_at) }} <br />


@endsection

@push('scripts')
@endpush
