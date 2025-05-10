const cartIcon = document.querySelector("#cart-icon");
const cart = document.querySelector(".cart");
const cartClose = document.querySelector("#cart-close");
const cartContent = document.querySelector(".cart-content");
const cartItemCountBadge = document.querySelector(".cart-item-count");
let cartCount = 0;

// Show cart on click
cartIcon.addEventListener("click", () => cart.classList.add("active"));
cartClose.addEventListener("click", () => cart.classList.remove("active"));

// Add products to cart when the 'Add to Cart' button is clicked
const addCartButtons = document.querySelectorAll(".add-to-cart");
addCartButtons.forEach(button => {
    button.addEventListener("click", event => {
        const productCard = event.target.closest(".product-card");
        addToCart(productCard);
    });
});

// Add product to cart
const addToCart = productCard => {
    const productImg = productCard.querySelector("img").src;
    const productTitle = productCard.querySelector("h4").textContent;
    const productPrice = productCard.querySelector(".price").textContent;

    // Check if item already exists in cart
    const cartItems = cartContent.querySelectorAll(".cart-product-title");
    for (let item of cartItems) {
        if (item.textContent === productTitle) {
            alert("This item is already in the cart");
            return;
        }
    }

    const cartBox = document.createElement("div");
    cartBox.classList.add("cart-box");
    cartBox.innerHTML = `
        <img src="${productImg}" alt="">
        <div class="cart-detail">
            <h2 class="cart-product-title">${productTitle}</h2>
            <span class="cart-price">${productPrice}</span>
            <div class="cart-quantity">
                <button id="decrement">-</button>
                <span class="number">1</span>
                <button id="increment">+</button>
            </div>
        </div>
        <i class="fa-solid fa-trash cart-remove"></i>
    `;
    cartContent.appendChild(cartBox);

    // Remove Item From Cart
    cartBox.querySelector(".cart-remove").addEventListener("click", () => {
        cartBox.remove();
        updateCartCount(-1);
        updateTotalPrice();
        saveCartToLocalStorage();
    });

    // Increment and Decrement Item Quantity
    cartBox.querySelector(".cart-quantity").addEventListener("click", (event) => {
        const numberElement = cartBox.querySelector(".number");
        const decrementButton = cartBox.querySelector("#decrement");
        let quantity = parseInt(numberElement.textContent);

        if (event.target.id === "decrement" && quantity > 1) {
            quantity--;
        } else if (event.target.id === "increment") {
            quantity++;
        }

        numberElement.textContent = quantity;
        decrementButton.style.color = (quantity === 1) ? "#999" : "#333";
        updateTotalPrice();
        saveCartToLocalStorage();
    });

    updateCartCount(1);
    updateTotalPrice();
    saveCartToLocalStorage();
};

// Update Total Price
const updateTotalPrice = () => {
    const totalPriceElement = document.querySelector(".total-price");
    const cartBoxes = cartContent.querySelectorAll(".cart-box");

    let total = 0;
    cartBoxes.forEach(cartBox => {
        const priceElement = cartBox.querySelector(".cart-price");
        const quantityElement = cartBox.querySelector(".number");
        const price = parseFloat(priceElement.textContent.replace("$", ""));
        const quantity = parseInt(quantityElement.textContent);
        total += price * quantity;
    });

    totalPriceElement.textContent = `$${total.toFixed(2)}`;
};

// Update Cart Count
const updateCartCount = change => {
    cartCount += change;

    if (cartCount > 0) {
        cartItemCountBadge.style.visibility = "visible";
        cartItemCountBadge.textContent = cartCount;
    } else {
        cartItemCountBadge.style.visibility = "hidden";
        cartItemCountBadge.textContent = "";
    }
};

// If You click on buy button and no items on cart
const buyNowButton = document.querySelector(".btn-buy");
buyNowButton.addEventListener("click" , () => {
    const cartBoxes = cartContent.querySelectorAll(".cart-box");
    if(cartBoxes.length === 0) {
        alert("Your cart is empty . Please add items to your cart before buying");
        return;
    } else {
        window.location.href = "../pages/Shopping Cart/shopping_cart.html";
    }
});

// Save cart to LocalStorage
const saveCartToLocalStorage = () => {
    const cartItems = [];
    const cartBoxes = cartContent.querySelectorAll(".cart-box");

    cartBoxes.forEach(cartBox => {
        const productImg = cartBox.querySelector("img").src;
        const productTitle = cartBox.querySelector(".cart-product-title").textContent;
        const productPrice = cartBox.querySelector(".cart-price").textContent;
        const quantity = cartBox.querySelector(".number").textContent;
        cartItems.push({ productImg, productTitle, productPrice, quantity });
    });

    localStorage.setItem("cart", JSON.stringify(cartItems));
};

// Load cart from LocalStorage
const loadCartFromLocalStorage = () => {
    const savedCart = JSON.parse(localStorage.getItem("cart"));
    
    // Clear previous cart count before loading
    cartCount = 0;

    if (savedCart && savedCart.length > 0) {
        savedCart.forEach(item => {
            const cartBox = document.createElement("div");
            cartBox.classList.add("cart-box");
            cartBox.innerHTML = `
                <img src="${item.productImg}" alt="">
                <div class="cart-detail">
                    <h2 class="cart-product-title">${item.productTitle}</h2>
                    <span class="cart-price">${item.productPrice}</span>
                    <div class="cart-quantity">
                        <button id="decrement">-</button>
                        <span class="number">${item.quantity}</span>
                        <button id="increment">+</button>
                    </div>
                </div>
                <i class="fa-solid fa-trash cart-remove"></i>
            `;
            cartContent.appendChild(cartBox);

            // Remove Item From Cart
            cartBox.querySelector(".cart-remove").addEventListener("click", () => {
                cartBox.remove();
                updateCartCount(-1);
                updateTotalPrice();
                saveCartToLocalStorage();
            });

            // Increment and Decrement Item Quantity
            cartBox.querySelector(".cart-quantity").addEventListener("click", (event) => {
                const numberElement = cartBox.querySelector(".number");
                const decrementButton = cartBox.querySelector("#decrement");
                let quantity = parseInt(numberElement.textContent);

                if (event.target.id === "decrement" && quantity > 1) {
                    quantity--;
                } else if (event.target.id === "increment") {
                    quantity++;
                }

                numberElement.textContent = quantity;
                decrementButton.style.color = (quantity === 1) ? "#999" : "#333";
                updateTotalPrice();
                saveCartToLocalStorage();
            });

            cartCount += 1;
        });

        updateCartCount(0); // Update badge after loading all
        updateTotalPrice();
    } else {
        // Cart is empty, reset badge and count
        cartCount = 0;
        updateCartCount(0);
        updateTotalPrice();
    }
};


// Load cart when page is loaded
window.addEventListener("DOMContentLoaded", () => {
    loadCartFromLocalStorage();
});
