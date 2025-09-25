@extends('layouts.email')

@section('content')
	<h2>Passwort zurücksetzen</h2>

	<p>
		Klicken Sie auf folgenden Link um Ihr Passwort zurückzusetzen: <br><br>
		<a href="{{ url('password/reset/'.$token) }}">Link</a>
	</p>
	{{ url('password/reset/'.$token) }}
@stop