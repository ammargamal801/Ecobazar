<?php
require_once '../../Backend/category-b/product-details.php';
?>
<?php
require_once '../../Backend/category-b/related.php';
?>
<?php
session_start();
require_once '../../Backend/Authentication/users.php';
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
    <title>Ecobazar - <?php echo $product['name']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="../Style/Products_Details_Description..style.css">
    <link rel="stylesheet" href="../Style/main.css">
    <link rel="stylesheet" href="../Style/add-to-cart.css"> 
</head>
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
                    <a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="./home_page/home page.php">Home <i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="../">contact us<i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="./about_and_comments_pages/Comments.php">comments<i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="./Blog/BLOG.html">Blog <i class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none d-flex align-items-center text-nowrap" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="./about_and_comments_pages/About_page.html">About Us</a>
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
                    <a href="Wishlist Page/wishlist.php" class="align-self-center d-lg-flex d-none" style="color:var(--black-text-color);"><i class="bi bi-heart fa-lg me-3"></i></a>
                    <!-- Cart Icon -->
                    <div id="cart-icon">
                        <a href="Shopping Cart/shopping_cart.php" style="color: var(--black-text-color);" class="me-3" data-bs-toggle="offcanvas" 
                        data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                            <i class="bi bi-handbag fa-lg"></i>
                        </a>
                        <span class="cart-item-count"></span>
                    </div>
                    <a href="Login Page/login.php" class="d-lg-flex d-none" style="color:var(--black-text-color);"><i class="bi bi-person fa-lg"></i></a>
                    <!-- Dark mode toggle button -->
                    <div class="me-3">
                        <button id="darkModeToggle" class="btn btn-link p-0" style="color: var(--black-text-color);">
                            <i class="bi bi-moon"></i>
                        </button>
                    </div>
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
    <div class="container-fluid" style="margin-top: 120px; height: 100px; margin-bottom: 20px;">
        <div class="row">
            <img src="../Assets/pic under header.jpg" alt="" class="img-fluid" style="height: 100px; object-fit: cover;">
        </div>
    </div>
    <main class="product-detail">
        <div class="container">
            <div class="breadcrumb">
                <span>Category</span> > <span><?php echo $product['category_name']; ?></span> > <span
                    class="active"><?php echo $product['name']; ?></span>
            </div>

            <div class="product-main">
                <div class="product-gallery">
                    <div class="main-image">
                        <img src="Assets/<?php echo $product['main_image']; ?>" alt="<?php echo $product['name']; ?>">
                    </div>
                </div>

                <div class="product-info">
                    <h1><?php echo $product['name']; ?></h1>
                    <div class="rating">
                        <span class="stars">★★★★★</span>
                        <span class="review-count">4 Review</span>
                        <span class="sold-count">$<?php echo number_format($product['sold_count']); ?></span>
                    </div>

                    <div class="price">
                        <span class="original-price"><?php echo ($product['original_price']); ?></span>
                        <span class="discounted-price"><?php echo ($product['discounted_price']); ?></span>
                        <?php if ($product['discounted_price'] < $product['original_price']): ?>
                            <span class="discount-badge">64% OFF</span>
                        <?php endif; ?>
                    </div>

                    <div class="brand-section">
                        <h3>Brand</h3>
                        <p><li><?php echo $product['brand_id']; ?></li></p>
                        <div class="social-share">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-pinterest"></i></a>
                        </div>
                        <p><?php echo $product['description']; ?></p>
                    </div>

                    <div class="add-to-cart1">
                        <button class="btn-add-to-cart1">Add to Cart</button>
                        <div class="meta-info">
                            <p><strong>Category:</strong> <?php echo $product['category_name']; ?></p>
                            <p><strong>Tag:</strong> <?php echo $product['tags']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-tabs">
                <ul class="tab-nav">
                    <li class="active"><a href="#description">Description</a></li>
                    <li><a href="#additional-info">Additional Information</a></li>
                    <li><a href="#customer-feedback">Customer Feedback</a></li>
                </ul>

                <!-- قسم الوصف -->
                <div id="description" class="tab-pane active">
                    <div class="description-container">
                        <!-- محتوى النص -->
                        <div class="description-text">
                            <p><?php echo $product['description']; ?></p>

                            <p>From minutes to mid, highlight only physical and physiological risks from hands, hand and
                                wristless discomfort levels. Expert and sincere with performance training, or support of
                                agile skills. Profit bonus elimination require eight reasons.</p>

                            <ul>
                                <?php
                                $features = explode("\n", $product['features']);
                                foreach ($features as $feature):
                                    if (!empty(trim($feature))):
                                        ?>
                                        <li><strong><?php echo $feature; ?></strong></li>
                                        <?php
                                    endif;
                                endforeach;
                                ?>
                            </ul>

                            <p>Once all these transitions, consumers pay back a worldwide walk. Not to blissmakers too
                                simple because they do not know how.</p>
                        </div>

                        <!-- عمود الفيديو -->
                        <div class="description-video">
                            <div class="video-container">
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/your-video-id"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="video-features">
                                <div class="feature">
                                    <div class="feature-icon">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                    <div class="feature-text">
                                        <h4>64% Discount</h4>
                                        <p>Serve your 64% money with us</p>
                                    </div>
                                </div>
                                <div class="feature">
                                    <div class="feature-icon">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                    <div class="feature-text">
                                        <h4>100% Organic</h4>
                                        <p>100% Organic <?php echo $product['category_name']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- معلومات إضافية -->
                <div id="additional-info" class="tab-pane">
                    <div class="additional-info-container">
                        <!-- الجانب الأيسر (النص والمعلومات) -->
                        <div class="info-text">
                            <table>
                                <tr>
                                    <th>Weight:</th>
                                    <td><?php echo $product['weight']; ?></td>
                                </tr>
                                <tr>
                                    <th>Color:</th>
                                    <td><?php echo $product['color']; ?></td>
                                </tr>
                                <tr>
                                    <th>Type:</th>
                                    <td><?php echo $product['type']; ?></td>
                                </tr>
                                <tr>
                                    <th>Category:</th>
                                    <td><?php echo $product['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Stock Status:</th>
                                    <td><?php echo $product['stock_quantity']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tags:</th>
                                    <td><?php echo $product['tags']; ?></td>
                                </tr>
                            </table>
                        </div>

                        <!-- الجانب الأيمن (الفيديو) -->
                        <div class="info-video">
                            <div class="video-container">
                                <iframe width="100%" height="315" src="https://www.youtube.com/embed/your-video-id"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </div>
                            <div class="video-features">
                                <div class="feature">
                                    <div class="feature-icon">
                                        <i class="fas fa-tag"></i>
                                    </div>
                                    <div class="feature-text">
                                        <h4>64% Discount</h4>
                                        <p>Serve your 64% money with us</p>
                                    </div>
                                </div>
                                <div class="feature">
                                    <div class="feature-icon">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                    <div class="feature-text">
                                        <h4>100% Organic</h4>
                                        <p>100% Organic <?php echo $product['category_name']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- تعليقات العملاء -->
                <div id="customer-feedback" class="tab-pane">
                    <div class="review">
                        <div class="review-header">
                            <h4>Kristin Weston</h4>
                            <span class="review-time">2 min ago</span>
                        </div>
                        <p>Dua da Lidomospeur nulla, ed dittium eros.</p>
                    </div>

                    <div class="review">
                        <div class="review-header">
                            <h4>Jane Cooper</h4>
                            <span class="review-date">30 Apr. 2021</span>
                        </div>
                        <p>Keep the soil evenly moist for the heartbeat growth. If the sun gets too hot, Chinese cabbage
                            tends to "bar" or go to seed: In long periods of heat, same kind of shade may be helpful.
                            Watch out for smalls as they will harm the plants.</p>
                    </div>

                    <div class="review">
                        <div class="review-header">
                            <h4>Jacob Jones</h4>
                            <span class="review-time">2 min ago</span>
                        </div>
                        <p>Vivamus oggi euilimod magna. Nem sed lechile nitix, et lechile fecus.</p>
                    </div>

                    <div class="review">
                        <div class="review-header">
                            <h4>Ralph Edwards</h4>
                            <span class="review-time">2 min ago</span>
                        </div>
                        <p>2007- Canton Fiat Choi Bei Chay Chinese Cabbage Seeds Helicom Non-Okô/Poductive Besides rape
                            VIA: chinensis, oka. Centreria Cholee, Ibé Choi, from USA.</p>
                    </div>

                    <button class="btn-load-more">Load More</button>
                </div>
            </div>
        </div>
        <section class="related-products-section">
            <div class="container">
                <h2 class="section-title">Related Products</h2>

                <div class="related-products-grid">
                    <?php if ($related_result && $related_result->num_rows > 0): ?>
                        <?php while ($product = $related_result->fetch_assoc()): ?>
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
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>no products found</p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php 
include './footer.html';
?>

    <script src="../Logics/Products_Details_Description.js"></script>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" 
    crossorigin="anonymous"></script>
    <script src="../Logics/add&delete-cart.js"></script>
    <script>
        // Wishlist functionality
        document.addEventListener('DOMContentLoaded', function() {
            const wishlistIcons = document.querySelectorAll('.wishlist-icon');
            
            wishlistIcons.forEach(icon => {
                icon.addEventListener('click', function() {
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
    <script src="../Logics/header.js"></script>
</body>
</html>