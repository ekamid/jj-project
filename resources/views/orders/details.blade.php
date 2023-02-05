@extends('layouts.admin')


@section('content')
    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders /</span> Details</h4>

            @if (session()->has('success'))
                <div id="global_alert"
                    class="alert bg-primary fade show d-flex align-items-center justify-content-between global_alert"
                    role="alert">
                    <p class="text-light m-0"> {{ session()->get('success') }}</p>
                </div>
            @endif

            @if (session()->has('error'))
                <div id="global_alert" class="alert bg-danger fade show d-flex align-items-center justify-content-between "
                    role="alert">
                    <p class="text-light m-0"> {{ session()->get('error') }}</p>
                </div>
            @endif


            <div class="card">
                <div class="card mb-3">
                    <div class="card-body order-table">
                        <div class="bg-dark text-center py-3">
                            <h4 class="text-light mb-0">Order Details</h4>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Customer</b>:</p>
                                    <p class="col-6 m-0">{{ $order->customer_name }}</p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Phone</b>:</p>
                                    <p class="col-6 m-0">{{ $order->phone }}</p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Email</b>:</p>
                                    <p class="col-6 m-0">{{ $order->email }}</p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Delivery Address</b>:</p>
                                    <p class="col-6 m-0">{{ $order->delivery_address }} </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Order Date</b>:</p>
                                    <p class="col-6 m-0">{{ explode(' ', $order->created_at)[0] }}</p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Payment Status</b>:</p>
                                    <p class="col-6 m-0">
                                        {{ $order->payment_status }}
                                    </p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Payment method</b>:</p>
                                    <p class="col-6 m-0">
                                        {{ $order->payment_method === 'cod' ? 'Cash On Delivery' : $order->payment_method }}
                                    </p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Delivery Status</b>:</p>
                                    <p class="col-6 m-0">{{ $order->status }}
                                        (<small>{{ @explode(' ', $order->updated_at)[0] }}</small>)</p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Product Price</b>:</p>
                                    <p class="col-6 m-0">{{ $order->subtotal_amount }}</p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Delivery Charge</b>:</p>
                                    <p class="col-6 m-0">{{ $order->delivery_charge }}</p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Total Order Amount</b>:</p>
                                    <p class="col-6 m-0">{{ $order->total_amount }}</p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Total Paid amount</b>:</p>
                                    <p class="col-6 m-0">{{ $order->paid_amount }}</p>
                                </div>
                                <div class="row mt-2">
                                    <p class="col-6 font-bold m-0"><b>Total Due Amount</b>:</p>
                                    <p class="col-6 m-0">{{ $order->total_amount - $order->paid_amount }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <p class="col-3 font-bold m-0"><b>Note</b>:</p>
                            <p class="col-9 m-0">{{ $order->order_note }}</p>
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-body order-table">
                        <div class="bg-dark text-center py-3">
                            <h4 class="text-light mb-0">Product List</h4>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $item)
                                    <tr>
                                        <td>
                                            <a style="text-decoration: none"
                                                href="{{ route('frontend.product_details', @$item->product->slug) }}"
                                                class="d-flex align-items-center">
                                                <img style="width: 75px"
                                                    src="{{ $item->product->images ? asset(json_decode($item->product->images)[0]) : '' }}"
                                                    alt="">
                                                <p class="m-0 ms-2"><b>{{ $item->name }}</b></p>
                                            </a>
                                        </td>
                                        <td class="align-middle">{{ $item->quantity }}</td>
                                        <td class="align-middle">{{ $item->price }}</td>
                                        <td class="align-middle">{{ $item->price * $item->quantity }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- / Content -->



            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
@endsection
