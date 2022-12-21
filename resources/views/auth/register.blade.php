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
                        <input type="text" name="name" required="" placeholder="Full Name">
                        <div class="clearfix"></div>
                    </div>
                    <div class="key">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <input type="text" name="email" required="" placeholder="Email">
                        <div class="clearfix"></div>
                    </div>
                    <div class="key">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" name="password" required="" placeholder="Password">
                        <div class="clearfix"></div>
                    </div>
                    <div class="key">
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <input type="password" name="password_confirmation" required="" placeholder="Confirm Password">
                        <div class="clearfix"></div>
                    </div>
                    <input type="submit" value="Register">
                </form>
            </div>
        </div>
    </div>
@endsection
