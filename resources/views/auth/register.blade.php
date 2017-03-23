@extends('layouts.app')

@section('content')
    <section class="hero is-fullheight is-dark is-bold">
        <div class="hero-body">
            <div class="container">
                <div class="columns is-vcentered">
                    <div class="column is-4 is-offset-4">
                        <h1 class="title">
                            Register an Account
                        </h1>
                        <div class="box">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                                {{ csrf_field() }}
                                <div class="field">
                                    <label class="label">Name</label>
                                    <p class="control">
                                        <input id="name"
                                               type="text"
                                               class="input"
                                               name="name"
                                               value="{{ old('name') }}"
                                               placeholder="John Smith"
                                               required
                                               autofocus>
                                    </p>
                                </div>
                                <div class="field">
                                    <label class="label">Email</label>
                                    <p class="control">
                                        <input id="email"
                                               type="email"
                                               class="input"
                                               name="email"
                                               value="{{ old('email') }}"
                                               placeholder="jsmith@example.org"
                                               required>
                                    </p>
                                </div>
                                <div class="field">
                                    <label class="label">Password</label>
                                    <p class="control">
                                        <input id="password"
                                               type="password"
                                               class="input"
                                               name="password"
                                               placeholder="●●●●●●●"
                                               required>
                                    </p>
                                </div>
                                <div class="field">
                                    <label class="label">Confirm Password</label>
                                    <p class="control">
                                        <input id="password-confirm"
                                               type="password"
                                               class="input"
                                               name="password_confirmation"
                                               placeholder="●●●●●●●"
                                               required>
                                    </p>
                                </div>
                                <hr>
                                <p class="control">
                                    <button class="button is-primary">Register</button>
                                    <button class="button is-default">Cancel</button>
                                </p>
                            </form>
                        </div>
                        <p class="has-text-centered">
                            <a href="login.html">Login</a>
                            |
                            <a href="#">Need help?</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
