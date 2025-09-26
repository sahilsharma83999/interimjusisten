@extends('admin.layout.default')

@section('content')
    <h1>
        Stellenangebote
        <a href="{{ route('add-job-offering') }}" class="btn btn-primary pull-right">Hinzufügen</a>
    </h1>
    <hr>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Stellenangebote List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="stellenbezeichnung-table">
                <div class="d-flex justify-content-end mb-2">
                    <input class="search form-control" placeholder="Search Users" style="max-width: 250px;" />
                </div>
                <table class="table table-bordered" width="100%" cellspacing="0">
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
                    <tbody class="list">
                        @forelse($offerings as $offering)
                            <tr>
                                <td>{{ $offering->id }}</td>
                                <td class="type">{{ ucfirst($offering->type) }}</td>
                                <td class="name">
                                    <a href="{{ route('show-job-offerings', [$offering->id]) }}">
                                        {{ $offering->name }}
                                    </a>
                                </td>
                                <td class="location">{{ $offering->location }}</td>
                                <td class="immersion">{{ $offering->immersion }}</td>
                                <td class="organisation">{{ $offering->organisation }}</td>
                                <td class="minimal_requirement">{{ $offering->minimal_requirement }} Jahre</td>
                                <td class="description limit-td">{!! $offering->description !!}</td>
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
                                <td colspan="10">Keine Angebote in der Datenbank</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <ul class="pagination mt-2"></ul>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
    <script>
        var stellenbezeichnungOptions = {
            valueNames: [
                'type', 'name', 'location', 'immersion',
                'organisation', 'minimal_requirement', 'description'
            ],
            page: 15,
            pagination: true
        };
        var jobList = new List('stellenbezeichnung-table', stellenbezeichnungOptions);
    </script>
@endsection
