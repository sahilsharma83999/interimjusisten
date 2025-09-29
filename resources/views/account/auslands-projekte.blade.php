@extends('layouts.public')

@section('content')
	<form action="{{ url('account/auslands-projekte') }}" id="auslands-projekts-view" method="POST" accept-charset="utf-8">
		<h1>
			Auslandsprojekte <small>Schritt 2 von 8</small>
			<span v-if="has === true">
				<div class="btn btn-success" v-on="click: addRow">
					<i class="fa fa-plus"></i>
				</div>
				<div class="btn btn-danger" v-on="click: removeRow">
					<i class="fa fa-minus"></i>
				</div>
			</span>
		</h1>
		{!! csrf_field() !!}
		<div class="form-group">
			<input type="radio" id="ausland_yes" name="ausland" v-model="has" v-on="click: enable()" value="1"
			@if($user->auslands_projekte)
				checked
			@endif
			>
			<label for="ausland_yes">Ja</label>

			<input type="radio" id="ausland_no" name="ausland" v-on="click : purgeAll" v-model="has" value="0"
			@if(!$user->auslands_projekte)
				checked
			@endif
			>
			<label for="ausland_no">Nein</label>
		</div>

		<div>
			<div class="form-group row" v-repeat="model : models">
				<input type="hidden" name="projects[@{{model.id}}][id]" v-model="model.id">
				<div class="col-lg-1">
					<label for="fmonth">Monat</label>
					<select name="projects[@{{model.id}}][fmonth]" id="fmonth" class="form-control" v-model="model.fmonth">
						@foreach(range(1,12) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-2">
					<label for="fyear">Jahr</label>
					<select name="projects[@{{model.id}}][fyear]" id="fyear" class="form-control" v-model="model.fyear">
						@foreach(range(\Carbon\Carbon::now()->year,1900) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-1">
					<label for="tmonth">Monat</label>
					<select name="projects[@{{model.id}}][tmonth]" id="tmonth" class="form-control" v-model="model.tmonth">
						@foreach(range(1,12) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-2">
					<label for="tyear">Jahr</label>
					<select name="projects[@{{model.id}}][tyear]" id="tyear" class="form-control" v-model="model.tyear">
						@foreach(range(\Carbon\Carbon::now()->year,1900) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-3">
					<label for="">Branche</label>
					<select name="projects[@{{model.id}}][branche]" class="form-control" v-model="model.branche" required>
						@foreach(App\Data\Branche::get() as $key => $branche)
							<option value="{{$key}}">{{$branche}}</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-3">
					<label for="">Beschreibung</label>
					<textarea name="projects[@{{model.id}}][description]" id="" class="form-control">@{{model.description}}</textarea>
				</div>
			</div>
		</div>

		<div class="form-group">
			<input type="submit" class="btn btn-lg btn-primary" value="Speichern">
		</div>
	</form>
@stop