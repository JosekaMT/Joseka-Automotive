@extends('layouts.admin')

@section('template_title')
    Vehicles
@endsection

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-0 shadow-none bg-black" id="navbarBlur">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Admin</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
                    </ol>
                    <h6 class="font-weight-normal mb-0 text-white" style="font-size: 1.2rem;">Dashboard</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <ul class="navbar-nav justify-content-end">
                        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line line-white"></i>
                                    <i class="sidenav-toggler-line line-white"></i>
                                    <i class="sidenav-toggler-line line-white"></i>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div class="icon icon-lg icon-shape shadow-danger text-center border-radius-xl mt-n4 position-absolute"
                                style="background-color: #9c2121;">
                                <i class="material-icons opacity-10">directions_car</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Vehicles</p>
                                <h4 class="mb-0">{{ $totalCars }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">car_rental</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Available Vehicles</p>
                                <h4 class="mb-0">{{ $availableCars }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">people</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Users</p>
                                <h4 class="mb-0">{{ $totalUsers }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">notifications</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Notifications</p>
                                <h4 class="mb-0">{{ $notificationsCount }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>



            </div>
            <div class="row mt-4">
            </div>

            <div class="row mb-4">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <h2 class="vehicle-heading2" id="card_title"> {{ __('Vehicles') }}</h2>
                                    </div>
                                </div>
                                <div class="px-0 d-flex justify-content">
                                    @if ($message = Session::get('success'))
                                        <div class="alert alert-success w-auto p-2 mt-2">
                                            <p>{{ $message }}</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body px-0 pb-2">
                                    <div class="float">
                                        <button class="btn btn-success btn-sm align-content-md-end" data-toggle="modal"
                                            data-target="#createCarModal">
                                            <i class="fa fa-plus"></i> Create New
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table align-items-center mb-0" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        ID</th>
                                                    <th>
                                                        Image</th>
                                                    <th>
                                                        Brand</th>
                                                    <th>
                                                        Model</th>
                                                    <th>
                                                        Body</th>
                                                    <th>
                                                        Fuel</th>
                                                    <th>
                                                        Gears</th>
                                                    <th>
                                                        Engine</th>
                                                    <th>
                                                        Horsepower</th>
                                                    <th>
                                                        Seats</th>
                                                    <th>
                                                        Color</th>
                                                    <th>
                                                        Availability</th>
                                                    <th>
                                                        Rental</th>
                                                    <th>
                                                        Price Per Hour</th>
                                                    <th>
                                                        Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($cars as $car)
                                                    <tr>
                                                        <td class="text-center">{{ $car->id }}</td>
                                                        <td class="text-center">
                                                            @if ($car->image1)
                                                                <img src="{{ asset('storage/' . $car->image1) }}"
                                                                    alt="Car Image"
                                                                    style="max-width: 130px; max-height: 130px; border-radius: 10px;">
                                                            @else
                                                                No Image
                                                            @endif
                                                        </td>

                                                        <td class="text-center">{{ $car->brand }}</td>
                                                        <td class="text-center">{{ $car->model }}</td>
                                                        <td class="text-center">{{ $car->body }}</td>
                                                        <td class="text-center">{{ $car->fuel }}</td>
                                                        <td class="text-center">{{ $car->gears }}</td>
                                                        <td class="text-center">{{ $car->engine }} CC</td>
                                                        <td class="text-center">{{ $car->horsepower }} HP</td>
                                                        <td class="text-center">{{ $car->seats }}</td>
                                                        <td class="text-center">{{ $car->color }}</td>

                                                        <td class="text-center">
                                                            @if ($car->available)
                                                                <span class="badge bg-success">Available</span>
                                                            @else
                                                                <span class="badge bg-danger">Not Available</span>
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if ($car->rented)
                                                                <span class="badge bg-warning">Rented</span>
                                                            @else
                                                                <span class="badge bg-secondary">Not Rented</span>
                                                            @endif
                                                        </td>

                                                        <td class="text-center">{{ $car->price_per_hour }} €</td>
                                                        <td class="text-center">
                                                            <div class="d-flex flex-column align-items-center">
                                                                <button type="button" class="btn btn-info btn-sm mb-1"
                                                                    data-toggle="modal"
                                                                    data-target="#showCarModal{{ $car->id }}">
                                                                    <i class="fa fa-fw fa-eye"
                                                                        style="font-size: 1.2em;"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-warning btn-sm mb-1"
                                                                    data-toggle="modal"
                                                                    data-target="#editCarModal{{ $car->id }}">
                                                                    <i class="fa fa-fw fa-edit"
                                                                        style="font-size: 1.2em;"></i>
                                                                </button>
                                                                <button type="button" class="btn btn-danger btn-sm mb-1"
                                                                    style="background-color: #9c2121;" data-toggle="modal"
                                                                    data-target="#deleteCarModal{{ $car->id }}">
                                                                    <i class="fa fa-fw fa-trash"
                                                                        style="font-size: 1.2em;"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Edit Car Modal -->
                                                    <div class="modal fade" id="editCarModal{{ $car->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="editCarModalLabel{{ $car->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document"
                                                            style="max-width: 800px;">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="editCarModalLabel{{ $car->id }}">Edit
                                                                        Vehicle</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @php $car = $car ?? new \App\Models\Car; @endphp
                                                                    <form method="POST"
                                                                        action="{{ route('cars.update', $car->id) }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        @include('car.form-edit')
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Edit Car Modal -->

                                                    <!-- Show Car Modal -->
                                                    <div class="modal fade" id="showCarModal{{ $car->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="showCarModalLabel{{ $car->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-scrollable modal-lg"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="showCarModalLabel{{ $car->id }}"
                                                                        style="color: black; font-size: 18px;">Show Vehicle
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div id="carouselExampleIndicators"
                                                                        class="carousel slide" data-ride="carousel">
                                                                        <ol class="carousel-indicators">
                                                                            @if ($car->image1)
                                                                                <li data-target="#carouselExampleIndicators"
                                                                                    data-slide-to="0" class="active"></li>
                                                                            @endif
                                                                            @if ($car->image2)
                                                                                <li data-target="#carouselExampleIndicators"
                                                                                    data-slide-to="1"></li>
                                                                            @endif
                                                                            @if ($car->image3)
                                                                                <li data-target="#carouselExampleIndicators"
                                                                                    data-slide-to="2"></li>
                                                                            @endif
                                                                        </ol>
                                                                        <div class="carousel-inner">
                                                                            @if ($car->image1)
                                                                                <div class="carousel-item active">
                                                                                    <img src="{{ asset('storage/' . $car->image1) }}"
                                                                                        class="d-block mx-auto img-fluid rounded"
                                                                                        alt="Image 1"
                                                                                        style="max-height: 300px; border-radius: 10px;">
                                                                                </div>
                                                                            @endif
                                                                            @if ($car->image2)
                                                                                <div class="carousel-item">
                                                                                    <img src="{{ asset('storage/' . $car->image2) }}"
                                                                                        class="d-block mx-auto img-fluid rounded"
                                                                                        alt="Image 2"
                                                                                        style="max-height: 300px; border-radius: 10px;">
                                                                                </div>
                                                                            @endif
                                                                            @if ($car->image3)
                                                                                <div class="carousel-item">
                                                                                    <img src="{{ asset('storage/' . $car->image3) }}"
                                                                                        class="d-block mx-auto img-fluid rounded"
                                                                                        alt="Image 3"
                                                                                        style="max-height: 300px; border-radius: 10px;">
                                                                                </div>
                                                                            @endif

                                                                        </div>
                                                                        <a class="carousel-control-prev"
                                                                            href="#carouselExampleIndicators"
                                                                            role="button" data-slide="prev"
                                                                            style="color: black;">
                                                                            <span class="carousel-control-prev-icon"
                                                                                aria-hidden="true"></span>
                                                                            <span class="sr-only">Previous</span>
                                                                        </a>
                                                                        <a class="carousel-control-next"
                                                                            href="#carouselExampleIndicators"
                                                                            role="button" data-slide="next"
                                                                            style="color: black;">
                                                                            <span class="carousel-control-next-icon"
                                                                                aria-hidden="true"></span>
                                                                            <span class="sr-only">Next</span>
                                                                        </a>
                                                                    </div>
                                                                    <div class="container-fluid">
                                                                        <div class="row mt-3">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Brand:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->brand }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Model:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->model }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Body:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->body }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Seats:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->seats }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Description:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->description }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Engine
                                                                                        (CC)
                                                                                        :</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->engine }} CC</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Horsepower
                                                                                        (HP):</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->horsepower }} HP</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Fuel:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->fuel }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Gears:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->gears }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Color:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->color }}</p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Available:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->available ? 'Yes' : 'No' }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Rented:</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->rented ? 'Yes' : 'No' }}
                                                                                    </p>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <strong
                                                                                        style="color: black; font-size: 18px;">Price
                                                                                        Per Hour (€):</strong>
                                                                                    <p
                                                                                        style="color: black; font-size: 18px;">
                                                                                        {{ $car->price_per_hour }} €</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Show Car Modal -->

                                                    <!-- Delete Car Modal -->
                                                    <div class="modal fade" id="deleteCarModal{{ $car->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="deleteCarModalLabel{{ $car->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="deleteCarModalLabel{{ $car->id }}">Delete
                                                                        Vehicle</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this vehicle?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form action="{{ route('cars.destroy', $car->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="button" class="btn btn-dark"
                                                                            data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn"
                                                                            style="background-color: #9c2121; color: white;">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Delete Car Modal -->
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Create Car -->
                <div class="modal fade" id="createCarModal" tabindex="-1" role="dialog"
                    aria-labelledby="createCarModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <!-- Agregamos la clase modal-lg para que el modal sea de ancho grande -->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createCarModalLabel">{{ __('Create New Vehicle') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                @php $car = $car ?? new \App\Models\Car; @endphp
                                <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    @include('car.form-create')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endsection
