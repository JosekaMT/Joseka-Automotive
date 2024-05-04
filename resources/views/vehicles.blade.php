@extends('layouts.app')

@section('template_title')
Vehicle Showcase
@endsection

@section('content')
<main>
    <div class="product-card-container-outer">
        <div class="container">
            <div id="product-card-container" class="product-card-container">
                @foreach ($cars as $car)
                <div class="product-card">
                    <a href="{{ $car->product_link }}" class="product-link" style="text-decoration: none;">
                        <img class="product-card-img" src="{{ asset('storage/' . $car->image1) }}" alt="{{ $car->brand }} {{ $car->model }}" />
                        <div class="product-card-details">
                            <div class="product-info-container"> <!-- Nuevo contenedor para el nombre del modelo, precio por hora y detalles -->
                                <div class="text-center">
                                    <span class="product-name mr-10">{{ $car->brand }} {{ $car->model }}</span>
                                    <span class="product-price">{{ $car->price_per_hour }} €/H</span>
                                </div>
                                <div class="product-info text-center text-muted mt-1">{{ $car->fuel }} | {{ $car->engine }} CC | {{ $car->horsepower }} CV</div>
                            </div>
                        </div>
                    </a>
                    <div class="product-wish-addtocart">
                        <a class="wish-btn" role="button" style="text-decoration: none;">
                            <i class="far fa-heart"></i>
                        </a>
                        <a href="{{ route('rent-vehicles') }}" class="addtocart-btn" style="text-decoration: none;">Rent Now!</a>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection