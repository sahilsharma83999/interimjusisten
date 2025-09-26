@extends('admin.layout.default')

@section('content')
    <h1>Search</h1>
    <hr>
    <form action="" method="POST" id="admin-search" accept-charset="utf-8">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <div class="form-control">
                                        <input type="checkbox" name="festanstellung" id="festanstellung"
                                            v-model="searchState.festanstellung" />
                                        <label for="festanstellung" class="input-group-addon">
                                            Festanstellung
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <div class="form-control">
                                        <input type="checkbox" name="interimManger" id="interimManger"
                                            v-model="searchState.interim" />
                                        <label for="interimManger" class="input-group-addon">
                                            Interim Jurist
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-group">
                                    <div class="form-control">
                                        <input type="checkbox" name="managementBuyIn" id="managementBuyIn"
                                            v-model="searchState.buyIn" />
                                        <label for="managementBuyIn" class="input-group-addon">
                                            Management Buy In
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="row justify-content-between mb-5">
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click:addAuslandRow">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click:removeAuslandRow">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text">Auslands projekte</span>
                        </div>
                    </div>
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click: addMandatRow">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click: removeMandatRow">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text"> Mandate</span>
                        </div>
                    </div>
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click: addAusbildungRow">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click: removeAusbildungRow">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text"> Ausbildung</span>
                        </div>
                    </div>
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click: addKarriereRow">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click: removeKarriereRow">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text"> Karriere</span>
                        </div>
                    </div>
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click:addInteresse">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click:removeInteresse">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text"> Fähigkeiten</span>
                        </div>
                    </div>
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click : addPersonalRow">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click : removePersonalRow">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text"> Personal verantw.</span>
                        </div>
                    </div>
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click : addUmsatzRow">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click : removeUmsatzRow">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text"> Umsatz verantw.</span>
                        </div>
                    </div>
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click : addEinkaufRow">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click : removeEinkaufRow">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text"> Einkaufs verantw.</span>
                        </div>
                    </div>
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click : addBudgetRow">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click : removeBudgetRow">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text"> Budget verantw.</span>
                        </div>
                    </div>
                    <div class="col-md-1 p-0">
                        <div class="text-center btn_check_group">
                            <div class="main-check">
                                <div class="btn btn-xs btn__plus pull-right" v-on="click:addSchwerpunkteRow">
                                    <i class="fa fa-plus"></i>
                                </div>
                                <div class="btn btn-xs btn__minus pull-right span5" v-on="click:removeSchwerpunkteRow">
                                    <i class="fa fa-minus"></i>
                                </div>
                            </div>
                            <span class="check-text"> Schwer punkte</span>
                        </div>
                    </div>
                </div>

                {{-- Filter boxes --}}
                <div class="row" v-repeat="projekts : searchState.auslandsProjekte">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Monate Erfahrung:</label>
                            <select name="" id="" class="form-control" v-model="projekts.experience">
                                @foreach (range(0, 96) as $months)
                                    <option value="{{ $months }}">{{ $months }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Branche:</label>
                            <select name="" id="" class="form-control" v-model="projekts.branche">
                                @foreach (App\Data\Branche::get() as $key => $branche)
                                    <option value="{{ $key }}">{{ $branche }}</option>
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
                                @foreach (range(0, 96) as $months)
                                    <option value="{{ $months }}">{{ $months }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Branche:</label>
                            <select name="" id="" class="form-control" v-model="mandat.branche">
                                @foreach (App\Data\Branche::get() as $key => $branche)
                                    <option value="{{ $key }}">{{ $branche }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Min. Umsatztesthye</label>
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
                                @foreach (range(0, 96) as $months)
                                    <option value="{{ $months }}">{{ $months }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Ausbildung $4a FAO</label>
                            <select name="" id="" class="form-control" v-model="ausbildung.ausbildung">
                                @foreach (\App\Data\Fachrichtung::getAusbildung() as $key => $ausbildung)
                                    <option value="{{ $key }}">{{ $ausbildung }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Spezialisierung</label>
                            <select name="" id="" class="form-control"
                                v-model="ausbildung.spezialisierung">
                                @foreach (\App\Data\Fachrichtung::getSpezialisierung() as $key => $spezialisierung)
                                    <option value="{{ $key }}">{{ $spezialisierung }}</option>
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
                                @foreach (range(0, 96) as $months)
                                    <option value="{{ $months }}">{{ $months }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="">Fachrichtung</label>
                            <select name="" id="" class="form-control" v-model="kar.fachrichtung">
                                @foreach (\App\Data\Fachrichtung::getKarriere() as $key => $fachrichtung)
                                    <option value="{{ $key }}">{{ $fachrichtung }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" v-repeat="interesse : searchState.interessen">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="interesse.interesse">
                                @foreach (\App\Data\Interessen::get() as $key => $interesse)
                                    <option value="{{ $key }}">{{ $interesse }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" v-repeat="verantwortung : searchState.personalVerantwortung">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="verantwortung.amount">
                                @foreach (App\Data\Verantwortung::getAmountForPersonal() as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="verantwortung.period">
                                @foreach (App\Data\Verantwortung::getPeriodForPersonal() as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" v-repeat="verantwortung : searchState.umsatzVerantwortung">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="verantwortung.amount">
                                @foreach (App\Data\Verantwortung::getAmountForUmsatz() as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="verantwortung.period">
                                @foreach (App\Data\Verantwortung::getPeriodForUmsatz() as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" v-repeat="verantwortung : searchState.budgetVerantwortung">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="verantwortung.amount">
                                @foreach (App\Data\Verantwortung::getAmountForBudget() as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="verantwortung.period">
                                @foreach (App\Data\Verantwortung::getPeriodForBudget() as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row" v-repeat="verantwortung : searchState.einkaufVerantwortung">
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="verantwortung.amount">
                                @foreach (App\Data\Verantwortung::getAmountForEinkauf() as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="verantwortung.period">
                                @foreach (App\Data\Verantwortung::getPeriodForEinkauf() as $key => $option)
                                    <option value="{{ $key }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4" v-repeat="punkte : searchState.schwerpunkte">
                        <div class="form-group">
                            <select name="" id="" class="form-control" v-model="punkte.selection"
                                options="availableKompetenz"></select>
                        </div>
                    </div>
                </div>

                {{-- Checkboxex --}}

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
                            <input type="checkbox" v-model="resultsView.karriere"> Ausbildung & Karriere
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


                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Results</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive" id="results">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="border text-black fw-semibold" v-show="resultsView.personal">
                                            Persönliche Daten</th>
                                        <th class="border text-black fw-semibold" v-show="resultsView.ausland">
                                            Auslandsprojekte</th>
                                        <th class="border text-black fw-semibold" v-show="resultsView.mandate">Mandate
                                        </th>
                                        <th class="border text-black fw-semibold" v-show="resultsView.karriere">Ausbildung
                                            &amp; Karriere</th>
                                        <th class="border text-black fw-semibold" v-show="resultsView.skills">Fähigkeiten
                                        </th>
                                        <th class="border text-black fw-semibold" v-show="resultsView.verantwortung">
                                            Verantwortung</th>
                                        <th class="border text-black fw-semibold" v-show="resultsView.kompetenz">
                                            Schwerpunkte</th>
                                        <th class="border text-black fw-semibold">Dokumente</th>
                                    </tr>
                                </thead>
                                <tbody class="list" v-repeat="result : results">
                                    <tr>
                                        <td v-show="resultsView.personal">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a
                                                        href="/admin/user/@{{ result.id }}">@{{ result.email }}</a><br>
                                                    @{{ result.title_gender }} @{{ result.title_graduation }} @{{ result.forename }}
                                                    @{{ result.surname }} <br>
                                                    @{{ result.street }} @{{ result.house_number }} <br>
                                                    @{{ result.zipcode }} @{{ result.city }} <br>
                                                    @{{ result.country }} <br>
                                                    @{{ result.birthdateString }} <br>
                                                </div>
                                                <div class="col-md-6">
                                                    @{{ result.email2 }} <br>
                                                    Mobil: @{{ result.mobil }} <br>
                                                    Privat: @{{ result.phone_private }} <br>
                                                    Gesch: @{{ result.phone_comercial }} <br>
                                                    Fax: @{{ result.fax }} <br>
                                                    @{{ result.homepage }} <br>
                                                </div>
                                            </div>
                                        </td>
                                        <td v-show="resultsView.ausland">
                                            <div v-repeat="ausland : result.auslands_projekte">
                                                @{{ ausland.from }} - @{{ ausland.to }}; @{{ ausland.branche }}
                                                <br>
                                            </div>
                                        </td>
                                        <td v-show="resultsView.mandate">
                                            <div v-repeat="mandate : result.mandate">
                                                @{{ mandate.from }} - @{{ mandate.to }}; @{{ mandate.branche }}
                                                <br>
                                                Umsatz: @{{ mandate.umsatz }}, MA: @{{ mandate.ma }}, <br>
                                                Mitarbeiter: @{{ mandate.worker }}, Budget: @{{ mandate.budget }}
                                                <br><br>
                                            </div>
                                        </td>
                                        <td v-show="resultsView.karriere">
                                            <div v-repeat="ausbildung : result.karriere">
                                                @{{ ausbildung.from }} - @{{ ausbildung.to }};<br>
                                                <div v-if="ausbildung.type === 'ausbildung'">
                                                    A:@{{ ausbildung.fachrichtung }};@{{ ausbildung.spezialisierung }}
                                                </div>
                                                <div v-if="ausbildung.type !== 'ausbildung'">
                                                    K:@{{ ausbildung.fachrichtung }};@{{ ausbildung.spezialisierung }}
                                                </div>
                                            </div>
                                        </td>
                                        <td v-show="resultsView.skills">
                                            <div v-if="result.skills.length">
                                                @{{ result.skills[0].skill }}
                                            </div>
                                        </td>
                                        <td v-show="resultsView.verantwortung">
                                            <div v-repeat="ver : result.verantwortung">
                                                <div v-if="ver.type === 'personal'">
                                                    P;@{{ ver.amount }};@{{ ver.period }}
                                                </div>
                                                <div v-if="ver.type === 'umsatz'">
                                                    U;@{{ ver.amount }};@{{ ver.period }}
                                                </div>
                                                <div v-if="ver.type === 'budget'">
                                                    B;@{{ ver.amount }};@{{ ver.period }}
                                                </div>
                                                <div v-if="ver.type === 'einkauf'">
                                                    E;@{{ ver.amount }};@{{ ver.period }}
                                                </div>
                                            </div>
                                        </td>
                                        <td v-show="resultsView.kompetenz">
                                            <div v-repeat="k in result.kompetenz">
                                                @{{ k.kompetenz }}
                                            </div>
                                        </td>
                                        <td>
                                            <div v-repeat="dokument : result.dokumente">
                                                @{{ dokument.type }}:
                                                <a href="/download/@{{ dokument.id }}"
                                                    class="btn btn-xs btn-primary">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
                {{-- <div class="row">
                            <div id="results" v-repeat="result : results" class="col-md-12">
                                <div class="admin-search-result">
                                    <div class="row">
                                        <div v-show="resultsView.personal" class="col-md-2 search-result-element">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <a href="/admin/user/@{{ result.id }}">@{{ result.email }}</a><br>
                                                    @{{ result.title_gender }} @{{ result.title_graduation }} @{{ result.forename }}
                                                    @{{ result.surname }} <br>
                                                    @{{ result.street }} @{{ result.house_number }} <br>
                                                    @{{ result.zipcode }} @{{ result.city }} <br>
                                                    @{{ result.country }} <br>
                                                    @{{ result.birthdateString }} <br>
                                                </div>
                                                <div class="col-md-6">
                                                    @{{ result.email2 }} <br>
                                                    Mobil: @{{ result.mobil }} <br>
                                                    Privat: @{{ result.phone_private }} <br>
                                                    Gesch: @{{ result.phone_comercial }} <br>
                                                    Fax: @{{ result.fax }} <br>
                                                    @{{ result.homepage }} <br>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-md-1 search-result-element" v-show="resultsView.ausland">
                                            <strong>Auslandsprojekte:</strong> <br>
                                            <div v-repeat="ausland : result.auslands_projekte">
                                                @{{ ausland.from }} - @{{ ausland.to }}; @{{ ausland.branche }} <br>
                                            </div>
                                        </div>
        
        
                                        <div class="col-md-2 search-result-element" v-show="resultsView.mandate">
                                            <strong>Mandate:</strong> <br>
                                            <div v-repeat="mandate : result.mandate">
                                                @{{ mandate.from }} - @{{ mandate.to }}; @{{ mandate.branche }} <br>
                                                Umsatz: @{{ mandate.umsatz }}, MA: @{{ mandate.ma }}, <br>
                                                Mitarbeiter: @{{ mandate.worker }}, Budget: @{{ mandate.budget }} <br><br>
                                            </div>
                                        </div>
        
                                        <div class="col-md-2 search-result-element" v-show="resultsView.karriere">
                                            <strong>Ausbildung &amp; Karriere:</strong> <br>
                                            <div v-repeat="ausbildung : result.karriere">
                                                @{{ ausbildung.from }} - @{{ ausbildung.to }};<br>
                                                <div v-if="ausbildung.type === 'ausbildung'">
                                                    A:@{{ ausbildung.fachrichtung }};@{{ ausbildung.spezialisierung }}
                                                </div>
                                                <div v-if="ausbildung.type !== 'ausbildung'">
                                                    K:@{{ ausbildung.fachrichtung }};@{{ ausbildung.spezialisierung }}
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="col-md-2 search-result-element" v-show="resultsView.skills">
                                            <strong>Fähigkeiten</strong>
                                            <div v-if="result.skills.length">
                                                @{{ result.skills[0].skill }}
                                            </div>
                                        </div>
        
                                        <div class="col-md-2 search-result-element" v-show="resultsView.verantwortung">
                                            <strong>Verantwortung</strong>
                                            <div v-repeat="ver : result.verantwortung">
                                                <div v-if="ver.type === 'personal'">
                                                    P;@{{ ver.amount }};@{{ ver.period }}
                                                </div>
                                                <div v-if="ver.type === 'umsatz'">
                                                    U;@{{ ver.amount }};@{{ ver.period }}
                                                </div>
                                                <div v-if="ver.type === 'budget'">
                                                    B;@{{ ver.amount }};@{{ ver.period }}
                                                </div>
                                                <div v-if="ver.type === 'einkauf'">
                                                    E;@{{ ver.amount }};@{{ ver.period }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 search-result-element" v-show="resultsView.kompetenz">
                                            <strong>Schwerpunkte</strong>
                                            <div v-repeat="k in result.kompetenz">
                                                @{{ k.kompetenz }}
                                            </div>
                                        </div>
        
                                        <div class="col-md-1 search-result-element">
                                            <strong>Dokumente</strong>
                                            <div v-repeat="dokument : result.dokumente">
                                                @{{ dokument.type }}:
                                                <a href="/download/@{{ dokument.id }}" class="btn btn-xs btn-primary">
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
            </div>
        </div>
    </form>
@stop
{{-- Admin@#123!$Abc --}}
