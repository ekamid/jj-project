<div class="product-section">
    <div class="container">
        <div class="row">
            <!-- Start Column 1 -->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h2 class="mb-4 section-title">{{ @$item['category']['name'] }}</h2>
                <p class="mb-4">{{ $item['category']['description'] }}</p>
                <p><a href="/category/{{ $item['category']['slug'] }}" class="btn">Explore</a></p>
            </div>
            <!-- End Column 1 -->

            <!-- Start Column 2 -->

            @foreach ($item['products'] as $item)
                @include('components.products.product_card')
            @endforeach
            <!-- End Column 2 -->

        </div>
    </div>
</div>
