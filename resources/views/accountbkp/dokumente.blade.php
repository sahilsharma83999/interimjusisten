@extends('layouts.public')

@section('content')
	<form action="{{ url('account/dokumente') }}" method="POST" id="dokumente-view" accept-charset="utf-8" enctype="multipart/form-data">
		{!! csrf_field() !!}
		<h1>Dokumente <small>Schritt 8 von 8</small></h1>
		<h2>
			Lebenslauf
		</h2>
			<div class="form-group row">
				<div class="col-lg-3">
					<input name="lebenslauf" type="file" class="form-control">
				</div>
				<div class="col-lg-3">
					@if(isset($lebenslauf))
						Lebenslauf vorhanden: {{$lebenslauf->original_file_name}} vom {{ $lebenslauf->created_at->format('d.m.Y') }}
					@endif
				</div>
			</div>
		<hr>

		<h2 class="button-align-4">
			Qualifikationen
			<div class="btn btn-success" v-on="click: addQualifikationRow">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeQualifikationRow" v-attr="disabled : qualifikation.length === 1">
				<i class="fa fa-minus"></i>
			</div>
		</h2>

			@foreach($qualifikationen as $quali)
				<div class="form-group row">
					<div class="col-lg-5">
						<div class="form-control">
							<a href="{{ url('account/dokumente/delete').'/'.$quali->id }}"><i class="fa fa-times"></i></a>
							{{$quali->original_file_name}} vom {{ $quali->created_at->format('d.m.Y') }}
						</div>
					</div>
				</div>
			@endforeach

			<div v-repeat="qlk : qualifikation">
				<div class="form-group row">
					<div class="col-lg-3">
						<input name="qualifikation[]" type="file" class="form-control">
					</div>
				</div>
			</div>
		<hr>

		<h2 class="button-align-4">
			Auszeichnungen
			<div class="btn btn-success" v-on="click: addAuszeichnungRow">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeAuszeichnungRow" v-attr="disabled : auszeichnung.length === 1">
				<i class="fa fa-minus"></i>
			</div>
		</h2>
			@foreach($auszeichnungen as $ausz)
				<div class="form-group row">
					<div class="col-lg-5">
						<div class="form-control">
							<a href="{{ url('account/dokumente/delete').'/'.$ausz->id }}"><i class="fa fa-times"></i></a>
							{{$ausz->original_file_name}} vom {{ $ausz->created_at->format('d.m.Y') }}
						</div>
					</div>
				</div>
			@endforeach

			<div v-repeat="az : auszeichnung">
				<div class="form-group row">
					<div class="col-lg-3">
						<input name="auszeichnung[]" type="file" class="form-control">
					</div>
				</div>
			</div>
		<hr>

		<h2 class="button-align-4">
			Sonstiges
			<div class="btn btn-success" v-on="click: addSonstigesRow">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeSonstigesRow" v-attr="disabled : sonstiges.length === 1">
				<i class="fa fa-minus"></i>
			</div>
		</h2>

			@foreach($sonstiges as $sonst)
				<div class="form-group row">
					<div class="col-lg-5">
						<div class="form-control">
							<a href="{{ url('account/dokumente/delete').'/'.$sonst->id }}"><i class="fa fa-times"></i></a>
							{{$sonst->original_file_name}} vom {{ $sonst->created_at->format('d.m.Y') }}
						</div>
					</div>
				</div>
			@endforeach

			<div v-repeat="s : sonstiges">
				<div class="form-group row">
					<div class="col-lg-3">
						<input name="sonstiges[]" type="file" class="form-control">
					</div>
				</div>
			</div>
		<hr>

		<div class="form-group">
			<input type="submit" value="Speichern" class="btn btn-lg btn-primary">
		</div>
	</form>

@stop