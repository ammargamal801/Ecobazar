<?php
require_once '../../Backend/category-b/product-details.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecobazar - <?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="../Style/Products_Details_Description..style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <header class="eco-header">
        <div class="container">
            <!-- الشعار ومتصفح البحث -->
            <div class="header-top">
                <div class="logo">
                    <a href="index.html">
                        <img src="Assets/plant 1.png" alt="Ecobazar Logo">
                        <h1>Ecobazar</h1>
                    </a>
                </div>

                <div class="search-bar">
                    <form action="/search">
                        <input type="text" placeholder="Search for organic products..." class="search-input">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <div class="header-icons">
                    <a href="#" class="icon-link"><i class="far fa-user"></i></a>
                    <a href="#" class="icon-link"><i class="far fa-heart"></i></a>
                    <a href="cart.html" class="icon-link cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="cart-count">0</span>
                    </a>
                </div>
            </div>

            <!-- القائمة الرئيسية -->
            <nav class="main-nav">
                <ul class="nav-list">
                    <li><a href="index.html" class="active">Home</a></li>
                    <li class="mega-menu">
                        <a href="shop.html">Shop <i class="fas fa-chevron-down"></i></a>
                        <!-- قائمة Mega Menu -->
                        <div class="mega-menu-content">
                            <div class="mega-menu-column">
                                <h4>Fruits & Vegetables</h4>
                                <ul>
                                    <li><a href="#">Organic Fruits</a></li>
                                    <li><a href="#">Fresh Vegetables</a></li>
                                    <li><a href="#">Leafy Greens</a></li>
                                </ul>
                            </div>
                            <div class="mega-menu-column">
                                <h4>Dairy & Eggs</h4>
                                <ul>
                                    <li><a href="#">Organic Milk</a></li>
                                    <li><a href="#">Farm Eggs</a></li>
                                    <li><a href="#">Cheese</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li><a href="blog.html">Blog</a></li>
                    <li><a href="about.html">About Us</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>

            <!-- زر القائمة المتنقلة -->
            <div class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

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
                        <span class="stars"><?php echo displayStars($average_rating); ?></span>
                        <span class="review-count"><?php echo $review_count; ?> Review</span>
                        <span class="sold-count">$<?php echo number_format($product['sold_count']); ?></span>
                    </div>

                    <div class="price">
                        <span class="original-price"><?php echo formatPrice($product['original_price']); ?></span>
                        <span class="discounted-price"><?php echo formatPrice($product['discounted_price']); ?></span>
                        <?php if ($product['discounted_price'] < $product['original_price']): ?>
                            <span
                                class="discount-badge"><?php echo calculateDiscount($product['original_price'], $product['discounted_price']); ?>%
                                OFF</span>
                        <?php endif; ?>
                    </div>

                    <div class="brand-section">
                        <h3>Brand</h3>
                        <div class="social-share">
                            <a href="#"><i class="fab fa-facebook"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-pinterest"></i></a>
                        </div>
                        <p><?php echo $product['description']; ?></p>
                    </div>

                    <div class="add-to-cart">
                        <button class="btn-add-to-cart">Add to Cart</button>
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
                                        <h4><?php echo calculateDiscount($product['original_price'], $product['discounted_price']); ?>%
                                            Discount</h4>
                                        <p>Serve your
                                            <?php echo calculateDiscount($product['original_price'], $product['discounted_price']); ?>%
                                            money with us</p>
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
                                    <td><?php echo $product['category_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Stock Status:</th>
                                    <td><?php echo $stock_status; ?></td>
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
                                        <h4><?php echo calculateDiscount($product['original_price'], $product['discounted_price']); ?>%
                                            Discount</h4>
                                        <p>Serve your
                                            <?php echo calculateDiscount($product['original_price'], $product['discounted_price']); ?>%
                                            money with us</p>
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
                    <?php if ($reviews_result && $reviews_result->num_rows > 0): ?>
                        <?php while ($review = $reviews_result->fetch_assoc()): ?>
                            <div class="review">
                                <div class="review-header">
                                    <h4><?php echo $review['user_name']; ?></h4>
                                    <span class="review-time">
                                        <?php
                                        $review_date = new DateTime($review['created_at']);
                                        $now = new DateTime();
                                        $diff = $now->diff($review_date);

                                        if ($diff->days == 0) {
                                            if ($diff->h == 0) {
                                                echo $diff->i . " min ago";
                                            } else {
                                                echo $diff->h . " hours ago";
                                            }
                                        } else if ($diff->days < 30) {
                                            echo $diff->days . " days ago";
                                        } else {
                                            echo $review_date->format('d M. Y');
                                        }
                                        ?>
                                    </span>
                                </div>
                                <p><?php echo $review['comment']; ?></p>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No reviews yet. Be the first to review this product.</p>
                    <?php endif; ?>

                    <?php if ($review_count > 4): ?>
                        <button class="btn-load-more">Load More</button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <section class="related-products-section">
            <div class="container">
                <h2 class="section-title">Related Products</h2>

                <div class="related-products-grid">
                    <!-- Product Card 1 -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="Assets/Product Image.png" alt="Green Apple">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Green Apple</h3>
                            <div class="product-price">
                                <span class="current-price">$10.99</span>
                                <span class="original-price">$21.99</span>
                            </div>
                            <div class="product-rating">
                                <span class="stars">★★★★★</span>
                            </div>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>

                    <!-- Product Card 2 -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="Assets/Product Image2.png" alt="Chinese Cabbage">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Chinese Cabbage</h3>
                            <div class="product-price">
                                <span class="current-price">$15.99</span>
                            </div>
                            <div class="product-rating">
                                <span class="stars">★★★★★</span>
                            </div>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>

                    <!-- Product Card 3 -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="Assets/Product Image3.png" alt="Green Capsicum">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Green Capsicum</h3>
                            <div class="product-price">
                                <span class="current-price">$22.99</span>
                            </div>
                            <div class="product-rating">
                                <span class="stars">★★★★★</span>
                            </div>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>

                    <!-- Product Card 4 -->
                    <div class="product-card">
                        <div class="product-image">
                            <img src="Assets/Product Image 4.png" alt="Ladies Finger">
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">Fresh Mango</h3>
                            <div class="product-price">
                                <span class="current-price">$28.99</span>
                            </div>
                            <div class="product-rating">
                                <span class="stars">★★★★★</span>
                            </div>
                            <button class="add-to-cart-btn">Add to Cart</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="newsletter">
        <div class="container">
            <h2>Subscribe our Newsletter</h2>
            <p>Felicitatezza su utilità degli insulti congiura media media nec lettus. Pinsella impetrata siti su magma.
            </p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit">Subscribe</button>
            </form>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-pinterest"></i></a>
            </div>
        </div>
    </section>

    <footer style="background-color: #111; color: #fff; padding: 40px 0; font-family: Arial, sans-serif;">
        <div style="width: 80%; margin: auto; display: flex; flex-wrap: wrap; justify-content: space-between;">
            <!-- Left Section -->
            <div style="width: 25%; min-width: 250px;">
                <h2 style="display: flex; align-items: center;">
                    <span style="color: #29a745; font-size: 24px; margin-right: 10px;">&#127793;</span>
                    <span>Ecobazar</span>
                </h2>
                <p style="color: #bbb; font-size: 14px;">Morbi cursus porttitor enim lobortis molestie. Duis gravida
                    turpis dui, eget bibendum magna congue nec.</p>
                <p style="color: #bbb; font-size: 14px;">
                    <span style="color: #29a745;">(+20) 01285964248</span> or
                    <a href="mailto:ZiadAlbadry16@gmail.com"
                        style="color: #29a745; text-decoration: none;">ZiadAlbadry16@gmail.com</a>
                </p>
            </div>

            <!-- Middle Sections -->
            <div style="width: 15%; min-width: 150px;">
                <h3>My Account</h3>
                <ul style="list-style: none; padding: 0; color: #bbb;">
                    <li>My Account</li>
                    <li>Order History</li>
                    <li style="color: white;">Shoping Cart</li>
                    <li>Wishlist</li>
                </ul>
            </div>
            <div style="width: 15%; min-width: 150px;">
                <h3>Helps</h3>
                <ul style="list-style: none; padding: 0; color: #bbb;">
                    <li>Contact</li>
                    <li>FAQs</li>
                    <li>Terms & Condition</li>
                    <li>Privacy Policy</li>
                </ul>
            </div>
            <div style="width: 15%; min-width: 150px;">
                <h3>Proxy</h3>
                <ul style="list-style: none; padding: 0; color: #bbb;">
                    <li>About</li>
                    <li>Shop</li>
                    <li>Product</li>
                    <li>Track Order</li>
                </ul>
            </div>
            <div style="width: 15%; min-width: 150px;">
                <h3>Categories</h3>
                <ul style="list-style: none; padding: 0; color: #bbb;">
                    <li>Fruit & Vegetables</li>
                    <li>Meat & Fish</li>
                    <li>Bread & Bakery</li>
                    <li>Beauty & Health</li>
                </ul>
            </div>
        </div>
        <!-- Bottom Section -->
        <div style="width: 80%; margin: auto; padding-top: 20px; border-top: 1px solid #333; text-align: center;">
            <p style="color: #bbb;">Ecobazar eCommerce © 2025. All Rights Reserved</p>
            <div style="display: flex; justify-content: center; align-items: center; gap: 10px;">
                <img src="Assets/ApplePay.png" alt="Apple Pay" width="40">
                <img src="https://upload.wikimedia.org/wikipedia/commons/0/04/Visa.svg" alt="Visa" width="40">
                <img src="Assets/Method=Discover.png" alt="Discover" width="40">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/b7/MasterCard_Logo.svg" alt="MasterCard"
                    width="40">
                <img src="images/Cart.png" alt="Visa" width="40">
            </div>
        </div>
    </footer>

    <script src="../Logics/Products_Details_Description.js"></script>
</body>

</html>