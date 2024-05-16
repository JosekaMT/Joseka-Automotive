<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('template_title') · Joseka Automotive</title>
    <link rel="icon" href="/img/favicon.png">
    <!-- Google Fonts: Nunito -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap">
    <!-- Styles -->
    <link href="{{ asset('./css/style-notifications.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/style-client.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/nucleo-svg.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/style-rent.css') }}" rel="stylesheet">
    <link href="{{ asset('./css/style-card.css') }}" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
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
        <nav class="navbar navbar-expand-md navbar-dark shadow-sm sticky-top justify-content-between"
            style="background-color: #000;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo.png') }}" style="width: 210px; height: 55px;" alt="logo">
                </a>
                <!-- Botón personalizado para todos los dispositivos -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line line-white"></i>
                        <i class="sidenav-toggler-line line-white"></i>
                        <i class="sidenav-toggler-line line-white"></i>
                    </div>
                </button>
                <!-- Contenido del menú -->
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="{{ url('/vehicles') }}">Vehicles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="#nosotros">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-uppercase" href="#contacto">Contact</a>
                        </li>
                        @guest
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user-circle fa-lg" style="font-size: 24px;"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                    <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                </div>
                            </li>
                        @else
                            <li class="nav-item dropdown position-relative">
                                <a class="nav-link dropdown-toggle" href="#" id="notificationsDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="material-icons notification-material-icons">notifications</i>
                                    @if (Auth::user()->unreadNotifications->count() > 0)
                                        <span
                                            class="notification-badge-custom">{{ Auth::user()->unreadNotifications->count() }}</span>
                                    @endif
                                </a>
                                <ul class="notification-dropdown-menu-custom dropdown-menu dropdown-menu-end p-3 shadow"
                                    aria-labelledby="notificationsDropdown" style="width: 280px;">
                                    @forelse(Auth::user()->unreadNotifications as $notification)
                                        <li class="notification-dropdown-item-custom d-flex justify-content-between align-items-center"
                                            id="notification-{{ $notification->id }}">
                                            @php
                                                $url = '';
                                                $status = $notification->data['status'] ?? null;
                                                if ($status == 'approved' || $status == 'rejected') {
                                                    $url = url('/billing');
                                                } else {
                                                    $url = url('/admin/notifications');
                                                }
                                            @endphp
                                            <a href="{{ $url }}" class="text-decoration-none text-dark w-100">
                                                <div>
                                                    @if (!empty($notification->data['admin_name']))
                                                        <strong>{{ $notification->data['admin_name'] }}:</strong><br>
                                                    @endif
                                                    @if ($status == 'approved')
                                                        Has approved your rental request.
                                                    @elseif ($status == 'rejected')
                                                        Has rejected your rental request.
                                                    @else
                                                        <strong>{{ $notification->data['user_name'] ?? 'User' }}:</strong><br>
                                                        Has requested to rent a car.
                                                    @endif
                                                    <br>
                                                    <small
                                                        class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                </div>
                                            </a>
                                            <button class="notification-close-btn-custom"
                                                onclick="markNotificationAsRead(event, '{{ $notification->id }}'); event.stopPropagation();">
                                                <i class="material-icons" style="color: #9c2121;">close</i>
                                            </button>
                                        </li>
                                    @empty
                                        <li class="notification-dropdown-item-custom text-center w-100"
                                            id="no-notifications">No notifications</li>
                                    @endforelse
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="profile_image"
                                        class="rounded-circle mx-1" style="width: 32px; height: 32px; object-fit: cover;">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ url('/admin') }}">Dashboard</a>
                                    @endif
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
                                        out</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-5">
            @yield('content')
        </main>

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
                                    Copyright ©
                                    <script>
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
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
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
    <script>
        function markNotificationAsRead(event, notificationId) {
            event.preventDefault();
            fetch(`/notifications/${notificationId}/mark-as-read`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(response => {
                if (response.ok) {
                    document.getElementById(`notification-${notificationId}`).remove();
                    if (!document.querySelector('.notification-dropdown-item-custom')) {
                        const noNotificationsItem = document.createElement('li');
                        noNotificationsItem.id = 'no-notifications';
                        noNotificationsItem.className = 'notification-dropdown-item-custom text-center w-100';
                        noNotificationsItem.textContent = 'No notifications';
                        document.querySelector('.notification-dropdown-menu-custom').appendChild(
                            noNotificationsItem);
                    }
                    const badge = document.querySelector('.notification-badge-custom');
                    if (badge) {
                        const count = parseInt(badge.textContent, 10) - 1;
                        if (count > 0) {
                            badge.textContent = count;
                        } else {
                            badge.remove();
                        }
                    }
                }
            });
        }
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
