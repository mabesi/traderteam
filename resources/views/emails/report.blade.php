@extends('emails.model')

@section('content')

<h2>Olá {{ $userName }}</h2>

<p>A denúncia que você fez contra <strong>{{ $reportedName }}</strong> por <strong>{{ $reasonName }}</strong> foi concluída.</p>
<p>A solução adotada pela administração do <strong>TraderTeam</strong> foi a seguinte:</p>
<p></p>
<p style="font-size:14px;font-weight:bold;padding:10px;border:1px solid gray;">{{ $resolution }}</p>
<p></p>
<p>Agradecemos pelo interesse em tornar nossa comunidade mais segura e agradável.</p>

@endsection
