@extends('admin.layout.default')

@section('content')
    <h1>Users List</h1>
    <hr>

    <form id="exportForm" action="{{ route('export-data') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary m-2" onclick="checkCheckboxex()">Export</button>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="selectall" id="input-selectall">
                                </th>
                                <th>Name</th>
                                <th>Work phone</th>
                                <th>Mobile phone</th>
                                <th>Email</th>
                                <th>Street</th>
                                <th>Postal code</th>
                                <th>City</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>
                                        <input type="checkbox" name="select[]" id="input-select-{{ $user->id }}"
                                            value="{{ $user->id }}">
                                    </td>
                                    <td>{{ $user->prefix ?? '' }} {{ $user->firstname ?? 'NA' }} {{ $user->lastname ?? '' }}
                                    </td>
                                    <td>{{ $user->phone_comercial ?? 'NA' }}</td>
                                    <td>{{ $user->mobil ?? 'NA' }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->street ?? 'NA' }}</td>
                                    <td>{{ $user->zipcode ?? 'NA' }}</td>
                                    <td>{{ $user->city ?? 'NA' }}</td>
                                    <td>{{ $user->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Keine Angebote in der Datenbank</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        document.getElementById('input-selectall').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('input[name="select[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });

        function checkCheckboxex() {
            let checkboxes = document.querySelectorAll('input[name="select[]"]');
            let isAnyChecked = false;
            for (let checkbox of checkboxes) {
                if (checkbox.checked) {
                    isAnyChecked = true;
                    break;
                }
            }
            if (!isAnyChecked) {
                alert('Please select at least one user to export.');
                event.preventDefault();
            }
        }
    </script>
@endsection
