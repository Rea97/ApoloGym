@extends('layouts.dashboard')

@section('title', 'Facturas')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-12">
                    {{ $invoices->links() }}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <!--  Resumen de facturas Panel  -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <i class="fa fa-cubes" aria-hidden="true"></i> Resúmen de Facturas
                    </h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-condensed">
                        <tr>
                            <th class="col-sm-1">Id</th>
                            <th class="col-sm-3">Términos adicionales</th>
                            <th class="col-sm-2">Fecha de creación</th>
                            <th class="col-sm-2">Vencimiento</th>
                            <th class="col-sm-2">Estado</th>
                            <th class="col-sm-1">Total</th>
                            <th class="col-sm-1">&nbsp;</th>
                        </tr>
                        @forelse($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->id }}</td>
                                <td>{{ $invoice->terms ?? 'Esta factura no tiene términos adicionales.' }}</td>
                                <td>{{ $invoice->created_at }}</td>
                                <td>{{ $invoice->due_date }}</td>
                                <td>{{ $invoice->status }}</td>
                                <td>$ {{ $invoice->total }}</td>
                                <td>
                                    <a class="btn btn-sm btn-warning" href="{{ route('dashboard.invoice.pdf', [$invoice->id]) }}" target="_blank">
                                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                        Ver PDF
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">
                                        <h4>Actualmente no hay facturas asignadas.</h4>
                                    </td>
                                </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection