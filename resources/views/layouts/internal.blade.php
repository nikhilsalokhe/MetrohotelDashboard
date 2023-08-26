<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Metro Dashboard') }}</title>
    @include('partials.headerscript')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('partials.navbar')
    </div>
    @include('partials.sidebar')
    <div class="content-wrapper pt-3">
        @yield('content')
    </div>
    <script>
        var URL = '{{ env('APP_URL') }}';
    </script>
    @include('partials.footerscript')
</body>

</html>
