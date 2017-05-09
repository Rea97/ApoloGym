@extends('layouts.dashboard')

@section('title', 'Clientes')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                @include('partials.alert-notification')
                <div class="col-sm-6 col-md-8 col-lg-6">
                    <pagination
                            v-show="pagination.total > 0"
                            :fetch-clients="fetchClients"
                            v-bind:pagination="pagination"
                            v-on:click.native="fetchClients(true, pagination.current_page)"
                            :offset="4">
                    </pagination>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6">
                    <div class="row">
                        <div class="col-sm-8">
                            <input v-on:search="fetchClients(true, pagination.current_page)"
                                   v-model="search"
                                   class="form-control"
                                   type="search"
                                   placeholder="Busque un cliente...">
                        </div>
                        <div class="col-sm-4">
                            <a href="{{ route('dashboard.client.create') }}" class="btn btn-success btn-block pull-right">
                                <i class="fa fa-user-plus" aria-hidden="true"></i> <span class="hidden-sm hidden-md">Nuevo registro</span>
                            </a>
                        </div>
                    </div>
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
                        <tr v-show="loaded" v-cloak v-for="client in clients">
                            <td>
                                <a :href="'/dashboard/clientes/'+client.id">
                                    @{{ client.id }}
                                </a>
                            </td>
                            <td>@{{ client.name }}</td>
                            <td>@{{ client.first_surname }} @{{ client.second_surname }}</td>
                            <td>@{{ client.email }}</td>
                            <td>@{{ client.phone_number }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" :href="'/dashboard/clientes/'+client.id">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </a>
                                <a class="btn btn-warning btn-sm" :href="'/dashboard/clientes/'+client.id+'/chat'">
                                    <i class="fa fa-comment" aria-hidden="true"></i>
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
                                <h4>Actualmente no hay clientes registrados.</h4>
                            </td>
                        </tr>
                        -->
                    </table>
                </div>
                <div class="panel-footer">
                    <div v-show="pagination.total <= 0">
                        <strong>No</strong> hay clientes registrados.
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
                                            v-on:change="fetchClients(true, pagination.current_page)"
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

@push('scripts')
    {{-- Envío de notificaciones mediante javascript, aún en revision si usar swal o toastr --}}
    @if(session('success'))
        <!--
        <script>
            swal("Correcto", "{{ session('success') }}", "success");
        </script>
    @elseif(session('error'))
        <script>
            swal("Error", "{{ session('error') }}", "error");
        </script>
        -->
    @endif
@endpush