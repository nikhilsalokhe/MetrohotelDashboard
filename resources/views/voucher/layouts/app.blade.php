<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ config('app.name', 'Metro Dashboard') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
  ============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('voucher/img/favicon.ico') }}">
    <!-- Google Fonts
  ============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
  ============================================ -->
    {{-- <link rel="stylesheet" href="{{ asset('voucher/css/bootstrap.min.css') }}"> --}}
    <!-- Bootstrap CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/font-awesome.min.css') }}">
    <!-- owl.carousel CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('voucher/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('voucher/css/owl.transitions.css') }}">
    <!-- meanmenu CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/meanmenu/meanmenu.min.css') }}">
    <!-- animate CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/animate.css') }}">
    <!-- normalize CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/normalize.css') }}">
    <!-- mCustomScrollbar CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/scrollbar/jquery.mCustomScrollbar.min.css') }}">
    <!-- jvectormap CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/jvectormap/jquery-jvectormap-2.0.3.css') }}">
    <!-- notika icon CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/notika-custom-icon.css') }}">
    <!-- wave CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/wave/waves.min.css') }}">
    <!-- main CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/main.css') }}">
    <!-- style CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/style.css') }}">
    <!-- main CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/chosen/chosen.css') }}">
    <!-- bootstrap select CSS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/bootstrap-select/bootstrap-select.css') }}">
    <!-- responsive CSS
  ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/responsive.css') }}">
    <!-- modernizr JS
  ============================================ -->
    <script src="{{ asset('voucher/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    <!-- Data Table JS
    ============================================ -->
    <link rel="stylesheet" href="{{ asset('voucher/css/jquery.dataTables.min.css') }}">
    @include('partials.headerscript')
    <style>
        .custom-loader {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 8px solid;
            border-color: #E4E4ED;
            border-right-color: #03acfb;
            animation: s2 1s infinite linear;
            position: fixed;
            top: 50%;
            left: 57%;
            z-index: 9999;
        }

        @keyframes s2 {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
        .card-header{
        	background: linear-gradient(to right, #fecb4b, #e69814);
        }
    </style>
    
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('partials.navbar')
    </div>
    @include('partials.sidebar')
    <!-- Loading overlay -->
    <div class="content-wrapper ">
        <div id="processing" style="display: none;">
            <div class="imgarea">
                <div class="custom-loader"></div>
            </div>
        </div>
        <script>
            // Show the loader and content overlay when the page starts loading
            const loader = document.getElementById("processing");
            const contentOverlay = document.createElement("div");
            contentOverlay.id = "content-overlay";
            contentOverlay.style.cssText = "display: none; background: rgba(0, 200, 255, 0.3); z-index: 999; position: fixed; top: 0; left: 0; bottom: 0; right: 0;";
            
            document.body.appendChild(contentOverlay);
            loader.style.display = "block";
            contentOverlay.style.display = "block";
        
            // After the page is fully loaded, hide the loader and content overlay
            window.addEventListener("load", function() {
                loader.style.display = "none";
                contentOverlay.style.display = "none";
            });
        </script>
        
        <div class="row  p-5 auto-dismiss " style="position: absolute; top: 50px; left:50%; z-index: 1;">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <p>{{ \Session::get('success') }}</p>
                </div><br />
            @endif
            @if (\Session::has('warning'))
                <div class="alert alert-danger alert-block">
                    <p>{{ \Session::get('warning') }}</p>
                </div><br />
            @endif
        </div>

        <!-- Start Content area -->
        @yield('content')
        <!-- End Content area-->

        <!-- Start Footer area-->
        <div class="footer-copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="footer-copy-right">
                            <p>
                                The System is Designed & Developed By TribeAppsoft
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.footerscript')
    <!-- End Footer area-->
    <!-- jquery
  ============================================ -->
    <script src="{{ asset('voucher/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- bootstrap JS
  ============================================ -->
    <script src="{{ asset('voucher/js/bootstrap.min.js') }}"></script>
    <!-- wow JS
  ============================================ -->
    <script src="{{ asset('voucher/js/wow.min.js') }}"></script>
    <!-- price-slider JS
  ============================================ -->
    <script src="{{ asset('voucher/js/jquery-price-slider.js') }}"></script>
    <!-- owl.carousel JS
  ============================================ -->
    <script src="{{ asset('voucher/js/owl.carousel.min.js') }}"></script>
    <!-- scrollUp JS
  ============================================ -->
    <script src="{{ asset('voucher/js/jquery.scrollUp.min.js') }}"></script>
    <!-- meanmenu JS
  ============================================ -->
    <script src="{{ asset('voucher/js/meanmenu/jquery.meanmenu.js') }}"></script>
    <!-- counterup JS
  ============================================ -->
    <script src="{{ asset('voucher/js/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('voucher/js/counterup/waypoints.min.js') }}"></script>
    <script src="{{ asset('voucher/js/counterup/counterup-active.js') }}"></script>
    <!-- mCustomScrollbar JS
  ============================================ -->
    <script src="{{ asset('voucher/js/scrollbar/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- jvectormap JS
  ============================================ -->
    <script src="{{ asset('voucher/js/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('voucher/js/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('voucher/js/jvectormap/jvectormap-active.js') }}"></script>
    <!-- sparkline JS
  ============================================ -->
    <script src="{{ asset('voucher/js/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('voucher/js/sparkline/sparkline-active.js') }}"></script>
    <!-- sparkline JS
  ============================================ -->
    <script src="{{ asset('voucher/js/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('voucher/js/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('voucher/js/flot/curvedLines.js') }}"></script>
    <script src="{{ asset('voucher/js/flot/flot-active.js') }}"></script>
    <!-- knob JS
  ============================================ -->
    <script src="{{ asset('voucher/js/knob/jquery.knob.js') }}"></script>
    <script src="{{ asset('voucher/js/knob/jquery.appear.js') }}"></script>
    <script src="{{ asset('voucher/js/knob/knob-active.js') }}"></script>
    <!--  wave JS
  ============================================ -->
    <script src="{{ asset('voucher/js/wave/waves.min.js') }}"></script>
    <script src="{{ asset('voucher/js/wave/wave-active.js') }}"></script>
    <!--  todo JS
  ============================================ -->
    <script src="{{ asset('voucher/js/todo/jquery.todo.js') }}"></script>
    <!--  chosen JS
    ============================================ -->
    <script src="{{ asset('voucher/js/chosen/chosen.jquery.js') }}"></script>
    <!-- bootstrap select JS
    ============================================ -->
    <script src="{{ asset('voucher/js/bootstrap-select/bootstrap-select.js') }}"></script>
    <!-- plugins JS
  ============================================ -->
    <script src="{{ asset('voucher/js/plugins.js') }}"></script>
    <!--  Chat JS
  ============================================ -->
    <script src="{{ asset('voucher/js/chat/moment.min.js') }}"></script>
    <script src="{{ asset('voucher/js/chat/jquery.chat.js') }}"></script>
    <!-- main JS
  ============================================ -->
    <script src="{{ asset('voucher/js/main.js') }}"></script>
    <!-- tawk chat JS
  ============================================ -->
    {{-- <script src="{{ asset('voucher/js/tawk-chat.js')}}"></script> --}}
    <!-- Data Table JS
  ============================================ -->
    <script src="{{ asset('voucher/js/data-table/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('voucher/js/data-table/data-table-act.js') }}"></script>
</body>
<script>
    $(document).ready(function() {
        // Function to automatically dismiss the message after a specified delay
        function autoDismissMessage() {
            $('.auto-dismiss').fadeOut('slow', function() {
                $(this).remove();
            });
        }

        // Check if the message div exists
        if ($('.auto-dismiss').length) {
            // Set a timeout to dismiss the message after 30 seconds (30000 milliseconds)
            setTimeout(autoDismissMessage, 6000);
        }
    });
</script>

</html>
