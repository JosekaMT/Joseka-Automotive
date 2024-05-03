@extends('layouts.app')

@section('template_title')
Vehicle Showcase
@endsection

@section('content')
<main>
    <div class="product-card-container-outer">
        <div class="container">
            <div id="product-card-container" class="product-card-container">
                <!-- Las tarjetas de productos se insertarán aquí usando JavaScript -->
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    fetch('/api/cars')
        .then(response => response.json())
        .then(cars => populate_products(cars));
});

function create_product_card(car) {
    return `
    <div class="product-card">
        <a href="${car.product_link}" class="product-link">
            <img class="product-card-img" src='${car.image1}'/>
            <div class="product-card-details">
                <span class="product-name">${car.brand} ${car.model}</span>
                <span class="product-price">$${car.price_per_hour} per hour</span>
            </div>
        </a>
        <div class="product-wish-addtocart">
            <a class="wish-btn">
                <img class="wish-btn-img" src="https://tech.mjassociate.co.in/images/svgs/like_red_outerline.svg" width="21" height="21">
            </a>
            <a href="#" class="addtocart-btn">Add To Cart</a>
        </div>
    </div> `;
}

function populate_products(cars) {
    const product_card_container = document.querySelector('.product-card-container');
    product_card_container.innerHTML = "";
    cars.forEach(car => {
        product_card_container.innerHTML += create_product_card(car);
    });
}

function addEvents() {
    document.querySelectorAll(".wish-btn-img").forEach((one_wish_btn) => {
        one_wish_btn.addEventListener('click', function(event) {
            event.target.src = "https://tech.mjassociate.co.in/images/svgs/like_red_filled.svg";
        });
    });
}

addEvents();
</script>
@endsection
