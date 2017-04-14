<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Buscar...">
                    <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{ route('dashboard.start') }}"
                   class="{{ markAsActive(route('dashboard.start')) }}">
                    <i class="fa fa-home fa-fw"></i> Inicio
                </a>
            </li>
            @if(isClient())
                <li>
                    <a href="{{ route('dashboard.routines') }}"
                       class="{{ markAsActive(route('dashboard.routines')) }}">
                        <i class="fa fa-th-list fa-fw"></i> Rutinas
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.diets') }}"
                       class="{{ markAsActive(route('dashboard.diets')) }}">
                        <i class="fa fa-cutlery fa-fw"></i> Dietas
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.progress') }}"
                       class="{{ markAsActive(route('dashboard.progress')) }}">
                        <i class="fa fa-line-chart fa-fw"></i> Progreso
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.schedule') }}"
                       class="{{ markAsActive(route('dashboard.schedule')) }}">
                        <i class="fa fa-calendar fa-fw"></i> Horario
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.instructor') }}"
                       class="{{ markAsActive(route('dashboard.instructor')) }}">
                        <i class="fa fa-user fa-fw"></i> Instructor
                    </a>
                </li>
            @endif
            @if(isAdmin())
                <li>
                    <a href="{{ route('dashboard.clients') }}"
                       class="{{ markAsActive(route('dashboard.clients')) }}">
                        <i class="fa fa-users fa-fw"></i> Clientes
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.instructors') }}"
                       class="{{ markAsActive(route('dashboard.instructors')) }}">
                        <i class="fa fa-users fa-fw"></i> Instructores
                    </a>
                </li>
            @endif

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->