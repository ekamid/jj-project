<div class="search-container card">
    <form class="form-inline my-2 my-lg-0 d-flex" method="POST" action="{{ route('frontend.product_search') }}">
        @csrf
        <input class="form-control mr-sm-2 border-0" type="text" name="search_term" placeholder="Product Name Keyward"
            aria-label="Search" required>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
</div>
