@extends('emails.model')

@section('content')

<h3>Olá  {!! $name !!}. Seja bem vindo ao TraderTeam!</h3>
<p>{!! $content !!}</p>

@endsection
