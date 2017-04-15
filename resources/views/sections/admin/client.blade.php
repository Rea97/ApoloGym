@extends('layouts.dashboard')

@section('title', 'Detalles del cliente')
@section('content')
    <client-details :instructor="instructor"
                    :instructors="instructors"
                    :client="client"
                    :fetch-client="fetchClient"
                    :fetch-instructors="fetchInstructors">
    </client-details>
@endsection