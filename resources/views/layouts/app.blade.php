<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'DPO') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Top Navigation -->
    @include('components.topnav')

    <!-- Sidebar -->
    @include('components.sidenav')

    <!-- Main Content -->
    <div class="content-container">
        @yield('content')
    </div>

    <script>
        window.addEventListener('scroll', function() {
            const goToTopBtn = document.getElementById('go-to-top');
            if (window.scrollY > 200) {
                goToTopBtn.classList.add('show');
            } else {
                goToTopBtn.classList.remove('show');
            }
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

    <script src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript" async
        src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
    </script>
</body>

</html>