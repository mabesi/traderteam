@extends('layouts.panel')

@push('css')
@endpush

@section('content')

Usuário: {{ Auth::user() }} <br><br><br>
Nascido a: {{ Auth::user()->profile->birthdate }} <br /><br />
Membro a: {{ Auth::user()->created_at }} <br /><br /><br /><br /><br />
Vc está logado e na index... <br>
Nascido a: {{ humanPastTime(Auth::user()->profile->birthdate) }} <br /><br />
Membro a: {{ humanPastTime(Auth::user()->created_at) }} <br />


@endsection

@push('scripts')
@endpush
