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
                <a href="{{ route('dashboard.inicio') }}"
                   class="{{ url()->current() == route('dashboard.inicio') ? 'active' : '' }}">
                    <i class="fa fa-home fa-fw"></i> Inicio
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.routines') }}"
                   class="{{ url()->current() == route('dashboard.routines') ? 'active' : '' }}">
                    <i class="fa fa-th-list fa-fw"></i> Rutinas
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.diets') }}"
                   class="{{ url()->current() == route('dashboard.diets') ? 'active' : '' }}">
                    <i class="fa fa-cutlery fa-fw"></i> Dieta
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.progress') }}"
                   class="{{ url()->current() == route('dashboard.progress') ? 'active' : '' }}">
                    <i class="fa fa-line-chart fa-fw"></i> Progreso
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.schedule') }}"
                   class="{{ url()->current() == route('dashboard.schedule') ? 'active' : '' }}">
                    <i class="fa fa-calendar fa-fw"></i> Horario
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard.instructor') }}"
                   class="{{ url()->current() == route('dashboard.instructor') ? 'active' : '' }}">
                    <i class="fa fa-user fa-fw"></i> Instructor
                </a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->