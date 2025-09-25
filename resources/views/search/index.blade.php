@extends('layouts.public')

@section('content')
	<div class="row">
		<div class="col-lg-8">
			<h1>Suche</h1>
		</div>
		<div class="search-field">
			<div class="form-group">
				<div class="col-lg-1 search-group-label">
					<div class="row">
						<label for="search-group">Gruppe:</label>
					</div>
				</div>
				<div class="col-lg-3">
					<select class="form-control" name="search-field" id="search-field" v-model="searchValue" class="search-group">

						@unless(isset($selected))
							<option selected value="-10"></option>
						@endunless

						@foreach(App\Data\Fachrichtung::getKarriere() as $key => $fach)
							<option value="{{strtolower($fach)}}"
							@if(isset($selected) AND strtolower($fach) === $selected)
								selected
							@endif
							>
								{{$fach}}
							</option>
						@endforeach

					</select>
				</div>
			</div>
		</div>
	</div>
	<hr>
	@if(empty($results))
		<h4 class="center">Wählen Sie eine Gruppe oben rechts, um einen Einblick in die Vorhanden Profil zu erhalten.</h4>
	@else
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Jahre Erfahrung</th>
					<th>Kompetenzen</th>
				</tr>
			</thead>
			<tbody>
				@foreach($results as $result)
					<tr>
						<td>{{$result->id}}</td>
						<td>{{$result->anonymousName()}}</td>
						<td>{{$result->yearsOfKarriere($selected)}}</td>
						<td>
							@forelse($result->kompetenz as $key => $kompetenz)
								@foreach(App\Data\KernKompetenz::keyToNames($kompetenz->key) as $key => $value)
									@if($key !== 'level1')
										{{ '->' }}
									@endif
									{{ $value }}
								@endforeach
								<br>
							@empty
								Keine Angaben vorhanden
							@endforelse
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<div style="text-align:right;">
			Gefunden: {{$results->count()}}
		</div>
	@endif
@stop