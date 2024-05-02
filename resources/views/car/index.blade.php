@extends('layouts.admin')

@section('template_title')
Cars
@endsection

@section('content')
<div class="row mb-4">
                <div class="col-lg-9 col-md-7 mb-md-0 mb-4"> <!-- Modificado -->
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-6 col-7">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">{{ __('Projects') }}</span>
                        <div class="float-right">
                            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#createCarModal">
                                {{ __('Create New') }}
                            </button>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success m-4">
                    <p>{{ $message }}</p>
                </div>
                @endif
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Image</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Brand</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Model</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Body</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fuel</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gears</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Engine</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Horsepower</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Seats</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Color</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price Per Hour</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                <tr>
                                    <td class="text-center">
                                        @if($car->image1)
                                        <img src="{{ asset('storage/' . $car->image1) }}" alt="Car Image" style="max-width: 50px; max-height: 50px;">
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
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editCarModal{{ $car->id }}">
                                            <i class="fa fa-fw fa-edit fa-lg"></i>
                                        </button>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#showCarModal{{ $car->id }}">
                                            <i class="fa fa-fw fa-eye fa-lg"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCarModal{{ $car->id }}">
                                            <i class="fa fa-fw fa-trash fa-lg"></i>
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
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="showCarModalLabel{{ $car->id }}">Show Car</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container-fluid">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <strong>Brand:</strong>
                                                                <p>{{ $car->brand }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Model:</strong>
                                                                <p>{{ $car->model }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Body:</strong>
                                                                <p>{{ $car->body }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Fuel:</strong>
                                                                <p>{{ $car->fuel }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Gears:</strong>
                                                                <p>{{ $car->gears }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Engine:</strong>
                                                                <p>{{ $car->engine }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Horsepower:</strong>
                                                                <p>{{ $car->horsepower }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Seats:</strong>
                                                                <p>{{ $car->seats }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Color:</strong>
                                                                <p>{{ $car->color }}</p>
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Price Per Hour:</strong>
                                                                <p>{{ $car->price_per_hour }}</p>
                                                            </div>
                                                            @if($car->image1)
                                                            <div class="form-group">
                                                                <strong>Image 1:</strong>
                                                                <br>
                                                                <img src="{{ asset('storage/' . $car->image1) }}" alt="Image 1" style="max-width: 200px;">
                                                            </div>
                                                            @endif
                                                            @if($car->image2)
                                                            <div class="form-group">
                                                                <strong>Image 2:</strong>
                                                                <br>
                                                                <img src="{{ asset('storage/' . $car->image2) }}" alt="Image 2" style="max-width: 200px;">
                                                            </div>
                                                            @endif
                                                            @if($car->image3)
                                                            <div class="form-group">
                                                                <strong>Image 3:</strong>
                                                                <br>
                                                                <img src="{{ asset('storage/' . $car->image3) }}" alt="Image 3" style="max-width: 200px;">
                                                            </div>
                                                            @endif
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