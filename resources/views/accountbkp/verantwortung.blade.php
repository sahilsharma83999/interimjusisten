@inject('vData','App\Data\Verantwortung')

@extends('layouts.public')

@section('content')
	<form action="{{ url('account/verantwortung') }}" id="verantwortung-view" method="POST" accept-charset="utf-8">
		{!! csrf_field() !!}
		<h1>Max. Verantwortung in einer Firma <small>Schritt 6 von 8</small></h1>

		<h2 class="button-align-6">
			Personalverantwortung
			<div class="btn btn-success" v-on="click: addRowPersonal">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeRowPersonal">
				<i class="fa fa-minus"></i>
			</div>
		</h2>
		<div v-repeat="p : personal">
			<div class="form-group row">
				<div class="col-lg-4">
					<select name="personal[@{{p.id}}][amount]" id="" v-model="p.amount" class="form-control">
						@foreach($vData::getAmountForPersonal() as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-4">
					<select name="personal[@{{p.id}}][period]" id="" v-model="p.period" class="form-control">
						@foreach($vData::getPeriodForPersonal() as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<hr>

		<h2 class="button-align-6">
			Umsatzverantwortung
			<div class="btn btn-success" v-on="click: addRowUmsatz">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeRowUmsatz">
				<i class="fa fa-minus"></i>
			</div>
		</h2>
		<div v-repeat="u : umsatz">
			<div class="form-group row">
				<div class="col-lg-4">
					<select name="umsatz[@{{u.id}}][amount]" id="" v-model="u.amount" class="form-control" required>
						@foreach($vData::getAmountForUmsatz() as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-4">
					<select name="umsatz[@{{u.id}}][period]" id="" v-model="u.period" class="form-control" required>
						@foreach($vData::getPeriodForUmsatz() as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<hr>

		<h2 class="button-align-6">
			Budgetverantwortung
			<div class="btn btn-success" v-on="click: addRowBudget">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeRowBudget">
				<i class="fa fa-minus"></i>
			</div>
		</h2>
		<div v-repeat="b:budget">
			<div class="form-group row">
				<div class="col-lg-4">
					<select name="budget[@{{b.id}}][amount]" v-model="b.amount" id="" class="form-control">
						@foreach($vData::getAmountForBudget() as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-4">
					<select name="budget[@{{b.id}}][period]" v-model="b.period" id="" class="form-control">
						@foreach($vData::getPeriodForBudget() as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<hr>

		<h2 class="button-align-6">
			Einkaufsverantwortung
			<div class="btn btn-success" v-on="click: addRowEinkauf">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeRowEinkauf">
				<i class="fa fa-minus"></i>
			</div>
		</h2>
		<div v-repeat="e:einkauf">
			<div class="form-group row">
				<div class="col-lg-4">
					<select name="einkauf[@{{e.id}}][amount]" v-model="e.amount" id="" class="form-control">
						@foreach($vData::getAmountForEinkauf() as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-lg-4">
					<select name="einkauf[@{{e.id}}][period]" v-model="e.period" id="" class="form-control">
						@foreach($vData::getPeriodForEinkauf() as $key => $value)
							<option value="{{$key}}">{{$value}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<input type="submit" class="btn btn-lg btn-primary" value="Speichern">
	</form>
@stop