@extends('layouts.app')

@section('content')
    <div class="login">

        <div class="main-agileits">
            <div class="form-w3agile">
                <h3>Login</h3>
                <form method="POST" action="{{ route('login') }}">
                    <div class="key">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="text" name="email" required value="{{ old('email') }}" placeholder="Email">
                        <div class="clearfix"></div>
                    </div>
                    <div class="key">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" name="password" value="{{ old('password') }}" required autofocus
                            placeholder="Password">
                        <div class="clearfix"></div>
                    </div>
                    <div class="block mt-3">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-500">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <input type="submit" value="Login">
                </form>
            </div>
            <div class="forg">
                <a href="{{ route('password.request') }}" class="forg-left">Forgot Password</a>
                <a href="{{ route('register') }}" class="forg-right">Register</a>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
