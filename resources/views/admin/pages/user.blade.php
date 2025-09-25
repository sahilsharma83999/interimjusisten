@extends('layouts.public')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<h2>{{$user->email}} <small>{{$user->email2}}</small></h2>
			<div class="row">
				<div class="col-md-6">
					<h3>Persönliches</h3>
					{{$user->title_gender}} {{$user->title_graduation}} {{$user->forename}} {{$user->surname}} <br>
					{{$user->birthdate}} <br>
					{{$user->street}} {{$user->house_number}} <br>
					{{$user->city}} {{$user->zipcode}} <br>
					{{$user->country}} <br>
					<br>
					Mobil: {{$user->mobil}} <br>
					Privat: {{$user->phone_private}} <br>
					Geschäftlich: {{$user->phone_comercial}} <br>
					Fax: {{$user->fax}} <br>
					Url: {{$user->homepage}} <br>
				</div>
				<div class="col-md-6">
					<h4>Selbsteinschätzung</h4> {{$user->self_evaluation}}
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<h3>Auslandsprojekte</h3>
					@forelse($user->auslandsProjekte as $projekt)
						<div class="row">
							<div class="col-md-12">
								<div class="well">
									{{$projekt->from->format('d.m.Y')}} - {{$projekt->to->format('d.m.Y')}} <br>
									Branche: <span class="bold">{{App\Data\Branche::keyToValue($projekt->branche)}}</span> <br>
									{{$projekt->description}}
								</div>
							</div>
						</div>
					@empty
						Keine Auslandsprojekte
					@endforelse
				</div>
				<div class="col-md-6">
					<h3>Mandate</h3>
					@forelse($user->mandate as $mandat)
						<div class="row">
							<div class="col-md-12">
								<div class="well">
									{{$mandat->from->format('d.m.Y')}} - {{$mandat->to->format('d.m.Y')}} <br>
									Branche: <span class="bold">{{App\Data\Branche::keyToValue($mandat->branche)}}</span><br>
									<div class="row">
										<div class="col-md-6">
											Umsatz: {{$mandat->umsatz}} <br>
											Budget - Verantwortung: {{$mandat->budget}}
										</div>
										<div class="col-md-6">
											Anzahl MA: {{$mandat->ma}} <br>
											Mitarbeiterverantwortung: {{$mandat->worker}}
										</div>
									</div>
									{{$mandat->description}}
								</div>
							</div>
						</div>
					@empty
						Keine Mandate
					@endforelse
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<h3>Ausbildung</h3>
					@forelse($user->karriere as $karriere)
						@if($karriere->type == "ausbildung")
							<div class="row">
								<div class="col-md-12">
									<div class="well">
										{{$karriere->from->format('d.m.Y')}} - {{$karriere->to->format('d.m.Y')}} <br>
										Ausbildung nach § 4a FAO: <span class="bold"> {{App\Data\Fachrichtung::keyToValueAusbildung($karriere->fachrichtung)}}</span><br>
										Spezialisierung: <span class="bold">{{App\Data\Fachrichtung::keyToValueSpezialisierung($karriere->spezialisierung)}}</span> <br>
										{{$karriere->description}}
									</div>
								</div>
							</div>
						@endif
					@empty
						Keine Ausbildung vorhanden
					@endforelse
				</div>
				<div class="col-md-6">
					<h3>Karriere</h3>
					@forelse($user->karriere as $karriere)
						@if($karriere->type == "karriere")
							<div class="row">
								<div class="col-md-12">
									<div class="well">
										{{$karriere->from->format('d.m.Y')}} - {{$karriere->to->format('d.m.Y')}} <br>
										Fachrichtung: <span class="bold"> {{App\Data\Fachrichtung::keyToValueAusbildung($karriere->fachrichtung)}}</span> <br>
										{{$karriere->description}}
									</div>
								</div>
							</div>
						@endif
					@empty
						Keine Ausbildung vorhanden
					@endforelse
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-6">
					<h3>Interessen</h3>
					@forelse($user->skills as $skill)
						<div class="well">
							{{App\Data\Interessen::keyToValue($skill->skill)}}
						</div>
					@empty
						Keine Interessen
					@endforelse
				</div>
				<div class="col-md-6">
					<h3>Schwerpunkte</h3>
					@forelse($user->kompetenz as $kompetenz)
						<div class="btn btn-info active" style="cursor:default;">
							{{App\Data\KernKompetenz::keyToName($kompetenz->key)}}
						</div>
					@empty
						Keine Schwerpunkte angegeben
					@endforelse
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-md-12">
					<h3>Verantwortungen</h3>
					<div class="well">
						@forelse($user->verantwortung as $verantwortung)
							{{ucfirst($verantwortung->type)}}:
							@if($verantwortung->type == 'personal')
								{{App\Data\Verantwortung::keyToValuePersonalPeriod($verantwortung->period)}} |
								{{App\Data\Verantwortung::keyToValuePersonalAmount($verantwortung->amount)}}
							@endif
							@if($verantwortung->type == 'umsatz')
								{{App\Data\Verantwortung::keyToValueUmsatzPeriod($verantwortung->period)}} |
								{{App\Data\Verantwortung::keyToValueUmsatzAmount($verantwortung->amount)}}
							@endif
							@if($verantwortung->type == 'budget')
								{{App\Data\Verantwortung::keyToValueBudgetPeriod($verantwortung->period)}} |
								{{App\Data\Verantwortung::keyToValueBudgetAmount($verantwortung->amount)}}
							@endif
							@if($verantwortung->type == 'einkauf')
								{{App\Data\Verantwortung::keyToValueEinkaufPeriod($verantwortung->period)}} |
								{{App\Data\Verantwortung::keyToValueEinkaufAmount($verantwortung->amount)}}
							@endif
							<br>
						@empty
							Keine Verantwortungen angegeben
						@endforelse
					</div>
				</div>
			</div>
		</div>
	</div>
@stop