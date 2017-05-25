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
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
    @if(url()->current() == url('/'))
        <link rel="stylesheet" href="{{ mix('css/section/welcome.css') }}">
    @endif
    <link href="//fonts.googleapis.com/css?family=Anton&subset=latin" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    @include('partials.analytics')
</head>
<body>
    <div id="app">
        @if(shouldIncludeNavbar())
            @include('partials.topnavbar')
        @endif


        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
    @if(session('status'))
        <script>
            swal("Éxito!", "{!! session('status') !!}", "success");
        </script>
    @endif
</body>
</html>
