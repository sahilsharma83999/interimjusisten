<footer>
    <div class="container">
        <ul class="footer-list">
            @auth
                <li><a href="{{ url('interim-juristen') }}">Über MC - Juristen</a></li>
                <li><a href="{{ url('legal-juristen') }}">Legal - Interim</a></li>
                <li><a href="{{ url('perm-juristen') }}">Legal - Perm</a></li>
                <li><a href="{{ url('outsourcing') }}">Legal Outsourcing</a></li>
                <li><a href="{{ url('kontakt') }}">Kontakt</a></li>
                <li><a href="{{ route('job-offerings')}}">Jobs</a></li>
                <li><a href="{{ url('suche') }}"><i class="fa fa-search"></i></a></li>
                @if(auth()->user() && auth()->user()->admin)
                    <li>
                        <a href="{{ url('export/xlsx') }}" class="btn btn-warning">
                            Export User To xlsx
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin-search') }}" class="btn btn-warning">
                            Admin Search
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('admin/stellenangebote') }}" class="btn btn-warning">
                            Edit Stellenangebote
                        </a>
                    </li>
                @endif
            @endauth
        </ul>
    </div>
    <ul class="footer-list-lower pull-right">
        <li><a href="{{ url('datenschutz') }}">Datenschutz</a></li>
        <li><a href="{{ url('impressum') }}">Impressum</a></li>
    </ul>
</footer>