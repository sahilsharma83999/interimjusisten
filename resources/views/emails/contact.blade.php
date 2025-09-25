@extends('layouts.email')

@section('content')
	<h2>Kontaktanfrage von {{url('/')}}</h2>
	<p>
		E-Mail: {{ $data["email"] }} <br>
		Name: {{ $data["contact_name"] }} <br>
 		Rückrufnummer: {{  $data["phone"] }} <br>
		Nachricht: <br><br>
		{{ $data["contact_msg"] }}
	</p>
@stop