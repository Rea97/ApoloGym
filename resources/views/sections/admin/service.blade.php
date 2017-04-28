@extends('layouts.dashboard')

@section('title', 'Detalles del servicio')
@section('content')
    <service-details :show-error-alert="showErrorAlert"
                     :get-id-of-resource-in-url="getIdOfResourceInUrl">
    </service-details>
@endsection