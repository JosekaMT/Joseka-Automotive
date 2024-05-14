@extends('layouts.admin')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-0 shadow-none bg-black" id="navbarBlur">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Notifications</li>
                    </ol>
                    <h6 class="font-weight-normal mb-0 text-white" style="font-size: 1.2rem;">Notifications</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-xl-none d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            @forelse($notifications as $notification)
                @php
                    $rental = \App\Models\Rental::find($notification->data['rental_id']);
                    $user = $rental ? \App\Models\User::find($rental->user_id) : null;
                    $car = $rental ? \App\Models\Car::find($rental->car_id) : null;
                @endphp

                @if ($rental && $user && $car)
                    <div class="card mb-3 mt-3 mx-auto" style="max-width: 75%;">
                        <div class="card-body p-3">
                            <div class="d-flex align-items-start mb-2">
                                <div class="me-3">
                                    <div class="avatar avatar-xl position-relative">
                                        @if ($user->profile_photo)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="profile_image"
                                                class="w-100 border-radius-lg shadow-sm"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default-user.png') }}" alt="profile_image"
                                                class="w-100 border-radius-lg shadow-sm"
                                                style="width: 60px; height: 60px; object-fit: cover;">
                                        @endif
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0">
                                        {{ $user->name }}
                                    </h6>
                                    <p class="mb-0 text-sm">
                                        {{ $user->is_admin ? 'Admin' : 'Client' }}
                                    </p>
                                </div>
                                <div class="ms-4 d-flex flex-column">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="card-text mb-1">
                                                <strong>User ID:</strong> {{ $user->id }}<br>
                                                <strong>Email:</strong> {{ $user->email }}<br>
                                            </p>
                                        </div>

                                        <div class="col-md-4">
                                            <p class="card-text mb-1">
                                                <strong>Phone:</strong> {{ $user->phone_number ?? 'N/A' }}<br>
                                                <strong>City:</strong> {{ $user->city ?? 'N/A' }}<br>
                                            </p>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="card-text mb-1">
                                                <strong>Address:</strong> {{ $user->address ?? 'N/A' }}<br>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <p class="card-text mb-2">
                                        <strong>Car ID:</strong> {{ $car->id }}<br>
                                        <strong>Car:</strong> {{ $car->brand }} {{ $car->model }}<br>
                                        <strong>Rental Period:</strong> {{ $rental->start_date }} to
                                        {{ $rental->end_date }}<br>
                                        <strong>Total Price:</strong> {{ $rental->total_price }} €<br>
                                    </p>
                                    <form action="{{ route('admin.rentals.approve', $rental->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    <form action="{{ route('admin.rentals.reject', $rental->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            style="background-color: #9c2121; color: white;">Reject</button>
                                    </form>
                                    <p class="text-muted mt-1">
                                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                                    </p>
                                </div>
                                <div class="col-md-6 d-flex align-items-center justify-content-end">
                                    <!-- Mostrar foto del vehículo -->
                                    <img src="{{ asset('storage/' . $car->image1) }}" class="img-fluid rounded-end"
                                        alt="Car Photo"
                                        style="width: auto; height: 100%; max-height: 200px; object-fit: cover; border-radius: 10px;">
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <p>Notification data is incomplete or invalid.</p>
                @endif
            @empty
                <p>No notifications found.</p>
            @endforelse
        </div>
    @endsection
