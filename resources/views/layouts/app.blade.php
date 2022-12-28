<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        Apurba Jewellary
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="application/x-javascript">
      addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
    </script>
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-icon.min.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/css/tiny-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

    @yield('styles')

    <!-- font -->
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet" />
    <link
        href="//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic"
        rel="stylesheet" type="text/css" />
    <!-- //font -->

</head>

<body>

    @include('frontend.navbar')

    @yield('content')

    @include('frontend.footer')


    <script src="{{ asset('frontend/js/jquery-3.6.3.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/js/tiny-slider.js') }}"></script>

    @yield('scripts')


</body>


</html>
