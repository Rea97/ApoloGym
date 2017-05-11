@inject('carbon', '\Carbon\Carbon')
@extends('layouts.dashboard')

@section('title', 'Clientes instruidos')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--  Resumen de clientes Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-cubes" aria-hidden="true"></i> Clientes que instruye
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Altura</th>
                            <th>Peso</th>
                            <th>Edad</th>
                            <th>Tiempo inscrito</th>
                            <th>&nbsp;</th>
                        </tr>
                        @forelse($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->first_surname }} {{ $client->second_surname ?? '' }}</td>
                                <td>{{ $client->height }} cm.</td>
                                <td>{{ $client->weight }} kg.</td>
                                <td>
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d', $client->birth_date)->age }}
                                </td>
                                <td>{{ \Carbon\Carbon::createFromFormat('Y-m-d', explode(' ', $client->created_at)[0])->diffForHumans() }}</td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{ route('dashboard.exercisesOfClient', [$client->id]) }}">
                                        <i class="fa fa-tasks" aria-hidden="true"></i>
                                    </a>
                                    <a class="btn btn-sm btn-warning" href="{{ route('dashboard.chatWithClient', [$client->id]) }}">
                                        <i class="fa fa-comment" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <h4>Actualmente no hay clientes asignados.</h4>
                                    </td>
                                </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection