<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
    <link rel="stylesheet" href="{{ mix('css/section/welcome.css') }}">

    <link href="//fonts.googleapis.com/css?family=Anton&subset=latin" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <section class="hero is-fullheight is-dark">
        <div class="hero-head">
            <div class="container">
                <nav class="nav">
                    <div class="container">
                        <div class="nav-left">
                            <a id="nav-logo" class="nav-item" href="{{ url('/') }}" style="font-size: x-large">

                                {{ config('app.name', 'Laravel') }}
                            </a>
                        </div>
                        <span class="nav-toggle">
                          <span></span>
                          <span></span>
                          <span></span>
                        </span>
                        <div class="nav-right nav-menu">
                            <a class="nav-item">
                                Noticias
                            </a>
                            <a class="nav-item">
                                Precios
                            </a>
                            <a class="nav-item">
                                Ubicacion
                            </a>
                            <a class="nav-item">
                                Contacto
                            </a>
                            @if(Auth::guest())
                                <span class="nav-item">
                                    <a class="button is-default" href="{{ route('register')}}">
                                      Unete!
                                    </a>
                                </span>
                            @else
                                <span class="nav-item">
                                    <a class="button is-default" href="{{ route('dashboard.start')}}">
                                      Dashboard
                                    </a>
                                </span>
                            @endif
                        </div>
                    </div>
                </nav>
            </div>
        </div>

        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="columns is-vcentered" style="padding-left: 60px; padding-right: 60px;">
                    <div class="column is-5">
                        <figure class="image is-4by3">
                            <img src="{{ asset('/imgs/welcome/gym.jpg') }}" class="promo-img" alt="Description">
                        </figure>
                    </div>
                    <div class="column is-6 is-offset-1">
                        <h1 class="title is-2">
                            El gimnasio de tu sueños
                        </h1>
                        <h2 class="subtitle is-4">
                            Todo lo que necesitas para una vida saludable
                        </h2>
                        <br>
                        <p class="control has-addons has-text-centered">
                            <input class="input is-expanded is-large" type="text" placeholder="Suscribete a nuestro newsletter" style="width: 70%">

                            <a class="button is-large is-danger is-outlined">
                                Suscribirse
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>



        <div class="hero-foot">
            <div class="container">
                <div class="tabs is-centered">
                    <ul>
                        <li><a href="">Acerca de</a></li>
                        <li><a>Copyright {{ date('Y') }} {{ config('app.name') }}</a></li>
                        <li><a href="">Contacto</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

<!--<section class="is-fullheight">
        <div class="hero-body">

            <div class="container has-text-centered">
                <div class="columns is-vcentered">
                    <div class="column is-5">
                        <figure class="image is-4by3">
                            <img src="{{ asset('/imgs/welcome/gym.jpg') }}" class="promo-img" alt="Description">
                        </figure>
                    </div>
                    <div class="column is-6 is-offset-1">
                        <h1 class="title is-2">
                            El gimnasio de tus sueños
                        </h1>
                        <h2 class="subtitle is-4">
                            Todo lo que necesitas para una vida saludable
                        </h2>
                        <br>
                        <p class="control has-addons has-text-centered">
                            <input class="input is-expanded is-large" type="text" placeholder="¡Suscribete al newsletter!">
                            <a class="button is-large is-danger is-outlined">
                                Suscribirse
                            </a>
                        </p>
                    </div>
                </div>
            </div>

            @include('partials.footer')
        </div>
    </section>-->
