@extends('layouts.dashboard')

@section('title', 'Horario')
@section('content')
    <instructor-schedule current-user="{{ currentAuth()->id }}"></instructor-schedule>
@endsection