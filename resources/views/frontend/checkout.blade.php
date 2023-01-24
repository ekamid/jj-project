@extends('layouts.app')


@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Checkout</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->



    <div class="untree_co-section">
        <div class="container">
            <form method="POST" action="{{ route('frontend.place_order') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-5 mb-md-0">
                        <h2 class="h3 mb-3 text-black">Shipping Details</h2>
                        <div class="p-3 p-lg-5 border bg-white">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="customer_name" class="text-black">Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                                        value="{{ @$customer['name'] }}">
                                </div>
                            </div>


                            <div class="form-group row mt-3">
                                <div class="col-md-12">
                                    <label for="delivery_address" class="text-black">Delivery Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="delivery_address" name="delivery_address"
                                        placeholder="Delivery address" value="{{ @$customer['address'] }}">
                                </div>
                            </div>


                            <div class="form-group row mt-3">
                                <div class="col-md-6">
                                    <label for="email" class="text-black">Email Address <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Email" value="{{ @$customer['email'] }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="phone" class="text-black">Phone <span
                                            class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Phone Number" value="{{ @$customer['phone'] }}">
                                </div>
                            </div>


                            <div class="form-group mt-3">
                                <label for="order_note" class="text-black">Order Note</label>
                                <textarea name="order_note" id="order_note" cols="30" rows="5" class="form-control"
                                    placeholder="Write your notes here...">{{ old('order_note') }}</textarea>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">


                        <div class="row mb-5">
                            <div class="col-md-12">
                                <h2 class="h3 mb-3 text-black">Your Order</h2>
                                <div class="p-3 p-lg-5 border bg-white">
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($products as $product)
                                                <tr>
                                                    <td>{{ $product['name'] }} <strong class="mx-2">x</strong>
                                                        {{ $product['quantity'] }}</td>
                                                    <td>৳{{ $product['price'] * $product['quantity'] }}</td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                                                <td class="text-black">৳{{ $subtotal }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Delivery Charge</strong>
                                                </td>
                                                <td class="text-black font-weight-bold">
                                                    <strong>৳{{ $delivery_charge }}</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                                <td class="text-black font-weight-bold">
                                                    <strong>৳{{ $subtotal + $delivery_charge }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>


                                    <div class="border p-3 mb-5">
                                        <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse"
                                                href="#collapsepaypal" role="button" aria-expanded="false"
                                                aria-controls="collapsepaypal">Cash On
                                                Delivery (COD)</a>
                                        </h3>

                                        <div class="collapse" id="collapsepaypal">
                                            <div class="py-2">
                                                <p class="mb-0">Make your payment directly in cash while receiving the
                                                    product.
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-black btn-lg py-3 btn-block"
                                            onclick="window.location='thankyou.html'">Place Order</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            showCartItems()
        })
    </script>
@endsection
