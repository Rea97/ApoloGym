@extends('layouts.dashboard')

@section('title', 'Detalles de la factura')
@section('content')
    <invoice-details :show-error-alert="showErrorAlert"
                     :get-id-of-resource-in-url="getIdOfResourceInUrl">
    </invoice-details>
@endsection