@extends('layouts.dashboard')

@section('title', 'Detalles del instructor')
@section('content')
    <instructor-details :is-admin="{{ isAdmin() }}"
                    :instructor="instructor"
                    :clients="clients">
                    <!--
                    :delete-instructor="deleteInstructor"
                    :update-instructor="updateInstructor">-->
    </instructor-details>
@endsection