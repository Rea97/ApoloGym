@extends('layouts.dashboard')

@section('title', 'Instructores')
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
                <div class="col-sm-6 col-md-8 col-lg-6">
                    <pagination
                            :fetch-instructors="fetchInstructors"
                            v-bind:pagination="pagination"
                            v-on:click.native="fetchInstructors(true, pagination.current_page)"
                            :offset="4">
                    </pagination>
                </div>
                <div class="col-sm-6 col-md-4 col- col-lg-6">
                    <div class="row">
                        <div class="col-sm-8">
                            <input @keyup="fetchInstructors(true, pagination.current_page)"
                                    v-model="search"
                                    class="form-control"
                                    type="text"
                                    placeholder="Busca un instructor...">
                        </div>
                        <div class="col-sm-4">
                            <a href="{{-- route('dashboard.instructor.create') --}}" class="btn btn-success btn-block pull-right">
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
            <!--  Resumen de instructors Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-users" aria-hidden="true"></i> Resúmen de Instructores
                    </h4>
                </div>
                <!--<div class="panel-body">
                    <div class="row">
                        <div class="col-sm-4 col-sm-offset-4">
                            <input class="form-control input-sm" type="text">
                        </div>
                    </div>
                </div>-->
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
                        <tr v-cloak v-for="instructor in instructors">
                            <td>
                                <a :href="'/dashboard/instructores/'+instructor.id">
                                    @{{ instructor.id }}
                                </a>
                            </td>
                            <td>@{{ instructor.name }}</td>
                            <td>@{{ instructor.first_surname }} @{{ instructor.second_surname }}</td>
                            <td>@{{ instructor.email }}</td>
                            <td>@{{ instructor.phone_number }}</td>
                            <td>
                                <a :href="'/dashboard/instructores/'+instructor.id">
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
                                            v-on:change="fetchInstructors(true, pagination.current_page)"
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