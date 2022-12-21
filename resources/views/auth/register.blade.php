@extends('layouts.app')

@section('content')
    <div class="login">

        <div class="main-agileits">
            <div class="form-w3agile">
                <h3>Register</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="key">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        <input type="text" name="name" required placeholder="Full Name" value="{{ old('name') }}">
                        <div class="clearfix"></div>
                    </div>
                    @error('name')
                        <div class="invalid-feedback text-danger" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                    @enderror

                    <div class="key">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="email" name="email" required placeholder="Email" value="{{ old('email') }}">
                        <div class="clearfix"></div>
                    </div>
                    @error('email')
                        <div class="invalid-feedback text-danger" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                    @enderror

                    <div class="key">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <input type="text" name="phone" required placeholder="Phone" value="{{ old('phone') }}">
                        <div class="clearfix"></div>
                    </div>

                    @error('phone')
                        <div class="invalid-feedback text-danger" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                    @enderror

                    <div class="key">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" name="password" required placeholder="Password">
                        <div class="clearfix"></div>
                    </div>

                    @error('password')
                        <div class="invalid-feedback text-danger" role="alert">
                            <b>{{ $message }}</b>
                        </div>
                    @enderror

                    <div class="key">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" name="password_confirmation" required placeholder="Confirm Password">
                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
@endsection
