@extends('layouts.dashboard')

@section('title', 'Mi Perfil')
@section('content')
    @if(isAdmin())
        <admin-profile :admin="{{ currentAuth() }}" :show-error-alert="showErrorAlert" :alert-confirm="alertConfirm"></admin-profile>
    @elseif(isInstructor())
        <instructor-profile :instructor="{{ currentAuth() }}" :show-error-alert="showErrorAlert" :alert-confirm="alertConfirm"></instructor-profile>
    @elseif(isClient())
        <client-profile :client="{{ currentAuth() }}" :show-error-alert="showErrorAlert" :alert-confirm="alertConfirm"></client-profile>
    @endif
@endsection