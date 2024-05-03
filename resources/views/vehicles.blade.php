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
                        <a href="#" class="product-link">
                            <img class="product-card-img" src="{{ $car->image1 }}"/>
                            <div class="product-card-details">
                                <span class="product-name">{{ $car->brand }} {{ $car->model }}</span>
                                <span class="product-price">${{ $car->price_per_hour }} per hour</span>
                            </div>
                        </a>
                        <div class="product-wish-addtocart">
                            <a class="wish-btn">
                                <img class="wish-btn-img" src="https://tech.mjassociate.co.in/images/svgs/like_red_outerline.svg" width="21" height="21">
                            </a>
                            <a href="#" class="addtocart-btn">Add To Cart</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection
