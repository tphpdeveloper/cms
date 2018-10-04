<!DOCTYPE html>
<html lang="ru">

    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/img/apple-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('backend/img/favicon.png') }}">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>
            @yield('meta_title', 'Панель прибров')
        </title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- CSS Files -->
        <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('backend/css/now-ui-dashboard.css?v=1.1.0') }}" rel="stylesheet" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link href="{{ asset('backend/demo/demo.css" rel="stylesheet') }}" />
        @stack('style')

    </head>

    <body class="">
        <div class="wrapper ">

            @include(config('myself.folder').'.layout.sidebar')
            <div class="main-panel">
                @include(config('myself.folder').'.layout.navbar')

                @section('panel-header') @show

                <div class="content">
                    @section('content') @show
                </div>

                @include(config('myself.folder').'.layout.footer')
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="{{ asset('backend/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('backend/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('backend/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Chart JS -->
        <script src="{{ asset('backend/js/plugins/chartjs.min.js') }}"></script>
        <!--  Notifications Plugin    -->
        <script src="{{ asset('backend/js/plugins/bootstrap-notify.js') }}"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset('backend/js/now-ui-dashboard.min.js?v=1.1.0') }}" type="text/javascript"></script>
        <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset('backend/demo/demo.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Javascript method's body can be found in assets/js/demos.js
                demo.initDashboardPageCharts();

            });
        </script>
        @stack('script')

    </body>

</html>
