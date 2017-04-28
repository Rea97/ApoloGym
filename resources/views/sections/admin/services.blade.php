@extends('layouts.dashboard')

@section('title', 'Servicios')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                @include('partials.alert-notification')
                <div class="col-sm-6 col-md-8 col-lg-6">
                    <pagination
                            v-show="pagination.total > 0"
                            :fetch-services="fetchServices"
                            v-bind:pagination="pagination"
                            v-on:click.native="fetchServices(true, pagination.current_page)"
                            :offset="4">
                    </pagination>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6">
                    <div class="row">
                        <div class="col-sm-8">
                            <input v-on:search="fetchServices(true, pagination.current_page)"
                                   v-model="search"
                                   class="form-control"
                                   type="search"
                                   placeholder="Busque un servicio...">
                        </div>
                        <div class="col-sm-4">
                            <a href="{{ route('dashboard.service.create') }}" class="btn btn-success btn-block pull-right">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> <span class="hidden-sm hidden-md">Nuevo registro</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--  Resumen de servicios Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-cubes" aria-hidden="true"></i> Resúmen de servicios
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <tr>
                            <th class="col-sm-1">Id</th>
                            <th class="col-sm-1">Nombre</th>
                            <th class="col-sm-4">Descripción</th>
                            <th class="col-sm-1">Precio</th>
                            <th class="col-sm-2">Fecha de creación</th>
                            <th class="col-sm-2">Fecha de actualización</th>
                            <th class="col-sm-1">&nbsp;</th>
                        </tr>
                        <tr v-show="loaded" v-cloak v-for="service in services">
                            <td>
                                <a :href="'/dashboard/servicios/'+service.id">
                                    @{{ service.id }}
                                </a>
                            </td>
                            <td>@{{ service.name }}</td>
                            <td>@{{ service.description.substr(0, 60) }}...</td>
                            <td>$ @{{ service.price }}</td>
                            <td>@{{ service.created_at }}</td>
                            <td>@{{ service.updated_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" :href="'/dashboard/servicios/'+service.id">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                    Detalles
                                </a>
                            </td>
                        </tr>
                        <tr v-show="!loaded">
                            <td colspan="6" class="text-center">
                                <h4><i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Cargando...</h4>
                            </td>
                        </tr>
                        <!--
                        FIXME: Se muestra aún cuando aparece el spin de carga.
                        <tr v-show="loaded && pagination.total <= 0">
                            <td colspan="6" class="text-center">
                                <h4>Actualmente no hay servicios registrados.</h4>
                            </td>
                        </tr>
                        -->
                    </table>
                </div>
                <div class="panel-footer">
                    <div v-show="pagination.total <= 0">
                        <strong>No</strong> hay servicios registrados.
                    </div>
                    <div v-show="pagination.total > 0" class="row">
                        <div class="col-sm-8">
                            <span v-cloak>
                                Mostrando <b>@{{ pagination.from }}</b> a <b>@{{ pagination.to }}</b> de <b>@{{ pagination.total }}</b> registros
                            </span>
                        </div>
                        <div class="col-sm-4">
                            <div class="pull-right form-inline">
                                <div class="form-group">
                                    <label class="control-label" for="quantity">Mostrar: </label>
                                    <select v-model="pagination.per_page"
                                            v-on:change="fetchServices(true, pagination.current_page)"
                                            class="form-control input-sm"
                                            name="quantity"
                                            id="quantity">
                                        <option value="10">10</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection