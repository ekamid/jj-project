@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/order-table.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/libs/datatable/datatables.min.css') }}">
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
                            <table id="orders_table" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Order Code</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Payment Method</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Paid</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td>
                                                <span>{{ $order->order_code }}</span>
                                                <br>
                                                <span
                                                    class="badge {{ $order->status == 'delivered' ? 'bg-success' : 'bg-danger' }}">{{ $order->status }}</span>
                                                <span
                                                    class="badge {{ $order->payment_status == 'unpaid' ? 'bg-danger' : 'bd-success' }}">
                                                    {{ $order->payment_status }}</span>
                                            </td>
                                            <td>{{ strrev(explode(' ', $order->created_at)[0]) }}</td>
                                            <td>{{ $order->payment_method }}</td>
                                            <td>{{ $order->total_amount }}</td>
                                            <td>{{ $order->paid_amount }}</td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('frontend.user.order_details', [
                                                                    'order_code' => $order->order_code,
                                                                ]) }}">View
                                                                Details</a></li>
                                                        </li>
                                                        <li><a target="_blank" class="dropdown-item"
                                                                href="{{ route('frontend.order_invoice', [
                                                                    'order_code' => $order->order_code,
                                                                ]) }}">Invoice</a>
                                                        </li>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('dashboard/vendor/libs/datatable/datatables.min.js') }}"></script>

    <script>
        $(document).ready(function() {

            console.log('datatabke')
            $('#orders_table').DataTable();
        });
    </script>
@endsection
