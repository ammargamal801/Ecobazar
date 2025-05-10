       // Cart functionality
        let cart = JSON.parse(localStorage.getItem('cart'));
                if (cart && cart.length > 0) {
    // استخراج اسم العنصر من السلة
            cart.forEach(item => {
                console.log("Item Name: " + parseFloat(item.productPrice.replace("$", "").trim())*parseInt(item.quantity));
            });
            } else {
                console.log("No items in cart");
            }
const updateOrderSummary = () => {
    const orderItemsContainer = document.querySelector('.order-items');
    const subtotalElement = document.querySelector('.price-summary .summary-row:first-child span:last-child');

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
};

        
        // Handle form submission
        document.querySelector('.submit-btn').addEventListener('click', async (e) => {
            e.preventDefault();
            
            const orderData = {
                customer: {
                    firstName: document.getElementById('name').value,
                    lastName: document.getElementById('lastName').value,
                    companyName: document.getElementById('companyName').value,
                    streetAddress: document.getElementById('streetAddress').value,
                    country: document.getElementById('country').value,
                    state: document.getElementById('state').value,
                    zipCode: document.getElementById('zipCode').value,
                    email: document.getElementById('email').value,
                    phone: document.getElementById('phone').value
                },
                items: cart,
                paymentMethod: document.querySelector('input[name="payment"]:checked').value,
                notes: document.getElementById('orderNotes').value
            };
            
            try {
                // For Java backend
                const response = await fetch('http://localhost:8080/api/orders', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(orderData)
                });
                
                // For PHP backend alternative
                // const response = await fetch('checkout.php', {
                //     method: 'POST',
                //     headers: {
                //         'Content-Type': 'application/json',
                //     },
                //     body: JSON.stringify(orderData)
                // });
                
                if (response.ok) {
                    const result = await response.json();
                    alert('Order placed successfully!');
                    localStorage.removeItem('cart');
                    window.location.href = 'order-confirmation.html?id=' + result.orderId;
                } else {
                    throw new Error('Failed to place order');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Failed to place order. Please try again.');
            }
        });
        
        // Initialize the order summary
        updateOrderSummary();