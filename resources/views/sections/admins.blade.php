@inject('carbon', '\Carbon\Carbon')
@extends('layouts.dashboard')

@section('title', 'Administradores')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    {{ $admins->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--  Resumen de administradores Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-cubes" aria-hidden="true"></i> Administradores
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>&nbsp;</th>
                        </tr>
                        @forelse($admins as $admin)
                            <tr>
                                <td>{{ $admin->id }}</td>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->first_surname }} {{ $admin->second_surname ?? '' }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('dashboard.chatWithAdmin', [$admin->id]) }}">
                                        <i class="fa fa-comment" aria-hidden="true"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">
                                        <h4>Actualmente no hay administradores.</h4>
                                    </td>
                                </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection