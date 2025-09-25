@extends('admin.layout.default')

@section('content')
	<h1>Stellenangebote <a href="{{route('add-job-offering')}}" class="btn btn-primary pull-right">Hinzufügen</a></h1>
	<hr>
	<table class="table table-striped table-hover">
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
			@forelse($offerings as $offering)
				<tr>
					<td>{{ $offering->id }}</td>
					<td>{{ ucfirst($offering->type) }}</td>
					<td>
						<a href="{{route('show-job-offerings',[$offering->id])}}">
							{{ $offering->name }}
						</a>
					</td>
					<td>{{ $offering->location }}</td>
					<td>{{ $offering->immersion }}</td>
					<td>{{$offering->organisation}}</td>
					<td>{{$offering->minimal_requirement}}  Jahre</td>
					<td class="limit-td">{!!$offering->description!!}</td>
					<td>
						<a href="{{ route('add-job-offering',[$offering->id]) }}" class="btn btn-info">
							<i class="fa fa-edit"></i>
						</a>
					</td>
					<td>
						<a href="{{ route('delete-job-offering',[$offering->id]) }}" class="btn btn-danger">
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
@stop