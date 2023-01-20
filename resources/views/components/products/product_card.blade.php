<div class="col-12 col-md-4 col-lg-3 mb-5">
    <div class="product-item">
        <a href="{{ route('frontend.product_details', @$item->slug) }}" style="text-decoration: none">
            <img src="{{ asset(json_decode(@$item->images)[0]) }}" class="img-fluid product-thumbnail">
            <h3 class="product-title">{{ @$item->name }}</h3>
            <strong class="product-price">৳{{ @$item->price }}</strong>
        </a>

        <span class="icon-cross add-to-cart-btn d-flex align-items-center justify-content-center"
            pId="{{ @$item->id }}" pName="{{ @$item->name }}" pImg="{{ asset(json_decode(@$item->images)[0]) }}"
            pPrice="{{ @$item->price }}" pSlug="{{ route('frontend.product_details', @$item->slug) }}">
            <i class="fa fa-plus" aria-hidden="true" style="color: #fff; font-size: 22px"></i>
        </span>
    </div>
</div>
