@extends('admin.layout.default')

@section('content')
    <h1>Stellenangebote <a href="{{ route('add-job-offering') }}" class="btn btn-primary pull-right">Hinzufügen</a></h1>
    <hr>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Stellenangebote List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Lfd-Nr</th>
                            <th>Type</th>
                            <th>Stellenbezeichnung</th>
                            <th>Standort</th>
                            <th>Vertiefung</th>
                            <th>Organisation</th>
                            <th>min. Berufserfahrung</th>
                            <th>Beschreibung</th>
                            <th>Edit</th>
                            <th>Löschen</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{dd($offerings)}} --}}
                        @forelse($offerings as $offering)
                            <tr>
                                <td>{{ $offering->id }}</td>
                                <td>{{ ucfirst($offering->type) }}</td>
                                <td>
                                    <a href="{{ route('show-job-offerings', [$offering->id]) }}">
                                        {{ $offering->name }}
                                    </a>
                                </td>
                                <td>{{ $offering->location }}</td>
                                <td>{{ $offering->immersion }}</td>
                                <td>{{ $offering->organisation }}</td>
                                <td>{{ $offering->minimal_requirement }} Jahre</td>
                                <td class="limit-td">{!! $offering->description !!}</td>
                                <td>
                                    <a href="{{ route('add-job-offering', [$offering->id]) }}" class="btn btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('delete-job-offering', [$offering->id]) }}" class="btn btn-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>Keine Angebote in der Datenbank</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
