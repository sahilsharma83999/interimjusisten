@extends('admin.layout.default')

@section('content')
    <h1>Search</h1>
    <hr>

    <!-- Pass PHP data to JS -->
    <script>
        window.brancheOptions = @json(\App\Data\Branche::get());
    </script>

    <!-- Your search form -->
    <div id="admin-search-app">
        <admin-search></admin-search>
    </div>
@stop
