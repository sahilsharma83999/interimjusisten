@extends('layouts.public')

@section('content')
	<div class="col-lg-6 col-lg-offset-3">
		<h1>Login</h1>
		<div class="well">
			<form action="" method="POST" accept-charset="utf-8">
				{!! csrf_field() !!}

				<div class="form-group">
					<label for="email">E-Mail-Adresse:</label>
					<input type="text" name="email" id="email" class="form-control" placeholder="E-Mail-Adresse">
				</div>

				<div class="form-group">
					<label for="password">Passwort:</label>
					<input type="password" name="password" id="password" class="form-control" placeholder="Passwort">
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-lg-4 pull-right">
							<input type="submit" value="Login" class="btn btn-lg btn-primary pull-right">
						</div>
						<div class="col-lg-6">
							<a href="{{url('password/email')}}">Passwort vergessen?</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="clear"></div>
@stop