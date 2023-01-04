@extends('layouts.app')

@section('styles')
    <link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
    <link rel="stylesheet" href="{{ asset('frontend/css/product-details.css') }}">
@endsection

@section('content')
    <div class="container mt-5 mb-3">
        <div class="row no-gutters">
            <div class="col-md-5 pr-2">
                <div class="card">
                    <div class="demo">
                        <ul id="lightSlider">
                            @foreach (json_decode($product->images) as $image)
                                <li data-thumb="{{ asset($image) }}"> <img src="{{ asset($image) }}" />
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="card">
                    <div class="about"> <span class="fs-3">{{ $product->name }}</span>
                        <h6 class="font-weight-bold text-dark">৳{{ ' ' }}<strong>{{ $product->price }}</strong>
                        </h6>
                    </div>
                    <div class="buttons"> <button data-id="2" data-name="{{ $product->name }}"
                            data-summary="{{ $product->name }}" data-price="{{ $product->price }}" data-quantity="1"
                            data-image="{{ asset($image) }}" class="btn btn-light wishlist btn-long cart my-cart-btn">Add to
                            Cart</button>
                    </div>
                    <hr>
                    <div class="product-description d-flex flex-column">
                        <div><span class="font-weight-bold">Color:</span><span> </span></div>
                        <div class="my-color">
                            @foreach (json_decode($product->size) as $size)
                                <label class="radio"> <input type="radio" name="product_size" value="MALE" checked>
                                    <span>{{ $size }}</span> </label>
                            @endforeach
                        </div>
                        <div class="mt-2"> <span class="fs-4">Description</span>
                            <div>{!! html_entity_decode(@$product->description) !!}</div>
                        </div>
                        <br>
                        <div class="mt-3 mb-3"> <span class="fs-4">Physical Stores</span> </div>
                        <div class="d-flex flex-row gap-4">
                            @isset($stores)
                                @foreach (@$stores as $store)
                                    <a href="{{ route('frontend.find_single_store', $store->id) }}"
                                        class="d-flex flex-column align-items-center physical-store-item">
                                        <img src="{{ asset($store->store_image) }}" alt="{{ $store->name }}"
                                            class="store-image">
                                        <div class="d-flex flex-column ml-1 comment-profile">
                                            <span class="username mt-2 fs-6">{{ $store->name }}</span>
                                        </div>
                                    </a>
                                @endforeach
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>


    <script>
        $('#lightSlider').lightSlider({
            gallery: true,
            item: 1,
            loop: true,
            slideMargin: 0,
            thumbItem: 6
        });
    </script>
@endsection
