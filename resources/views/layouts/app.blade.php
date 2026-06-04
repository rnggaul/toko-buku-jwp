<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Pencatatan Stok Barang')</title>
    
    <link rel="shortcut icon" href="{{ asset('hope-ui/assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/core/libs.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/vendor/aos/dist/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/hope-ui.min.css?v=2.0.0') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/custom.min.css?v=2.0.0') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/dark.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/customizer.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('hope-ui/assets/css/rtl.min.css') }}" />
    @stack('styles')
</head>
<body class=" ">
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    @include('partials.sidebar')

    <main class="main-content">
        <div class="position-relative iq-banner">
            @include('partials.navbar')
            @yield('page-header')
        </div>
        
        @yield('content')

        @include('partials.footer')
    </main>

    @include('partials.scripts')
    @stack('scripts')
</body>
</html>