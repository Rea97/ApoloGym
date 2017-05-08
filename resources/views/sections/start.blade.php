@inject('input', '\Illuminate\Support\Facades\Input')
@inject('carbon', '\Carbon\Carbon')

@extends('layouts.dashboard')

@section('title', 'Inicio')
@section('content')
    @if(isAdmin())
        <div class="row">
            <div class="col-sm-4 col-md-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $summary['new_clients'] }}</div>
                                <div>
                                    {{ $summary['new_clients'] === 1 ? 'Nuevo cliente' : 'Nuevos clientes' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.clients') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-sm-4 col-md-4">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $summary['new_invoices'] }}</div>
                                <div>
                                    {{ $summary['new_invoices'] === 1 ? 'Nueva factura' : 'Nuevas facturas' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.invoices') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-sm-4 col-md-4">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-bell fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{ $summary['notifications'] }}</div>
                                <div>
                                    {{ $summary['notifications'] === 1 ? 'Nueva notificación' : 'Nuevas notificaciones' }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.profile') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Ver detalles</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @include('partials.admin.finances')
    @elseif(isClient())
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
                                <div class="huge">{{ $posts->count() }}</div>
                                <div>{{ $posts->count() === 1 ? 'Nueva noticia' : 'Nuevas noticias' }}</div>
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
                                <div class="huge">{{ $notifications->count() }}</div>
                                <div>{{ $notifications->count() === 1 ? 'Notificación' : 'Notificaciones' }}</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('dashboard.profile') }}">
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
                            @forelse($posts as $post)
                                <div class="col-sm-6 col-md-6">
                                    <div class="thumbnail">
                                        <img src="{{ getPostImage($post) }}" alt="{{ $post->title }}">
                                        <div class="caption">
                                            <h3>{{ $post->title }}</h3>
                                            <p>{{ str_limit($post->description) }}</p>
                                            <p>
                                                <a target="_blank" href="{{ url('/blog/posts/'.$post->id) }}" class="btn btn-primary" role="button">Leer más...</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <h2>No hay noticias.</h2>
                            @endforelse


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
                            @forelse($notifications as $notification)
                                <a href="{{ $notification->data['action'] }}" class="list-group-item">
                                    <i class="fa fa-fw {{ $notification->data['icon'] }}"></i> {{ $notification->data['message'] }}
                                        <span class="pull-right text-muted small">
                                        <em>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $notification->created_at)->diffForHumans() }}</em>
                                    </span>
                                    <br>&nbsp;
                                </a>
                                @empty
                                    <span class="text-muted text-center">No hay notificaciones sin leer.</span>
                            @endforelse
                        </div>
                        <!-- /.list-group -->
                        @if($notifications->count() > 0)
                            <a href="{{ route('dashboard.profile') }}" class="btn btn-default btn-block">Ver más...</a>
                        @endif
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->


            </div>
            <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->
    @endif
@endsection
@push('scripts')
    <script>
        let data = JSON.parse('');

        new Morris.Donut({
            element: 'incomes-expenses-last-month',
            data: [
                {label: "Download Sales", value: 12},
                {label: "In-Store Sales", value: 30},
                {label: "Mail-Order Sales", value: 20}
            ],
            colors: [
                '#ABD324',
                '#DADD21',
                '#eee'
            ]
        });



        /*$(function() {

            Morris.Area({
                element: 'morris-area-chart',
                data: [{
                    period: '2010 Q1',
                    iphone: 2666,
                    ipad: null,
                    itouch: 2647
                }, {
                    period: '2010 Q2',
                    iphone: 2778,
                    ipad: 2294,
                    itouch: 2441
                }, {
                    period: '2010 Q3',
                    iphone: 4912,
                    ipad: 1969,
                    itouch: 2501
                }, {
                    period: '2010 Q4',
                    iphone: 3767,
                    ipad: 3597,
                    itouch: 5689
                }, {
                    period: '2011 Q1',
                    iphone: 6810,
                    ipad: 1914,
                    itouch: 2293
                }, {
                    period: '2011 Q2',
                    iphone: 5670,
                    ipad: 4293,
                    itouch: 1881
                }, {
                    period: '2011 Q3',
                    iphone: 4820,
                    ipad: 3795,
                    itouch: 1588
                }, {
                    period: '2011 Q4',
                    iphone: 15073,
                    ipad: 5967,
                    itouch: 5175
                }, {
                    period: '2012 Q1',
                    iphone: 10687,
                    ipad: 4460,
                    itouch: 2028
                }, {
                    period: '2012 Q2',
                    iphone: 8432,
                    ipad: 5713,
                    itouch: 1791
                }],
                xkey: 'period',
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['iPhone', 'iPad', 'iPod Touch'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });

            Morris.Donut({
                element: 'morris-donut-chart',
                data: [{
                    label: "Download Sales",
                    value: 12
                }, {
                    label: "In-Store Sales",
                    value: 30
                }, {
                    label: "Mail-Order Sales",
                    value: 20
                }],
                resize: true
            });

            Morris.Bar({
                element: 'morris-bar-chart',
                data: [{
                    y: '2006',
                    a: 100,
                    b: 90
                }, {
                    y: '2007',
                    a: 75,
                    b: 65
                }, {
                    y: '2008',
                    a: 50,
                    b: 40
                }, {
                    y: '2009',
                    a: 75,
                    b: 65
                }, {
                    y: '2010',
                    a: 50,
                    b: 40
                }, {
                    y: '2011',
                    a: 75,
                    b: 65
                }, {
                    y: '2012',
                    a: 100,
                    b: 90
                }],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Series A', 'Series B'],
                hideHover: 'auto',
                resize: true
            });

        });
        */
    </script>
@endpush