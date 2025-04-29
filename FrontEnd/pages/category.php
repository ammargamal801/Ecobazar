<?php
require_once '../category-b/products_filter.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecobazar - Category</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="category.css">
</head>

<body>
    <div class="container2">
        <div class="filter-container">
            <div class="filter-button">
                <span>Filter</span>
                <i class="fas fa-filter"></i>
            </div>
            <div class="sort-by">
                <span>Sort by:</span>
                <select class="sort-select">
                    <option value="latest">Latest</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="popular">Popular</option>
                </select>
            </div>
            <div class="results-count">
                <span id="results-count"><?php echo count($products); ?></span> results found
            </div>
        </div>
    </div>

    <!-- /////////////////////////////////////////////////////// -->
    <div class="container">
        <div class="filter-container-sort">
            <!-- Filter Content -->
            <div class="filter-content active">
                <!-- Categories Section -->
                <div class="section">
                    <div class="section-title">
                        All Categories
                        <span class="chevron up"><i class="fas fa-chevron-up"></i></span>
                    </div>
                    <div class="category-list">
                        <div class="sidebar">
                            <form id="filterForm" method="GET" action="">
                                <?php foreach ($categories as $category): ?>
                                    <div class="category-item">
                                        <label>
                                            <input type="checkbox" name="categories[]"
                                                value="<?php echo $category['id']; ?>" <?php echo in_array($category['id'], $selected_categories) ? 'checked' : ''; ?>
                                                onchange="document.getElementById('filterForm').submit();">
                                            <?php echo $category['name']; ?>
                                        </label>
                                    </div>
                                <?php endforeach; ?>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Price Section -->
                <div class="section">
                    <div class="section-title">
                        Price
                        <span class="chevron up"><i class="fas fa-chevron-up"></i></span>
                    </div>
                    <div class="slider-container">
                        <div class="price-range-slider">
                            <div class="slider-track"></div>
                            <div class="slider-range"></div>
                            <input type="range" min="0" max="100" value="0" class="min-price" id="min-price">
                            <input type="range" min="0" max="100" value="100" class="max-price" id="max-price">
                        </div>

                        <div class="price-values">
                            <span>Price: </span>
                            <span id="min-value">0</span>
                            <span> - </span>
                            <span id="max-value">100</span>
                        </div>
                    </div>
                </div>
                <!-- Rating Section -->
                <div class="section">
                    <div class="section-title">
                        Rating
                        <span class="chevron up"><i class="fas fa-chevron-up"></i></span>
                    </div>
                    <div class="rating-options">
                        <div class="rating-option">
                            <input type="checkbox" id="rating-5">
                            <label for="rating-5">
                                <span class="stars2">★★★★★</span>
                                <span class="rating-text">5.0</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="checkbox" id="rating-4" checked>
                            <label for="rating-4">
                                <span class="stars2">★★★★☆</span>
                                <span class="rating-text">4.0 & up</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="checkbox" id="rating-3">
                            <label for="rating-3">
                                <span class="stars2">★★★☆☆</span>
                                <span class="rating-text">3.0 & up</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="checkbox" id="rating-2">
                            <label for="rating-2">
                                <span class="stars2">★★☆☆☆</span>
                                <span class="rating-text">2.0 & up</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="checkbox" id="rating-1">
                            <label for="rating-1">
                                <span class="stars2">★☆☆☆☆</span>
                                <span class="rating-text">1.0 & up</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Popular Tags Section -->
                <div class="section">
                    <div class="section-title">
                        Popular Tag
                        <span class="chevron up"><i class="fas fa-chevron-up"></i></span>
                    </div>
                    <div class="tags-container">
                        <span class="tag">Healthy</span>
                        <span class="tag active">Fresh</span>
                        <span class="tag">Vegetarian</span>
                        <span class="tag">Kitchen</span>
                        <span class="tag">Vitamins</span>
                        <span class="tag">Bread</span>
                        <span class="tag">Meat</span>
                        <span class="tag">Snacks</span>
                        <span class="tag">Tofu</span>
                        <span class="tag">Lunch</span>
                        <span class="tag">Dinner</span>
                        <span class="tag">Breakfast</span>
                        <span class="tag">Fruit</span>
                    </div>
                </div>

                <!-- Discount Banner -->
                <div class="discount-banner">
                    <div class="banner-content">
                        <div class="discount-text">
                            <span class="percentage">79%</span> Discount
                        </div>
                        <div class="description">on your first order</div>
                        <div class="action-btn">
                            <button class="shop-now">Shop Now →</button>
                        </div>
                    </div>
                    <div class="banner-image">
                        <img src="../images/veg/sale.jpg" alt="Fresh vegetables">
                    </div>
                </div>

                <!-- Sale Products Section -->
                <div class="section">
                    <div class="sale-title">Sale Products</div>
                    <div class="product-list">
                        <div class="product-card-sort">
                            <div class="product-image-sort">
                                <img src="../images/veg/redswchil.jpg" alt="Red Capsicum">
                            </div>
                            <div class="product-info-sort">
                                <div class="product-name-sort">Red Capsicum</div>
                                <div class="product-price-sort">
                                    <span class="current-price-sort">$20.00</span>
                                    <span class="original-price-sort">$32.00</span>
                                </div>
                                <div class="product-rating-sort">★★★★☆</div>
                            </div>
                        </div>
                        <div class="product-card-sort">
                            <div class="product-image-sort">
                                <img src="../images/veg/mango.jpg" alt="Chinese Cabbage">
                            </div>
                            <div class="product-info-sort">
                                <div class="product-name-sort">Chinese Cabbage</div>
                                <div class="product-price-sort">
                                    <span class="current-price-sort">$24.00</span>
                                    <span class="original-price-sort">$30.00</span>
                                </div>
                                <div class="product-rating-sort">★★★★☆</div>
                            </div>
                        </div>
                        <div class="product-card-sort">
                            <div class="product-image-sort">
                                <img src="../images/veg/swgrchil.jpg" alt="Green Capsicum">
                            </div>
                            <div class="product-info-sort">
                                <div class="product-name-sort">Green Capsicum</div>
                                <div class="product-price-sort">
                                    <span class="current-price-sort">$14.00</span>
                                    <span class="original-price-sort">$20.00</span>
                                </div>
                                <div class="product-rating-sort">★★★★☆</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ///////////////////////////////////////////////////////// -->
        <div class="products-container">
            <div class="products-grid">
                <?php if (count($products) > 0): ?>
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <div class="product-image">
                                <img src="<?php echo htmlspecialchars($product['image']); ?>">
                                <div class="wishlist">
                                    <i class="far fa-heart"></i>
                                </div>
                                <div class="Preview">
                                    <i class="far fa-eye"></i>
                                </div>
                            </div>
                            <div class="product-info">
                                <h4><?php echo htmlspecialchars($product['name']); ?></h4>
                                <div class="price">$<?php echo $product['price']; ?></div>
                                <div class="rating">
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                <button class="add-to-cart">
                                    <i class="fas fa-shopping-basket"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>no products found</p>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <!-- /////////////////////////////////////////////////////////////////////// -->

    <script src="category.js"></script>
    
</body>

</html>