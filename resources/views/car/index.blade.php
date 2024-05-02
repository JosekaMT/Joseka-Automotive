@extends('layouts.app')

@section('template_title')
Cars
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span id="card_title">{{ __('Cars') }}</span>
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
                <div class="card-body bg-white">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Brand</th>
                                    <th>Model</th>
                                    <th>Body</th>
                                    <th>Fuel</th>
                                    <th>Gears</th>
                                    <th>Engine</th>
                                    <th>Horsepower</th>
                                    <th>Seats</th>
                                    <th>Color</th>
                                    <th>Price Per Hour</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $car)
                                <tr>
                                    <td>{{ $car->id }}</td>
                                    <td>
                                        @if($car->image1)
                                        <img src="{{ asset('storage/' . $car->image1) }}" alt="Car Image" style="max-width: 130px; max-height: 130px;">
                                        @else
                                        No Image
                                        @endif
                                    </td>
                                    <td>{{ $car->brand }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->body }}</td>
                                    <td>{{ $car->fuel }}</td>
                                    <td>{{ $car->gears }}</td>
                                    <td>{{ $car->engine }}</td>
                                    <td>{{ $car->horsepower }}</td>
                                    <td>{{ $car->seats }}</td>
                                    <td>{{ $car->color }}</td>
                                    <td>{{ $car->price_per_hour }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#showCarModal{{ $car->id }}">
                                            <i class="fa fa-fw fa-eye"></i> Show
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteCarModal{{ $car->id }}">
                                            <i class="fa fa-fw fa-trash"></i> Delete
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $cars->withQueryString()->links() !!}
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

@foreach($cars as $car)
<!-- Show Car Modal -->
<div class="modal fade" id="showCarModal{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="showCarModalLabel{{ $car->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCarModalLabel{{ $car->id }}">{{ $car->brand }} - {{ $car->model }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group mb-2 mb20">
                    <strong>Brand:</strong>
                    {{ $car->brand }}
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Model:</strong>
                    {{ $car->model }}
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Body:</strong>
                    {{ $car->body }}
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Fuel:</strong>
                    {{ $car->fuel }}
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Gears:</strong>
                    {{ $car->gears }}
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Engine:</strong>
                    {{ $car->engine }}
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Horsepower:</strong>
                    {{ $car->horsepower }}
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Seats:</strong>
                    {{ $car->seats }}
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Color:</strong>
                    {{ $car->color }}
                </div>
                <div class="form-group mb-2 mb20">
                    <strong>Price Per Hour:</strong>
                    {{ $car->price_per_hour }}
                </div>

                @if($car->image1)
                <div class="form-group mb-2 mb20">
                    <strong>Image 1:</strong><br>
                    <img src="{{ asset('storage/' . $car->image1) }}" alt="Image 1" style="max-width: 200px;">
                </div>
                @endif
                @if($car->image2)
                <div class="form-group mb-2 mb20">
                    <strong>Image 2:</strong><br>
                    <img src="{{ asset('storage/' . $car->image2) }}" alt="Image 2" style="max-width: 200px;">
                </div>
                @endif
                @if($car->image3)
                <div class="form-group mb-2 mb20">
                    <strong>Image 3:</strong><br>
                    <img src="{{ asset('storage/' . $car->image3) }}" alt="Image 3" style="max-width: 200px;">
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteCarModal{{ $car->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteCarModalLabel{{ $car->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteCarModalLabel{{ $car->id }}">Confirm Delete</h5>
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
@endforeach

@endsection