@extends('layouts.dashboard')

@section('title', 'Instructores')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                @include('partials.alert-notification')
                <div class="col-sm-6 col-md-8 col-lg-6">
                    <pagination
                            v-show="pagination.total > 0"
                            :fetch-instructors="fetchInstructors"
                            v-bind:pagination="pagination"
                            v-on:click.native="fetchInstructors(true, pagination.current_page)"
                            :offset="4">
                    </pagination>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6">
                    <div class="row">
                        <div class="col-sm-8">
                            <!--
                            De esta forma se consiguen resultados no tan buenos en la búsqueda sin embargo es más amigable
                            con el usuario porque obtiene feedback cada que presiona una tecla.
                            El punto negativo es que el performance es malo debido a que se realizan demasiadas peticiones ajax.
                            Esta técnica es mejor implementarla  pero realizando la búsqueda a nivel client side.
                            <input v-on:keyup="fetchInstructors(true, pagination.current_page)"
                            v-model="search"
                            class="form-control"
                            type="text"
                            placeholder="Busca un instructor...">
                            -->
                            <!--
                            De esta forma, la búsqueda funciona de una manera más eficiente, además de que
                            no se realizan tantas peticiones, sin embargo no es tan amigable con el usuario
                            ya que debe presionar enter para cada busqueda
                            -->
                            <input v-on:search="fetchInstructors(true, pagination.current_page)"
                                    v-model="search"
                                    class="form-control"
                                    type="search"
                                    placeholder="Busque un instructor...">
                        </div>
                        <div class="col-sm-4">
                            <a href="{{ route('dashboard.instructor.create') }}" class="btn btn-success btn-block pull-right">
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
                        <tr v-show="loaded" v-cloak v-for="instructor in instructors">
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
                                <a data-toggle="tooltip"
                                    data-placement="top"
                                    title="Perfil del instructor"
                                    class="btn btn-sm btn-info"
                                    :href="'/dashboard/instructores/'+instructor.id">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </a>
                                <a data-toggle="tooltip"
                                   data-placement="top"
                                   title="Enviar mensaje"
                                   class="btn btn-warning btn-sm" :href="'/dashboard/instructores/'+instructor.id+'/chat'">
                                    <i class="fa fa-comment" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        <tr v-show="!loaded">
                            <td colspan="6" class="text-center">
                                <h4><i class="fa fa-spinner fa-pulse" aria-hidden="true"></i> Cargando...</h4>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="panel-footer">
                    <div v-show="pagination.total <= 0">
                        <strong>No</strong> hay instructores registrados.
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