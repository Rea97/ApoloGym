@extends('layouts.dashboard')

@section('title', 'Nuevo registro')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <!--  Create New Client Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Agregue un cliente
                    </h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('client.store') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend>
                                <small>
                                    <i class="fa fa-book" aria-hidden="true"></i>
                                </small>
                                Datos personales
                            </legend>
                            <div class="row">
                                <!--  name Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('name') ? 'has-error' : '' }}">
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
                                <!--  first_surname Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('first_surname') ? 'has-error' : '' }}">
                                    <label for="first_surname">Apellido Paterno</label>
                                    <input id="first_surname"
                                           name="first_surname"
                                           type="text"
                                           class="form-control"
                                           value="{{ old('first_surname') }}"
                                           placeholder="Apellido paterno">
                                    @if($errors->has('first_surname'))
                                        <span class="help-block">{{ $errors->first('first_surname') }}</span>
                                    @endif
                                </div>
                                <!--  second_surname Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('second_surname') ? 'has-error' : '' }}">
                                    <label for="second_surname">Apellido Materno</label>
                                    <input id="second_surname"
                                           name="second_surname"
                                           type="text"
                                           class="form-control"
                                           value="{{ old('second_surname') }}"
                                           placeholder="Apellido materno">
                                    @if($errors->has('second_surname'))
                                        <span class="help-block">{{ $errors->first('second_surname') }}</span>
                                    @endif
                                </div>
                                <!--  birth_date Form Field  -->
                                <div class="form-group col-sm-6 {{ $errors->has('birth_date') ? 'has-error' : '' }}">
                                    <label for="birth_date">Fecha de nacimiento</label>
                                    <input id="birth_date"
                                            name="birth_date"
                                            type="date"
                                            class="form-control"
                                            value="{{ old('birth_date') }}">
                                    @if($errors->has('birth_date'))
                                        <span class="help-block">{{ $errors->first('birth_date') }}</span>
                                    @endif
                                </div>
                                <!--  gender Form Field  -->
                                <div class="form-group col-sm-6 {{ $errors->has('second_surname') ? 'has-error' : '' }}">
                                    <label for="gender">Género</label>
                                    <select id="gender"
                                            name="gender"
                                            class="form-control">
                                        <option value="m" {{ old('gender') === 'm' ? 'selected' : '' }}>
                                            Masculino
                                        </option>
                                        <option value="f" {{ old('gender') === 'f' ? 'selected' : '' }}>
                                            Femenino
                                        </option>
                                    </select>
                                    @if($errors->has('gender'))
                                        <span class="help-block">{{ $errors->first('gender') }}</span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                <small>
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </small>
                                Datos de facturación
                            </legend>
                            <div class="row">
                                <!--  rfc Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('rfc') ? 'has-error' : '' }}">
                                    <label for="rfc">Rfc</label>
                                    <input id="rfc"
                                            name="rfc"
                                            type="text"
                                            class="form-control"
                                            value="{{ old('rfc') }}"
                                            placeholder="Rfc del cliente, en caso de tenerlo">
                                    @if($errors->has('rfc'))
                                        <span class="help-block">{{ $errors->first('rfc') }}</span>
                                    @endif
                                </div>
                                <!--  phone_number Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                                    <label for="phone_number">Teléfono</label>
                                    <input id="phone_number"
                                            name="phone_number"
                                            type="text"
                                            class="form-control"
                                            value="{{ old('phone_number') }}"
                                            placeholder="Telefono">
                                    @if($errors->has('phone_number'))
                                        <span class="help-block">{{ $errors->first('phone_number') }}</span>
                                    @endif
                                </div>
                                <!--  address Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('address') ? 'has-error' : '' }}">
                                    <label for="address">Dirección</label>
                                    <input id="address"
                                           name="address"
                                           type="text"
                                           class="form-control"
                                           value="{{ old('address') }}"
                                           placeholder="Direccion de cliente">
                                    @if($errors->has('address'))
                                        <span class="help-block">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                <small>
                                    <i class="fa fa-heartbeat" aria-hidden="true"></i>
                                </small>
                                Datos referentes al gimnasio
                            </legend>
                            <div class="row">
                                <!--  height Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('height') ? 'has-error' : '' }}">
                                    <label for="height">Altura</label>
                                    <input id="height"
                                            name="height"
                                            type="number"
                                            class="form-control"
                                            value="{{ old('height') }}"
                                            placeholder="Altura en cm.">
                                    @if($errors->has('height'))
                                        <span class="help-block">{{ $errors->first('height') }}</span>
                                    @endif
                                </div>
                                <!--  weight Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('weight') ? 'has-error' : '' }}">
                                    <label for="weight">Peso</label>
                                    <input id="weight"
                                            name="weight"
                                            type="number"
                                            class="form-control"
                                            value="{{ old('weight') }}"
                                            placeholder="Peso en Kg.">
                                    @if($errors->has('weight'))
                                        <span class="help-block">{{ $errors->first('weight') }}</span>
                                    @endif
                                </div>
                                <!--  instructor_id Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('instructor_id') ? 'has-error' : '' }}">
                                    <label for="instructor_id">Instructor</label>
                                    <select id="instructor_id"
                                            name="instructor_id"
                                            class="form-control">
                                        @foreach($instructors as $instructor)
                                            <option value="{{ $instructor->id }}"
                                                    {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                                {{ $instructor->name }} {{ $instructor->first_surname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('instructor_id'))
                                        <span class="help-block">{{ $errors->first('insructor_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                <small>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </small>
                                Datos de la cuenta
                            </legend>
                            <div class="row">
                                <!--  email Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('email') ? 'has-error' : '' }}">
                                    <label for="email">E-mail</label>
                                    <input id="email"
                                           name="email"
                                           type="text"
                                           class="form-control"
                                           value="{{ old('email') }}"
                                           placeholder="Correo del cliente">
                                    @if($errors->has('email'))
                                        <span class="help-block">{{ $errors->first('email') }}</span>
                                    @else
                                        <span class="help-block">Email con el cual el podrá inciar sesión a su cuenta.</span>
                                    @endif
                                </div>
                                <!--  password Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('password') ? 'has-error' : '' }}">
                                    <label for="password">Contraseña</label>
                                    <input id="password"
                                            name="password"
                                            type="password"
                                            class="form-control"
                                            placeholder="Contraseña para el cliente">
                                    @if($errors->has('password'))
                                        <span class="help-block">{{ $errors->first('password') }}</span>
                                    @else
                                        <span class="help-block">
                                            Contraseña temporal que después <strong>deberá cambiar el cliente</strong>.
                                        </span>
                                    @endif
                                </div>
                                <!--  password_confirmation Form Field  -->
                                <div class="form-group col-sm-4">
                                    <label for="password_confirmation">Confirmación de contraseña</label>
                                    <input id="password_confirmation"
                                            name="password_confirmation"
                                            type="password"
                                            class="form-control"
                                            placeholder="Repite la contraseña">
                                        <span class="help-block">Por favor, repite la contraseña para evitar errores de tipeo.</span>
                                </div>
                            </div>
                        </fieldset>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                Registrar usuario
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