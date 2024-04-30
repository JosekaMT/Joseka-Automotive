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

                        <span id="card_title">
                            {{ __('Cars') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('cars.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
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
                                    <th>Image</th> <!-- Nueva columna de imagen -->
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
                                    <th>Actions</th> <!-- Asumiendo que tienes acciones -->
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
                                        <form action="{{ route('cars.destroy', $car->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary" href="{{ route('cars.show', $car->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('cars.edit', $car->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                        </form>
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
@endsection
