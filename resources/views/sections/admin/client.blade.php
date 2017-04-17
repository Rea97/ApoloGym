@extends('layouts.dashboard')

@section('title', 'Detalles del cliente')
@section('content')
    <client-details :is-admin="{{ isAdmin() }}"
                    :instructor="instructor"
                    :instructors="instructors"
                    :client="client"
                    :delete-client="deleteClient"
                    :update-client="updateClient"
                    :fetch-client="fetchClient"
                    :fetch-instructors="fetchInstructors">
    </client-details>
@endsection