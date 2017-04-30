<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-messages">
            <li>
                <a href="#">
                    <div>
                        <strong>Instructor</strong>
                        <span class="pull-right text-muted">
                                        <em>Ayer</em>
                                    </span>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <strong>Instructor</strong>
                        <span class="pull-right text-muted">
                                        <em>Ayer</em>
                                    </span>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <strong>Instructor</strong>
                        <span class="pull-right text-muted">
                                        <em>Ayer</em>
                                    </span>
                    </div>
                    <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque eleifend...</div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>Ver todos los mensajes</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>
        <!-- /.dropdown-messages -->
    </li>
    <!-- /.dropdown -->
    <!-- Tareas pendiente
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-tasks">
            <li>
                <a href="#">
                    <div>
                        <p>
                            <strong>Cargando imagen</strong>
                            <span class="pull-right text-muted">40% Completado</span>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                <span class="sr-only">40% Completado (success)</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <p>
                            <strong>Cargando video</strong>
                            <span class="pull-right text-muted">20% Completado</span>
                        </p>
                        <div class="progress progress-striped active">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                <span class="sr-only">20% Completado</span>
                            </div>
                        </div>
                    </div>
                </a>
            </li>

            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>Ver todas las tareas</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>
        </ul>-->
        <!-- /.dropdown-tasks -->
    <!--</li>-->
    <!-- /.dropdown -->

    <notifications-list></notifications-list>
    <!--
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">


            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-comment fa-fw"></i> Nueva Noticia
                        <span class="pull-right text-muted small">Hace 4 minutos</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-envelope fa-fw"></i> Mensaje enviado
                        <span class="pull-right text-muted small">Hace 4 minutos</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-tasks fa-fw"></i> Nueva rutina
                        <span class="pull-right text-muted small">Hace 4 minutos</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a href="#">
                    <div>
                        <i class="fa fa-cutlery fa-fw"></i> Nueva Dieta
                        <span class="pull-right text-muted small">Hace 4 minutos</span>
                    </div>
                </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>Ver todas las notificaciones</strong>
                    <i class="fa fa-angle-right"></i>
                </a>
            </li>

        </ul>

    </li>
    -->
    <!-- /.dropdown -->
    <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
            <li><a href="{{ route('dashboard.profile') }}"><i class="fa fa-user fa-fw"></i> Perfil</a>
            </li>
            <li><a href="{{ route('dashboard.settings') }}"><i class="fa fa-gear fa-fw"></i> Ajustes</a>
            </li>
            <li class="divider"></li>
            <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out fa-fw"></i> Salir</a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </ul>
        <!-- /.dropdown-user -->
    </li>
    <!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->