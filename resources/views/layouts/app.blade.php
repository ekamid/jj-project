<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        J Jewllery
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript">
      addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-updated.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">

    @yield('styles')

    <!-- font -->
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" />
    <link
        href="//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic"
        rel="stylesheet" type="text/css" />
    <!-- //font -->

</head>

<body>

    @include('frontend.top_header')
    @include('frontend.bottom_header')

    @yield('content')

    @include('frontend.footer')


    <script src="{{ asset('frontend/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('frontend/js/minicart.js') }}"></script>
    <script src="{{ asset('frontend/js/easyResponsiveTabs.js') }}"></script>

    @yield('scripts')


    <script type="text/javascript">
        $(document).ready(function() {
            $("#horizontalTab").easyResponsiveTabs({
                type: "default", //Types: default, vertical, accordion
                width: "auto", //auto or any width like 600px
                fit: true, // 100% fit in a container
            });
        });
    </script>


    <!-- cart-js -->
    <script>
        w3ls1.render();

        w3ls1.cart.on("w3sb1_checkout", function(evt) {
            var items, len, i;

            if (this.subtotal() > 0) {
                items = this.items();

                for (i = 0, len = items.length; i < len; i++) {
                    items[i].set("shipping", 0);
                    items[i].set("shipping2", 0);
                }
            }
        });
    </script>
    <!-- //cart-js -->
</body>


</html>
