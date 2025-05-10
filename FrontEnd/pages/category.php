<?php
require_once '../../Backend/category-b/products_filter.php';
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
</head>

<body>
<nav class="navbar border fixed-top d-flex py-3" style="background-color: var(--white);">
        <div class="container-fluid d-flex justify-content-center">
            <div class="container d-flex align-items-center position-relative">
                <!-- Navbar Toggler for Sidebar -->
                <div class="col-1 me-3 mt-1 d-flex">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
                    aria-controls="offcanvasNavbar2" aria-label="Toggle navigation2">
                        <span class="navbar-toggler-icon d-block d-xxl-none"></span>
                    </button>
                </div>
                <!-- Navigation Links -->
                <div class="col-3 d-flex d-xxl-flex d-none align-items-center ms-n6" style="margin-left: -100px;">
                    <a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Home <i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Shop<i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Pages<i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Blog <i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none d-flex align-items-center text-nowrap" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">About Us</a>
                </div>
                <!-- Ecobazar Logo -->
                <div class="col-3 d-flex justify-content-center fs-2" style="font-family: Poppins, sans-serif; font-weight: 400; color: var(--black-text-color); position: absolute; left: 50%; transform: translateX(-50%);">
                    <a href="" class="text-decoration-none d-flex" style="color: var(--black-text-color);">
                        <i class="fas fa-leaf me-1 mt-2" style="color: var(--green-text);"></i>
                        Ecobazar
                    </a>
                </div>
                <!-- Icons and Search -->
                <div class="col-3 justify-content-end align-self-center d-flex ms-auto">
                    <i class="bi bi-search fa-lg me-3" id="searchIcon" style="cursor: pointer;"></i>
                    <a href="" class="align-self-center d-lg-flex d-none" style="color:var(--black-text-color);"><i class="bi bi-heart fa-lg me-3"></i></a>
                    <!-- Cart Icon -->
                    <div id="cart-icon">
                        <a href="#" style="color: var(--black-text-color);" class="me-3" data-bs-toggle="offcanvas" 
                        data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <i class="bi bi-handbag fa-lg"></i>
                        </a>
                        <span class="cart-item-count"></span>
                    </div>
                    <a href="" class="d-lg-flex d-none" style="color:var(--black-text-color);"><i class="bi bi-person fa-lg"></i></a>
                    <!-- Search Box -->
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="searchBox">
                    </form>
                </div>
            </div>
            <button class="navbar-toggler border-0 ms-2 d-none" type="button" data-bs-toggle="offcanvas" 
            data-bs-target="#offcanvasNavMenu" aria-controls="offcanvasNavMenu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Offcanvas for Left Sidebar -->
            <div class="offcanvas offcanvas-start border-0" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label">
                <div class="offcanvas-header mt-4">
                    <h5 class="offcanvas-title" id="offcanvasNavbar2Label">
                        <a href="" class="ms-1 border border-black rounded-5 p-3" style="color:var(--black-text-color);">
                            <i class="bi bi-person fa-lg fa-5x"></i>
                        </a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="text-decoration-none d-flex align-items-center" style="color:var(--black-text-color);" href="">Home <i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1" style="color:var(--black-text-color);" href="">Shop<i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1" style="color:var(--black-text-color);" href="">Pages<i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1" style="color:var(--black-text-color);" href="">Blog <i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1" style="color:var(--black-text-color);" href="">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1" style="color:var(--black-text-color);" href="">Wish list</a>
                        </li>
                    </ul>
                    <div class="fw-bold" style="margin-top:250px;color: var(--black-text-color);">
                        <i class="fas fa-leaf fa-2x" style="color: var(--green-text);"></i>
                    </div>
                </div>
            </div>
            <!-- cart details -->
            <div class="cart">
                <h2 class="cart-title">Your Cart</h2>
                <div class="cart-content">
                </div>
                <div class="total">
                    <div class="total-title">Total</div>
                    <div class="total-price">$0</div>
                </div>
                <button class="btn-buy">Buy Now</button>
                <i class="fa-solid fa-circle-xmark" id="cart-close"></i>
            </div>
        </div>
    </nav>

    <!-- Photo on Header Section -->
    <div class="container-fluid" style="margin-top: 120px; height: 100px;">
        <div class="row">
            <img src="../Assets/pic under header.jpg" alt="" class="img-fluid" style="height: 100px; object-fit: cover;">
        </div>
    </div>

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
                                <div class="price">$<?php echo $product['original_price']; ?></div>
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

    
    <!-- Custom JavaScript for search on nav bar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchIcon = document.getElementById('searchIcon');
            const searchBox = document.getElementById('searchBox');

            searchIcon.addEventListener('click', function(event) {
                event.preventDefault();
                if (searchBox.style.display === 'none' || searchBox.style.display === '') {
                    searchBox.style.display = 'block';
                } else {
                    searchBox.style.display = 'none';
                }
            });
        });
    </script>

    <script src="../Logics/add&delete-cart.js"></script>
    <script src="../Logics/category.js"></script>
    
</body>
</html>