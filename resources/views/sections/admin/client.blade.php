@extends('layouts.dashboard')

@section('title', 'Detalles del cliente')
@section('content')
    <client-details :instructor="instructor"
                    :instructors="instructors"
                    :client="client"
                    :fetch-client="fetchClient"
                    :fetch-instructors="fetchInstructors">
    </client-details>
    <!--
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user"></i> {{ ucwords($client->name) }}
                </div>
                <div class="panel-body text-center">
                    <img class="img img-responsive img-thumbnail" src="{{ asset('/imgs/home/profile.jpg') }}" alt="">
                </div>
            </div>

        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-book"></i> Datos personales
                        </div>
                        <div class="panel-body">
                            <h4><i class="fa fa-user-circle" aria-hidden="true"></i> Nombre(s)</h4>
                            <div class="input-group">
                                <input class="form-control" type="text" value="{{ $client->name }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-success"><i class="fa fa-check-circle" aria-hidden="true"></i></button>
                                </span>
                            </div>
                            <p>{{ $client->name }}</p>
                            <div class="divider"></div>
                            <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido paterno</h4>
                            <p>{{ $client->first_surname }}</p>
                            <div class="divider"></div>
                            <h4><i class="fa fa-users" aria-hidden="true"></i> Apellido materno</h4>
                            <p>{{ $client->second_surname }}</p>
                            <div class="divider"></div>
                            <h4>
                                <i class="fa fa-{{ $client->gender == 'm' ? 'mars' : 'venus' }}"
                                   aria-hidden="true"></i>
                                Género
                            </h4>
                            <p>{{ $client->gender == 'm' ? 'Masculino' : 'Femenino  ' }}</p>
                            <div class="divider"></div>
                            <h4><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de nacimiento</h4>
                            <p>{{ $client->birth_date }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-money"></i> Datos de facturación
                        </div>
                        <div class="panel-body">
                            <h4><i class="fa fa-id-card" aria-hidden="true"></i> Rfc</h4>
                            <p>{{ $client->rfc }}</p>
                            <div class="divider"></div>
                            <h4><i class="fa fa-map-marker" aria-hidden="true"></i> Dirección</h4>
                            <p>{{ $client->address }}</p>
                            <div class="divider"></div>
                            <h4><i class="fa fa-phone" aria-hidden="true"></i> Teléfono</h4>
                            <p>{{ $client->phone_number }}</p>
                            <div class="divider"></div>
                            <h4><i class="fa fa-calendar" aria-hidden="true"></i> Fecha de último pago</h4>
                            <p>{{ $client->birth_date }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-offset-4">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-heartbeat"></i> Datos de gimnasio
                    </div>
                    <div class="panel-body">
                        <h4><i class="fa fa-male" aria-hidden="true"></i> Altura</h4>
                        <p>{{ $client->height }} cm.</p>
                        <div class="divider"></div>
                        <h4><i class="fa fa-street-view" aria-hidden="true"></i> Peso</h4>
                        <p>{{ $client->weight }} kg.</p>
                        <div class="divider"></div>
                        <h4><i class="fa fa-user" aria-hidden="true"></i> Instructor</h4>
                        <p>
                            <a href="{{url('dashboard/instructors/'.$client->instructor->id)}}">
                                {{ $client->instructor->name }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    -->
@endsection