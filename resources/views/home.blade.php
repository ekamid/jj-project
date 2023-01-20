@extends('layouts.app')


@section('content')
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Apurba Jewellers</h1>
                        <p class="mb-4">An ecommerce platform for jewelry would allow customers to browse and purchase
                            various types of jewelry online..</p>
                        <p><a href="{{ route('frontend.shop') }}" class="btn btn-secondary me-2">Shop Now</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    {{-- <div class="hero-img-wrap">
                        <img src="images/couch.png" class="img-fluid">
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    @foreach ($data as $item)
        @include('components.products.category_wise_product')
    @endforeach
@endsection
