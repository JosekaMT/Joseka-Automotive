@extends('layouts.admin')

@section('template_title')
Cars
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header pb-0">
                <div class="row">
                    <div class="col-lg-6 col-7">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h4 id="card_title"><i class="fa fa-car"></i> {{ __('Cars') }}</h4>
                        </div>
                    </div>

                    <div class="px-0">
                        @if ($message = Session::get('success'))
                        <div class="alert alert-success m-2">
                            <p>{{ $message }}</p>
                        </div>
                        @endif
                    </div>

                    <div class="card-body px-0 pb-2">
                        <div class="float">

                            <button class="btn btn-success btn-sm align-content-md-end" data-toggle="modal" data-target="#createCarModal">
                                <i class="fa fa-plus"></i> Create New
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Brand</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Model</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Body</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fuel</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gears</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Engine (CC)</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Horsepower (CV)</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Seats</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Color</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price Per Hour (€)</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cars as $car)
                                    <tr>
                                        <td class="text-center">{{ $car->id }}</td>
                                        <td class="text-center">
                                            @if($car->image1)
                                            <img src="{{ asset('storage/' . $car->image1) }}" alt="Car Image" style="max-width: 150px; max-height: 150px;">
                                            @else
                                            No Image
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $car->brand }}</td>
                                        <td class="text-center">{{ $car->model }}</td>
                                        <td class="text-center">{{ $car->body }}</td>
                                        <td class="text-center">{{ $car->fuel }}</td>
                                        <td class="text-center">{{ $car->gears }}</td>
                                        <td class="text-center">{{ $car->engine }}</td>
                                        <td class="text-center">{{ $car->horsepower }}</td>
                                        <td class="text-center">{{ $car->seats }}</td>
                                        <td class="text-center">{{ $car->color }}</td>
                                        <td class="text-center">{{ $car->price_per_hour }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#showCarModal{{ $car->id }}">
                                                <i class="fa fa-fw fa-eye" style="font-size: 1.3em;"></i>
                                            </button>
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCarModal{{ $car->id }}">
                                                <i class="fa fa-fw fa-edit" style="font-size: 1.2em;"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" style="background-color: #9c2121;" data-toggle="modal" data-target="#deleteCarModal{{ $car->id }}">
                                                <i class="fa fa-fw fa-trash" style="font-size: 1.2em;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Edit Car Modal -->
                                    <div class="modal fade" id="editCarModal{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="editCarModalLabel{{ $car->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editCarModalLabel{{ $car->id }}">Edit Car</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @php $car = $car ?? new \App\Models\Car; @endphp
                                                    <form method="POST" action="{{ route('cars.update', $car->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        @include('car.form')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Edit Car Modal -->
                                    <!-- Show Car Modal -->
                                    <div class="modal fade" id="showCarModal{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="showCarModalLabel{{ $car->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="showCarModalLabel{{ $car->id }}" style="color: black; font-size: 18px;">Show Car</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                        <ol class="carousel-indicators">
                                                            @if($car->image1)
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                                            @endif
                                                            @if($car->image2)
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                                            @endif
                                                            @if($car->image3)
                                                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                                            @endif
                                                        </ol>
                                                        <div class="carousel-inner">
                                                            @if($car->image1)
                                                            <div class="carousel-item active">
                                                                <img src="{{ asset('storage/' . $car->image1) }}" class="d-block mx-auto img-fluid" alt="Image 1" style="max-height: 300px;">
                                                            </div>
                                                            @endif
                                                            @if($car->image2)
                                                            <div class="carousel-item">
                                                                <img src="{{ asset('storage/' . $car->image2) }}" class="d-block mx-auto img-fluid" alt="Image 2" style="max-height: 300px;">
                                                            </div>
                                                            @endif
                                                            @if($car->image3)
                                                            <div class="carousel-item">
                                                                <img src="{{ asset('storage/' . $car->image3) }}" class="d-block mx-auto img-fluid" alt="Image 3" style="max-height: 300px;">
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" style="color: black;">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next" style="color: black;">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    </div>
                                                    <div class="container-fluid">
                                                        <div class="row mt-3">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Brand:</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->brand }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Model:</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->model }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Body:</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->body }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Fuel:</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->fuel }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Gears:</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->gears }}</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Engine (CC):</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->engine }} CC</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Horsepower (CV):</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->horsepower }} CV</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Seats:</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->seats }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Color:</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->color }}</p>
                                                                </div>
                                                                <div class="form-group">
                                                                    <strong style="color: black; font-size: 18px;">Price Per Hour (€):</strong>
                                                                    <p style="color: black; font-size: 18px;">{{ $car->price_per_hour }} €</p>
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
                                    <div class="modal fade" id="deleteCarModal{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCarModalLabel{{ $car->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteCarModalLabel{{ $car->id }}">Delete Car</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this car?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
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
    <div class="modal fade" id="createCarModal" tabindex="-1" role="dialog" aria-labelledby="createCarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCarModalLabel">{{ __('Create New Car') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @php $car = $car ?? new \App\Models\Car; @endphp
                    <form method="POST" action="{{ route('cars.store') }}" enctype="multipart/form-data">
                        @csrf
                        @include('car.form')

                    </form>
                </div>
            </div>
        </div>
    </div>

    @endsection