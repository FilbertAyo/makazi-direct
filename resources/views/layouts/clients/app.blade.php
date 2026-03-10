<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @stack('head')
    <title>@yield('title', 'Dashboard') – {{ config('app.name', 'Makazi Direct') }}</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
          crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <style>
        /* Landlord workspace: offset for fixed header (top bar + nav) */
        .landlord-workspace {
            padding-top: 120px;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .landlord-sidebar {
            width: 260px;
            min-height: calc(100vh - 120px);
            background: #fff;
            border-right: 1px solid #e9ecef;
            position: sticky;
            top: 120px;
        }
        .landlord-sidebar .nav-link {
            color: var(--light-text-color);
            padding: 0.75rem 1rem;
            border-radius: 0;
            border-left: 3px solid transparent;
            font-size: 15px;
        }
        .landlord-sidebar .nav-link:hover {
            color: var(--body-text-color);
            background-color: rgba(7, 140, 0, 0.06);
            border-left-color: var(--accent-color);
        }
        .landlord-sidebar .nav-link.active {
            color: var(--accent-color);
            font-weight: 600;
            background-color: rgba(7, 140, 0, 0.08);
            border-left-color: var(--accent-color);
        }
        .landlord-sidebar .nav-link i {
            width: 1.25rem;
            margin-right: 0.5rem;
            color: inherit;
        }
        .landlord-main {
            flex: 1;
            padding: 1.5rem 2rem 2rem;
        }
        @media (max-width: 991.98px) {
            .landlord-workspace { padding-top: 100px; }
            .landlord-sidebar {
                width: 100%;
                min-height: auto;
                top: 100px;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
            }
            .landlord-main { padding: 1rem; }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-light">
    @include('partials.header')

    <div class="landlord-workspace">
        <div class="container d-flex flex-column flex-lg-row">
     

        @include('layouts.clients.aside')

        <main class="landlord-main">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            
            @yield('content')
        </main>
        </div>
    </div>

    @include('partials.footer')

    <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
            crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    @stack('scripts')
</body>

</html>
