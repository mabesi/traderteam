@extends('emails.model')

@section('content')

<h3>{{ $title }}</h3>

<div>
    {!! $content !!}
</div>

@endsection
