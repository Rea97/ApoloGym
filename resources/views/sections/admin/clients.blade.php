@extends('layouts.dashboard')

@section('title', 'Clientes')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                @if(session('success') || session('error'))
                    <div class="col-sm-12">
                        <div class="alert alert-dismissable {{ session('success') ? 'alert-success' : 'alert-danger' }}">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            {{ session('success') ? session('success') : session('error') }}
                        </div>
                    </div>
                @endif
                <div class="col-sm-8 col-md-8 col-lg-10">
                    <pagination
                            :fetch-clients="fetchClients"
                            v-bind:pagination="pagination"
                            v-on:click.native="fetchClients(true, pagination.current_page)"
                            :offset="4">
                    </pagination>
                </div>
                <div class="col-sm-4 col-md-4 col- col-lg-2">
                    <a href="{{ route('dashboard.client.create') }}" class="btn btn-success btn-block pull-right">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Nuevo registro
                    </a>
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
                        <span v-show="!loaded" class="pull-right">
                            <i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Cargando...
                        </span>
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
                        <tr v-cloak v-for="client in clients">
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
                                <a :href="'/dashboard/clientes/'+client.id">
                                    Ver detalles
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="row">
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