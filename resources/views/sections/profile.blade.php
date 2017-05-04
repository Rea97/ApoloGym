@extends('layouts.dashboard')

@section('title', 'Mi Perfil')
@section('content')
    @if(isAdmin())
        <admin-profile :admin="{{ currentAuth() }}" :show-error-alert="showErrorAlert" :alert-confirm="alertConfirm"></admin-profile>
    @elseif(isInstructor())
        Perfil de instructor
    @elseif(isClient())
        Perfil de cliente
    @endif
@endsection