@extends('layouts.dashboard')

@section('title', 'Nuevo registro')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <!--  Create New Service Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregue un servicio
                    </h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('services.store') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend>
                                <small>
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                </small>
                                Datos del servicio
                            </legend>
                            <div class="row">
                                <!--  name Form Field  -->
                                <div class="form-group col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                    <label for="name">Nombre(s)</label>
                                    <input id="name"
                                           name="name"
                                           type="text"
                                           class="form-control"
                                           value="{{ old('name') }}"
                                           placeholder="Nombre o nombres del cliente">
                                    @if($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <!--  price Form Field  -->
                                <div class="form-group col-sm-6 {{ $errors->has('price') ? 'has-error' : '' }}">
                                    <label for="price">Precio</label>
                                    <input id="price"
                                           name="price"
                                           type="number"
                                           class="form-control"
                                           step="0.01"
                                           value="{{ old('price') }}">
                                    @if($errors->has('price'))
                                        <span class="help-block">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                                <!--  description Form Field  -->
                                <div class="form-group col-sm-12 {{ $errors->has('description') ? 'has-error' : '' }}">
                                    <label for="description">Descripción</label>
                                    <textarea name="description"
                                              id="description"
                                              class="form-control"
                                              cols="30"
                                              rows="10">{{ old('description') }}</textarea>
                                    @if($errors->has('description'))
                                        <span class="help-block">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>

                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                Registrar Servicio
                            </button>
                            <button type="reset" class="btn btn-warning">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                                Limpiar Campos Del Formulario
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection