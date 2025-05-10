    // Cart functionality
    let cart = JSON.parse(localStorage.getItem('cart'));
    const updateOrderSummary = () => {
        const orderItemsContainer = document.querySelector('.order-items');
        const subtotalElement = document.querySelector('.price-summary .summary-row:first-child span:last-child');
        const totalInputHidden = document.querySelector(".totalHidden");
        const paymentMethod = document.querySelector(".payment");
        // Clear existing items
        orderItemsContainer.innerHTML = '';

        let subtotal = 0;
        const cart = JSON.parse(localStorage.getItem('cart')); // استخدم الـ localStorage للحصول على السلة المحدثة

        cart.forEach(item => {
            const itemElement = document.createElement('div');
            itemElement.className = 'item';
            itemElement.innerHTML = `
                <span>${item.productTitle} x${item.quantity}</span>
                <span>$${(parseFloat(item.productPrice.replace("$", "").trim()) * parseInt(item.quantity)).toFixed(2)}</span>
            `;
            orderItemsContainer.appendChild(itemElement);

            subtotal += parseFloat(item.productPrice.replace("$", "").trim()) * parseInt(item.quantity);
        });

        const storedTotal = localStorage.getItem('cartTotal');
        const displayTotal = storedTotal ? parseFloat(storedTotal).toFixed(2) : subtotal.toFixed(2);

        // Update subtotal
        subtotalElement.textContent = `$${displayTotal}`;

        // Update total
        document.querySelector('.price-summary .total span:last-child').textContent = `$${displayTotal}`;
        totalInputHidden.value = `${displayTotal}`;
        document.getElementById('cartItems').value = JSON.stringify(cart);
        document.querySelector("form").addEventListener("submit", function () {
        document.getElementById('cartItems').value = JSON.stringify(cart);
});

};








    // Initialize the order summary
    updateOrderSummary();