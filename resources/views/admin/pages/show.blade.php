@extends('admin.layout.default')

@section('content')
	<h3>Stellenangebot</h3>
	<hr>
	@if($offering->logo_path !== null)
		<div class="pull-right">
			<img src="{{asset($offering->logo_path)}}" class="jobs-logo" alt="">
		</div>
	@endif
	<div class="jobs-name">
		{{$offering->name}}
	</div>
	<div class="jobs-type-location">
		{{ucfirst($offering->type)}}; {{$offering->location}}
	</div>
	<div class="jobs-immersion">
		{{$offering->immersion}}
	</div>
	<div class="jobs-immersion">
		mindestens {{$offering->minimal_requirement}} Jahre Berufserfahrung
	</div>
	<hr>
	<div class="jobs-tasks-text well">
		{!!$offering->description!!}
	</div>
	<div class="jobs-profil">
		Tags
	</div>
	<pre class="jobs-profil-text">{{$offering->immersion}}</pre>
	<div class="jobs-footer">
		Für weitere Informationen steht Ihnen gerne Frau Nicole Schmidt zur Verfügung.<br>
		<span class="bold">MC Interim-Jurist.de</span><br>
		Vischerstr. 4 <br>
		D- 71601 Ludwigsburg<br>
		<a href="mailto:bewerbung@interim-jurist.de">bewerbung@interim-jurist.de</a><br>
		<a href="http://www.interim-jurist.de">www.Interim-Jurist.de</a>
	</div>
@stop