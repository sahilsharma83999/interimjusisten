@extends('layouts.public')

@section('content')
	<form action="{{ url('account/schwerpunkte') }}"  id="schwerpunkte-view" method="POST" accept-charset="utf-8">
		{!! csrf_field() !!}

		<h1>Berufliche Schwerpunkte <small>Schritt 7 von 8</small></h1>

		<hr>

		<h3>Wählen Sie 5 Kernkompetenzen aus</h3>

		<div class="well">
			Gewichten Sie Ihre Kompetenzfelder:<br>
			Platz 1 = Hauptkompetenz, Platz 2 = zweitgrößte Komptenz u.s.w.<br>
			Bitte geben Sie Ihre speziellen Kenntnisse an und ordnen Sie der zutreffenden Erfahrungsstufe zu:
		</div>

		<div class="row well">
			<div class="col-lg-4">
				<select
					name="kompetenz[first][level1]"
					id="first"
					class="form-control"
					v-model="kompetenz.first.level1.selected"
					options="kompetenz.first.level1.options">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[first][level2]"
					id="first2"
					class="form-control"
					v-model="kompetenz.first.level2.selected"
					options="kompetenz.first.level2.options"
					v-attr="disabled:kompetenz.first.level2.options.length === 0">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[first][level3]"
					id="first3"
					class="form-control"
					v-model="kompetenz.first.level3.selected"
					options="kompetenz.first.level3.options"
					v-attr="disabled:kompetenz.first.level3.options.length === 0">
				</select>
			</div>
		</div>

		<div class="row well">
			<div class="col-lg-4">
				<select
					name="kompetenz[second][level1]"
					id="second"
					class="form-control"
					v-model="kompetenz.second.level1.selected"
					options="kompetenz.second.level1.options">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[second][level2]"
					id="second2"
					class="form-control"
					v-model="kompetenz.second.level2.selected"
					options="kompetenz.second.level2.options"
					v-attr="disabled:kompetenz.second.level2.options.length === 0">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[second][level3]"
					id="second3"
					class="form-control"
					v-model="kompetenz.second.level3.selected"
					options="kompetenz.second.level3.options"
					v-attr="disabled:kompetenz.second.level3.options.length === 0">
				</select>
			</div>
		</div>

		<div class="row well">
			<div class="col-lg-4">
				<select
					name="kompetenz[third][level1]"
					id="third"
					class="form-control"
					v-model="kompetenz.third.level1.selected"
					options="kompetenz.third.level1.options">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[third][level2]"
					id="third2"
					class="form-control"
					v-model="kompetenz.third.level2.selected"
					options="kompetenz.third.level2.options"
					v-attr="disabled:kompetenz.third.level2.options.length === 0">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[third][level3]"
					id="third3"
					class="form-control"
					v-model="kompetenz.third.level3.selected"
					options="kompetenz.third.level3.options"
					v-attr="disabled:kompetenz.third.level3.options.length === 0">
				</select>
			</div>
		</div>

		<div class="row well">
			<div class="col-lg-4">
				<select
					name="kompetenz[fourth][level1]"
					id="fourth"
					class="form-control"
					v-model="kompetenz.fourth.level1.selected"
					options="kompetenz.fourth.level1.options">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[fourth][level2]"
					id="fourth2"
					class="form-control"
					v-model="kompetenz.fourth.level2.selected"
					options="kompetenz.fourth.level2.options"
					v-attr="disabled:kompetenz.fourth.level2.options.length === 0">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[fourth][level3]"
					id="fourth3"
					class="form-control"
					v-model="kompetenz.fourth.level3.selected"
					options="kompetenz.fourth.level3.options"
					v-attr="disabled:kompetenz.fourth.level3.options.length === 0">
				</select>
			</div>
		</div>

		<div class="row well">
			<div class="col-lg-4">
				<select
					name="kompetenz[fifth][level1]"
					id="fifth"
					class="form-control"
					v-model="kompetenz.fifth.level1.selected"
					options="kompetenz.fifth.level1.options">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[fifth][level2]"
					id="fifth2"
					class="form-control"
					v-model="kompetenz.fifth.level2.selected"
					options="kompetenz.fifth.level2.options"
					v-attr="disabled:kompetenz.fifth.level2.options.length === 0">
				</select>
			</div>
			<div class="col-lg-4">
				<select
					name="kompetenz[fifth][level3]"
					id="fifth3"
					class="form-control"
					v-model="kompetenz.fifth.level3.selected"
					options="kompetenz.fifth.level3.options"
					v-attr="disabled:kompetenz.fifth.level3.options.length === 0">
				</select>
			</div>
		</div>

		<hr>
		<h3>Wählen Sie 3 Bereiche aus, in dem das Unternehmen Ihr Headquarter hat.</h3>
		<div class="form-group row">
			<div class="col-lg-4">
				<select name="schwerpunkt[0]" id="" class="form-control" required>
					@foreach(App\Data\Schwerpunkte::get() as $key => $value)
						<option value="{{$key}}"
							@if(App\Models\Schwerpunkte::stripSelected($key,0))
								selected
							@endif
						>{{$value}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-4">
				<select name="schwerpunkt[1]" id="" class="form-control" required>
					@foreach(App\Data\Schwerpunkte::get() as $key => $value)
						<option value="{{$key}}"
							@if(App\Models\Schwerpunkte::stripSelected($key,1))
								selected
							@endif
						>{{$value}}</option>
					@endforeach
				</select>
			</div>
			<div class="col-lg-4">
				<select name="schwerpunkt[2]" id="" class="form-control" required>
					@foreach(App\Data\Schwerpunkte::get() as $key => $value)
						<option value="{{$key}}"
							@if(App\Models\Schwerpunkte::stripSelected($key,2))
								selected
							@endif
						>{{$value}}</option>
					@endforeach
				</select>
			</div>
		</div>

		<hr>

		<h3>Berufsverhältnis gewünscht als</h3>
		<div class="form-group row">
			<div class="col-lg-4">
				<div class="input-group" v-class="has-success : festanstellung">
					<span class="input-group-addon">
						<input type="checkbox" name="festanstellung" id="festanstellung" v-model="festanstellung"
							@if(Auth::user()->festanstellung)
								checked
							@endif
						>
					</span>
					<div class="form-control">
						Festanstellung
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="input-group" v-class="has-success : interimManger">
					<span class="input-group-addon">
						<input type="checkbox" name="interimManger" id="interimManger" v-model="interimManger"
							@if(Auth::user()->interimManger)
								checked
							@endif
						>
					</span>
					<div class="form-control">
						Interim Jurist
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="input-group" v-class="has-success : managementBuyIn">
					<span class="input-group-addon">
						<input type="checkbox" name="managementBuyIn" id="managementBuyIn" v-model="managementBuyIn"
							@if(Auth::user()->managementBuyIn)
								checked
							@endif
						>
					</span>
					<div class="form-control">
						Management Buy In
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<input type="submit" value="Speichern" class="btn btn-lg btn-primary">
		</div>
	</form>
@endsection