@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-6">
            <!-- Image gallery -->
            <div class="bg-image hover-zoom ripple shadow-1-strong rounded">
                <img src="{{ asset('storage/' . $car->image1) }}" class="w-100"/>
            </div>
            <div class="d-flex justify-content-around mt-4">
                @if($car->image1)
                <img src="{{ asset('storage/' . $car->image1) }}" class="rounded" style="width: 70px; cursor: pointer;">
                @endif
                @if($car->image2)
                <img src="{{ asset('storage/' . $car->image2) }}" class="rounded" style="width: 70px; cursor: pointer;">
                @endif
                @if($car->image3)
                <img src="{{ asset('storage/' . $car->image3) }}" class="rounded" style="width: 70px; cursor: pointer;">
                @endif
            </div>
        </div>
        <div class="col-md-6">
            <!-- Car details -->
            <h2>{{ $car->brand }} {{ $car->model }}</h2>
            <h3 class="text-danger"><strike>€{{ $car->price_per_hour * 1.2 }}</strike> €{{ $car->price_per_hour }}</h3>
            <p class="text-success">Special discount available!</p>
            <p class="lead">
                <span class="badge bg-primary">{{ $car->new ? 'New' : 'Used' }}</span>
                <span class="badge bg-success">{{ $car->available ? 'Available' : 'Not available' }}</span>
            </p>
            <div>
                <h5>Color:</h5>
                <button class="btn btn-primary btn-sm">{{ $car->color }}</button>
            </div>
            <div class="mt-3">
                <h5>Seats:</h5>
                <select class="form-select" style="width: 150px;">
                    <option selected>{{ $car->seats }} Seats</option>
                </select>
            </div>
            <button class="btn btn-primary btn-lg my-4">
    <a href="{{ route('rent-vehicles.show', ['id' => $id]) }}" style="text-decoration: none; color: white;">Rent Now</a>
</button>


    </div>
</div>
@endsection
