@extends('layouts.app')

@section('template_title')
{{ $car->brand ?? __('Show') . " " . __('Car') }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} Car</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary btn-sm" href="{{ route('cars.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body bg-white">
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
                            <img src="{{ asset('storage/car_images/' . basename($car->image1)) }}" alt="Image 1" style="max-width: 200px;">
                        </div>
                    @endif
                    @if($car->image2)
                        <div class="form-group mb-2 mb20">
                            <strong>Image 2:</strong><br>
                            <img src="{{ asset('storage/car_images/' . basename($car->image2)) }}" alt="Image 2" style="max-width: 200px;">
                        </div>
                    @endif
                    @if($car->image3)
                        <div class="form-group mb-2 mb20">
                            <strong>Image 3:</strong><br>
                            <img src="{{ asset('storage/car_images/' . basename($car->image3)) }}" alt="Image 3" style="max-width: 200px;">
                        </div>
                    @endif


                </div>
            </div>
        </div>
    </div>
</section>
@endsection