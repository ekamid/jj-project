@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/order-table.css') }}">
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
                                <h3 class="text-light mb-0">Purchase History</h3>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Order Code</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Paid</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <span>SOOKH-CF6Z6ZLB</span>
                                            <br>
                                            <span class="badge badge-success bg-success">
                                                Paid</span>
                                            <span class="badge badge-success bg-warning">
                                                Pending</span>

                                        </td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        <td>
                                            <div></div>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection
