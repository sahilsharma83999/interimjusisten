@extends('admin.layout.default')

@section('content')
	<div class="col-lg-8 col-lg-offset-2">
		<h1>Stellenangebot</h1>
		<hr>
		<form action="{{ route('store-job-offering',['id' => @$offering->id]) }}" method="POST" accept-charset="utf-8" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<div class="form-group">
				<label for="name">Stellenbezeichnung:</label>
				<input type="text" name="name" id="name" class="form-control" value="{{ @$offering->name }}">
			</div>
			<div class="form-group">
				<label for="location">Standort:</label>
				<input type="text" name="location" id="location" class="form-control" value="{{ @$offering->location }}">
			</div>
			<div class="form-group">
				<label for="immersion">Vertiefung:</label>
				<input type="text" name="immersion" id="immersion" class="form-control" value="{{ @$offering->immersion }}">
			</div>
			<div class="form-group">
				<label for="organisation">Organisation:</label>
				<input type="text" name="organisation" id="organisation" class="form-control" value="{{ @$offering->organisation }}">
			</div>
			<div class="form-group">
				<label for="type">Typ:</label>
				<select name="type" id="type" class="form-control">
					<option value="intrim"
					@if(@$offering->type === "interim")
						selected
					@endif
					>Interim</option>
					<option value="permanent"
					@if(@$offering->type === "permanent")
						selected
					@endif
					>Permanent</option>
				</select>
			</div>
			<div class="form-group">
				<label for="minimal_requirement">min. Berufserfahrung:</label>
				<select name="minimal_requirement" class="form-control">
					@foreach(range(1,10) as $year)
						<option value="{{$year}}"
						@if($year == @$offering->minimal_requirement)
							selected
						@endif
						>{{$year}} Jahre</option>
					@endforeach
				</select>
			</div>
			<div class="form-group">
				<label for="logo_path">Firmenlogo:</label>
				<input type="file" name="logo_path">
			</div>
			<div class="form-group">
				<label for="description">Beschreibung:</label>
				<textarea name="description" role="wysiwyg" id="description" class="form-control" style="height:150px">
					{{ @$offering->description }}
				</textarea>
			</div>
			<div class="form-group">
				<input type="submit" value="Speichern" class="btn btn-lg btn-primary">
			</div>
		</form>
	</div>
@stop