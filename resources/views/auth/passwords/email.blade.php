@extends('layouts.app')

@section('content')
<section class="hero is-fullheight is-dark is-bold">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-4 is-offset-4">
                        <h1 class="title">
                            Reestablecer contraseña
                        </h1>

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.email') }}">
                            {!! csrf_field() !!}
                            <div class="box">
                                <div class="field">
                                    <label class="label">
                                        Email
                                    </label>
                                    <p class="control">
                                        <input id="email"
                                               type="email"
                                               class="input {{ $errors->has('email') ? 'is-danger' : '' }}"
                                               name="email"
                                               value="{{ old('email') }}"
                                               placeholder="Introduce tu dirección de correo"
                                               autofocus
                                               required>
                                        @if ($errors->has('email'))
                                            <span class="input-error">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <hr>
                                <p class="control">
                                    <button class="button is-primary">
                                        Enviar enlace de reestablecimiento
                                    </button>
                                </p>
                            </div>
                        </form>

                        <p class="has-text-centered">
                            <a href="{{ route('register') }}">Registrarse</a>
                            |
                            <a href="{{ route('login') }}">Inicio de sesión</a>
                            |
                            <a href="#">Ayuda</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
