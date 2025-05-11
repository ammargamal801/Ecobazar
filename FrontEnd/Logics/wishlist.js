function removeFromWishlist(productId) {
    if (confirm('Are you sure you want to remove this item from your wishlist?')) {
        fetch('../../../Backend/wishlist/wishlist_handle.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `action=remove&product_id=${productId}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the row from the table
                const row = document.querySelector(`tr[data-product-id="${productId}"]`);
                if (row) {
                    row.remove();
                }
                
                // If no more items, show empty message
                if (document.querySelectorAll('tbody tr').length === 0) {
                    location.reload();
                }
                
                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while removing the item from wishlist');
        });
    }
}

function addToCart(productId) {
    // Implement add to cart functionality
    alert('Product added to cart!');
    // You can implement actual cart functionality here
}