<div class="header-bottom-w3ls">
    <div class="container">
        <div class="col-md-7 navigation-agileits">
            <nav class="navbar navbar-default">
                <div class="navbar-header nav_2">
                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse"
                        data-target="#bs-megadropdown-tabs">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                    <ul class="nav navbar-nav">
                        <li class="active">
                            <a href="index.html" class="hyper"><span>Home</span></a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle hyper" data-toggle="dropdown"><span>Clothing<b
                                        class="caret"></b></span></a>
                            <ul class="dropdown-menu multi">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <ul class="multi-column-dropdown">
                                            <li>
                                                <a href="women.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Women's Clothing</a>
                                            </li>
                                            <li>
                                                <a href="men.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Men's Clothing</a>
                                            </li>
                                            <li>
                                                <a href="kids.html">
                                                    <i class="fa fa-angle-right" aria-hidden="true"></i>Kid's
                                                    Wear</a>
                                            </li>
                                            <li>
                                                <a href="party.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Party Wear</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4">
                                        <ul class="multi-column-dropdown">
                                            <li>
                                                <a href="casuals.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Casuals</a>
                                            </li>
                                            <li>
                                                <a href="night.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Night Wear</a>
                                            </li>
                                            <li>
                                                <a href="formals.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Formals</a>
                                            </li>
                                            <li>
                                                <a href="inner.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Inner Wear</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle hyper" data-toggle="dropdown"><span> Personal
                                    Care <b class="caret"></b></span></a>
                            <ul class="dropdown-menu multi multi1">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <ul class="multi-column-dropdown">
                                            <li>
                                                <a href="jewellery.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Jewellery
                                                </a>
                                            </li>
                                            <li>
                                                <a href="watches.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Watches</a>
                                            </li>
                                            <li>
                                                <a href="cosmetics.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Cosmetics</a>
                                            </li>
                                            <li>
                                                <a href="deos.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Deo & Perfumes</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-4">
                                        <ul class="multi-column-dropdown">
                                            <li>
                                                <a href="haircare.html">
                                                    <i class="fa fa-angle-right" aria-hidden="true"></i>Hair Care
                                                </a>
                                            </li>
                                            <li>
                                                <a href="shoes.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Shoes</a>
                                            </li>
                                            <li>
                                                <a href="handbags.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Handbags</a>
                                            </li>
                                            <li>
                                                <a href="skincare.html"><i class="fa fa-angle-right"
                                                        aria-hidden="true"></i>Skin care</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </ul>
                        </li>
                        <li>
                            <a href="about.html" class="hyper"><span>About</span></a>
                        </li>
                        <li>
                            <a href="contact.html" class="hyper"><span>Contact Us</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        @section('scripts')
            <script>
                $(document).ready(function() {
                    $(".dropdown").hover(
                        function() {
                            $(".dropdown-menu", this).stop(true, true).slideDown("fast");
                            $(this).toggleClass("open");
                        },
                        function() {
                            $(".dropdown-menu", this).stop(true, true).slideUp("fast");
                            $(this).toggleClass("open");
                        }
                    );
                });
            </script>
        @endsection
        <div class="col-md-4 search-agileinfo">
            <form action="#" method="post">
                <input type="search" name="Search" placeholder="Search for a Product..." required="" />
                <button type="submit" class="btn btn-default search" aria-label="Left Align">
                    <i class="fa fa-search" aria-hidden="true"> </i>
                </button>
            </form>
        </div>
        <div class="col-md-1 cart-wthree">
            <div class="cart">
                <form action="#" method="post" class="last">
                    <input type="hidden" name="cmd" value="_cart" />
                    <input type="hidden" name="display" value="1" />
                    <button class="w3view-cart" type="submit" name="submit" value="">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
