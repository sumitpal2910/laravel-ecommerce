<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title> @yield('title') Laravel Ecommerce</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

    <!-- Toastr css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

    <!-- Light box css-->
    <link href="{{ asset('frontend/assets/css/lightbox.css') }}" rel="stylesheet">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>


    <!-- Jquery -->
    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>

</head>

<body class="cnt-home">
    <!-- ============================================== HEADER ============================================== -->
    @include('frontend.body.header')

    <!-- ============================================== HEADER : END ============================================== -->
    
    @yield('content')
    <!-- /#top-banner-and-menu -->

    <!-- ============================================================= FOOTER ============================================================= -->
    @include('frontend.body.footer')
    <!-- ============================================================= FOOTER : END============================================================= -->


    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/lightbox.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}" defer></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}" defer></script>

    <!-- Toastr -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" defer>
    </script>

    <script>
        $(document).ready(function() {

            @if (Session::has('message'))
                let type = "{{ Session::get('alert-type', 'info') }}";
            
                switch (type) {
                case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            
                case 'success':
                toastr.success(" {{ session('message') }}");
                break;
            
                case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            
                case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
                }
            @endif
        });
    </script>
</body>

</html>
