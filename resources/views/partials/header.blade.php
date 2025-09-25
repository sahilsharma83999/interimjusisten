<header>
    <nav class="container">
        <ul class="navigation-list">
            @auth
                <li><a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}"></a></li>
                <li><a href="{{ url('account/details') }}">Persönliches</a></li>
                <li><a href="{{ url('account/auslands-projekte') }}">Auslandprojekte</a></li>
                <li><a href="{{ url('account/mandate') }}">Mandate</a></li>
                <li><a href="{{ url('account/karriere') }}">Karriere</a></li>
                <li><a href="{{ url('account/faehigkeiten')}}">Fähigkeiten</a></li>
                <li><a href="{{ url('account/verantwortung')}}">Verantwortung</a></li>
                <li><a href="{{ url('account/schwerpunkte')}}">Schwerpunkte</a></li>
                <li><a href="{{ url('account/dokumente')}}">Dokumente</a></li>
                <li><a href="{{ url('auth/logout') }}">Logout</a></li>
            @else
                <li><a href="{{ url('/') }}"><img src="{{ asset('img/logo.png') }}"></a></li>
                <li><a href="{{ url('interim-juristen') }}">Über MC - Juristen</a></li>
                <li><a href="{{	url('legal-juristen') }}">Legal - Interim</a></li>
                <li><a href="{{	url('perm-juristen') }}">Legal - Perm</a></li>
                <li><a href="{{	url('outsourcing') }}">Legal Outsourcing</a></li>
                <li><a href="{{	url('kontakt') }}">Kontakt</a></li>
                <li><a href="{{ route('job-offerings')}}">Jobs</a></li>
                <li><a href="{{	url('suche') }}"><i class="fa fa-search"></i></a></li>
                <li><a href="{{ url('auth/login') }}">Login</a></li>
                <li><a href="{{ url('auth/register') }}">Registrieren</a></li>
            @endauth
        </ul>
    </nav>
</header>