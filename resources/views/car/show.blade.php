<!-- resources/views/car/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $car->name }}</h1>
    <p><strong>Brand:</strong> {{ $car->brand }}</p>
    <p><strong>Model:</strong> {{ $car->model }}</p>
    <p><strong>Price per Hour:</strong> {{ $car->price_per_hour }}</p>
    
    @if ($car->image1)
        <div>
            <img src="{{ asset('storage/' . $car->image1) }}" alt="Image 1" style="max-width: 100px; max-height: 100px;">
        </div>
    @endif
    @if ($car->image2)
        <div>
            <img src="{{ asset('storage/' . $car->image2) }}" alt="Image 2" style="max-width: 100px; max-height: 100px;">
        </div>
    @endif
    @if ($car->image3)
        <div>
            <img src="{{ asset('storage/' . $car->image3) }}" alt="Image 3" style="max-width: 100px; max-height: 100px;">
        </div>
    @endif

    <a href="{{ route('cars.index') }}">Back to Cars</a>
</div>
@endsection
