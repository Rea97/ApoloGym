@extends('layouts.dashboard')

@section('title', 'Rutina del cliente')
@section('content')
    <div class="row">
        @include('partials.alert-notification')
        <div class="col-sm-12">
            <!--  Nuevo ejercicio Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Nuevo Ejercicio
                    </h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('exercise.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                        <div class="row">

                            <!--  name Form Field  -->
                            <div class="form-group col-sm-6 {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">Nombre</label>
                                <input id="name"
                                       name="name"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('name') }}"
                                       placeholder="Nombre del ejercicio">
                                @if($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <!--  worked_muscle Form Field  -->
                            <div class="form-group col-sm-6 {{ $errors->has('worked_muscle') ? 'has-error' : '' }}">
                                <label for="worked_muscle">Músculo ejercitado</label>
                                <input id="worked_muscle"
                                       name="worked_muscle"
                                       type="text"
                                       class="form-control"
                                       value="{{ old('worked_muscle') }}"
                                       placeholder="Musculo ejercitado">
                                @if($errors->has('worked_muscle'))
                                    <span class="help-block">{{ $errors->first('worked_muscle') }}</span>
                                @endif
                            </div>
                            <!--  picture Form Field  -->
                            <!--
                            <div class="form-group col-sm-4 {{ $errors->has('picture') ? 'has-error' : '' }}">
                                <label for="picture">Imagen</label>
                                <input id="picture"
                                       name="picture"
                                       type="file"
                                       class="form-control">
                                @if($errors->has('picture'))
                                    <span class="help-block">{{ $errors->first('picture') }}</span>
                                @endif
                            </div>
                            -->
                        </div>

                        <div class="row">
                            <!--  sets Form Field  -->
                            <div class="form-group col-sm-2 {{ $errors->has('sets') ? 'has-error' : '' }}">
                                <label for="sets">Series</label>
                                <input id="sets"
                                       name="sets"
                                       type="number"
                                       min="0"
                                       class="form-control"
                                       value="{{ old('sets') }}"
                                       placeholder="Series a realizar">
                                @if($errors->has('sets'))
                                    <span class="help-block">{{ $errors->first('sets') }}</span>
                                @endif
                            </div>
                            <!--  reps Form Field  -->
                            <div class="form-group col-sm-2 {{ $errors->has('reps') ? 'has-error' : '' }}">
                                <label for="reps">Repeticiones</label>
                                <input id="reps"
                                       name="reps"
                                       type="number"
                                       min="0"
                                       value="{{ old('reps') }}"
                                       class="form-control"
                                       placeholder="Repeticiones a realizar">
                                @if($errors->has('reps'))
                                    <span class="help-block">{{ $errors->first('reps') }}</span>
                                @endif
                            </div>
                            <!--  weight Form Field  -->
                            <div class="form-group col-sm-4 {{ $errors->has('weight') ? 'has-error' : '' }}">
                                <label for="weight">Peso</label>
                                <input id="weight"
                                       name="weight"
                                       type="number"
                                       min="0"
                                       step="0.01"
                                       class="form-control"
                                       value="{{ old('weight') }}"
                                       placeholder="Peso a utilizar en libras">
                                @if($errors->has('weight'))
                                    <span class="help-block">{{ $errors->first('weight') }}</span>
                                @endif
                            </div>
                            <!--  date Form Field  -->
                            <div class="form-group col-sm-4 {{ $errors->has('date') ? 'has-error' : '' }}">
                                <label for="date">Fecha</label>
                                <input id="date"
                                       name="date"
                                       type="date"
                                       value="{{ old('date') }}"
                                       class="form-control">
                                @if($errors->has('date'))
                                    <span class="help-block">{{ $errors->first('date') }}</span>
                                @endif
                            </div>

                            <div class="form-group col-sm-12">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                    Agregar Ejercicio
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <!--  Rutina Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        Rutina de <strong>{{ $client->name }} {{ $client->first_surname }}</strong>
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Ejercicio</th>
                            <th>Musculo trabajado</th>
                            <!--
                            <th>Imagen</th>
                            -->
                            <th>Repeticiones</th>
                            <th>Series</th>
                            <th>Peso</th>
                            <th>Fecha de realización</th>
                            <th>Terminado</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($exercises as $exercise)
                            <tr>
                                <td>{{ $exercise->name }}</td>
                                <td>{{ $exercise->worked_muscle }}</td>
                                <!--
                                <td>
                                    @if(! is_null($exercise->picture))
                                        <a href="{{ $exercise->picture }}">Ver imagen</a>
                                    @else
                                        <i>Sin imagen</i>
                                    @endif
                                </td>
                                -->
                                <td>{{ $exercise->reps }}</td>
                                <td>{{ $exercise->sets }}</td>
                                <td>{{ $exercise->weight }} lbs.</td>
                                <td>{{ $exercise->date }}</td>
                                <td>{{ $exercise->finish ? 'Sí' : 'No' }}</td>
                                <td>
                                    <!--<button class="btn btn-sm btn-info">
                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                    </button>-->
                                    <form method="post" action="{{ route('exercise.delete', [$exercise->id]) }}" id="delete-exercise-{{$exercise->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('delete') }}
                                        <input type="hidden" name="client_id" value="{{ $client->id }}">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <h4>No hay ejercicios asignados a {{ $client->name }}</h4>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection