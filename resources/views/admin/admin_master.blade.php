<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href=" {{ asset('backend/images/favicon.ico') }}">

        <title> @yield('title') | Ecommerce</title>

        <!-- Vendors Style-->
        <link rel="stylesheet" href=" {{ asset('backend/css/vendors_css.css') }}">
        <!-- Style-->
        <link rel="stylesheet" href=" {{ asset('backend/css/style.css') }}">
        <link rel="stylesheet" href=" {{ asset('backend/css/skin_color.css') }}">
        <!-- Toastr css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />

        <!--Jquery Ui-->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <!--Tree JS-->
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />


        <link rel="stylesheet" href="{{asset('css/backend_custom.css')}}">

        <!-- Jquery -->
        <script src="{{ asset('../assets/vendor_components/jquery-3.3.1/jquery-3.3.1.min.js') }}"></script>

        <!-- Config-->
        <script src="{{ asset('backend/js/config/config.js') }}"></script>


    </head>

    <body class="hold-transition dark-skin sidebar-mini theme-primary fixed sidebar-collapse">

        <div class="wrapper">

            <!-- Header -->
            @include('admin.body.header')

            <!-- Left Sidebar-->
            @include('admin.body.sidebar')


            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">

                @yield('content')


            </div>
            <!-- /.content-wrapper -->

            <!-- Footer -->
            @include('admin.body.footer')



            <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
            <div class="control-sidebar-bg"></div>

        </div>
        <!-- ./wrapper -->
        <script type="text/javascript">
            let CSRF_TOKEN = $(`meta[name="csrf-token"]`).attr('content');
            let BASE_URL = window.location.origin + "/";
        </script>

        <!-- Vendor JS -->
        <script src="{{ asset('backend/js/vendors.min.js') }}" defer></script>
        <script src="{{ asset('../assets/icons/feather-icons/feather.min.js') }}" defer></script>
        <script src="{{ asset('../assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}" defer>
        </script>
        <script src="{{ asset('../assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}" defer>
        </script>
        {{-- <script src="{{ asset('../assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}" defer>
        </script> --}}



        <!-- Tags Input -->
        <script src="{{ asset('../assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}" defer>
        </script>

        <!-- CK Editor -->
        {{--<script src="{{ asset('../assets/vendor_components/ckeditor/ckeditor.js') }}" defer></script>
        <script src="{{ asset('backend/js/pages/editor.js') }}" defer></script>--}}

        <!-- Data Table -->
        <script src="{{ asset('../assets/vendor_components/datatable/datatables.min.js') }}" defer></script>
        {{--<script src="{{ asset('backend/js/pages/data-table.js') }}"></script>--}}

        <!-- Sunny Admin App -->
        <script src="{{ asset('backend/js/template.js') }}" defer></script>
        <script src="{{ asset('backend/js/pages/dashboard.js') }}" defer></script>

        <!-- Toastr -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
            defer>
        </script>


        <!--Jquery Ui-->
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js" defer></script>
        <!--Tree JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js" defer></script>




        <!-- ALl npm package -->
        <script src="{{ asset('js/app.js') }}" defer></script>


        <!-- =============== CONFIG ====================== -->
        <!-- data table -->
        <script src="{{ asset('backend/js/config/data-table.js') }}" defer></script>

        <!-- =============== PAGES ====================== -->
        <!-- Order  -->
        <script src="{{ asset('backend/js/custom/pages/products.js') }}" defer></script>
        <script src="{{ asset('backend/js/custom/pages/gallery.js') }}" defer></script>
        <script src="{{ asset('backend/js/custom/pages/video.js') }}" defer></script>
        <script src="{{ asset('backend/js/custom/pages/folder.js') }}" defer></script>
        <script src="{{ asset('backend/js/custom/pages/order.js') }}" defer></script>
        <script src="{{ asset('backend/js/custom/pages/report.js') }}" defer></script>


        <!-- Toastr Notification -->
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
        })
        </script>





    </body>

</html>
