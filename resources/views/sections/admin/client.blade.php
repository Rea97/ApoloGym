@extends('layouts.dashboard')

@section('title', 'Detalles del cliente')
@section('content') <!-- TODO: Eliminar :is-admin, no es necesario -->
    <client-details :is-admin="{{ isAdmin() }}"
                    :instructor="instructor"
                    :instructors="instructors"
                    :client="client"
                    :delete-client="deleteClient"
                    :update-client="updateClient"
                    :fetch-client="fetchClient"
                    :fetch-instructors="fetchInstructors"
                    :quantity-of-invoices="{{ $quantityOfInvoices }}"
                    :show-error-alert="showErrorAlert">
    </client-details>
@endsection