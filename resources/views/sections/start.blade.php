@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-envelope fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">26</div>
                            <div>Nuevos mensajes</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-th-list fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">12</div>
                            <div>Nuevas rutinas</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-book fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">124</div>
                            <div>Nuevas noticias</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-bell fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">13</div>
                            <div>Notificaciones</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-book fa-fw"></i> Ultimas noticias
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                                <img src="{{ asset('imgs/home/noticia.jpg') }}" alt="...">
                                <div class="caption">
                                    <h3>Nueva noticia</h3>
                                    <p>Contenido de la nueva noticia...</p>
                                    <p>
                                        <a href="#" class="btn btn-primary" role="button">Leer más...</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                                <img src="{{ asset('imgs/home/noticia.jpg') }}" alt="...">
                                <div class="caption">
                                    <h3>Nueva noticia</h3>
                                    <p>Contenido de la nueva noticia...</p>
                                    <p>
                                        <a href="#" class="btn btn-primary" role="button">Leer más...</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                                <img src="{{ asset('imgs/home/noticia.jpg') }}" alt="...">
                                <div class="caption">
                                    <h3>Nueva noticia</h3>
                                    <p>Contenido de la nueva noticia...</p>
                                    <p>
                                        <a href="#" class="btn btn-primary" role="button">Leer más...</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                                <img src="{{ asset('imgs/home/noticia.jpg') }}" alt="...">
                                <div class="caption">
                                    <h3>Nueva noticia</h3>
                                    <p>Contenido de la nueva noticia...</p>
                                    <p>
                                        <a href="#" class="btn btn-primary" role="button">Leer más...</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                                <img src="{{ asset('imgs/home/noticia.jpg') }}" alt="...">
                                <div class="caption">
                                    <h3>Nueva noticia</h3>
                                    <p>Contenido de la nueva noticia...</p>
                                    <p>
                                        <a href="#" class="btn btn-primary" role="button">Leer más...</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                            <div class="thumbnail">
                                <img src="{{ asset('imgs/home/noticia.jpg') }}" alt="...">
                                <div class="caption">
                                    <h3>Nueva noticia</h3>
                                    <p>Contenido de la nueva noticia...</p>
                                    <p>
                                        <a href="#" class="btn btn-primary" role="button">Leer más...</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Notificaciones
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class="fa fa-envelope fa-fw"></i> Mensaje recibido
                            <span class="pull-right text-muted small"><em>Hace 30 minutos</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-tasks fa-fw"></i> Nueva rutina
                            <span class="pull-right text-muted small"><em>Hace 42 minutos</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-upload fa-fw"></i> Archivo subido
                            <span class="pull-right text-muted small"><em>22:32</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-trash fa-fw"></i> Archivo eliminado
                            <span class="pull-right text-muted small"><em>10:50</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-envelope fa-fw"></i> Mensaje recibido
                            <span class="pull-right text-muted small"><em>10:10</em>
                                    </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-money fa-fw"></i> Nueva factura
                            <span class="pull-right text-muted small"><em>Ayer</em>
                                    </span>
                        </a>
                    </div>
                    <!-- /.list-group -->
                    <a href="#" class="btn btn-default btn-block">Ver más...</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->


        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
@endsection