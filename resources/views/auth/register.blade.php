@extends('layouts.app')


@section('content')
    <div class="login-page my-5" style="max-width: 580px; margin: auto">
        <div class="container">
            <div class="bg-white shadow rounded">
                <div class="form-left h-100 py-5 px-5">
                    <form method="POST" action="{{ route('register') }}" class="row g-4">
                        @csrf
                        <div class="col-12">
                            <label>Name<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                <input class="form-control" type="text" name="name" required
                                    value="{{ old('name') }}" placeholder="Name">
                            </div>
                            @error('name')
                                <div class="invalid-feedback text-danger d-block">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label>Email<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                <input class="form-control" type="email" name="email" required
                                    value="{{ old('email') }}" placeholder="Email">
                            </div>
                            @error('email')
                                <div class="invalid-feedback text-danger d-block">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label>Phone<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-person-fill"></i></div>
                                <input class="form-control" type="text" name="phone" required
                                    value="{{ old('phone') }}" placeholder="Phone">
                            </div>
                            @error('phone')
                                <div class="invalid-feedback text-danger d-block">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label>Password<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                <input class="form-control" type="password" name="password" value="{{ old('password') }}"
                                    required autofocus placeholder="Password">
                            </div>
                            @error('password')
                                <div class="invalid-feedback text-danger d-block">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label>Confirm Password<span class="text-danger">*</span></label>
                            <div class="input-group">
                                <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                <input class="form-control" type="password" name="password_confirmation" required autofocus
                                    placeholder="Retype Password">
                            </div>
                            @error('password')
                                <div class="invalid-feedback text-danger d-block">
                                    <b>{{ $message }}</b>
                                </div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-4 float-end mt-4">Register</button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="bg-white shadow rounded p-3 text-center mt-3">
                <h6 class="mb-0">Already have an account? Please <small><a href="{{ route('login') }}">Login</a></small>
                </h6>
            </div>
        </div>
    </div>
@endsection
