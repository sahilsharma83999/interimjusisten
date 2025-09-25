@extends('admin.layout.default')

@section('content')
	<form action="" method="POST" id="admin-search" accept-charset="utf-8">
    @csrf
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-addon">
										<input type="checkbox" name="festanstellung" id="festanstellung" v-model="searchState.festanstellung">
									</span>
									<div class="form-control">
										Festanstellung
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-addon">
										<input type="checkbox" name="interimManger" id="interimManger" v-model="searchState.interim">
									</span>
									<div class="form-control">
										Interim Jurist
									</div>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="input-group">
									<span class="input-group-addon">
										<input type="checkbox" name="managementBuyIn" id="managementBuyIn" v-model="searchState.buyIn">
									</span>
									<div class="form-control">
										Management Buy In
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<hr>
				<div class="row">
					<div class="col-md-1">
						<h6 class="text-center">
							<div class="btn btn-xs btn-success pull-right" v-on="click:addAuslandRow">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5" v-on="click:removeAuslandRow">
								<i class="fa fa-minus"></i>
							</div>
							Auslands projekte
						</h6>
					</div>
					<div class="col-md-1">
						<h6 class="text-center">
							<div class="btn btn-xs btn-success pull-right" v-on="click: addMandatRow">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5" v-on="click: removeMandatRow">
								<i class="fa fa-minus"></i>
							</div>
							Mandate
						</h6>
					</div>
					<div class="col-md-1">
						<h6 class="text-center">
							Ausbildung
							<div class="btn btn-xs btn-success pull-right" v-on="click: addAusbildungRow">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5" v-on="click: removeAusbildungRow">
								<i class="fa fa-minus"></i>
							</div>
						</h6>
					</div>
					<div class="col-md-1">
						<h6 class="text-center">
							Karriere
							<div class="btn btn-xs btn-success pull-right" v-on="click: addKarriereRow">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5" v-on="click: removeKarriereRow">
								<i class="fa fa-minus"></i>
							</div>
						</h6>
					</div>
					<div class="col-md-1">
						<h6 class="text-center">
							Fähigkeiten
							<div class="btn btn-xs btn-success pull-right" v-on="click:addInteresse">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5" v-on="click:removeInteresse">
								<i class="fa fa-minus"></i>
							</div>
						</h6>
					</div>
					<div class="col-md-1">
						<h6 class="text-center">
							<div class="btn btn-xs btn-success pull-right" v-on="click : addPersonalRow">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5" v-on="click : removePersonalRow">
								<i class="fa fa-minus"></i>
							</div>
							Personal verantw.
						</h6>
					</div>
					<div class="col-md-1">
						<h6 class="text-center">
							<div class="btn btn-xs btn-success pull-right"  v-on="click : addUmsatzRow">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5"  v-on="click : removeUmsatzRow">
								<i class="fa fa-minus"></i>
							</div>
							Umsatz verantw.
						</h6>
					</div>
					<div class="col-md-1">
						<h6 class="text-center">
							<div class="btn btn-xs btn-success pull-right"  v-on="click : addEinkaufRow">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5"  v-on="click : removeEinkaufRow">
								<i class="fa fa-minus"></i>
							</div>
							Einkaufs verantw.
						</h6>
					</div>
					<div class="col-md-1">
						<h6 class="text-center">
							<div class="btn btn-xs btn-success pull-right"  v-on="click : addBudgetRow">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5"  v-on="click : removeBudgetRow">
								<i class="fa fa-minus"></i>
							</div>
							Budget verantw.
						</h6>
					</div>
					<div class="col-md-1">
						<h6 class="text-center">
							<div class="btn btn-xs btn-success pull-right" v-on="click:addSchwerpunkteRow">
								<i class="fa fa-plus"></i>
							</div>
							<div class="btn btn-xs btn-danger pull-right span5" v-on="click:removeSchwerpunkteRow">
								<i class="fa fa-minus"></i>
							</div>
							Schwer punkte
						</h6>
					</div>
				</div>

				<div class="row" v-repeat="projekts : searchState.auslandsProjekte">
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Monate Erfahrung:</label>
							<select name="" id="" class="form-control" v-model="projekts.experience">
								@foreach(range(0,96) as $months)
									<option value="{{$months}}">{{$months}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Branche:</label>
							<select name="" id="" class="form-control" v-model="projekts.branche">
								@foreach(App\Data\Branche::get() as $key => $branche)
									<option value="{{$key}}">{{$branche}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row" v-repeat="mandat : searchState.mandate">
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Monate Erfahrung:</label>
							<select name="" id="" class="form-control" v-model="mandat.experience">
								@foreach(range(0,96) as $months)
									<option value="{{$months}}">{{$months}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Branche:</label>
							<select name="" id="" class="form-control" v-model="mandat.branche">
								@foreach(App\Data\Branche::get() as $key => $branche)
									<option value="{{$key}}">{{$branche}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Min. Umsatz</label>
							<input class="form-control" type="text" v-model="mandat.minUmsatz">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Min. Anzahl MA</label>
							<input class="form-control" type="text" v-model="mandat.minMA">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Min. Mitarbeiterver.</label>
							<input class="form-control" type="text" v-model="mandat.minMit">
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Min. Budgetver.</label>
							<input class="form-control" type="text" v-model="mandat.minBud">
						</div>
					</div>
				</div>

				<div class="row" v-repeat="ausbildung : searchState.ausbildung">
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Monate Erfahrung:</label>
							<select name="" id="" class="form-control">
								@foreach(range(0,96) as $months)
									<option value="{{$months}}">{{$months}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Ausbildung $4a FAO</label>
							<select name="" id="" class="form-control" v-model="ausbildung.ausbildung">
								@foreach(\App\Data\Fachrichtung::getAusbildung() as  $key => $ausbildung)
									<option value="{{$key}}">{{$ausbildung}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Spezialisierung</label>
							<select name="" id="" class="form-control" v-model="ausbildung.spezialisierung">
								@foreach(\App\Data\Fachrichtung::getSpezialisierung() as  $key => $spezialisierung)
									<option value="{{$key}}">{{$spezialisierung}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row" v-repeat="kar : searchState.karriere">
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Monate Erfahrung:</label>
							<select name="" id="" class="form-control" v-model="kar.experience">
								@foreach(range(0,96) as $months)
									<option value="{{$months}}">{{$months}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-2">
						<div class="form-group">
							<label for="">Fachrichtung</label>
							<select name="" id="" class="form-control" v-model="kar.fachrichtung">
								@foreach(\App\Data\Fachrichtung::getKarriere() as  $key => $fachrichtung)
									<option value="{{$key}}">{{$fachrichtung}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-2" v-repeat="interesse : searchState.interessen">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="interesse.interesse">
								@foreach(\App\Data\Interessen::get() as  $key => $interesse)
									<option value="{{$key}}">{{$interesse}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row" v-repeat="verantwortung : searchState.personalVerantwortung">
					<div class="col-md-3">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="verantwortung.amount">
								@foreach(App\Data\Verantwortung::getAmountForPersonal() as $key => $option)
									<option value="{{$key}}">{{$option}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="verantwortung.period">
								@foreach(App\Data\Verantwortung::getPeriodForPersonal() as $key => $option)
									<option value="{{$key}}">{{$option}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row" v-repeat="verantwortung : searchState.umsatzVerantwortung">
					<div class="col-md-3">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="verantwortung.amount">
								@foreach(App\Data\Verantwortung::getAmountForUmsatz() as $key => $option)
									<option value="{{$key}}">{{$option}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="verantwortung.period">
								@foreach(App\Data\Verantwortung::getPeriodForUmsatz() as $key => $option)
									<option value="{{$key}}">{{$option}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row" v-repeat="verantwortung : searchState.budgetVerantwortung">
					<div class="col-md-3">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="verantwortung.amount">
								@foreach(App\Data\Verantwortung::getAmountForBudget() as $key => $option)
									<option value="{{$key}}">{{$option}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="verantwortung.period">
								@foreach(App\Data\Verantwortung::getPeriodForBudget() as $key => $option)
									<option value="{{$key}}">{{$option}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row" v-repeat="verantwortung : searchState.einkaufVerantwortung">
					<div class="col-md-3">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="verantwortung.amount">
								@foreach(App\Data\Verantwortung::getAmountForEinkauf() as $key => $option)
									<option value="{{$key}}">{{$option}}</option>
								@endforeach
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="verantwortung.period">
								@foreach(App\Data\Verantwortung::getPeriodForEinkauf() as $key => $option)
									<option value="{{$key}}">{{$option}}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-4"  v-repeat="punkte : searchState.schwerpunkte">
						<div class="form-group">
							<select name="" id="" class="form-control" v-model="punkte.selection" options="availableKompetenz"></select>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<label for="">
							<input type="checkbox" v-model="resultsView.personal"> Persönliche Daten
						</label>
						<label for="">
							<input type="checkbox" v-model="resultsView.ausland"> Auslandsprojekte
						</label>
						<label for="">
							<input type="checkbox" v-model="resultsView.mandate"> Mandate
						</label>
						<label for="">
							<input type="checkbox" v-model="resultsView.ausbildung"> Ausbildung
						</label>
						<label for="">
							<input type="checkbox" v-model="resultsView.karriere"> Karriere
						</label>
						<label for="">
							<input type="checkbox" v-model="resultsView.skills"> Fähigkeiten
						</label>
						<label for="">
							<input type="checkbox" v-model="resultsView.verantwortung"> Verantwortung
						</label>
						<label for="">
							<input type="checkbox" v-model="resultsView.kompetenz"> Schwerpunkte
						</label>
					</div>
				</div>
				<hr>
				<div class="row">
					<div id="results" v-repeat="result : results" class="col-md-12">
						<div class="admin-search-result">
							<div class="row">
								<div v-show="resultsView.personal" class="col-md-2 search-result-element">
									<div class="row">
										<div class="col-md-6">
											<a href="/admin/user/@{{result.id}}">@{{result.email}}</a><br>
											@{{result.title_gender}} @{{result.title_graduation}} @{{result.forename}} @{{result.surname}} <br>
											@{{result.street}} @{{result.house_number}} <br>
											@{{result.zipcode}} @{{result.city}} <br>
											@{{result.country}} <br>
											@{{result.birthdateString}} <br>
										</div>
										<div class="col-md-6">
											@{{result.email2}} <br>
											Mobil: @{{result.mobil}} <br>
											Privat: @{{result.phone_private}} <br>
											Gesch: @{{result.phone_comercial}} <br>
											Fax: @{{result.fax}} <br>
											@{{result.homepage}} <br>
										</div>
									</div>
								</div>

								<div class="col-md-1 search-result-element" v-show="resultsView.ausland">
									<strong>Auslandsprojekte:</strong> <br>
									<div v-repeat="ausland : result.auslands_projekte">
										@{{ausland.fromString}} - @{{ausland.toString}}; @{{ausland.brancheString}} <br>
									</div>
								</div>

								<div class="col-md-2 search-result-element" v-show="resultsView.mandate">
									<strong>Mandate:</strong> <br>
									<div v-repeat="mandate : result.mandate">
										@{{mandate.fromString}} - @{{mandate.toString}}; @{{mandate.brancheString}} <br>
										Umsatz: @{{mandate.umsatz}}, MA: @{{mandate.ma}}, <br>
										Mitarbeiter: @{{mandate.worker}}, Budget: @{{mandate.budget}} <br><br>
									</div>
								</div>

								<div class="col-md-2 search-result-element" v-show="resultsView.ausbildung">
									<strong>Ausbildung &amp; Karriere:</strong> <br>
									<div v-repeat="ausbildung : result.karriere">
										@{{ausbildung.fromString}} - @{{ausbildung.toString}};<br>
										<div v-if="ausbildung.type === 'ausbildung'">
											A:@{{ausbildung.fachrichtungString}};@{{ausbildung.spezialisierungString}}
										</div>
										<div v-if="ausbildung.type !== 'ausbildung'">
											K:@{{ausbildung.fachrichtungString}};@{{ausbildung.spezialisierungString}}
										</div>
									</div>
								</div>

								<div class="col-md-1 search-result-element" v-show="resultsView.skills">
									<strong>Fähigkeiten</strong>
									<div v-repeat="skill: result.skills">
										@{{skill.string}}
									</div>
								</div>

								<div class="col-md-2 search-result-element" v-show="resultsView.verantwortung">
									<strong>Verantwortung</strong>
									<div v-repeat="ver : result.verantwortung">
										<div v-if="ver.type === 'personal'">
											P;@{{ver.amountString}};@{{ver.periodString}}
										</div>
										<div v-if="ver.type === 'umsatz'">
											U;@{{ver.amountString}};@{{ver.periodString}}
										</div>
										<div v-if="ver.type === 'budget'">
											B;@{{ver.amountString}};@{{ver.periodString}}
										</div>
										<div v-if="ver.type === 'einkauf'">
											E;@{{ver.amountString}};@{{ver.periodString}}
										</div>
									</div>
								</div>
								<div class="col-md-1 search-result-element" v-show="resultsView.kompetenz">
									<strong>Schwerpunkte</strong>
									<div v-repeat="schwerpunkt : result.kompetenz">
										@{{schwerpunkt.string}}
									</div>
								</div>

								<div class="col-md-1 search-result-element">
									<strong>Dokumente</strong>
									<div v-repeat="dokument : result.dokumente">
										@{{dokument.type}}:
										<a href="/download/@{{dokument.id}}" class="btn btn-xs btn-primary">
											<i class="fa fa-download"></i>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
@stop