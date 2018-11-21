<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

    <head>
        <title> @yield('meta_title', 'Админ панель') </title>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
        <meta name="csrf-token" content="{{ csrf_token() }}"/>
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset($folder_path.'/img/apple-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset($folder_path.'/img/favicon.png') }}">
        <!--     Fonts and icons     -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- CSS Files -->
        <link rel="stylesheet" href="{{ asset($folder_path.'/css/bootstrap.min.css') }}" />
        <link rel="stylesheet" href="{{ asset($folder_path.'/css/now-ui-dashboard.css?v=1.1.0') }}" />
        <!-- CSS Just for demo purpose, don't include it in your project -->
{{--        <link href="{{ asset('backend/demo/demo.css" rel="stylesheet') }}" />--}}

        <link rel="stylesheet" href="{{ asset($folder_path.'/css/main.css') }}" />
        @stack('style')

    </head>

    <body class="">
        <div class="wrapper ">

            @section('sidebar')
                @include($prefix.'layout.sidebar')
            @show
            <div class="main-panel">
                @section('navbar')
                    @include($prefix.'layout.navbar')
                @show

                @section('panel-header')
                    @if(route('admin.dashboard') == URL::current())
                        @include($prefix.'layout.panel-header.lg')
                    @else
                        @include($prefix.'layout.panel-header.sm')
                    @endif
                @show

                <div class="content">
                    @section('content') @show
                </div>

                @section('footer')
                    @include($prefix.'layout.footer')
                @show
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="{{ asset($folder_path.'/js/core/jquery.min.js') }}"></script>
        <script src="{{ asset($folder_path.'/js/core/popper.min.js') }}"></script>
        <script src="{{ asset($folder_path.'/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset($folder_path.'/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
        <!--  Google Maps Plugin    -->
        {{--<script src="https://maps.googleapis.com/maps/api/js"></script>--}}

        <!-- Chart JS -->
        <script src="{{ asset($folder_path.'/js/plugins/chartjs.min.js') }}"></script>
        <!--  Notifications Plugin    -->
        <script src="{{ asset($folder_path.'/js/plugins/bootstrap-notify.js') }}"></script>
        <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="{{ asset($folder_path.'/js/now-ui-dashboard.min.js?v=1.1.0') }}"></script>
        <!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
        <script src="{{ asset($folder_path.'/demo/demo.js') }}"></script>
        <script>
            $(document).ready(function() {
                // Javascript method's body can be found in assets/js/demos.js
                demo.initDashboardPageCharts();
            });
        </script>
        <script src="{{ asset($folder_path.'/js/plugins/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset($folder_path.'/js/main.js') }}"></script>
        <script>
            $(document).ready(function(){
                @if(session()->has('notification_primary'))
                    primaryNotification('{!! session('notification_primary') !!}');
                @endif
                @if(session()->has('notification_info'))
                    infoNotification('{!! session('notification_info') !!}');
                @endif
                @if(session()->has('notification_success'))
                    successNotification('{!! session('notification_success') !!}');
                @endif
                @if(session()->has('notification_warning'))
                    warningNotification('{!! session('notification_warning') !!}');
                @endif
                @if(session()->has('notification_danger'))
                    dangerNotification('{!! session('notification_danger') !!}');
                @endif
            });

        </script>
        @stack('script')
        <div id="loader" style="display:none;"></div>
    </body>

</html>
