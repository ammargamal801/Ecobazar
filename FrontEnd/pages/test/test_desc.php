<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chinese Cabbage - Ecobazar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #00B207;
            --secondary-color: #FF8A00;
            --light-gray: #f7f7f7;
            --dark-text: #1A1A1A;
            --light-text: #666666;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--dark-text);
            background-color: #fff;
        }
        
        .product-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .product-badge {
            background-color: var(--primary-color);
            color: white;
            font-size: 12px;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: 500;
            display: inline-block;
        }
        
        .product-rating i {
            color: #FFB800;
            font-size: 14px;
        }
        
        .product-sku {
            color: var(--light-text);
            font-size: 14px;
            margin-left: 10px;
        }
        
        .price-original {
            text-decoration: line-through;
            color: var(--light-text);
            font-size: 16px;
        }
        
        .price-current {
            font-size: 24px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .price-discount {
            background-color: #FFE7E7;
            color: #FF4F4F;
            font-size: 12px;
            padding: 2px 6px;
            border-radius: 4px;
            font-weight: 500;
        }
        
        .brand-badge {
            display: inline-flex;
            align-items: center;
        }
        
        .brand-badge img {
            height: 20px;
            margin-right: 5px;
        }
        
        .product-description {
            color: var(--light-text);
            font-size: 14px;
            line-height: 1.6;
            margin-top: 15px;
        }
        
        .quantity-input {
            width: 30px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 500;
            font-size: 16px;
        }
        
        .quantity-control {
            display: flex;
            align-items: center;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px 10px;
            width: fit-content;
        }
        
        .quantity-btn {
            background: transparent;
            border: none;
            font-size: 16px;
            cursor: pointer;
            color: var(--light-text);
            padding: 0 5px;
        }
        
        .add-to-cart-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-weight: 500;
            width: 100%;
            max-width: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .add-to-cart-btn:hover {
            background-color: #009706;
        }
        
        .wishlist-btn {
            border: 1px solid #ddd;
            background-color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 10px;
        }
        
        .wishlist-btn:hover {
            background-color: #f5f5f5;
        }
        
        .social-share {
            margin-top: 20px;
        }
        
        .social-share span {
            color: var(--dark-text);
            font-weight: 500;
            margin-right: 10px;
        }
        
        .social-share a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #f5f5f5;
            color: var(--dark-text);
            margin-right: 10px;
            text-decoration: none;
        }
        
        .social-share a:hover {
            background-color: var(--primary-color);
            color: white;
        }
        
        .product-info-label {
            font-weight: 500;
            color: var(--dark-text);
            margin-right: 5px;
        }
        
        .product-info-value {
            color: var(--light-text);
        }
        
        .product-info-value a {
            color: var(--light-text);
            text-decoration: none;
        }
        
        .product-info-value a:hover {
            color: var(--primary-color);
        }
        
        .product-main-img {
            max-height: 350px;
            object-fit: contain;
        }
        
        .product-thumbnails {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .product-thumbnail {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            cursor: pointer;
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .product-thumbnail.active {
            border-color: var(--primary-color);
        }
        
        .product-thumbnail img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        /* Product Tabs Styling */
        .product-tabs {
            border-bottom: 1px solid #ddd;
            margin-top: 40px;
        }
        
        .product-tabs .nav-link {
            color: var(--light-text);
            border: none;
            padding: 10px 20px;
            font-weight: 500;
        }
        
        .product-tabs .nav-link.active {
            color: var(--primary-color);
            border-bottom: 2px solid var(--primary-color);
            background-color: transparent;
        }
        
        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        
        .feature-icon {
            color: var(--primary-color);
            margin-right: 10px;
        }
        
        /* Benefits Section Styling */
        .discount-badge {
            background-color: #E6F5E6;
            color: var(--primary-color);
            font-size: 12px;
            padding: 8px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .organic-badge {
            background-color: #E6F5E6;
            color: var(--primary-color);
            font-size: 12px;
            padding: 8px;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        /* Related Products Styling */
        .related-products-section {
            margin-top: 60px;
            margin-bottom: 40px;
        }

        .related-products-section h2 {
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
        }

        .related-product-card {
            border: 1px solid #eee;
            border-radius: 8px;
            background-color: #fff;
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
        }

        .related-product-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .related-product-img-container {
            background-color: #f9f9f9;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 200px;
        }

        .related-product-img {
            max-height: 160px;
            max-width: 100%;
            object-fit: contain;
        }

        .related-product-info {
            padding: 15px;
        }

        .related-product-title {
            font-size: 16px;
            font-weight: 500;
            margin-bottom: 8px;
            color: var(--dark-text);
        }

        .related-product-rating {
            margin-bottom: 8px;
        }

        .related-product-rating i {
            color: #FFB800;
            font-size: 14px;
        }

        .related-product-price {
            display: flex;
            align-items: center;
        }

        .related-product-current-price {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-color);
        }

        .related-product-original-price {
            text-decoration: line-through;
            color: var(--light-text);
            font-size: 14px;
            margin-left: 8px;
        }

        .sale-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #FF4F4F;
            color: white;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 500;
        }

        .cart-icon-btn {
            position: absolute;
            right: 10px;
            bottom: 15px;
            background-color: var(--primary-color);
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;
        }

        .wishlist-icon-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: white;
            color: #666;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #eee;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .quick-view-btn {
            position: absolute;
            top: 50px;
            right: 10px;
            background-color: white;
            color: #666;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #eee;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        @media (max-width: 768px) {
            .product-thumbnails {
                flex-direction: row;
                overflow-x: auto;
                margin-top: 15px;
            }
            
            .product-thumbnail {
                flex: 0 0 60px;
                margin-right: 10px;
                height: 60px;
                width: 60px;
            }
        }
    </style>
</head>
<body>
    <div class="product-container">
        <div class="row">
            <!-- Product Images -->
            <div class="col-md-6 mb-4">
                <div class="d-flex">
                    <div class="product-thumbnails me-3">
                        <div class="product-thumbnail active">
                            <img src="../../Assets/photo green.jpg" alt="Chinese Cabbage Thumbnail" class="img-fluid">
                        </div>
                        <div class="product-thumbnail">
                            <img src="../../Assets/photo green.jpg" alt="Chinese Cabbage Thumbnail" class="img-fluid">
                        </div>
                        <div class="product-thumbnail">
                            <img src="../../Assets/photo green.jpg" alt="Chinese Cabbage Thumbnail" class="img-fluid">
                        </div>
                        <div class="product-thumbnail">
                            <img src="../../Assets/photo green.jpg" alt="Chinese Cabbage Thumbnail" class="img-fluid">
                        </div>
                    </div>
                    <div class="main-image-container">
                        <img src="../../Assets/photo green.jpg" alt="Chinese Cabbage" class="img-fluid product-main-img">
                    </div>
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <h2 class="mb-0">Chinese Cabbage</h2>
                    <span class="product-badge">In Stock</span>
                </div>
                
                <div class="d-flex align-items-center mb-3">
                    <div class="product-rating me-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="me-2">4.5 Review</span>
                    <span class="product-sku">SKU: 2306584</span>
                </div>
                
                <div class="d-flex align-items-center mb-3">
                    <span class="price-original me-2">$48.00</span>
                    <span class="price-current me-2">$17.28</span>
                    <span class="price-discount">64% OFF</span>
                </div>
                
                <div class="mb-3">
                    <span class="product-info-label">Brand:</span>
                    <span class="brand-badge">
                        <img src="../../Assets/organic-icon.png" alt="Organic" onerror="this.src='data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiMwMEIyMDciIHN0cm9rZS13aWR0aD0iMiIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cGF0aCBkPSJNMTIgMjJzOC0xMCA4LTEzLjUtNS4zNzMtNi0xMi02UzAgNS4wMSAwIDguNSA4IDE4LjUgOCAxOC41IiBmaWxsPSIjRTZGNUU2Ii8+PC9zdmc+'; this.style.height='20px';">
                        <span>Organic</span>
                    </span>
                </div>
                
                <div class="product-description">
                    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nulla nisl diam, blandit vel consequat nec, ultrices at ipsum. Nulla varius magna a consequat pulvinar.</p>
                </div>
                
                <div class="d-flex align-items-center my-4">
                    <div class="quantity-control me-3">
                        <button class="quantity-btn" id="decrease-qty">-</button>
                        <input type="text" class="quantity-input" value="5" id="product-qty" readonly>
                        <button class="quantity-btn" id="increase-qty">+</button>
                    </div>
                    
                    <button class="add-to-cart-btn">
                        Add to Cart
                    </button>
                    
                    <button class="wishlist-btn">
                        <i class="far fa-heart"></i>
                    </button>
                </div>
                
                <div class="mb-3">
                    <div class="mb-2">
                        <span class="product-info-label">Category:</span>
                        <span class="product-info-value"><a href="#">Vegetables</a></span>
                    </div>
                    <div>
                        <span class="product-info-label">Tag:</span>
                        <span class="product-info-value">
                            <a href="#">Vegetables</a>, 
                            <a href="#">Healthy</a>, 
                            <a href="#">Chinese</a>, 
                            <a href="#">Cabbage</a>, 
                            <a href="#">Green Cabbage</a>
                        </span>
                    </div>
                </div>
                
                <div class="social-share">
                    <span>Share Item:</span>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        
        <!-- Product Tabs -->
        <ul class="nav nav-tabs product-tabs" id="productTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab" aria-controls="description" aria-selected="true">Descriptions</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="additional-tab" data-bs-toggle="tab" data-bs-target="#additional" type="button" role="tab" aria-controls="additional" aria-selected="false">Additional Information</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="feedback-tab" data-bs-toggle="tab" data-bs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="false">Customer Feedback</button>
            </li>
        </ul>
        
        <div class="tab-content p-4" id="productTabsContent">
            <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                <p>Sed commodo ultricies mi eu porta. Donec ipsum felis, imperdiet at posuere ac, viverra at mauris. Maecenas tincidunt ligula a sem vestibulum pretium. Maecenas turpis turpis, faucibus at lectus eu, iaculis imperdiet nisl. Sed efficitur nisi et mi rhoncus, vel commodo nunc ultrices. Vivamus vestibulum eros eros, aliquam mollis lacus sed et. Donec commodo sem, sed consequat ante, amet a convallis. Morbi a tincidunt felis, felis sagittis amet a tincidunt. Amet a tincidunt felis, felis sagittis amet a tincidunt. Amet a tincidunt felis, felis sagittis amet a tincidunt.</p>
                
                <p>Nulla rhoncus tellus, faucibus quis pharetra sed, gravida ac dui. Sed lacinia, metus faucibus iaculis tincidunt, turpis ex varius velit, pulvinar tincidunt risque mi eget nulla. Proin commodo.</p>
                
                <div class="mt-4">
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span>100 g of fresh leaves provides:</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span>Vitamin A, B6, C, K and folate (vitamin B9).</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span>Omega-3 and omega-6 alpha-linolenic acid.</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle feature-icon"></i>
                        <span>Fresh crunchy cells vibrant flavor pointers.</span>
                    </div>
                </div>
                
                <p class="mt-4">Cras et diam maximus, accumsan sapien et, sollicitudin velit. Nulla blandit eros non turpis lobortis volutis et ut massa.</p>
            </div>
            
            <div class="tab-pane fade" id="additional" role="tabpanel" aria-labelledby="additional-tab">
                <h4>Additional Information</h4>
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">Weight</th>
                            <td>500g</td>
                        </tr>
                        <tr>
                            <th scope="row">Origin</th>
                            <td>China</td>
                        </tr>
                        <tr>
                            <th scope="row">Organic</th>
                            <td>Yes</td>
                        </tr>
                        <tr>
                            <th scope="row">Storage</th>
                            <td>Keep refrigerated</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <div class="tab-pane fade" id="feedback" role="tabpanel" aria-labelledby="feedback-tab">
                <h4>Customer Reviews</h4>
                <div class="d-flex align-items-center mb-4">
                    <div class="product-rating me-2">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span>4.5 out of 5</span>
                </div>
                
                <div class="review-item mb-4 pb-4 border-bottom">
                    <div class="d-flex justify-content-between mb-2">
                        <h5>John Doe</h5>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-2">Posted on March 15, 2023</p>
                    <p>Very fresh and crispy! I love using it in my stir-fry dishes. Will definitely buy again.</p>
                </div>
                
                <div class="review-item">
                    <div class="d-flex justify-content-between mb-2">
                        <h5>Jane Smith</h5>
                        <div class="product-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                    </div>
                    <p class="text-muted mb-2">Posted on February 28, 2023</p>
                    <p>Good quality cabbage. Lasted well in the fridge for over a week.</p>
                </div>
            </div>
        </div>
        
        <!-- Benefits Section -->
        <div class="row mt-5 mb-5">
            <div class="col-md-6">
                <div class="d-flex align-items-center mb-4">
                    <div class="discount-badge me-3">
                        <span>64%</span>
                    </div>
                    <div>
                        <h5 class="mb-1">64% Discount</h5>
                        <p class="mb-0">Share your 64% saving with us!</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center">
                    <div class="organic-badge me-3">
                        <span>100%</span>
                    </div>
                    <div>
                        <h5 class="mb-1">100% Organic</h5>
                        <p class="mb-0">100% Organic Vegetables</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Related Products -->
        <div class="related-products-section">
            <h2>Related Products</h2>
            <div class="row">
                <!-- Product 1 -->
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="related-product-card">
                        <span class="sale-badge">Sale 50%</span>
                        <button class="wishlist-icon-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="quick-view-btn">
                            <i class="far fa-eye"></i>
                        </button>
                        <div class="related-product-img-container">
                            <img src="../../Assets/photo green.jpg" alt="Green Apple" class="related-product-img">
                        </div>
                        <div class="related-product-info">
                            <h5 class="related-product-title">Green Apple</h5>
                            <div class="related-product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="related-product-price">
                                <span class="related-product-current-price">$14.99</span>
                                <span class="related-product-original-price">$29.99</span>
                            </div>
                            <button class="cart-icon-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 2 -->
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="related-product-card">
                        <button class="wishlist-icon-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="quick-view-btn">
                            <i class="far fa-eye"></i>
                        </button>
                        <div class="related-product-img-container">
                            <img src="../../Assets/photo green.jpg" alt="Organic Cauliflower" class="related-product-img">
                        </div>
                        <div class="related-product-info">
                            <h5 class="related-product-title">Organic Cauliflower</h5>
                            <div class="related-product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="related-product-price">
                                <span class="related-product-current-price">$14.99</span>
                            </div>
                            <button class="cart-icon-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 3 -->
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="related-product-card">
                        <button class="wishlist-icon-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="quick-view-btn">
                            <i class="far fa-eye"></i>
                        </button>
                        <div class="related-product-img-container">
                            <img src="../../Assets/photo green.jpg" alt="Green Capsicum" class="related-product-img">
                        </div>
                        <div class="related-product-info">
                            <h5 class="related-product-title">Green Capsicum</h5>
                            <div class="related-product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <div class="related-product-price">
                                <span class="related-product-current-price">$14.99</span>
                            </div>
                            <button class="cart-icon-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Product 4 -->
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <div class="related-product-card">
                        <button class="wishlist-icon-btn">
                            <i class="far fa-heart"></i>
                        </button>
                        <button class="quick-view-btn">
                            <i class="far fa-eye"></i>
                        </button>
                        <div class="related-product-img-container">
                            <img src="../../Assets/photo green.jpg" alt="Ladies Finger" class="related-product-img">
                        </div>
                        <div class="related-product-info">
                            <h5 class="related-product-title">Ladies Finger</h5>
                            <div class="related-product-rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="far fa-star"></i>
                            </div>
                            <div class="related-product-price">
                                <span class="related-product-current-price">$16.99</span>
                            </div>
                            <button class="cart-icon-btn">
                                <i class="fas fa-shopping-cart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Quantity input functionality
        document.addEventListener('DOMContentLoaded', function() {
            const decreaseBtn = document.getElementById('decrease-qty');
            const increaseBtn = document.getElementById('increase-qty');
            const qtyInput = document.getElementById('product-qty');
            
            decreaseBtn.addEventListener('click', function() {
                let currentQty = parseInt(qtyInput.value);
                if (currentQty > 1) {
                    qtyInput.value = currentQty - 1;
                }
            });
            
            increaseBtn.addEventListener('click', function() {
                let currentQty = parseInt(qtyInput.value);
                qtyInput.value = currentQty + 1;
            });
            
            // Thumbnail click functionality
            const thumbnails = document.querySelectorAll('.product-thumbnail');
            const mainImg = document.querySelector('.product-main-img');
            
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    // Remove active class from all thumbnails
                    thumbnails.forEach(t => t.classList.remove('active'));
                    
                    // Add active class to clicked thumbnail
                    this.classList.add('active');
                    
                    // Update main image
                    const thumbnailImg = this.querySelector('img');
                    if (thumbnailImg) {
                        mainImg.src = thumbnailImg.src;
                    }
                });
            });
        });
    </script>
</body>
</html>