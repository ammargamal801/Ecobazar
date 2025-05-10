const savedCart = JSON.parse(localStorage.getItem("cart"));

const cartItemsContainer = document.getElementById("cart-items");
let subtotal = 0;

if (savedCart && savedCart.length > 0) {
    savedCart.forEach(item => {
        const price = parseFloat(item.productPrice.replace("$", "").trim());
        const quantity = parseInt(item.quantity);
        const total = price * quantity;
        subtotal += total;

        const row = document.createElement("tr");
        row.classList.add("cart-item");

        row.innerHTML = `
            <td>
                <div class="d-flex align-items-center">
                    <img src="../../Assets/placeholder.jpg" alt="${item.productTitle}" style="width: 50px; height: auto; margin-right: 10px;">
                    <span>${item.productTitle}</span>
                </div>
            </td>
            <td class="price">$${price.toFixed(2)}</td>
            <td>
                <div class="d-flex align-items-center">
                    <button class="btn btn-light btn-sm quantity-decrease">-</button>
                    <input type="number" class="form-control w-25 text-center mx-1 quantity" value="${quantity}" min="1">
                    <button class="btn btn-light btn-sm quantity-increase">+</button>
                </div>
            </td>
            <td class="subtotal">$${total.toFixed(2)}</td>
            <td><button class="btn btn-danger btn-sm remove-item">×</button></td>
        `;

        cartItemsContainer.appendChild(row);

        // Remove Item
        row.querySelector(".remove-item").addEventListener("click", () => {
            // Remove the item row from the DOM
            row.remove();
        
            // Get the latest version of cart from localStorage
            let currentCart = JSON.parse(localStorage.getItem("cart")) || [];
        
            // Remove the item from the cart by matching title
            const updatedCart = currentCart.filter(cartItem => cartItem.productTitle !== item.productTitle);
        
            // Update localStorage or remove if empty
            if (updatedCart.length === 0) {
                localStorage.removeItem("cart");
            } else {
                localStorage.setItem("cart", JSON.stringify(updatedCart));
            }
        
            // Recalculate subtotal and update DOM
            let newSubtotal = 0;
            document.querySelectorAll(".cart-item").forEach(cartRow => {
                const price = parseFloat(cartRow.querySelector(".price").textContent.replace("$", ""));
                const quantity = parseInt(cartRow.querySelector(".quantity").value);
                newSubtotal += price * quantity;
                cartRow.querySelector(".subtotal").textContent = `$${(price * quantity).toFixed(2)}`;
            });
        
            // Update subtotal and total
            document.getElementById("cart-subtotal").textContent = `$${newSubtotal.toFixed(2)}`;
            document.getElementById("cart-total").textContent = `$${newSubtotal.toFixed(2)}`;
        });

        // Handle Quantity Increase
        row.querySelector(".quantity-increase").addEventListener("click", () => {
            const quantityInput = row.querySelector(".quantity");
            let quantity = parseInt(quantityInput.value);
            quantity++;
            quantityInput.value = quantity;

            // Update subtotal for this item
            const newTotal = price * quantity;
            row.querySelector(".subtotal").textContent = `$${newTotal.toFixed(2)}`;

            // Recalculate and update total price
            subtotal = 0;
            document.querySelectorAll(".cart-item").forEach(cartRow => {
                const itemPrice = parseFloat(cartRow.querySelector(".price").textContent.replace("$", ""));
                const itemQuantity = parseInt(cartRow.querySelector(".quantity").value);
                subtotal += itemPrice * itemQuantity;
            });

            document.getElementById("cart-subtotal").textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById("cart-total").textContent = `$${subtotal.toFixed(2)}`;

            // Update localStorage with new quantity
            item.quantity = quantity;
            localStorage.setItem("cart", JSON.stringify(savedCart));
        });

        // Handle Quantity Decrease
        row.querySelector(".quantity-decrease").addEventListener("click", () => {
            const quantityInput = row.querySelector(".quantity");
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantity--;
                quantityInput.value = quantity;

                // Update subtotal for this item
                const newTotal = price * quantity;
                row.querySelector(".subtotal").textContent = `$${newTotal.toFixed(2)}`;

                // Recalculate and update total price
                subtotal = 0;
                document.querySelectorAll(".cart-item").forEach(cartRow => {
                    const itemPrice = parseFloat(cartRow.querySelector(".price").textContent.replace("$", ""));
                    const itemQuantity = parseInt(cartRow.querySelector(".quantity").value);
                    subtotal += itemPrice * itemQuantity;
                });

                document.getElementById("cart-subtotal").textContent = `$${subtotal.toFixed(2)}`;
                document.getElementById("cart-total").textContent = `$${subtotal.toFixed(2)}`;

                // Update localStorage with new quantity
                item.quantity = quantity;
                localStorage.setItem("cart", JSON.stringify(savedCart));
            }
        });
    });

    document.getElementById("cart-subtotal").textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById("cart-total").textContent = `$${subtotal.toFixed(2)}`;
} else {
    cartItemsContainer.innerHTML = `<tr><td colspan="5" class="text-center text-muted">Your cart is empty.</td></tr>`;
}
