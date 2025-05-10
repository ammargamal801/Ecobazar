<?php
require_once '../../Backend/category-b/products_filter.php';
session_start();

// Get wishlist product IDs for the current user if logged in
$wishlist_product_ids = [];
if (isset($_SESSION['user'])) {
    require_once '../../Backend/Authentication/users.php';
    $user = unserialize($_SESSION['user']);
    $user_id = $user->getId();
    $wishlist_items = Customer::getWishlist($user_id);
    $wishlist_product_ids = array_column($wishlist_items, 'id');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecobazar - Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../Style/category.css">
    <link rel="stylesheet" href="../Style/main.css">
    <link rel="stylesheet" href="../Style/add-to-cart.css">
    <style>
        body {
            background-color: white !important;
        }

        .wishlist-icon {
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .wishlist-icon.fas {
            color: #EA4B48;
        }

        .wishlist-icon:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <?php
    include './header.php';
    ?>
    <!-- ///////////////////////////////////////////////////////////////////////////////////////////////////////////// -->
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
                    <option value="price-low" <?php echo $sort_by == 'price-low' ? 'selected' : ''; ?>>Price: Low to High
                    </option>
                    <option value="price-high" <?php echo $sort_by == 'price-high' ? 'selected' : ''; ?>>Price: High to
                        Low</option>
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
                            <input type="range" min="0" max="50" value="<?php echo $min_price; ?>" class="min-price"
                                id="min-price" onchange="updatePriceFilter()">
                            <input type="range" min="0" max="50" value="<?php echo $max_price; ?>" class="max-price"
                                id="max-price" onchange="updatePriceFilter()">
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
                        <?php foreach ($sale_products as $sale_product): ?>
                            <div class="product-card-sort">
                                <div class="product-image-sort">
                                    <img src="<?php echo htmlspecialchars($sale_product['main_image']); ?>"
                                        alt="<?php echo htmlspecialchars($sale_product['name']); ?>">
                                </div>
                                <div class="product-info-sort">
                                    <div class="product-name-sort"><?php echo htmlspecialchars($sale_product['name']); ?>
                                    </div>
                                    <div class="product-price-sort">
                                        <span
                                            class="current-price-sort">$<?php echo $sale_product['discounted_price']; ?></span>
                                        <span
                                            class="original-price-sort">$<?php echo $sale_product['original_price']; ?></span>
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
                                    <?php if (isset($_SESSION['user'])): ?>
                                        <i class="<?php echo in_array($product['id'], $wishlist_product_ids ?? []) ? 'fas' : 'far'; ?> fa-heart wishlist-icon"
                                            data-product-id="<?php echo $product['id']; ?>"></i>
                                    <?php else: ?>
                                        <a href="./Login Page/login.php" title="Login to add to wishlist"><i
                                                class="far fa-heart"></i></a>
                                    <?php endif; ?>
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
    <?php
    include './footer.html';
    ?>
    <script src="../Logics/category.js"></script>
    <!-- Custom JavaScript for search on nav bar -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchIcon = document.getElementById('searchIcon');
            const searchBox = document.getElementById('searchBox');

            searchIcon.addEventListener('click', function (event) {
                event.preventDefault();
                if (searchBox.style.display === 'none' || searchBox.style.display === '') {
                    searchBox.style.display = 'block';
                } else {
                    searchBox.style.display = 'none';
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../Logics/add&delete-cart.js"></script>
    <script>
        // Wishlist functionality
        document.addEventListener('DOMContentLoaded', function () {
            const wishlistIcons = document.querySelectorAll('.wishlist-icon');

            wishlistIcons.forEach(icon => {
                icon.addEventListener('click', function () {
                    const productId = this.getAttribute('data-product-id');
                    const isInWishlist = this.classList.contains('fas');

                    // Determine action based on current state
                    const action = isInWishlist ? 'remove' : 'add';

                    // Send request to server
                    fetch('../../Backend/wishlist/wishlist_handle.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `action=${action}&product_id=${productId}`
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Toggle heart icon
                                this.classList.toggle('far');
                                this.classList.toggle('fas');

                                // Show success message
                                alert(data.message);
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while updating your wishlist');
                        });
                });
            });
        });
    </script>
</body>

</html>