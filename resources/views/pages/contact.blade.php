@extends('layouts.public')

@section('content')
	<form action="{{url('kontakt') }}" method="POST" accept-charset="utf-8">
		{!! csrf_field() !!}
		<div class="row">
			<div class="col-lg-6 col-lg-offset-3">
				<h1>Kontakt</h1>
				<div class="well">
					<div class="form-group">
						<label for="email">E-Mail-Adresse:</label>
						<input type="text" name="email" id="email" class="form-control" placeholder="E-Mail-Adresse" value="{{ old('email') }}">
					</div>
					<div class="form-group">
						<label for="contact_name">Name:</label>
						<input type="text" name="contact_name" id="contact_name" class="form-control" placeholder="Name" value="{{ old('contact_name') }}">
					</div>
					<div class="form-group">
						<label for="phone">Rückrufnummer:</label>
						<input type="text" name="phone" id="phone" class="form-control" placeholder="Rückrufnummer" value="{{ old('phone') }}">
					</div>
					<div class="form-group">
						<label for="contact_msg">Nachricht:</label>
						<textarea name="contact_msg" id="contact_msg" rows="10" class="form-control">{{ old('contact_msg') }}</textarea>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary btn-block" value="Senden">
					</div>
				</div>
			</div>
		</div>
	</form>
@stop