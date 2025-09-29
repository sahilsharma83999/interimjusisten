@extends('layouts.public')

@section('content')
	<form action="{{ url('account/karriere') }}" id="karriere-view" method="POST" accept-charset="utf-8">
		<h1>Werdegang <small>Schritt 4 von 8</small></h1>
		{!! csrf_field() !!}
		<h2>
			Ausbildung
			<div class="btn btn-success" v-on="click: addAusbildungRow">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeAusbildungRow">
				<i class="fa fa-minus"></i>
			</div>
		</h2>
		<div class="" v-repeat="ausbildung : ausbildungen">
			<div class="form-group row">
				<input type="hidden" name="ausbildung[@{{ausbildung.id}}][id]" v-model="ausbildung.id">
				<input type="hidden" name="ausbildung[@{{ausbildung.id}}][type]" value="ausbildung">
				<div class="col-lg-1">
					<label for="fmonth">Monat</label>
					<select name="ausbildung[@{{ausbildung.id}}][fmonth]" id="fmonth" class="form-control" v-model="ausbildung.fmonth">
						@foreach(range(1,12) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-2">
					<label for="fyear">Jahr</label>
					<select name="ausbildung[@{{ausbildung.id}}][fyear]" id="fyear" class="form-control" v-model="ausbildung.fyear">
						@foreach(range(\Carbon\Carbon::now()->year,1900) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-1">
					<label for="tmonth">Monat</label>
					<select name="ausbildung[@{{ausbildung.id}}][tmonth]" id="tmonth" class="form-control" v-model="ausbildung.tmonth">
						@foreach(range(1,12) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-2">
					<label for="tyear">Jahr</label>
					<select name="ausbildung[@{{ausbildung.id}}][tyear]" id="tyear" class="form-control" v-model="ausbildung.tyear">
						@foreach(range(\Carbon\Carbon::now()->year,1900) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-3">
					<label>Ausbildung nach § 4a FAO</label>
					<select name="ausbildung[@{{ausbildung.id}}][fachrichtung]" class="form-control" v-model="ausbildung.fachrichtung" required>
						@foreach(App\Data\Fachrichtung::getAusbildung() as $key => $fach)
							<option value="{{$key}}">{{$fach}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-3">
					<label for="">Beschreibung</label>
					<textarea name="ausbildung[@{{ausbildung.id}}][description]" id="" class="form-control" v-model="ausbildung.description"></textarea>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-lg-6"></div>
				<div class="col-lg-3">
					<label>Spezialisierung</label>
					<select name="ausbildung[@{{ausbildung.id}}][spezialisierung]" class="form-control" v-model="ausbildung.spezialisierung" required>
						@foreach(App\Data\Fachrichtung::getSpezialisierung() as $key => $fach)
							<option value="{{$key}}">{{$fach}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<hr>


		<h2> 
			Karriere
			<div class="btn btn-success" v-on="click: addKarriereRow">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeKarriereRow">
				<i class="fa fa-minus"></i>
			</div>
		</h2>

		<div class="form-group row" v-repeat="karriere : karrieren">
			<input type="hidden" name="karriere[@{{karriere.id}}][id]" v-model="karriere.id">
			<input type="hidden" name="karriere[@{{karriere.id}}][type]" value="karriere">
			<div class="col-lg-1">
				<label for="fmonth">Monat</label>
				<select name="karriere[@{{karriere.id}}][fmonth]" id="fmonth" class="form-control" v-model="karriere.fmonth">
					@foreach(range(1,12) as $value)
						<option value="{{ $value }}">{{ $value }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-2">
				<label for="fyear">Jahr</label>
				<select name="karriere[@{{karriere.id}}][fyear]" id="fyear" class="form-control" v-model="karriere.fyear">
					@foreach(range(\Carbon\Carbon::now()->year,1900) as $value)
						<option value="{{ $value }}">{{ $value }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-1">
				<label for="tmonth">Monat</label>
				<select name="karriere[@{{karriere.id}}][tmonth]" id="tmonth" class="form-control" v-model="karriere.tmonth">
					@foreach(range(1,12) as $value)
						<option value="{{ $value }}">{{ $value }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-2">
				<label for="tyear">Jahr</label>
				<select name="karriere[@{{karriere.id}}][tyear]" id="tyear" class="form-control" v-model="karriere.tyear">
					@foreach(range(\Carbon\Carbon::now()->year,1900) as $value)
						<option value="{{ $value }}">{{ $value }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3">
				<label>Fachrichtung</label>
				<select name="karriere[@{{karriere.id}}][fachrichtung]" class="form-control" v-model="karriere.fachrichtung" required>
					@foreach(App\Data\Fachrichtung::getKarriere() as $key => $fach)
						<option value="{{$key}}">{{$fach}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-3">
				<label for="">Beschreibung</label>
				<textarea name="karriere[@{{karriere.id}}][description]" id="" class="form-control" v-model="karriere.description"></textarea>
			</div>
		</div>

		<div class="form-group">
			<input type="submit" value="Speichern" class="btn btn-lg btn-primary">
		</div>
	</form>
@endsection