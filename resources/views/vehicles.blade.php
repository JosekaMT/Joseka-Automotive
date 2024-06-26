@extends('layouts.client')

@section('template_title')
    Vehicles
@endsection

@section('content')
    <main>
        <div class="product-card-container-outer">
            <div class="container">
                <h2 class="vehicle-heading">Vehicles</h2>
                <div id="product-card-container" class="product-card-container">
                    @if($cars->isEmpty())
                        <p>No vehicles available.</p>
                    @else
                        @foreach ($cars as $car)
                            @include('layouts.car-card', ['car' => $car])
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection
