@extends('layouts.public')

@section('content')
	<form action="{{ url('account/faehigkeiten') }}" id="faehigkeiten-view" method="POST" accept-charset="utf-8">
		{!! csrf_field() !!}
		<h2>
			Persönliche Eigenschaften und Interessen <small>Schritt 5 von 8</small>
			<div class="btn btn-success" v-on="click: addRow" v-attr="disabled:models.length >= 4">
				<i class="fa fa-plus"></i>
			</div>
			<div class="btn btn-danger" v-on="click: removeRow">
				<i class="fa fa-minus"></i>
			</div> <br>
			<small>Vier Nennungen sind möglich</small>
		</h2>
		<div v-repeat="model : models">
			<div class="form-group row">
				<div class="col-lg-4">
					<select class="form-control" name="skills[]" v-model="model.skill">
						@foreach(App\Data\Interessen::get() as $key => $interesse)
							<option value="{{$key}}">{{$interesse}}</option>
						@endforeach
					</select>
				</div>
			</div>
		</div>
		<hr>
		<h2>Selbsteinschätzung &amp; Dritteinschätzung</h2>
		<div class="form-group">
			<textarea name="self_evaluation" id="self_evaluation" cols="30" rows="10" class="form-control">{{@Auth::user()->self_evaluation}}</textarea>
		</div>

		<input type="submit" class="btn btn-lg btn-primary" value="Speichern">

	</form>
@stop