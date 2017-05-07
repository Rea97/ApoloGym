@extends('layouts.dashboard')
@section('title', 'Noticias')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-6 col-md-8 col-lg-6">
                    <pagination
                            v-show="pagination.total > 0"
                            :fetch-clients="fetchPosts"
                            v-bind:pagination="pagination"
                            v-on:click.native="fetchPosts(true, pagination.current_page)"
                            :offset="4">
                    </pagination>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-6">
                    <div class="row">
                        <div class="col-sm-8">
                            <input v-on:search="fetchPosts(true, pagination.current_page)"
                                   v-model="search"
                                   class="form-control"
                                   type="search"
                                   placeholder="Busque una noticia...">
                        </div>
                        <div class="col-sm-4">
                            <a href="{{ route('dashboard.posts.create') }}" class="btn btn-success btn-block pull-right">
                                <i class="fa fa-plus" aria-hidden="true"></i> <span class="hidden-sm hidden-md">Nueva noticia</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--  Noticias Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-newspaper-o" aria-hidden="true"></i> Resúmen de noticias
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <tr>
                            <th class="col-sm-1">Id</th>
                            <th class="col-sm-2">Título</th>
                            <th class="col-sm-4">Descripción</th>
                            <th class="col-sm-2">Fecha de creación</th>
                            <th class="col-sm-2">Fecha de modificación</th>
                            <th class="col-sm-1">&nbsp;</th>
                        </tr>
                        <tr v-show="loaded" v-cloak v-for="post in posts">
                            <td>
                                <a :href="'/dashboard/noticias/'+post.id">
                                    @{{ post.id }}
                                </a>
                            </td>
                            <td>@{{ post.title }}</td>
                            <td>@{{ post.description }}</td>
                            <td>@{{ post.created_at }}</td>
                            <td>@{{ post.updated_at }}</td>
                            <td>
                                <a class="btn btn-sm btn-info" :href="'/dashboard/noticias/'+post.id">
                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                </a>
                                <button v-on:click="deletePost(post.id)" type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>
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
                        <strong>No</strong> hay noticias creadas.
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
                                            v-on:change="fetchPosts(true, pagination.current_page)"
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