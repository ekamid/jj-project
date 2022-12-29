@extends('layouts.app')

@section('styles')
    <link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
    <link rel="stylesheet" href="{{ asset('frontend/css/product-details.css') }}">
@endsection

@section('content')
    <div class="container mt-2 mb-3">
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
                    <div class="buttons"> <button class="btn btn-outline-warning btn-long cart">Add to Cart</button>
                        <button class="btn btn-warning btn-long buy">Buy it Now</button> <button
                            class="btn btn-light wishlist"> <i class="fa fa-heart"></i> </button>
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
                <div class="card mt-2"> <span>Similar items:</span>
                    <div class="similar-products mt-2 d-flex flex-row">
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img
                                src="https://i.imgur.com/KZpuufK.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$1,999</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img
                                src="https://i.imgur.com/GwiUmQA.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$1,699</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img
                                src="https://i.imgur.com/c9uUysL.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$2,999</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;margin-right: 3px;"> <img
                                src="https://i.imgur.com/kYWqL7k.jpg" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$3,999</h6>
                            </div>
                        </div>
                        <div class="card border p-1" style="width: 9rem;"> <img src="https://i.imgur.com/DhKkTrG.jpg"
                                class="card-img-top" alt="...">
                            <div class="card-body">
                                <h6 class="card-title">$999</h6>
                            </div>
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
