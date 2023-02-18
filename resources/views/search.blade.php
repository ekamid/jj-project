@extends('layouts.app')

@section('content')
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Search Products</h1>
                    </div>

                    @include('components.search-product')
                </div>
                <div class="col-lg-7">

                </div>
            </div>
        </div>
    </div>
    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">

                <!-- Start Column 1 -->

                @if (count($products))
                    @foreach ($products as $item)
                        @include('components.products.product_card')
                    @endforeach
                @else
                    <h3>Search Result Empty</h3>
                @endif



            </div>

        </div>
    </div>
@endsection
