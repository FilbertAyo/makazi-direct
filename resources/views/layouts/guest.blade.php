<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Makazi Direct') }} - Auth</title>

        <!-- Vendor & Theme CSS (Bootstrap + template) -->
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendor.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
              crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('assets/style.css') }}">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700&display=swap"
              rel="stylesheet">
    </head>
    <body>

    @include('partials.header')
 

        <main class="d-flex align-items-center justify-content-center"
              style="min-height: 100vh; padding-top: 80px;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="card shadow-sm border-0">
                            <div class="card-body p-4 p-lg-5">
                                {{ $slot }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        @include('partials.footer')

        <script src="{{ asset('assets/js/jquery-1.11.0.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
                crossorigin="anonymous"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('form').forEach(function(form) {
                var digitsInput = form.querySelector('input[id$="_digits"]');
                if (!digitsInput) return;
                var fullId = digitsInput.getAttribute('data-phone-full-id');
                if (!fullId) return;
                form.addEventListener('submit', function() {
                    var fullInput = document.getElementById(fullId);
                    if (!fullInput) return;
                    var digits = digitsInput.value.replace(/\D/g, '');
                    if (digits.length === 10 && digits.charAt(0) === '0') digits = digits.slice(1);
                    digits = digits.slice(0, 9);
                    fullInput.value = '+255' + digits;
                });
                digitsInput.addEventListener('input', function() {
                    var v = this.value.replace(/\D/g, '');
                    if (v.length === 10 && v.charAt(0) === '0') v = v.slice(1);
                    this.value = v.slice(0, 9);
                });
                digitsInput.addEventListener('paste', function(e) {
                    e.preventDefault();
                    var v = (e.clipboardData || window.clipboardData).getData('text').replace(/\D/g, '');
                    if (v.length === 10 && v.charAt(0) === '0') v = v.slice(1);
                    this.value = v.slice(0, 9);
                });
            });
        });
        </script>

    </body>
</html>
