@extends('layouts.app')

@section('content')
    <!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->


<section class="hero is-fullheight is-dark is-bold">
    <div class="hero-body">
        <div class="container">
            <div class="columns is-vcentered">
                <div class="column is-4 is-offset-4">
                    <h1 class="title">
                        Login
                    </h1>

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
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
                                           placeholder="jsmith@example.org"
                                           required
                                           autofocus>
                                    @if ($errors->has('email'))
                                        <span class="is-danger">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="field">
                                <label class="label">Password</label>
                                <p class="control">
                                    <input id="password"
                                           type="password"
                                           class="input {{ $errors->has('password') ? ' is-danger' : '' }}"
                                           name="password"
                                           placeholder="●●●●●●●"
                                           required>
                                    @if($errors->has('password'))
                                        <span class="is-danger">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="field">
                                <p class="control" style="color: #0a0a0a">
                                    <label class="checkbox">
                                        <input type="checkbox"
                                               name="remember"
                                               class="checkbox"
                                               {{ old('remember') ? 'checked' : '' }}>
                                        Mantener sesión iniciada
                                    </label>
                                </p>
                            </div>

                            <hr>
                            <p class="control">
                                <button class="button is-primary">Entrar</button>
                            </p>
                        </div>
                    </form>

                    <p class="has-text-centered">
                        <a href="{{ url('/register') }}">Registrarse</a>
                        |
                        <a href="{{ route('password.request') }}">Olvidé mi contraseña</a>
                        |
                        <a href="#">Ayuda</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
