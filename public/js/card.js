function create_product_card(car) {
    return `
    <div class="product-card">
        <a href="${car.product_link}" class="product-link">
            <img class="product-card-img" src='${car.image1}' alt='${car.brand} ${car.model}'/>
            <div class="product-card-details">
                <span class="product-name">${car.brand} ${car.model}</span>
                <span class="product-price">$${car.price_per_hour} per hour</span>
                <div class="product-details">
                    <p>Fuel: ${car.fuel}</p>
                    <p>Engine: ${car.engine}</p>
                    <p>Horsepower: ${car.horsepower}</p>
                </div>
            </div>
            <a href="#" class="btn btn-danger w-100">Rent Now!</a>
        </a>
    </div> `;
}
