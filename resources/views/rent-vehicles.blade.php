@extends('layouts.app')

@section('content')

<style>
    /* Estilos para las miniaturas */
    .product-card-container .img-thumbnail {
        width: 26%;
        height: 115px; /* Establecer la misma altura para todas las miniaturas */
        max-height: 110px; /* Asegurar que las imágenes no se hagan más grandes que la altura establecida */
        cursor: pointer;
    }

    /* Estilos para la imagen principal */
    .main-image {
        height: 400px; /* Establecer un tamaño fijo para la imagen principal */
        object-fit: cover; /* Ajustar la imagen principal para que cubra todo el contenedor */
        border-radius: 15px; /* Agregar bordes redondeados */
    }
</style>

<div class="container my-5">
    <div class="row">
        <div class="col-md-7" style="padding: 0; overflow: hidden;">
            <!-- Bootstrap Carousel for Main Image with Rounded Corners -->
            <div id="carImageCarousel" class="carousel slide" data-bs-ride="carousel" style="max-height: 400px; overflow: hidden; border-radius: 15px; margin: auto; width: 85%;">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('storage/' . $car->image1) }}" class="d-block w-100 main-image" alt="Car Image 1">
                    </div>
                    @if($car->image2)
                    <div class="carousel-item">
                        <img src="{{ asset('storage/' . $car->image2) }}" class="d-block w-100 main-image" alt="Car Image 2">
                    </div>
                    @endif
                    @if($car->image3)
                    <div class="carousel-item">
                        <img src="{{ asset('storage/' . $car->image3) }}" class="d-block w-100 main-image" alt="Car Image 3">
                    </div>
                    @endif
                </div>
            </div>

            <!-- Thumbnails with Matching Width, Rounded Corners, and Precise Alignment -->
            <div class="d-flex justify-content-between product-card-container" style="width: 85%; margin: 10px auto 0 auto;">
                <!-- Align width and margin with the carousel above -->
                <img src="{{ asset('storage/' . $car->image1) }}" class="img-thumbnail cover-img product-card-img" style="width: 26%; max-height: 150px; cursor: pointer; border-radius: 10px;" data-bs-target="#carImageCarousel" data-bs-slide-to="0" class="active">
                @if($car->image2)
                <img src="{{ asset('storage/' . $car->image2) }}" class="img-thumbnail cover-img product-card-img" style="width: 26%; max-height: 150px; cursor: pointer; border-radius: 10px; margin: 0 2%;" data-bs-target="#carImageCarousel" data-bs-slide-to="1">
                <!-- Increased margin -->
                @endif
                @if($car->image3)
                <img src="{{ asset('storage/' . $car->image3) }}" class="img-thumbnail cover-img product-card-img" style="width: 26%; max-height: 150px; cursor: pointer; border-radius: 10px;" data-bs-target="#carImageCarousel" data-bs-slide-to="2">
                @endif
            </div>
        </div>
        <div class="col-md-5">
            <!-- Car Details -->
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
</div>

<script>
    // Inicializar el carrusel de Bootstrap al cargar la página
    window.onload = function() {
        var carousel = new bootstrap.Carousel(document.getElementById('carImageCarousel'), {
            interval: false // Desactivar la transición automática de las diapositivas
        });
    };
</script>

@endsection
