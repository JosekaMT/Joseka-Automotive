@extends('layouts.client')

@section('template_title')
    Vehicle Showcase
@endsection

@section('content')
    <main>
        <div class="product-card-container-outer py">
            <div class="container">
                <!-- Heading for the Vehicle Showcase -->
                <h2 class="vehicle-heading">Vehicles</h2>
                
                <div id="product-card-container" class="product-card-container">
                    @foreach ($cars as $car)
                        <div class="product-card">
                            <a href="{{ $car->product_link }}" class="product-link" style="text-decoration: none;">
                                <img class="product-card-img" src="{{ asset('storage/' . $car->image1) }}"
                                    alt="{{ $car->brand }} {{ $car->model }}" />
                                <div class="product-card-details">
                                    <div class="product-info-container">
                                        <div class="text-center">
                                            <!-- Vehicle Name -->
                                            <h5 class="product-name">{{ $car->brand }} {{ $car->model }}</h5>
                                            <!-- Vehicle Price -->
                                            <h4 class="product-price text-danger">{{ $car->price_per_hour }} €/H</h4>
                                        </div>
                                        <div class="product-info text-center text-muted mt-1">
                                            {{ $car->fuel }} | {{ $car->engine }} CC | {{ $car->horsepower }} HP
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="product-wish-addtocart">
                                <a class="wish-btn" role="button" style="text-decoration: none;">
                                    <i class="far fa-heart"></i>
                                </a>
                                <a href="{{ route('rent-vehicles.show', ['id' => $car->id]) }}" class="addtocart-btn"
                                    style="text-decoration: none;">Rent Now!</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection
