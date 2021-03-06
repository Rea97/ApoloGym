<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/vendor/vendor.css') }}">
    <link rel="stylesheet" href="{{ mix('css/all.css') }}">
    <link rel="stylesheet" href="{{ mix('css/section/dashboard.css') }}">
    <link href="//fonts.googleapis.com/css?family=Anton&subset=latin" rel="stylesheet" type="text/css">
    <style>
        ul.pagination{margin: 0}
        h1.page-header{margin: 30px 0 20px;}
    </style>
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">
    <div id="wrapper">
        <!-- Navigation -->
        @include('partials.dashboard.navigation')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        @yield('title')
                        <div class="pull-right hidden-xs">
                            <a class="btn btn-sm btn-primary" onclick="window.history.back()">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                Página anterior
                            </a>
                        </div>

                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            @yield('content')
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</div>


<!-- Scripts -->
<script src="{{ mix('js/app.js') }}"></script>
@stack('scripts')
</body>
</html>
