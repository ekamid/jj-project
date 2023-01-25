@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('frontend/css/tracking_order.css') }}">
@endsection

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Order Details</h1>
                    </div>
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->


    <div class="untree_co-section tracking-order">
        <div class="container">

            <table width="100%">
                <tr>
                    <td width="75px">
                        <div class="logotype">AJ.</div>
                    </td>
                    <td width="300px">
                        <div
                            style="background: #ffd9e8;border-left: 15px solid #fff;padding-left: 30px;font-size: 26px;font-weight: bold;letter-spacing: -1px;height: 73px;line-height: 75px;">
                            Order invoice</div>
                    </td>
                    <td></td>
                </tr>
            </table>
            <br>
            <table width="100%" style="border-collapse: collapse;">
                <tr>
                    <td widdth="50%" style="background:#eee;padding:20px;">
                        <strong>Order Code:</strong> {{ $order->order_code }}<br>
                        <strong>Date:</strong> {{ $order->created_at }}<br>
                        <strong>Payment type:</strong> {{ $order->payment_method }}<br>
                        <strong>Payment status:</strong> {{ $order->payment_status }}<br>
                    </td>
                    <td style="background:#eee;padding:20px;">

                        <strong>Email:</strong> {{ $order->email }}<br>
                        <strong>Phone:</strong> {{ $order->phone }}<br>
                        <strong>Delivery Address:</strong> {{ $order->delivery_address }}<br>

                    </td>
                </tr>
            </table><br>

            <h3>Products</h3>

            <table width="100%" style="border-collapse: collapse;border-bottom:1px solid #eee;">
                <tr>
                    <td width="40%" class="column-header">Product</td>
                    <td width="20%" class="column-header">Price</td>
                    <td width="20%" class="column-header">Quantity</td>
                    <td width="20%" class="column-header">Total</td>
                </tr>
                @foreach ($products as $product)
                    <tr>
                        <td class="row-table">{{ @$product->name }}
                        </td>
                        <td class="row-table">{{ @$product->price }}</td>
                        <td class="row-table">{{ @$product->quantity }}</td>
                        <td class="row-table">{{ $product->price * $product->quantity }}</td>
                    </tr>
                @endforeach

            </table><br>
            <table width="100%" style="background:#eee;padding:20px;">
                <tr>
                    <td>
                        <table width="300px" style="float:right">
                            <tr>
                                <td><strong>Subtotal:</strong></td>
                                <td style="text-align:right">{{ $order->subtotal_amount }}</td>
                            </tr>
                            <tr>
                                <td><strong>Delivery Charge:</strong></td>
                                <td style="text-align:right">{{ $order->delivery_charge }}</td>
                            </tr>
                            <tr>
                                <td><strong>Grand total:</strong></td>
                                <td style="text-align:right">{{ $order->total_amount }}</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </div><!-- container -->
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {
            showCartItems()
        })
    </script>
@endsection
