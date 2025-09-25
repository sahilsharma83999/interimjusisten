<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Interim Juristen</title>
	@vite(['resources/css/app.css', 'resources/js/app.js'])
	<link rel="stylesheet" href="{{ asset('css/all.css') }}">


	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
	<div class="site-wrapper">
		@unless(isset($_COOKIE['accepted_cookies']))
			<button class="btn btn-sm btn-block btn-cookie" id="cookie-agreement">
				interim-jurist.de verwendet Cookies, um Ihnen den bestmöglichen Service zu gewährleisten. Wenn Sie auf der Seite weitersurfen stimmen Sie der Cookie-Nutzung zu. <i class="fa fa-times"></i>
			</button>
		@endunless
		@include('partials.header')

			<div class="content-wrapper 
			@if(isset($scretchContainerFullWidth))
				container-fluid
			@else
				container
			@endif
			">
				@if(Session::has('infoMsg'))
					<div class="alert alert-info">
						{{ Session::get('infoMsg') }}
					</div>
				@endif

				@if ($errors->any() OR (Auth::check() AND !Auth::user()->aktiv) )
				    <div class="alert alert-danger">
				        <ul>
				            @foreach ($errors->all() as $error)
				                <li>{{ $error }}</li>
				            @endforeach
				            @if(Auth::check() AND !Auth::user()->aktiv)
								<li>Ihre E-Mail-Adresse ist noch nicht bestätigt. Sie können erst nach der Bestätigung Ihre Einstellungen vornehmen.</li>
				            @endif
				        </ul>
				    </div>
				@endif

				@yield('content')

				@if(Auth::guest())
					<div class="home-bottom-call-out text-center">
						Sie sind Rechtsanwalt und sind als Interim Jurist tätig? Sie wollen als Interim Jurist tätig werden? <a href="{{ url('auth/register') }}">Registrieren</a> Sie sich auf unserer Seite.
					</div>
				@endif

			</div>
			<div class="content-wrapper-footer-spacer"></div>
			{{-- <div class="clear"></div> --}}

		@include('partials.footer')

	</div>
	@yield('pagescripts')
</body>
</html>