@extends('layouts.dashboard')

@section('title', 'Rutinas')
@section('content')
    <div class="row">
        @include('partials.alert-notification')
        <div class="col-sm-12">
            <!--  Routine Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title"><i class="fa fa-th-list" aria-hidden="true"></i> Rutina</h4>
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
                                <td>
                                    <form method="post" action="{{ route('exercise.check', [$exercise->id]) }}">
                                        {{ csrf_field() }}
                                        {{ method_field('put') }}
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fa fa-check" aria-hidden="true"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">
                                    <h4>No hay ejercicios asignados.</h4>
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