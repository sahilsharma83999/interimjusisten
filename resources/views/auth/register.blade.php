@extends('layouts.public')

@section('content')
	<div class="col-lg-6 col-lg-offset-3">
		<h1>Registrieren</h1>
		<div class="well">
			<form action="{{url('auth/register')}}" method="POST" accept-charset="utf-8">
				{!! csrf_field() !!}

				<div class="form-group">
					<label for="email">E-Mail-Adresse:</label>
					<input type="text" name="email" id="email" class="form-control">
				</div>

				<div class="form-group">
					<label for="password">Passwort:</label>
					<input type="password" name="password" id="password" class="form-control">
				</div>

				<div class="form-group">
					<label for="password_confirmation">Passwort wiederholen:</label>
					<input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
				</div>

				<div class="form-group">
					<div class="g-recaptcha" data-sitekey="{{ Config::get('services.recaptcha.public') }}"></div>
				</div>

				<div class="form-group">
					<input type="submit" value="Register" id="register" class="btn-block btn btn-primary">
				</div>

			</form>
		</div>
	</div>
	<div class="clear"></div>
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1 well">
			<h4>Warum sollte ich mich registrieren?</h4>
			<p>
				Die Registrierung umfasst mehrere Fragen, die sich auf Ihre Ausbildung, Spezialisierung (Mandate), etc. beziehen. Ihre Antworten dienen uns, Sie besser für Interim Mandate vorzustellen.
				So können wir Sie Ihren speziellen Fähigkeiten entsprechend, mit den Anforderungen der Mandanten matchen.
				Je genauer und vollständig, desto seltener belästigen wir Sie mit nicht passenden Anfragen.
			</p>
			<p>
				Im Anschluss des Fragenteils können Sie Ihre Dokumente als Word oder .pdf-Datei hochladen. Sie entscheiden, welche Dokumente wir erhalten, wir benötigen die  Zulassung als Jurist, Weiterbildungsbescheinigung, Sprachzertifikate, etc. Wir nennen dies „Qualität“.
				Sollten Sie in weiteren Ländern / Gerichten zugelassen sein, so bitten wir Sie, die relevanten Dokumente hochzuladen.
			</p>
			<p>
				Sie können die Dokumente einscannen oder mit einem Smartphone fotografieren und im Anschluss hochladen.
			</p>
			<p>
				Zeitaufwand - Fragen: ca. 20 min
			</p>
			<p>
				Nach der erfolgreichen Registrierung werden wir den persönlichen Kontakt zu Ihnen aufnehmen.
				Bei passenden Anfragen können wir Sie mit den hinterlegten Daten direkt ansprechen.
				Sie können jederzeit mit Ihren Login-Daten Ihr Profil ergänzen, löschen oder weitere Dokumente hochladen.
			</p>
			<p>
				<h4>Unsere Vorgehensweise:</h4>
				<ol>
					<li>Beantwortung der Fragen &amp; hochladen der Dokumente</li>
					<li>Überprüfung auf Vollständigkeit</li>
					<li>Matching mit Interim Mandats Anfragen</li>
					<li>Kurzvorstellung des Interim Mandats bei Ihnen. Klärung ob das Mandat Ihren Vorstellungen entspricht.</li>
					<li>Bei positiver Entscheidung stellen wir Ihr Profil beim Mandanten vor.</li>
					<li>Bei positiver Rückmeldung seitens des Mandanten, wird ein persönliches Gespräch folgen.</li>
				</ol>
			</p>
		</div>
	</div>
@stop

@section('pagescripts')
	<script src='https://www.google.com/recaptcha/api.js?hl=de'></script>
@stop
