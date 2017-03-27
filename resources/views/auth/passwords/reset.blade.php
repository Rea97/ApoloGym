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

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('password.request') }}">
                            {!! csrf_field() !!}
                            <input type="hidden" name="token" value="{{ $token }}">
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
                                               placeholder="Introduce tú dirección de correo"
                                               autofocus
                                               required>
                                        @if ($errors->has('email'))
                                            <span class="input-error">
                                                {{ $errors->first('email') }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="field">
                                    <label class="label">
                                        Nueva contraseña
                                    </label>
                                    <p class="control">
                                        <input id="password"
                                               type="password"
                                               class="input {{ $errors->has('password') ? 'is-danger' : '' }}"
                                               name="password"
                                               placeholder="●●●●●●●"
                                               required>
                                        @if ($errors->has('password'))
                                            <span class="input-error">
                                                {{ $errors->first('password') }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <div class="field">
                                    <label class="label">
                                        Confirma la nueva contraseña
                                    </label>
                                    <p class="control">
                                        <input id="password-confirm"
                                               type="password"
                                               class="input {{ $errors->has('password_confirmation') ? 'is-danger' : '' }}"
                                               name="password_confirmation"
                                               placeholder="●●●●●●●"
                                               required>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="input-error">
                                                {{ $errors->first('password_confirmation') }}
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                <hr>
                                <p class="control">
                                    <button class="button is-primary">
                                        Guardar cambios
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
