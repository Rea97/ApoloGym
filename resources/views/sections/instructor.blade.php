@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user"></i> Juan Carlos
                </div>
                <div class="panel-body text-center">
                    <img class="img img-responsive img-thumbnail" src="{{ asset('/imgs/home/instructor2.jpg') }}" alt="">
                </div>
            </div>

        </div>
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-book"></i> Biografía
                </div>
                <div class="panel-body">
                    <h4>Nombre Completo</h4>
                    <p>Juan Carlos Hernández Rodríguez</p>
                    <h4>Edad</h4>
                    <p>26</p>
                    <h4>Teléfono</h4>
                    <p>044 811 738 39 12</p>
                    <h4>Correo electrónico</h4>
                    <p>juan@gmail.com</p>
                    <h4>Acerca de él</h4>
                    <p>Soy una persona apasionada por el ejercicio, para mí, es una parte fundamental de la vida y creo
                    que todos deberían dedicar al menos 60 minutos al día de su tiempo.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="chat-panel panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i> Conversación
            <!-- Botón de esquina superior derecha
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-chevron-down"></i>
                </button>
                <ul class="dropdown-menu slidedown">
                    <li>
                        <a href="#">
                            <i class="fa fa-refresh fa-fw"></i> Refresh
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-check-circle fa-fw"></i> Available
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-times fa-fw"></i> Busy
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-clock-o fa-fw"></i> Away
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="#">
                            <i class="fa fa-sign-out fa-fw"></i> Sign Out
                        </a>
                    </li>
                </ul>
            </div>
            -->
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <ul class="chat">
                <li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Juan Carlos</strong>
                            <small class="pull-right text-muted">
                                <i class="fa fa-clock-o fa-fw"></i> Hace 30 minutos
                            </small>
                        </div>
                        <p>
                            Hola!
                        </p>
                    </div>
                </li>
                <li class="right clearfix">
                    <span class="chat-img pull-right">
                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <small class=" text-muted">
                                <i class="fa fa-clock-o fa-fw"></i> Hace 29 minutos</small>
                            <strong class="pull-right primary-font">Tú</strong>
                        </div>
                        <p>
                            Hola :)
                        </p>
                    </div>
                </li>
                <li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Juan Carlos</strong>
                            <small class="pull-right text-muted">
                                <i class="fa fa-clock-o fa-fw"></i> Hace 15 minutos</small>
                        </div>
                        <p>
                            Solo quería aprovechar para felicitarte por tu entrada al gimnasio.
                        </p>
                    </div>
                </li>
                <li class="right clearfix">
                    <span class="chat-img pull-right">
                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <small class=" text-muted">
                                <i class="fa fa-clock-o fa-fw"></i> Hace 12 minutos</small>
                            <strong class="pull-right primary-font">Tú</strong>
                        </div>
                        <p>
                            Oh gracias es parte de mi nuevo propósito
                        </p>
                    </div>
                </li>
                <li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Juan Carlos</strong>
                            <small class="pull-right text-muted">
                                <i class="fa fa-clock-o fa-fw"></i> Hace 12 minutos
                            </small>
                        </div>
                        <p>
                            Excelente, también aprovecho para mencionarte que dentro de poco subiré las rutinas con las que empezarás, para que las veas :)
                        </p>
                    </div>
                </li>
                <li class="right clearfix">
                    <span class="chat-img pull-right">
                        <img src="http://placehold.it/50/FA6F57/fff" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <small class=" text-muted">
                                <i class="fa fa-clock-o fa-fw"></i> Hace 10 minutos</small>
                            <strong class="pull-right primary-font">Tú</strong>
                        </div>
                        <p>
                            Muy bien, estaré revisándolo
                        </p>
                    </div>
                </li>

                <li class="left clearfix">
                    <span class="chat-img pull-left">
                        <img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="img-circle" />
                    </span>
                    <div class="chat-body clearfix">
                        <div class="header">
                            <strong class="primary-font">Juan Carlos</strong>
                            <small class="pull-right text-muted">
                                <i class="fa fa-clock-o fa-fw"></i> Hace 3 minutos</small>
                        </div>
                        <p>
                            okay, te veo mañana :)
                        </p>
                    </div>
                </li>

            </ul>
        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
            <div class="input-group">
                <input id="btn-input" type="text" class="form-control input-sm" placeholder="Escribe tú mensaje aquí." />
                <span class="input-group-btn">
                    <button class="btn btn-warning btn-sm" id="btn-chat">
                        Enviar
                    </button>
                </span>
            </div>
        </div>
        <!-- /.panel-footer -->
    </div>
    <!-- /.panel .chat-panel -->
@endsection