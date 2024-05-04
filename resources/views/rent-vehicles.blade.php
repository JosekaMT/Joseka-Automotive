@extends('layouts.app')

@section('content')

<style>
    /* Estilos para las miniaturas */
    .product-card-container .product-card-img {
        width: 200px;
        /* Establecer un ancho fijo para todas las miniaturas */
        height: 115px;
        /* Establecer la misma altura para todas las miniaturas */
        object-fit: cover;
        /* Ajustar el tamaño de la imagen sin deformarla */
        cursor: pointer;
        border-radius: 10px;
        /* Ajustar el radio de borde */
    }

    /* Estilos para la imagen principal */
    .main-image {
        height: 400px;
        /* Establecer un tamaño fijo para la imagen principal */
        object-fit: cover;
        /* Ajustar la imagen principal para que cubra todo el contenedor */
        border-radius: 10px;
        /* Agregar bordes redondeados */
    }

    /* Estilos para los círculos de colores */
    .color-circle {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
        margin-bottom: -5px;
         /* Margen superior para ajustar la posición */
    }

    /* Estilos para el nombre del color */
    .color-name {
        display: inline-block;
        vertical-align: middle; /* Alinear verticalmente */
    }

    .red-circle {
        background-color: red;
    }

    .blue-circle {
        background-color: blue;
    }

    .green-circle {
        background-color: green;
    }

    .yellow-circle {
        background-color: yellow;
    }

    .black-circle {
        background-color: black;
    }

    .white-circle {
        background-color: white;
        border: 1px solid #000;
    }

    .silver-circle {
        background-color: silver;
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
            <div class="d-flex justify-content-between product-card-container" style="width: 85%; margin: 10px auto 0 auto; border-radius: 10px; overflow: hidden;">
                <!-- Align width and margin with the carousel above -->
                <img src="{{ asset('storage/' . $car->image1) }}" class="product-card-img cover-img" data-bs-target="#carImageCarousel" data-bs-slide-to="0" class="active">
                @if($car->image2)
                <img src="{{ asset('storage/' . $car->image2) }}" class="product-card-img cover-img" data-bs-target="#carImageCarousel" data-bs-slide-to="1">
                <!-- Increased margin -->
                @endif
                @if($car->image3)
                <img src="{{ asset('storage/' . $car->image3) }}" class="product-card-img cover-img" data-bs-target="#carImageCarousel" data-bs-slide-to="2">
                @endif
            </div>
        </div>
        <div class="col-md-5">
            <!-- Car Details -->
            <h2>{{ $car->brand }} {{ $car->model }} {{ $car->body }} {{ $car->horsepower }} HP {{ $car->seats }}p.</h2>
            <h2 class="text-danger">{{ $car->price_per_hour }} €</h2>
            <p class="lead">
                <span class="badge bg-success">{{ $car->available ? 'Available' : 'Not available' }}</span>
            </p>
            <div class="mb-4">
                <h5>Color:</h5>
                @switch($car->color)
                @case('Red')
                <span class="color-circle red-circle"></span>Red
                @break
                @case('Blue')
                <span class="color-circle blue-circle"></span>Blue
                @break
                @case('Green')
                <span class="color-circle green-circle"></span>Green
                @break
                @case('Yellow')
                <span class="color-circle yellow-circle"></span>Yellow
                @break
                @case('Black')
                <span class="color-circle black-circle"></span>Black
                @break
                @case('White')
                <span class="color-circle white-circle"></span>White
                @break
                @case('Silver')
                <span class="color-circle silver-circle"></span>Silver
                @break
                @default
                <button class="btn btn-primary btn-sm">{{ $car->color }}</button>
                @endswitch
            </div>
            <!-- Mini tabla con la información del coche -->
            <div class="mt-4">
                <h5>Car Information:</h5>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Body <h6> <strong>{{ $car->body }}</strong></h6>
                            </td>
                            <td>Seats <h6> <strong>{{ $car->seats }}</strong></h6>
                            </td>
                            <td>Gears <h6> <strong>{{ $car->gears }}</strong></h6>
                            </td>
                        </tr>
                        <tr>
                            <td>Fuel <h6> <strong>{{ $car->fuel }}</strong></h6>
                            </td>
                            <td>Engine <h6> <strong>{{ $car->engine }} CC</strong></h6>
                            </td>
                            <td>Horsepower <h6> <strong>{{ $car->horsepower }} HP</strong></h6>
                            </td>
                        </tr>

                    </tbody>
                </table>
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