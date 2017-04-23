@extends('layouts.dashboard')

@section('title', 'Nuevo registro')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <!--  Create New Client Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-user-plus" aria-hidden="true"></i> Agregue un Instructor
                    </h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('instructor.store') }}" method="post">
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
                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                </small>
                                Datos de contácto
                            </legend>
                            <div class="row">
                                <!--  phone_number Form Field  -->
                                <div class="form-group col-sm-6 {{ $errors->has('phone_number') ? 'has-error' : '' }}">
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
                                <div class="form-group col-sm-6 {{ $errors->has('address') ? 'has-error' : '' }}">
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
                                        <span class="help-block">Por favor, repita la contraseña para evitar errores de tipeo.</span>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                <small>
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </small>
                                Datos financieros
                            </legend>
                            <div class="row">
                                <!--  salary Form Field  -->
                                <div class="form-group col-sm-4 {{ $errors->has('salary') ? 'has-error' : '' }}">
                                    <label for="salary">Salario</label>
                                    <input id="salary"
                                           name="salary"
                                           type="number"
                                           min="0"
                                           step="0.10"
                                           class="form-control"
                                           value="{{ old('salary') ?? '0' }}"
                                           placeholder="Salario del instructor">
                                    @if($errors->has('salary'))
                                        <span class="help-block">{{ $errors->first('salary') }}</span>
                                    @endif
                                </div>

                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>
                                <small>
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                </small>
                                Horario
                            </legend>
                            <div class="row">
                                <div class="col-sm-12">
                                    <p>Cada día viene con dos campos, el de la hora de entrada, y la de salida.
                                        Para asignar día libre, basta con dejar en blanco el campo de entrada y salida del respectivo día.
                                        Si gusta, puede dejar en blanco y asignar el horario después en el perfil del instructor.
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Monday -->
                                <div class="form-group col-sm-3 {{ $errors->has('monday-from') ? 'has-error' : '' }}">
                                    <label for="monday-from">Lunes</label>
                                    <input id="monday-from"
                                           name="monday-from"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('monday-from') }}">
                                    @if($errors->has('monday-from'))
                                        <span class="help-block">{{ $errors->first('monday-from') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3 {{ $errors->has('monday-to') ? 'has-error' : '' }}">
                                    <label for="monday-to">&nbsp;</label>
                                    <input id="monday-to"
                                           name="monday-to"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('monday-to') }}">
                                    @if($errors->has('monday-to'))
                                        <span class="help-block">{{ $errors->first('monday-to') }}</span>
                                    @endif
                                </div>
                                <!-- Tuesday -->
                                <div class="form-group col-sm-3 {{ $errors->has('tuesday-from') ? 'has-error' : '' }}">
                                    <label for="tuesday-from">Martes</label>
                                    <input id="tuesday-from"
                                           name="tuesday-from"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('tuesday-from') }}">
                                    @if($errors->has('tuesday-from'))
                                        <span class="help-block">{{ $errors->first('tuesday-from') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3 {{ $errors->has('tuesday-to') ? 'has-error' : '' }}">
                                    <label for="tuesday-to">&nbsp;</label>
                                    <input id="tuesday-to"
                                           name="tuesday-to"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('tuesday-to') }}">
                                    @if($errors->has('tuesday-to'))
                                        <span class="help-block">{{ $errors->first('tuesday-to') }}</span>
                                    @endif
                                </div>
                                <!-- Wednesday -->
                                <div class="form-group col-sm-3 {{ $errors->has('wednesday-from') ? 'has-error' : '' }}">
                                    <label for="wednesday-from">Miercoles</label>
                                    <input id="wednesday-from"
                                           name="wednesday-from"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('wednesday-from') }}">
                                    @if($errors->has('wednesday-from'))
                                        <span class="help-block">{{ $errors->first('wednesday-from') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3 {{ $errors->has('wednesday-to') ? 'has-error' : '' }}">
                                    <label for="wednesday-to">&nbsp;</label>
                                    <input id="wednesday-to"
                                           name="wednesday-to"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('wednesday-to') }}">
                                    @if($errors->has('wednesday-to'))
                                        <span class="help-block">{{ $errors->first('wednesday-to') }}</span>
                                    @endif
                                </div>
                                <!-- Thursday -->
                                <div class="form-group col-sm-3 {{ $errors->has('thursday-from') ? 'has-error' : '' }}">
                                    <label for="thursday-from">Jueves</label>
                                    <input id="thursday-from"
                                           name="thursday-from"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('thursday-from') }}">
                                    @if($errors->has('thursday-from'))
                                        <span class="help-block">{{ $errors->first('thursday-from') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3 {{ $errors->has('thursday-to') ? 'has-error' : '' }}">
                                    <label for="thursday-to">&nbsp;</label>
                                    <input id="thursday-to"
                                           name="thursday-to"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('thursday-to') }}">
                                    @if($errors->has('thursday-to'))
                                        <span class="help-block">{{ $errors->first('thursday-to') }}</span>
                                    @endif
                                </div>
                                <!-- Friday -->
                                <div class="form-group col-sm-3 {{ $errors->has('friday-from') ? 'has-error' : '' }}">
                                    <label for="friday-from">Viernes</label>
                                    <input id="friday-from"
                                           name="friday-from"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('friday-from') }}">
                                    @if($errors->has('friday-from'))
                                        <span class="help-block">{{ $errors->first('friday-from') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3 {{ $errors->has('friday-to') ? 'has-error' : '' }}">
                                    <label for="friday-to">&nbsp;</label>
                                    <input id="friday-to"
                                           name="friday-to"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('friday-to') }}">
                                    @if($errors->has('friday-to'))
                                        <span class="help-block">{{ $errors->first('friday-to') }}</span>
                                    @endif
                                </div>
                                <!-- Saturday -->
                                <div class="form-group col-sm-3 {{ $errors->has('saturday-from') ? 'has-error' : '' }}">
                                    <label for="saturday-from">Sábado</label>
                                    <input id="saturday-from"
                                           name="saturday-from"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('saturday-from') }}">
                                    @if($errors->has('saturday-from'))
                                        <span class="help-block">{{ $errors->first('saturday-from') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3 {{ $errors->has('saturday-to') ? 'has-error' : '' }}">
                                    <label for="saturday-to">&nbsp;</label>
                                    <input id="saturday-to"
                                           name="saturday-to"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('saturday-to') }}">
                                    @if($errors->has('saturday-to'))
                                        <span class="help-block">{{ $errors->first('saturday-to') }}</span>
                                    @endif
                                </div>
                                <!-- Sunday -->
                                <div class="form-group col-sm-3 {{ $errors->has('sunday-from') ? 'has-error' : '' }}">
                                    <label for="sunday-from">Domingo</label>
                                    <input id="sunday-from"
                                           name="sunday-from"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('sunday-from') }}">
                                    @if($errors->has('sunday-from'))
                                        <span class="help-block">{{ $errors->first('sunday-from') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-sm-3 {{ $errors->has('sunday-to') ? 'has-error' : '' }}">
                                    <label for="sunday-to">&nbsp;</label>
                                    <input id="sunday-to"
                                           name="sunday-to"
                                           type="time"
                                           class="form-control"
                                           value="{{ old('sunday-to') }}">
                                    @if($errors->has('sunday-to'))
                                        <span class="help-block">{{ $errors->first('sunday-to') }}</span>
                                    @endif
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