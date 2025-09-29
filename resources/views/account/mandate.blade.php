@extends('layouts.public')

@section('content')
	<form action="" method="POST" id="mandate-view" accept-charset="utf-8">
		<h1>
			Mandatsübersicht <small>Schritt 3 von 8</small>
			<div class="btn btn-success" v-on="click: addRow">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeRow">
				<i class="fa fa-minus"></i>
			</div>
		</h1>
		{!! csrf_field() !!}
		<div class="mandte" v-repeat="model : models">
			<div class="row">
				<input type="hidden" name="mandate[@{{model.id}}][id]" v-model="model.id">
				<div class="col-lg-1">
					<label for="fmonth">Vom:</label>
					<select name="mandate[@{{model.id}}][fmonth]" id="fmonth" class="form-control" v-model="model.fmonth">
						@foreach(range(1,12) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-2">
					<label for="fyear">Monat - Jahr</label>
					<select name="mandate[@{{model.id}}][fyear]" id="fyear" class="form-control" v-model="model.fyear">
						@foreach(range(\Carbon\Carbon::now()->year,1900) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-1">
					<label for="tmonth">Bis:</label>
					<select name="mandate[@{{model.id}}][tmonth]" id="tmonth" class="form-control" v-model="model.tmonth">
						@foreach(range(1,12) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-2">
					<label for="tyear">Monat - Jahr</label>
					<select name="mandate[@{{model.id}}][tyear]" id="tyear" class="form-control" v-model="model.tyear">
						@foreach(range(\Carbon\Carbon::now()->year,1900) as $value)
							<option value="{{ $value }}">{{ $value }}</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-3">
					<label for="">Branche</label>
					<select name="mandate[@{{model.id}}][branche]" class="form-control" v-model="model.branche" required>
						@foreach(App\Data\Branche::get() as $key => $branche)
							<option value="{{$key}}">{{$branche}}</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-3">
					<label for="">Beschreibung</label>
					<textarea name="mandate[@{{model.id}}][description]" id="" class="form-control">@{{model.description}}</textarea>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-lg-6"></div>
				<div class="col-lg-3">
					<label for="">Umsatz</label>
					<div class="input-group">
						<input type="text" name="mandate[@{{model.id}}][umsatz]" id="" v-model="model.umsatz" class="form-control" placeholder="Umsatz">
						<span class="input-group-addon">€</span>
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-lg-6"></div>
				<div class="col-lg-3">
					<label for="">Anzahl MA</label>
					<input type="text" name="mandate[@{{model.id}}][ma]" id="" v-model="model.ma" class="form-control" placeholder="Anzahl MA">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-lg-6"></div>
				<div class="col-lg-3">
					<label for="">Mitarbeiterverantwortung</label>
					<input type="text" name="mandate[@{{model.id}}][worker]" id="" v-model="model.worker" class="form-control" placeholder="Mitarbeiterverantwortung">
				</div>
			</div>
			<div class="row form-group">
				<div class="col-lg-6"></div>
				<div class="col-lg-3">
					<label for="">Budget - Verantwortung</label>
					<div class="input-group">
						<input type="text" name="mandate[@{{model.id}}][budget]" id="" v-model="model.budget" class="form-control" placeholder="Budget - Verantwortung">
						<span class="input-group-addon">€</span>
					</div>

				</div>
			</div>
			<hr>
		</div>
		<div class="form-group">
			<input type="submit" value="Speichern" class="btn btn-lg btn-primary">
		</div>
	</form>
@endsection