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
    
</head>
<body>
    <center> <h1>My Wishlist</h1> </center>
    <div class="container wishlist-container">
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
                    <!-- Product Row 1 -->
                    <tr>
                        <td>
                            <div class="product-cell">
                                <img src="../../Assets/apple.png" alt="Green Capsicum" class="product-image">
                                <h5 class="product-name">Green Capsicum</h5>
                            </div>
                        </td>
                        <td class="price-cell">$14.99</td>
                        <td class="stock-cell">
                            <span class="stock-status in-stock">In Stock</span>
                        </td>
                        <td class="action-cell">
                            <div class="action-buttons">
                                <button class="btn btn-add-to-cart">Add to Cart</button>
                                <button class="btn btn-remove"><i class="fas fa-times"></i></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Product Row 2 -->
                    <tr>
                        <td>
                            <div class="product-cell">
                                <img src="../../assets/images/products/chinese-cabbage.jpg" alt="Chinese Cabbage" class="product-image">
                                <h5 class="product-name">Chinese Cabbage</h5>
                            </div>
                        </td>
                        <td class="price-cell">$45.00</td>
                        <td class="stock-cell">
                            <span class="stock-status in-stock">In Stock</span>
                        </td>
                        <td class="action-cell">
                            <div class="action-buttons">
                                <button class="btn btn-add-to-cart">Add to Cart</button>
                                <button class="btn btn-remove"><i class="fas fa-times"></i></button>
                            </div>
                        </td>
                    </tr>

                    <!-- Product Row 3 -->
                    <tr>
                        <td>
                            <div class="product-cell">
                                <img src="../../assets/images/products/fresh-mango.jpg" alt="Fresh Sujapuri Mango" class="product-image">
                                <h5 class="product-name">Fresh Sujapuri Mango</h5>
                            </div>
                        </td>
                        <td class="price-cell">$9.00</td>
                        <td class="stock-cell">
                            <span class="stock-status out-of-stock">Out of Stock</span>
                        </td>
                        <td class="action-cell">
                            <div class="action-buttons">
                                <button class="btn btn-add-to-cart" disabled>Add to Cart</button>
                                <button class="btn btn-remove"><i class="fas fa-times"></i></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
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

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>