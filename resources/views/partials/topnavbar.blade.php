<nav class="nav has-shadow">
    <div class="container">
        <div class="nav-left">
            <a id="nav-logo" class="nav-item" href="{{ url('/') }}">
                <figure class="image is-32x32">
                    <img src="{{ asset('imgs/logo.png') }}" alt="ApoloGym">
                </figure>&nbsp;
                {{ config('app.name', 'Laravel') }}
            </a>
            <!--
            <a class="nav-item is-tab is-hidden-mobile is-active">Home</a>
            <a class="nav-item is-tab is-hidden-mobile">Features</a>
            <a class="nav-item is-tab is-hidden-mobile">Pricing</a>
            <a class="nav-item is-tab is-hidden-mobile">About</a>
            -->
        </div>
        <span class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
        </span>
        <div class="nav-right nav-menu">
            <!--
            <a class="nav-item is-tab is-hidden-tablet is-active">Home</a>
            <a class="nav-item is-tab is-hidden-tablet">Features</a>
            <a class="nav-item is-tab is-hidden-tablet">Pricing</a>
            <a class="nav-item is-tab is-hidden-tablet">About</a>
            -->

            @if (Auth::guest())
                <a class="nav-item is-tab {{ url()->current() == route('login') ? 'is-active' : '' }}"
                   href="{{ route('login') }}">
                    Inicia sesión
                </a>
                <!--
                <a class="nav-item is-tab {{ url()->current() == route('register') ? 'is-active' : '' }}"
                   href="{{ route('register') }}">
                    Registrate
                </a>
                -->
            @else
                <a class="nav-item is-tab" href="{{ url('/profile') }}">{{ Auth::user()->name }}</a>
                <a class="nav-item is-tab" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            @endif
        </div>
    </div>
</nav>
