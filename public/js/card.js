function create_product_card(car) {
    return `
    <div class="product-card">
        <a href="${car.product_link}" class="product-link">
            <img class="product-card-img" src='${car.image1}'/>
            <div class="product-card-details">
                <span class="product-name">${car.brand} ${car.model}</span>
                <span class="product-price">$${car.price_per_hour} per hour</span>
                <div class="product-details">
                    <p>Fuel: ${car.fuel}</p>
                    <p>Engine: ${car.engine}</p>
                    <p>Horsepower: ${car.horsepower}</p>
                </div>
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
