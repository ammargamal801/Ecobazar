<?php
require_once '../../Backend/category-b/products_filter.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecobazar - Category</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../Style/category.css">
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
                <select class="sort-select" name="sort" onchange="document.getElementById('filterForm').submit();">
                    <option value="latest" <?php echo $sort_by == 'latest' ? 'selected' : ''; ?>>Latest</option>
                    <option value="price-low" <?php echo $sort_by == 'price-low' ? 'selected' : ''; ?>>Price: Low to High</option>
                    <option value="price-high" <?php echo $sort_by == 'price-high' ? 'selected' : ''; ?>>Price: High to Low</option>
                    <option value="popular" <?php echo $sort_by == 'popular' ? 'selected' : ''; ?>>Popular</option>
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
                                <!-- Hidden inputs to preserve other filter values -->
                                <input type="hidden" name="min_price" value="<?php echo $min_price; ?>">
                                <input type="hidden" name="max_price" value="<?php echo $max_price; ?>">
                                <input type="hidden" name="sort" value="<?php echo $sort_by; ?>">
                                <input type="hidden" name="rating" value="<?php echo $rating_filter; ?>">
                                <?php foreach ($tags as $tag): ?>
                                    <input type="hidden" name="tags[]" value="<?php echo htmlspecialchars($tag); ?>">
                                <?php endforeach; ?>

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
                            <input type="range" min="0" max="50" value="<?php echo $min_price; ?>" class="min-price" id="min-price" 
                                onchange="updatePriceFilter()">
                            <input type="range" min="0" max="50" value="<?php echo $max_price; ?>" class="max-price" id="max-price"
                                onchange="updatePriceFilter()">
                        </div>

                        <div class="price-values">
                            <span>Price: </span>
                            <span id="min-value"><?php echo $min_price; ?></span>
                            <span> - </span>
                            <span id="max-value"><?php echo $max_price; ?></span>
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
                            <input type="checkbox" id="rating-5" <?php echo $rating_filter == 5 ? 'checked' : ''; ?>
                                onclick="setRatingFilter(5)">
                            <label for="rating-5">
                                <span class="stars2">★★★★★</span>
                                <span class="rating-text">5.0</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="checkbox" id="rating-4" <?php echo $rating_filter == 4 ? 'checked' : ''; ?>
                                onclick="setRatingFilter(4)">
                            <label for="rating-4">
                                <span class="stars2">★★★★☆</span>
                                <span class="rating-text">4.0 & up</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="checkbox" id="rating-3" <?php echo $rating_filter == 3 ? 'checked' : ''; ?>
                                onclick="setRatingFilter(3)">
                            <label for="rating-3">
                                <span class="stars2">★★★☆☆</span>
                                <span class="rating-text">3.0 & up</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="checkbox" id="rating-2" <?php echo $rating_filter == 2 ? 'checked' : ''; ?>
                                onclick="setRatingFilter(2)">
                            <label for="rating-2">
                                <span class="stars2">★★☆☆☆</span>
                                <span class="rating-text">2.0 & up</span>
                            </label>
                        </div>
                        <div class="rating-option">
                            <input type="checkbox" id="rating-1" <?php echo $rating_filter == 1 ? 'checked' : ''; ?>
                                onclick="setRatingFilter(1)">
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
                        <?php foreach ($popular_tags as $tag): ?>
                            <span class="tag <?php echo in_array($tag, $tags) ? 'active' : ''; ?>" 
                                onclick="toggleTag('<?php echo $tag; ?>')"><?php echo $tag; ?></span>
                        <?php endforeach; ?>
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
                            <button class="shop-now" >Shop Now →</button>
                        </div>
                    </div>
                    <div class="banner-image">
                        <img src="../Assets/bannel.jpg" alt="Fresh vegetables">
                    </div>
                </div>

                <!-- Sale Products Section -->
                <div class="section">
                    <div class="sale-title">Sale Products</div>
                    <div class="product-list">
                        <?php foreach ($sale_products as $sale_product): ?>
                            <div class="product-card-sort">
                                <div class="product-image-sort">
                                    <img src="<?php echo htmlspecialchars($sale_product['main_image']); ?>" alt="<?php echo htmlspecialchars($sale_product['name']); ?>">
                                </div>
                                <div class="product-info-sort">
                                    <div class="product-name-sort"><?php echo htmlspecialchars($sale_product['name']); ?></div>
                                    <div class="product-price-sort">
                                        <span class="current-price-sort">$<?php echo $sale_product['discounted_price']; ?></span>
                                        <span class="original-price-sort">$<?php echo $sale_product['original_price']; ?></span>
                                    </div>
                                    <div class="product-rating-sort">
                                        <?php 
                                        $full_stars = floor($sale_product['avg_rating']);
                                        $half_star = $sale_product['avg_rating'] - $full_stars >= 0.5;
                                        
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $full_stars) {
                                                echo '★';
                                            } elseif ($half_star && $i == $full_stars + 1) {
                                                echo '★';
                                            } else {
                                                echo '☆';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
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
                                <img src="<?php echo htmlspecialchars($product['main_image']); ?>">
                                <div class="wishlist">
                                    <i class="far fa-heart"></i>
                                </div>
                                <div class="Preview">
                                    <a href="./Products_Details_Description.php?id=<?php echo $product['id']; ?>">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="product-info">
                                <h4>
                                    <a href="../pages/product-details.php?id=<?php echo $product['id']; ?>">
                                        <?php echo htmlspecialchars($product['name']); ?>
                                    </a>
                                </h4>
                                <div class="price">
                                    <?php if (!empty($product['discounted_price'])): ?>
                                        <span class="current-price-sort">$<?php echo $product['discounted_price']; ?></span>
                                        <span class="original-price-sort">$<?php echo $product['original_price']; ?></span>
                                    <?php else: ?>
                                        $<?php echo $product['original_price']; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="rating">
                                    <div class="stars">
                                        <?php
                                        $product_rating = isset($product['avg_rating']) ? $product['avg_rating'] : 0;
                                        $full_stars = floor($product_rating);
                                        $half_star = $product_rating - $full_stars >= 0.5;
                                        
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $full_stars) {
                                                echo '<i class="fas fa-star"></i>';
                                            } elseif ($half_star && $i == $full_stars + 1) {
                                                echo '<i class="fas fa-star-half-alt"></i>';
                                            } else {
                                                echo '<i class="far fa-star"></i>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <button class="add-to-cart" data-product-id="<?php echo $product['id']; ?>">
                                    <i class="fas fa-shopping-basket"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No products found matching your criteria</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- /////////////////////////////////////////////////////////////////////// -->
    
    <script src="../Logics/category.js"></script>

</body>

</html>