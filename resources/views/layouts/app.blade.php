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

    <style>
        /* ==========================================================================
           1. PERBAIKAN BUG #1 & BUG #2: SINKRONISASI SIDEBAR MINI (QA VERIFIED)
           ========================================================================== */
        
        /* Hilangkan scroller horizontal (ke samping) yang bocor di sidebar mini */
        body.sidebar-mini .sidebar,
        body.sidebar-mini aside,
        body.sidebar-mini .sidebar-body {
            overflow-x: hidden !important;
        }

        /* Jika sidebar sedang mini, paksa menu dropdown (collapse) Master Data 
           untuk tidak bisa terbuka ke bawah agar tidak merusak layout */
        body.sidebar-mini .sidebar-body .collapse,
        body.sidebar-mini .sidebar-body .collapsing {
            display: none !important;
            height: 0 !important;
        }

        /* Sembunyikan ikon panah kecil penanda extend dropdown saat mode mini */
        body.sidebar-mini .sidebar-body .nav-item .sub-nav-toggle::after,
        body.sidebar-mini .sidebar-body .nav-item i.right-icon {
            display: none !important;
            opacity: 0 !important;
        }

        /* ==========================================================================
           2. TWEAK STYLING: TOMBOL TOGGLE KUSTOM & STATIC ITEM
           ========================================================================== */

        /* Menghilangkan ruang kosong "Menu Utama" saat sidebar mengecil */
        body.sidebar-mini .static-item,
        [data-toggle="sidebar"].sidebar-mini .static-item,
        .sidebar.sidebar-mini .static-item,
        aside.sidebar-mini .static-item,
        .sidebar-compact .static-item {
            display: none !important;
            height: 0 !important;
            min-height: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
            overflow: hidden !important;
            visibility: hidden !important;
        }

        /* Styling Dasar Tombol Toggle Kustom Baru */
        .custom-toggle-link {
            background-color: rgba(59, 138, 255, 0.08) !important;
            color: #3b8aff !important;
            padding: 0.65rem 1rem !important;
        }
        
        .custom-toggle-link:hover {
            background-color: #3b8aff !important;
            color: #ffffff !important;
        }

        .toggle-icon-box svg {
            transition: transform 0.3s ease;
        }

        /* Penyesuaian Sempurna Saat Sidebar Menjadi Mode Mini */
        body.sidebar-mini .toggle-text-label {
            display: none !important;
        }

        body.sidebar-mini .custom-toggle-link {
            justify-content: center !important;
            padding: 0.65rem 0 !important;
            margin: 0 0.5rem !important;
        }

        body.sidebar-mini .toggle-icon-box svg {
            transform: rotate(180deg);
        }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const customToggle = document.getElementById('customSidebarToggle');
        
        // 1. LOGIKA UTAMA: Tombol Toggle Kustom di Paling Bawah
        if (customToggle) {
            customToggle.addEventListener('click', function(e) {
                e.preventDefault();
                const nativeToggle = document.querySelector('[data-toggle="sidebar"]');

                if (nativeToggle && nativeToggle !== customToggle) {
                    nativeToggle.click();
                } else {
                    const sidebar = document.querySelector('.sidebar');
                    if (sidebar) {
                        sidebar.classList.toggle('sidebar-mini');
                    }
                    document.body.classList.toggle('sidebar-mini');
                }
            });
        }

        // 2. LOGIKA TAMBAHAN: Otomatis Lebarkan Sidebar Saat Menu Dropdown (Master Data) Diklik
        // Kita cari semua menu di sidebar yang memiliki pemicu dropdown/collapse
        const dropdownMenus = document.querySelectorAll('.sidebar .nav-item [data-bs-toggle="collapse"]');
        
        dropdownMenus.forEach(menu => {
            menu.addEventListener('click', function() {
                // Periksa apakah saat ini body sedang dalam mode mini
                const isMini = document.body.classList.contains('sidebar-mini');
                
                if (isMini) {
                    // Simulasikan klik pada toggle untuk melebarkan kembali sidebar secara natural
                    const nativeToggle = document.querySelector('[data-toggle="sidebar"]');
                    if (nativeToggle) {
                        nativeToggle.click();
                    } else {
                        // Jalankan Plan B jika tombol native tidak ketemu
                        const sidebar = document.querySelector('.sidebar');
                        if (sidebar) {
                            sidebar.classList.remove('sidebar-mini');
                        }
                        document.body.classList.remove('sidebar-mini');
                    }
                }
            });
        });
    });
</script>
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