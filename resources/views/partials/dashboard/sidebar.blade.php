<!--<div class="navbar-default sidebar" role="navigation"> tema anterior     -->
<div class="sidebar" role="navigation"> <!-- Flaty -->
    <div class="sidebar-nav navbar-collapse">
        <div class="visible-lg">
            <div class="container visible-lg" style="margin-top: 14px">
                <img class="img img-responsive pull-left" style="width: 32px" src="{{ getPP(currentAuth()) }}" alt="">&nbsp;
                <h4 class="pull-left">Bienvenido, {{ currentAuth()->name }}</h4>
            </div>
            <div class="divider" style="margin-bottom: 0"></div>
        </div>
        <ul class="nav" id="side-menu">
            <!--
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>
            -->
            <li>
                <a href="{{ route('dashboard.start') }}"
                   class="li-sidebar {{ markAsActive(route('dashboard.start')) }}">
                    <i class="fa fa-home fa-fw"></i> Inicio
                </a>
            </li>
            @if(isClient())
                <li>
                    <a href="{{ route('dashboard.routines') }}"
                       class="li-sidebar {{ markAsActive(route('dashboard.routines')) }}">
                        <i class="fa fa-th-list fa-fw"></i> Rutinas
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.progress') }}"
                       class="li-sidebar {{ markAsActive(route('dashboard.progress')) }}">
                        <i class="fa fa-line-chart fa-fw"></i> Progreso
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.instructor') }}"
                       class="li-sidebar {{ markAsActive(route('dashboard.instructor')) }}">
                        <i class="fa fa-user fa-fw"></i> Instructor
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.client.invoices') }}"
                       class="li-sidebar {{ markAsActive(route('dashboard.client.invoices')) }}">
                        <i class="fa fa-money fa-fw"></i> Facturación
                    </a>
                </li>
            @endif
            @if(isAdmin())
                <li>
                    <a href="{{ route('dashboard.invoices') }}"
                       class="li-sidebar {{ markAsActive(route('dashboard.invoices')) }}">
                        <i class="fa fa-file-text fa-fw"></i> Facturas
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.services') }}"
                       class="li-sidebar {{ markAsActive(route('dashboard.services')) }}">
                        <i class="fa fa-cubes fa-fw"></i> Servicios
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.clients') }}"
                       class="li-sidebar {{ markAsActive(route('dashboard.clients')) }}">
                        <i class="fa fa-users fa-fw"></i> Clientes
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.instructors') }}"
                       class="li-sidebar {{ markAsActive(route('dashboard.instructors')) }}">
                        <i class="fa fa-users fa-fw"></i> Instructores
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.posts') }}"
                       class="li-sidebar {{ markAsActive(route('dashboard.posts')) }}">
                        <i class="fa fa-newspaper-o fa-fw"></i> Noticias
                    </a>
                </li>
            @endif

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->