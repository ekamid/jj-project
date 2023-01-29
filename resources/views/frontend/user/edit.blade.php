@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="main-body my-4">

            <div class="row gutters-sm">
                <div class="col-md-4 mb-3">
                    @include('frontend.user.sidebar')
                </div>
                <div class="col-md-8">
                    <form action="{{ route('frontend.user.edit') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        {{-- <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img style="width: 180px;" src="https://bootdey.com/img/Content/avatar/avatar7.png"
                                        alt="Admin" class="rounded-circle" width="150" id="user_avater_prev">
                                    <div class="mt-3">
                                        <input type="file" name="avater" id="user_avater">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="input-only-border-bottom" name="name"
                                            value="{{ auth()->user()->name }}" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="input-only-border-bottom" name="email"
                                            value="{{ auth()->user()->email }}" required>
                                    </div>
                                </div>
                                <hr>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Mobile</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="input-only-border-bottom" name="phone"
                                            value="{{ auth()->user()->phone }}" required>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Address</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        <input type="text" class="input-only-border-bottom" name="address"
                                            value="{{ auth()->user()->address }}">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-info " type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
@endsection
