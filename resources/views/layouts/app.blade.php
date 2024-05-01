<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Joseka Automotive') }}</title>

    <link rel="icon" href="/img/favicon.png">
    <!-- Google Fonts: Nunito -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/style.css') }}" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm sticky-top justify-content-between" style="background-color: #000;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" style="width: 210px; height: 55px;" alt="logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item mr-4">
                        <a class="nav-link text-uppercase" href="/" style="color: #fff;">Inicio</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link text-uppercase" href="#vehiculos" style="color: #fff;">Vehículos</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link text-uppercase" href="#nosotros" style="color: #fff;">Nosotros</a>
                    </li>
                    <li class="nav-item mr-4">
                        <a class="nav-link text-uppercase" href="#contacto" style="color: #fff;">Contacto</a>
                    </li>
                    @guest
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff;">
                            <i class="fas fa-user-circle fa-lg"></i>
                            <i class="fas fa-caret-down fa-md"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('register') }}" style="color: #000;">Registrarse</a>
                            <a class="dropdown-item" href="{{ route('login') }}" style="color: #000;">Iniciar sesión</a>
                        </div>
                    </li>
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #fff;">
                            <i class="fas fa-user-circle fa-lg"></i>
                            {{ Auth::user()->name }}
                            <i class="fas fa-caret-down fa-md"></i>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #000;">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
    </div>
    <footer class="text-white bg-black">
        <div class="container py-2">
            <div class="row">
                <div class="col-12 col-md-8 mx-auto">
                    <div class="text-center">
                        <div class="d-flex justify-content-center mb-4 mt-3">
                            <a href="/" class="logo-link">
                                <img src="/img/logo.png" class="img-fluid" style="width: 260px; height: 70px;">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center gap-7 flex-wrap">
                            <a class="footer-link mx-4" href="/">Inicio</a>
                            <a class="footer-link mx-4" href="#articles">Vehículos</a>
                            <a class="footer-link mx-4" href="#becomePartner">Nosotros</a>
                            <a class="footer-link mx-4" href="#about">Contacto</a>
                            <a class="footer-link mx-2 " href="https://twitter.com/joseka_mt">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="footer-link mx-4 " href="https://www.instagram.com/joseka_mt/">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <hr class="my-2" style="border-color: white;">
                            <p class="text-center text-white-600 mt-4">
                                Copyright © <script>
                                    document.write(new Date().getFullYear());
                                </script> Todos los derechos reservados.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="custom-button" id="top">
        <i class="fas fa-angle-up"></i>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script> <!--*Script principal de la aplicación-->
   
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
   
   <script>
        $(document).ready(function() {

            $("#top").click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 'smooth');
            });

            $(window).scroll(function() {
                if ($(this).scrollTop() > 50) {
                    $('#top').fadeIn('slow');
                } else {
                    $('#top').fadeOut('slow');
                }
            });
        });
    </script>
</body>

</html>