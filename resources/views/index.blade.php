@extends('layouts.panel')

@push('css')
@endpush

@section('content')

Vc está logado e na index... <br>
Usuário: {{ Auth::user() }}

@endsection

@push('scripts')
@endpush
