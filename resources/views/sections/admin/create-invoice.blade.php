@extends('layouts.dashboard')

@section('title', 'Nueva registro')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <!--  Create New Service Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Agregue una factura
                    </h4>
                </div>
                <div class="panel-body">
                    <form action="{{ route('invoices.store') }}" method="post">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend>
                                <small>
                                    <i class="fa fa-money" aria-hidden="true"></i>
                                </small>
                                Datos de la factura
                            </legend>
                            <div class="row">
                                <!--  client_id Form Field  -->
                                <div class="form-group col-sm-6 {{ $errors->has('client_id') ? 'has-error' : '' }}">
                                    <label for="client_id">Cliente</label>
                                    <select name="client_id" id="client_id" class="form-control">
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ !is_null($client_id) && $client_id == $client->id ? 'selected' : '' }}>
                                                {{ $client->name }} {{ $client->first_surname }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('client_id'))
                                        <span class="help-block">{{ $errors->first('client_id') }}</span>
                                    @endif
                                </div>
                                <!--  due_date Form Field  -->
                                <div class="form-group col-sm-6 {{ $errors->has('due_date') ? 'has-error' : '' }}">
                                    <label for="due_date">Vencimiento</label>
                                    <input id="due_date"
                                           name="due_date"
                                           type="date"
                                           class="form-control"
                                           value="{{ old('due_date') }}">
                                    @if($errors->has('due_date'))
                                        <span class="help-block">{{ $errors->first('due_date') }}</span>
                                    @endif
                                </div>

                                <table class="table table-hover table-striped table-condensed">
                                    <tr>
                                        <th class="col-sm-2">id</th>
                                        <th class="col-sm-2">Servicio</th>
                                        <th class="col-sm-6">Descripción</th>
                                        <th class="col-sm-1">Precio</th>
                                        <th class="col-sm-1">&nbsp;</th>
                                    </tr>
                                    @foreach($services as $service)
                                        <tr>
                                            <td>{{ $service->id }}</td>
                                            <td>{{ $service->name }}</td>
                                            <td>{{ $service->description }}</td>
                                            <td>$ {{ $service->price }}</td>
                                            <td>
                                                <input type="checkbox" name="services[]" value="{{ $service->id }}">
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                            </div>
                        </fieldset>

                        <div class="pull-right">
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-file" aria-hidden="true"></i>
                                Generar Factura
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