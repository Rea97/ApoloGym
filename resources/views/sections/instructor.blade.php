@extends('layouts.dashboard')

@section('title', 'Instructor')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-user"></i> {{ clientsInstructor()->name }}
                </div>
                <div class="panel-body">
                    <div class="text-center">
                        <img
                                class="img img-responsive img-thumbnail"
                                src="{{ asset(getPP(clientsInstructor())) }}"
                                alt="Foto de perfil-{{clientsInstructor()->name}}">
                    </div>
                    <h4><i class="fa fa-user"></i> Nombre Completo</h4>
                    <p>
                        {{ clientsInstructor()->name}}
                        {{ clientsInstructor()->first_surname }}
                        {{ clientsInstructor()->second_surname ?? '' }}
                    </p>
                    <div class="divider"></div>
                    <h4><i class="fa fa-calendar"></i> Edad</h4>
                    <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d', clientsInstructor()->birth_date)->age }} años</p>
                    <div class="divider"></div>
                <!--<h4><i class="fa fa-phone"></i> Teléfono</h4>
                    <p>{{ clientsInstructor()->phone_number }}</p>
                    <div class="divider"></div>
                    -->
                    <h4><i class="fa fa-at"></i> Correo electrónico</h4>
                    <p>{{ clientsInstructor()->email }}</p>
                    <div class="divider"></div>
                    <h4><i class="fa fa-book"></i> Acerca de él</h4>
                    <p>{{ clientsInstructor()->about_me ?? 'No dispone actualmente de una biografía' }}</p>
                    <!--<p>Soy una persona apasionada por el ejercicio, para mí, es una parte fundamental de la vida y creo
                    que todos deberían dedicar al menos 60 minutos al día de su tiempo.</p>-->
                </div>
            </div>

        </div>
        <div class="col-lg-8">
            @component('components.chat', ['messages' => $orderedMessages, 'recipient' => clientsInstructor()])
                @slot('route')
                    {{ route('message.toInstructor', [clientsInstructor()->id]) }}
                @endslot
            @endcomponent
        </div>
    </div>

@endsection

@push('scripts')
    <script src="{{ mix('/js/chat.js') }}"></script>
@endpush