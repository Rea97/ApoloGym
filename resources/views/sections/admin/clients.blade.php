@extends('layouts.dashboard')

@section('title', 'Clientes')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            {{ $clients->links() }}
            <button class="btn btn-success pull-right">
                <i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo registro
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--  Resumen de clientes Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-users" aria-hidden="true"></i> Resúmen de clientes
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>&nbsp;</th>
                        </tr>
                        @foreach($clients as $client)
                            <tr>
                                <td>
                                    <a href="{{route('dashboard.client', $client->id)}}">
                                        {{ $client->id }}
                                    </a>
                                </td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->first_surname }} {{ $client->second_surname }}</td>
                                <td>{{ $client->email }}</td>
                                <td>{{ $client->phone_number }}</td>
                                <td>
                                    <a href="{{route('dashboard.client', $client->id)}}">
                                        Ver detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            
        </div>
    </div>
@endsection