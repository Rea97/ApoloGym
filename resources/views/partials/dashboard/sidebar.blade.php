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
                <a href="" class="{{ url()->current() == route('dashboard.inicio') ? 'active' : '' }}">
                    <i class="fa fa-home fa-fw"></i> Inicio
                </a>
            </li>
            <li>
                <a href="" >
                    <i class="fa fa-th-list fa-fw"></i> Rutinas
                </a>
            </li>
            <li>
                <a href="" class="{{-- url()->current() == route('dashboard.dieta') ? 'active' : '' --}}">
                    <i class="fa fa-cutlery fa-fw"></i> Dieta
                </a>
            </li>
            <li>
                <a href="" class="{{-- url()->current() == route('dashboard.progreso') ? 'active' : '' --}}">
                    <i class="fa fa-line-chart fa-fw"></i> Progreso
                </a>
            </li>
            <li>
                <a href="" class="{{-- url()->current() == route('dashboard.horario') ? 'active' : '' --}}">
                    <i class="fa fa-calendar fa-fw"></i> Horario
                </a>
            </li>
            <li>
                <a href="" class="{{-- url()->current() == route('dashboard.instructor') ? 'active' : '' --}}">
                    <i class="fa fa-user fa-fw"></i> Instructor
                </a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->