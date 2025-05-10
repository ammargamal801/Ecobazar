<?php
session_start();
require_once '../../../Backend/Authentication/users.php';

// Check if user is logged in
$is_logged_in = isset($_SESSION['user']);
$wishlist_items = [];

if ($is_logged_in) {
    $user = unserialize($_SESSION['user']);
    $user_id = $user->getId();
    $wishlist_items = Customer::getWishlist($user_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist - Ecobazar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../Style/wishlist.css">
    <link rel="stylesheet" href="../../Style/main.css">
    
</head>
<body>
    <center> <h1>My Wishlist</h1> </center>
    <div class="container wishlist-container">
        <?php if (!$is_logged_in): ?>
            <div class="alert alert-warning text-center">
                <p>Please <a href="../Login Page/login.php" class="alert-link">login</a> to view your wishlist.</p>
            </div>
        <?php elseif (empty($wishlist_items)): ?>
            <div class="alert alert-info text-center">
                <p>Your wishlist is empty. Browse our <a href="../../index.php" class="alert-link">products</a> to add items to your wishlist.</p>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="wishlist-table">
                    <thead>
                        <tr>
                            <th width="50%">PRODUCT</th>
                            <th class="text-center">PRICE</th>
                            <th class="text-center">STOCK STATUS</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($wishlist_items as $item): ?>
                            <tr data-product-id="<?php echo $item['id']; ?>">
                                <td>
                                    <div class="product-cell">
                                        <img src="../../Assets/products/<?php echo $item['main_image'] ?: 'placeholder.png'; ?>" alt="<?php echo $item['name']; ?>" class="product-image">
                                        <h5 class="product-name"><?php echo $item['name']; ?></h5>
                                    </div>
                                </td>
                                <td class="price-cell">$<?php echo $item['discounted_price'] ?: $item['original_price']; ?></td>
                                <td class="stock-cell">
                                    <?php if ($item['stock_quantity'] > 0): ?>
                                        <span class="stock-status in-stock">In Stock</span>
                                    <?php else: ?>
                                        <span class="stock-status out-of-stock">Out of Stock</span>
                                    <?php endif; ?>
                                </td>
                                <td class="action-cell">
                                    <div class="action-buttons">
                                        <button class="btn btn-add-to-cart" <?php echo $item['stock_quantity'] <= 0 ? 'disabled' : ''; ?> onclick="addToCart(<?php echo $item['id']; ?>)">Add to Cart</button>
                                        <button class="btn btn-remove" onclick="removeFromWishlist(<?php echo $item['id']; ?>)"><i class="fas fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        
        <!-- Social Share Section -->
        <div class="social-share">
            <div class="d-flex align-items-center">
                <span>Share:</span>
                <a href="#" class="social-icon">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="fab fa-pinterest-p"></i>
                </a>
                <a href="#" class="social-icon">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
        </div>
    </div>
<?php 
include '../../pages/footer.html';
?>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
    </script>
</body>
</html>