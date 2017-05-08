@extends('layouts.dashboard')

@section('title', 'Mi Perfil')
@section('content')
    @if(isAdmin())
        <admin-profile :admin="{{ currentAuth() }}" :show-error-alert="showErrorAlert" :alert-confirm="alertConfirm"></admin-profile>
    @elseif(isInstructor())
        Perfil de instructor
    @elseif(isClient())
        <client-profile :client="{{ currentAuth() }}" :show-error-alert="showErrorAlert" :alert-confirm="alertConfirm"></client-profile>
    @endif
@endsection