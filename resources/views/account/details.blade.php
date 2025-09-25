@extends('layouts.public')

@section('content')
    <h1>Persönliche Details <small>Schritt 1 von 8</small></h1>
    <form action="{{ url('account/details') }}" method="POST" accept-charset="utf-8">
        {!! csrf_field() !!}

        <div class="row form-group">
            <div class="col-lg-2">
                <label for="title_gender">Anrede:</label>
                <select name="title_gender" id="title_gender" class="form-control">
                    <option></option>
                    @foreach (\App\Models\User::TITLE_GENDER as $option)
                        <option value="{{ $option }}" @if (Auth::user()->title_gender === $option) selected @endif>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>

            </div>
            <div class="col-lg-2">
                <label for="title_graduation">Titel:</label>
                <select name="title_graduation" id="title_graduation" class="form-control">
                    <option></option>
                    @foreach (\App\Models\User::TITLE_GRADUATION as $option)
                        <option value="{{ $option }}" @if (Auth::user()->title_graduation === $option) selected @endif>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>

            </div>
        </div>

        <div class="row form-group">
            <div class="col-lg-3">
                <label for="forename">Vorname:</label>
                <input type="text" name="forename" id="forename" placeholder="Vorname" class="form-control"
                    value="{{ @Auth::user()->forename }}">
            </div>
            <div class="col-lg-3">
                <label for="surname">Nachname:</label>
                <input type="text" name="surname" id="surname" placeholder="Nachname" class="form-control"
                    value="{{ @Auth::user()->surname }}">
            </div>
        </div>
        <div class="form-group">
            <hr>
            <h4>Geburtsdatum</h4>
        </div>
        <div class="row form-group">
            <div class="col-lg-1">
                <label for="bday">Tag</label>
                <select name="bday" id="bday" class="form-control">
                    @foreach (range(1, 31) as $value)
                        <option @if ($value === $day) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-1">
                <label for="bmonth">Monat</label>
                <select name="bmonth" id="bmonth" class="form-control">
                    @foreach (range(1, 31) as $value)
                        <option @if ($value === $month) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-2">
                <label for="byear">Jahr</label>
                <select name="byear" id="byear" class="form-control">
                    @foreach (range(\Carbon\Carbon::now()->year, 1900) as $value)
                        <option @if ($value === $year) selected @endif>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr>

        <div class="form-group row">
            <div class="col-lg-4">
                <label for="street">Straße:</label>
                <input type="text" name="street" id="street" placeholder="Straße" class="form-control"
                    value="{{ @Auth::user()->street }}">
            </div>
            <div class="col-lg-2">
                <label for="house_number">Hausnummer:</label>
                <input type="text" name="house_number" id="house_number" placeholder="Hausnummer" class="form-control"
                    value="{{ @Auth::user()->house_number }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-2">
                <label for="zipcode">Postleihzahl:</label>
                <input type="text" name="zipcode" id="zipcode" placeholder="Postleihzahl" class="form-control"
                    value="{{ @Auth::user()->zipcode }}">
            </div>
            <div class="col-lg-2">
                <label for="city">Wohnort:</label>
                <input type="text" name="city" id="city" placeholder="Wohnort" class="form-control"
                    value="{{ @Auth::user()->city }}">
            </div>
            <div class="col-lg-2">
                <label for="country">Land:</label>
                <input type="text" name="country" id="country" placeholder="Land" class="form-control"
                    value="{{ @Auth::user()->country }}">
            </div>
        </div>

        <hr>

        <div class="form-group row">
            <div class="col-lg-4">
                <label for="email">E-Mail:</label>
                <input type="text" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}"
                    disabled>
            </div>
            <div class="col-lg-4">
                <label for="email2">E-Mail 2:</label>
                <input type="text" name="email2" id="email2" class="form-control" placeholder="E-Mail 2"
                    value="{{ @Auth::user()->email2 }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-3">
                <label for="mobil">Mobil:</label>
                <input type="text" name="mobil" id="mobil" class="form-control" placeholder="Mobil"
                    value="{{ @Auth::user()->mobil }}">
            </div>
            <div class="col-lg-3">
                <label for="phone_private">Festnetz Privat:</label>
                <input type="text" name="phone_private" id="phone_private" class="form-control"
                    placeholder="Festnetz Privat" value="{{ @Auth::user()->phone_private }}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-3">
                <label for="phone_comercial">Festnetz Büro:</label>
                <input type="text" name="phone_comercial" id="phone_comercial" class="form-control"
                    placeholder="Festnetz Büro" value="{{ @Auth::user()->phone_comercial }}">
            </div>
            <div class="col-lg-3">
                <label for="fax">Fax:</label>
                <input type="text" name="fax" id="fax" class="form-control" placeholder="Fax"
                    value="{{ @Auth::user()->fax }}">
            </div>
        </div>

        <hr>

        <div class="form-group row">
            <div class="col-lg-5">
                <label for="email_signature">E-Mail-Signatur:</label>
                <textarea name="email_signature" id="email_signature" class="form-control" placeholder="E-Mail-Signatur">{{ @Auth::user()->email_signature }}</textarea>
            </div>
            <div class="col-lg-4">
                <label for="homepage">Homepage:</label>
                <input type="text" name="homepage" id="homepage" class="form-control" placeholder="Homepage"
                    value="{{ @Auth::user()->homepage }}">
            </div>
        </div>

        <input type="submit" value="Speichern" class="btn btn-lg btn-primary">
    </form>
@stop
