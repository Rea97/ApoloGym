@extends('layouts.dashboard')

@section('title', 'Perfil')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user"></i> {{ ucwords(Auth::user()->name) }}
                </div>
                <div class="panel-body text-center">
                    <img class="img img-responsive img-thumbnail" src="{{ asset('/imgs/home/profile.jpg') }}" alt="">
                </div>
            </div>

        </div>
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-book"></i> Información de perfil
                </div>
                <div class="panel-body">
                    <p>Te sugerimos que llenes la siguiente información acerca de ti
                    para poder conocerte mejor, y poder brindarte un mejor servicio.</p>
                    <form action="">
                        <!--  name Form Field  -->
                        <div class="form-group">
                            <label for="name">Nombre</label>
                            <input id="name"
                                    name="name"
                                    type="text"
                                    class="form-control input-sm"
                                    placeholder="">
                        </div>
                        <!--  lastname Form Field  -->
                        <div class="form-group">
                            <label for="lastname">Apellidos</label>
                            <input id="lastname"
                                    name="lastname"
                                    type="text"
                                   class="form-control input-sm"
                                    placeholder="">
                        </div>
                        <!--  aboutme Form Text Area  -->
                        <label for="aboutme">Acerca de mí</label>
                        <textarea name="aboutme"
                                    id="aboutme"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Escribe una breve descripción acerca de ti"></textarea>
                        <span class="help-block">Texto de ayuda</span>


                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection