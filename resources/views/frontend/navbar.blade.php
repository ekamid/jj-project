    <nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

        <div class="container">
            <a class="navbar-brand" href="/">AJ<span>.</span></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('frontend.shop') ? 'active' : '' }}"><a class="nav-link"
                            href="{{ route('frontend.shop') }}">Shop</a></li>

                    <li class="nav-item {{ request()->routeIs('frontend.find_stores') ? 'active' : '' }}"><a
                            class="nav-link" href="{{ route('frontend.find_stores') }}">Find Store</a></li>
                </ul>

                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="{{ route('frontend.user.dashboard') }}"><img
                                src="{{ asset('frontend/images/user.svg') }}"></a></li>
                    <li><a class="nav-link" style="position: relative" href="{{ route('frontend.cart') }}"><img
                                src="{{ asset('frontend/images/cart.svg') }}">
                            <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span
                                    class="badge badge-notify my-cart-badge"></span></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </nav>
