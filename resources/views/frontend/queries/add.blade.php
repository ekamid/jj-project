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
                    <div class="card mb-3">
                        <div class="card-body order-table">
                            <div class="bg-primary text-center py-3">
                                <h3 class="text-light mb-0">Create Query</h3>
                            </div>
                            @if (Session::has('error'))
                                <div class="alert alert-danger mt-2 p-2">
                                    <p class="mb-0 text-light">{{ Session::get('error') }}</p>
                                </div>
                            @endif
                            <form class="row g-3 mt-2" action="{{ route('frontend.user.queries.add') }}" method="POST">
                                @csrf
                                <div class="col-md-12">
                                    <label for="query_title" class="form-label">Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        placeholder="What's it for?" class="form-control" id="query_title" required>
                                    @error('title')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Type</label>
                                    <fieldset class="d-flex gap-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="gridRadios1"
                                                value="general" checked>
                                            <label class="form-check-label" for="gridRadios1">
                                                General
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="type" id="gridRadios2"
                                                value="order">
                                            <label class="form-check-label" for="gridRadios2">
                                                Order
                                            </label>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-12 d-none" id="orderIdContainer">
                                    <label for="query_order_id" class="form-label">Order Code</label>
                                    <br>
                                    <input name="order_id" type="text" class="form-control" id="query_order_id"
                                        placeholder="Search Order by Code">
                                    <input hidden name="order_code" type="text" id="query_order_code">
                                    @error('order_id')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="query_description" class="form-label">Description</label>
                                    <textarea placeholder="Write Queries" class="form-control" name="description" id="query_description" rows="5"
                                        required>{{ old('description') }}</textarea>

                                    @error('description')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-dark">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/typeahead.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('input[name="type"]').on('change', function(e) {
                if (e.target.value === 'order') {
                    $('#orderIdContainer').removeClass('d-none')
                } else {
                    $('#orderIdContainer').addClass('d-none')
                }
            })

            $("#query_order_id").typeahead({
                source: function(que, result) {
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        type: "GET",
                        url: "../get-orders",
                        data: {
                            que: que,
                        },
                        success: function(data) {
                            console.log(data)
                            let tempData = [];
                            data.map((item) => tempData.push(`${item.order_code}`));

                            result(tempData);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        },
                    });
                },


                updater: function(item) {
                    $.ajax({
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                        },
                        type: "GET",
                        url: "../get-order",
                        data: {
                            code: item,
                        },
                        success: function(data) {
                            let order = data[0];

                            $("#query_order_id").val(order.order_code);
                            $("#query_order_code").val(order.order_code);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        },
                    });
                },
            });

        });
    </script>
@endsection
