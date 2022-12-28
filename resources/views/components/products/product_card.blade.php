<div class="col-12 col-md-4 col-lg-3 mb-5">
    <a class="product-item" href="product/{{ $item->slug }}">
        <img src="{{ asset(json_decode($item->images)[0]) }}" class="img-fluid product-thumbnail">
        <h3 class="product-title">{{ $item->name }}</h3>
        <strong class="product-price">৳{{ $item->price }}</strong>

        <span class="icon-cross d-flex align-items-center justify-content-center">
            <i class="fa fa-plus" aria-hidden="true" style="color: #fff; font-size: 22px"></i>
        </span>
    </a>
</div>
