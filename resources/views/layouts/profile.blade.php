<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        Joseka Automotive · Profile
    </title>
    <link rel="icon" href="/img/favicon.png">
    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap">
    <!-- Nucleo Icons -->

    <link href="{{ asset('./css/style-dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/nucleo-svg.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/style.css') }}" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">

</head>
<body class="g-sidenav-show  bg-gray-200 ps ps--active-y">
    <main class="main-content position-relative max-height-vh-100 h-100">
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm sticky-top justify-content-between" style="background-color: #000;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" style="width: 210px; height: 55px;" alt="logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="/" style="color: #fff;">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="{{ url('/vehicles') }}" style="color: #fff;">Vehicles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="#nosotros" style="color: #fff;">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="#contacto" style="color: #fff;">Contact</a>
                        </li>
                        @guest
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #fff;">
                                <i class="fas fa-user-circle fa-lg"></i>
                                <i class="fas fa-caret-down fa-md"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('register') }}" style="color: #000;">Register</a>
                                <a class="dropdown-item" href="{{ route('login') }}" style="color: #000;">Login</a>
                            </div>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link no-uppercase" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="color: #fff;">
                                <i class="fas fa-user-circle fa-lg"></i>
                                {{ Auth::user()->name }}
                                <i class="fas fa-caret-down fa-md"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}" style="color: #000;">
                                    Profile
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #000;">
                                    Sign out
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

        <div class="container-fluid py-4">
            <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('{{ asset('img/fondo-profile.jpg') }}');">
                <span class="mask bg-gradient-dark opacity-6"></span>
            </div>
            <div class="card card-body mx-3 mx-md-4 mt-n6">
                <div class="row gx-4 mb-2">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm" style="width: 100px; height: 70px; object-fit: cover;">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ Auth::user()->name }}
                            </h5>
                            <p class="mb-0 font-weight-normal text-sm">
                                {{ Auth::user()->is_admin ? 'Admin' : Auth::user()->role }}
                            </p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <!-- Columna de Información Básica -->
                        <div class="col-12 col-xl-4">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <h6 class="mb-0">Basic Information</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control border" id="name" name="name" value="{{ auth()->user()->name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="phone_number" class="form-label">Mobile</label>
                                        <input type="text" class="form-control border" id="phone_number" name="phone_number" value="{{ auth()->user()->phone_number }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" class="form-control border" id="city" name="city" value="{{ auth()->user()->city }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="address" class="form-label">Address</label>
                                        <input type="text" class="form-control border" id="address" name="address" value="{{ auth()->user()->address }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Columna de Información de Contacto -->
                        <div class="col-12 col-xl-4">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <h6 class="mb-0">Email Information</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control border" id="email" name="email" value="{{ auth()->user()->email }}">
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label for="password" class="form-label">New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border" id="password" name="password">
                                            <span class="input-group-text ms-2" onclick="togglePasswordVisibility('password')">
                                                <i class="material-icons mx-2" style="color: black;">visibility</i> <!-- Icono de ojo -->
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control border" id="password_confirmation" name="password_confirmation">
                                            <span class="input-group-text ms-2" onclick="togglePasswordVisibility('password_confirmation')">
                                                <i class="material-icons mx-2" style="color: black;">visibility</i> <!-- Icono de ojo -->
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Columna de Foto de Perfil -->
                        <div class="col-12 col-xl-4">
                            <div class="card card-plain h-100">
                                <div class="card-header pb-0 p-3">
                                    <h6 class="mb-0">Profile Photo</h6>
                                </div>
                                <div class="card-body p-3">
                                    <div class="mb-3">
                                        <label for="profile_photo" class="form-label">Upload New Photo</label>
                                        <input type="file" class="form-control border" id="profile_photo" name="profile_photo">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-danger" style="background-color: #9c2121;">Update All</button>
                        </div>
                    </div>
                </form>

                <script>
                    function togglePasswordVisibility(inputId) {
                        const passwordInput = document.getElementById(inputId);
                        const passwordIcon = passwordInput.nextElementSibling.querySelector('i');
                        if (passwordInput.type === "password") {
                            passwordInput.type = "text";
                            passwordIcon.textContent = "visibility_off"; // Cambia el ícono a "visibility_off" cuando la contraseña es visible
                        } else {
                            passwordInput.type = "password";
                            passwordIcon.textContent = "visibility"; // Cambia el ícono a "visibility" cuando la contraseña está oculta
                        }
                    }
                </script>

            </div>
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
                            <div class="col-12 d-flex justify-content-center gap-4 flex-wrap">
                                <a class="footer-link mx-4" href="/">Home</a>
                                <a class="footer-link mx-4" href="#articles">Vehicles</a>
                                <a class="footer-link mx-4" href="#becomePartner">About us</a>
                                <a class="footer-link mx-4" href="#about">Contact</a>
                                <a class="footer-link mx-2 " href="https://twitter.com/joseka_mt">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="footer-link mx-4 " href="https://www.instagram.com/joseka_mt/">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </div>
                        </div>
                        <hr class="horizontal light">
                        <div class="row">
                            <div class="col-12">
                                <hr class="my-2" style="border-color: white;">
                                <p class="text-center text-white-600 mt-2">
                                    Copyright © <script>
                                        document.write(new Date().getFullYear());
                                    </script> All rights reserved.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/chartjs.min.js"></script>
    <script>
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["M", "T", "W", "T", "F", "S", "S"],
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "rgba(255, 255, 255, .8)",
                    data: [50, 20, 10, 22, 50, 10, 40],
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Nunito",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Nunito",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 320, 500, 350, 200, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Nunito",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Nunito",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });

        var ctx3 = document.getElementById("chart-line-tasks").getContext("2d");

        new Chart(ctx3, {
            type: "line",
            data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "Mobile apps",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(255, 255, 255, .8)",
                    pointBorderColor: "transparent",
                    borderColor: "rgba(255, 255, 255, .8)",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5],
                            color: 'rgba(255, 255, 255, .2)'
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#f8f9fa',
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Nunito",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#f8f9fa',
                            padding: 10,
                            font: {
                                size: 14,
                                weight: 300,
                                family: "Nunito",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        });
    </script>

    <script>
        /*NO BORRAR*/
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
        /*NO BORRAR*/
        /*OCULTAR SCROLL LATERAL*/
        document.addEventListener("DOMContentLoaded", function() {
            const mainContent = document.querySelector('.main-content');
            if (mainContent.classList.contains('ps--active-x')) {
                mainContent.classList.remove('ps--active-x');
            }
        });
        /*NO BORRAR*/
        const ps = new PerfectScrollbar('.main-content', {
            suppressScrollX: true

        });
        document.querySelector('.main-content').addEventListener('ps-scroll-x', function() {
            this.classList.remove('ps--active-x');
        });


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

    <!--APP -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
</body>

</html>