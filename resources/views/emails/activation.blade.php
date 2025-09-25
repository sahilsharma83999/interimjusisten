@extends('layouts.email')

@section('content')
	<h3>Willkommen zu Interim Juristen,</h3>

	bitte bestätigen Sie über den unten aufgeführten Link ihre E-Mail-Adresse:

	{{ (url('auth/validateEmail').'/'.$user->aktivkey) }}
@stop

