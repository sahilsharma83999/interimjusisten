@extends('layouts.public')

@section('content')
	<form method="POST" action="/password/email">
	    {!! csrf_field() !!}
	    <div class="row">
	    	<div class="col-lg-6 col-lg-offset-3">
	    	<h2>Passwort zurücksetzen</h2>
	    	</div>
			<div class="col-lg-6 col-lg-offset-3 well">
				<div class="form-group">
				    <label for="email">E-Mail-Adresse:</label>
				    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
				</div>

				<div class="form-group">
				    <button type="submit" class="btn btn-primary btn-block">
				        Sende einen Link um mein Passwort zurückzusetzen
				    </button>
				</div>
			</div>
		</div>
	</form>
@stop