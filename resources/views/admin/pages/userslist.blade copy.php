@extends('admin.layout.default')

@section('content')
    <h1>Users List</h1>
    <hr>

    <form id="exportForm" action="{{ route('export-data') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary m-2" onclick="checkCheckboxes(event)">Export</button>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive" id="users-list">
                    <div class="d-flex justify-content-end mb-2">
                        <input class="search form-control" placeholder="Search Users" style="max-width: 250px;" />
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" name="selectall" id="input-selectall"></th>
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
                        <tbody class="list">
                            @forelse($users as $user)
                                <tr>
                                    <td><input type="checkbox" name="select[]" value="{{ $user->id }}"></td>
                                    <td class="name">{{ $user->prefix ?? '' }} {{ $user->firstname ?? 'NA' }}
                                        {{ $user->lastname ?? '' }}</td>
                                    <td class="workphone">{{ $user->phone_comercial ?? 'NA' }}</td>
                                    <td class="mobile">{{ $user->mobil ?? 'NA' }}</td>
                                    <td class="email">{{ $user->email }}</td>
                                    <td class="street">{{ $user->street ?? 'NA' }}</td>
                                    <td class="zipcode">{{ $user->zipcode ?? 'NA' }}</td>
                                    <td class="city">{{ $user->city ?? 'NA' }}</td>
                                    <td class="date">{{ $user->created_at }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">Keine Angebote in der Datenbank</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <ul class="pagination"></ul>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/list.js/2.3.1/list.min.js"></script>
    <script>
        // Initialize List.js
        var options = {
            valueNames: ['name', 'workphone', 'mobile', 'email', 'street', 'zipcode', 'city', 'date'],
            page: 15,
            pagination: true
        };
        var userList = new List('users-list', options);

        // Select all checkboxes
        document.getElementById('input-selectall').addEventListener('change', function() {
            let checkboxes = document.querySelectorAll('input[name="select[]"]');
            for (let checkbox of checkboxes) {
                checkbox.checked = this.checked;
            }
        });

        // Export validation
        function checkCheckboxes(event) {
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
