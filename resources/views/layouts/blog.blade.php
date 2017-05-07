<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog - @yield('title')</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{ mix('/css/vendor/vendor.css') }}" rel="stylesheet">


    <!-- Theme CSS -->


    <!-- Custom Fonts -->
    <link href="//fonts.googleapis.com/css?family=Anton&amp;subset=latin" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        #nav-logo {font-family: 'Anton', sans-serif;}
    </style>
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-default navbar-custom navbar-fixed-top" style="margin-bottom: 100px;">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="nav-logo" class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('/imgs/logo.png') }}" alt="ApoloGym" class="pull-left" style="width: 32px">
                {{ config('app.name') }} <small>Blog</small>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                @if(currentGuard()->check())
                    <li>
                        <a href="{{ route('dashboard.start') }}">
                            <i class="fa fa-dashboard" aria-hidden="true"></i>
                            Dashboard
                        </a>
                    </li>
                @else
                    <li>
                        <a href="index.html">Inicio</a>
                    </li>
                    <li>
                        <a href="about.html">Acerca de</a>
                    </li>
                    <li>
                        <a href="contact.html">Contácto</a>
                    </li>
                @endif

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

@yield('content')

<hr>

<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                <ul class="list-inline text-center">
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                                <span class="fa-stack fa-lg">
                                    <i class="fa fa-circle fa-stack-2x"></i>
                                    <i class="fa fa-youtube fa-stack-1x fa-inverse"></i>
                                </span>
                        </a>
                    </li>
                </ul>
                <p class="copyright text-muted">Copyright &copy; ApoloGym {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</footer>

<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')

</body>

</html>
