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
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description"
	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap 
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">-->
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- main style -->
	
	<link rel="stylesheet" href="../../Style/main.css">
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">


	 <!-- Bootstrap CSS for styling and layout -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- Bootstrap Icons for icon set -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Font Awesome for additional icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>

<body>
	
  <!-- Main navigation bar fixed at top -->
  <nav class="navbar border fixed-top d-flex py-3" style="background-color: var(--white);">
	<div class="container-fluid d-flex justify-content-center">
		<div class="container d-flex align-items-center position-relative">
			<!-- Mobile menu toggle button (hidden on larger screens) -->
			<div class="col-1 me-3 mt-1 d-flex">
				<button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar2"
					aria-controls="offcanvasNavbar2" aria-label="Toggle navigation2">
					<span class="navbar-toggler-icon d-block d-xxl-none"></span>
				</button>
			</div>

			<!-- Primary navigation links (hidden on mobile) -->
			<div class="col-3 d-flex d-xxl-flex d-none align-items-center ms-n6" style="margin-left: -100px;">
				<a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Home <i class="bi bi-chevron-down ms-1 mt-1"></i></a>
				<a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Shop<i class="bi bi-chevron-down ms-1 mt-1"></i></a>
				<a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Pages<i class="bi bi-chevron-down ms-1 mt-1"></i></a>
				<a class="text-decoration-none me-3 d-flex align-items-center" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Blog <i class="bi bi-chevron-down ms-1 mt-1"></i></a>
				<a class="text-decoration-none d-flex align-items-center text-nowrap" style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">About Us</a>
			</div>

			<!-- Brand logo centered in the navigation -->
			<div class="col-3 d-flex justify-content-center fs-2" style="font-family: Poppins, sans-serif; font-weight: 400; color: var(--black-text-color); position: absolute; left: 50%; transform: translateX(-50%);">
				<a href="" class="text-decoration-none d-flex" style="color: var(--black-text-color);">
					<i class="fas fa-leaf me-1 mt-2" style="color: var(--green-text);"></i>
					Ecobazar
				</a>
			</div>

			<!-- Right-side navigation icons and controls -->
			<div class="col-3 d-flex align-items-center justify-content-end ms-auto">
				<!-- Search icon with click functionality -->
				<div class="me-3">
					<i class="bi bi-search fa-lg" id="searchIcon" style="cursor: pointer;"></i>
				</div>
				<!-- Wishlist icon (hidden on mobile) -->
				<div class="me-3 d-lg-flex d-none">
					<a href="" style="color:var(--black-text-color);">
						<i class="bi bi-heart fa-lg"></i>
					</a>
				</div>
				<!-- Shopping cart with offcanvas toggle -->
				<div class="me-3">
					<a href="#" style="color: var(--black-text-color);" data-bs-toggle="offcanvas"
						data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
						<i class="bi bi-handbag fa-lg"></i>
					</a>
				</div>
				<!-- User profile icon (hidden on mobile) -->
				<div class="me-3 d-lg-flex d-none">
					<a href="" style="color:var(--black-text-color);">
						<i class="bi bi-person fa-lg"></i>
					</a>
				</div>
				<!-- Login button (hidden on mobile) -->
				<div class="me-3 d-lg-flex d-none">
					<a href="#" class="btn btn-sm" style="background-color: var(--green-text); color: white; padding: 0.25rem 0.75rem;">
						Login
					</a>
				</div>
				<!-- Dark mode toggle button -->
				<div class="me-3">
					<button id="darkModeToggle" class="btn btn-link p-0" style="color: var(--black-text-color);">
						<i class="bi bi-moon"></i>
					</button>
				</div>
				<!-- Search input field (initially hidden) -->
				<div>
					<form class="d-flex" role="search">
						<input class="form-control" type="search" placeholder="Search" aria-label="Search" id="searchBox">
					</form>
				</div>
			</div>
		</div>

		<!-- Secondary mobile menu toggle (currently hidden) -->
		<button class="navbar-toggler border-0 ms-2 d-none" type="button" data-bs-toggle="offcanvas"
			data-bs-target="#offcanvasNavMenu" aria-controls="offcanvasNavMenu" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- Mobile offcanvas menu -->
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
				<!-- Brand logo at bottom of mobile menu -->
				<div class="fw-bold" style="margin-top:250px;color: var(--black-text-color);">
					<i class="fas fa-leaf fa-2x" style="color: var(--green-text);"></i>
				</div>
			</div>
		</div>

		<!-- Shopping cart offcanvas panel -->
		<div class="offcanvas offcanvas-end border-0" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasCartLabel">Shopping Cart (2)</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<div class="container">
					<div class="col">
						<!-- First cart item -->
						<div class="row position-relative">
							<div class="col">
								<img src="../Assets/orange.jpg" class="w-25" alt="">
							</div>
							<div class="col-auto">
								<div class="row" style="margin-left: -240px;margin-top:20px;">
									<p style="font-weight:400;font-family: poppins;color:var(--black-text-color);"> Fresh Indian Orange</p>
								</div>
								<div class="row" style="margin-top:-18px;margin-left: -240px;">
									<p style="color:var(--black-text-color);">1 kg x <span class="fw-bold">12.00</span></p>
								</div>
							</div>
							<div class="col position-absolute" style="margin-left: 320px; margin-top:20px;">
								<div class="btn-group" role="group" aria-label="Third group">
									<button type="button" class="x-button border-0" style="background-color:var(--white);color:var(--black-text-color);">x</button>
								</div>
							</div>
						</div>

						<!-- Second cart item -->
						<div class="row">
							<div class="row position-relative">
								<div class="col" style="margin-left:-50px;">
									<img src="../Assets/apple.jpg" class="w-50" alt="">
								</div>
								<div class="col-auto">
									<div class="row" style="margin-left: -185px;margin-top:40px;">
										<p style="font-weight:400;font-family: poppins;color:var(--black-text-color);"> Green Apple</p>
									</div>
									<div class="row" style="margin-top:-18px;margin-left: -185px;">
										<p style="color:var(--black-text-color);">1 kg x <span class="fw-bold">14.00</span></p>
									</div>
								</div>
								<div class="col position-absolute" style="margin-left: 320px; margin-top:40px;">
									<div class="btn-group" role="group" aria-label="Third group">
										<button type="button" class="x-button border-0" style="background-color:var(--white);color:var(--black-text-color);">x</button>
									</div>
								</div>
							</div>
						</div>

						<!-- Cart summary -->
						<div class="row" style="margin-top: 370px;">
							<div class="col d-flex justify-content-end align-content-end">
								<p style="color: var(--black-text-color);">2 products</p>
							</div>
							<div class="col">
								<p class="fw-bold" style="color: var(--black-text-color);">$26.00</p>
							</div>
						</div>

						<!-- Cart action buttons -->
						<div class="col" style="margin-top: 10px;">
							<div class="row d-block">
								<button type="button" class="btn border rounded-5 d-block"
									style="color: var(--background-page); background-color: var(--green-text); margin-bottom: 10px;">Checkout</button>
							</div>
							<div class="row d-block">
								<button type="button" class="btn border rounded-5" style="color: var(--black-text-color); background-color: var(--card-border-color);">Go To Cart</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</nav>


	<!-- home page slider -->
	<div class="homepage-slider">
		<!-- single home slider -->

		<div class="single-homepage-slider homepage-bg-1">

			<div class="container">
				<div class="row">
					<div class="col-md-12 col-lg-7 offset-lg-1 offset-xl-0">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Fresh & Organic</p>
								<h1>Delicious Seasonal Fruits</h1>
								<div class="hero-btns">
									<a href="shop.html" class="boxed-btn">Fruit Collection</a>
									<a href="contact.html" class="bordered-btn">Contact Us</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-2">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-center">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Fresh Everyday</p>
								<h1>100% Organic Collection</h1>
								<div class="hero-btns">
									<a href="shop.html" class="boxed-btn">Visit Shop</a>
									<a href="contact.html" class="bordered-btn">Contact Us</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- single home slider -->
		<div class="single-homepage-slider homepage-bg-3">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1 text-right">
						<div class="hero-text">
							<div class="hero-text-tablecell">
								<p class="subtitle">Mega Sale Going On!</p>
								<h1>Get December Discount</h1>
								<div class="hero-btns">
									<a href="shop.html" class="boxed-btn">Visit Shop</a>
									<a href="contact.html" class="bordered-btn">Contact Us</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end home page slider -->

	<!-- features list section -->

	<section class="featured-section">
		<article class="feature-card feature-card--green">
			<img src="https://cdn.builder.io/api/v1/image/assets/TEMP/37d23bf74969880e6c71d3a6b99e71251a317ed2?placeholderIfAbsent=true&apiKey=4877d8b6a2aa42afb2308a2d0798240b"
				alt="" class="feature-icon" />
			<div class="feature-content">
				<h3 class="feature-title feature-title--light">Free Shipping</h3>
				<p class="feature-description feature-description--light">Free shipping with discount</p>
			</div>
		</article>

		<article class="feature-card">
			<img src="https://cdn.builder.io/api/v1/image/assets/TEMP/6917c9963f260b80137fbd4eda9f1dc596e94b4b?placeholderIfAbsent=true&apiKey=4877d8b6a2aa42afb2308a2d0798240b"
				alt="" class="feature-icon" />
			<div class="feature-content">
				<h3 class="feature-title">Great Support 24/7</h3>
				<p class="feature-description">Instant access to Contact</p>
			</div>
		</article>

		<div class="feature-divider" role="separator" aria-orientation="vertical"></div>

		<article class="feature-card">
			<img src="https://cdn.builder.io/api/v1/image/assets/TEMP/4341551d8853ac508db5d6056f4f27f6f14073f6?placeholderIfAbsent=true&apiKey=4877d8b6a2aa42afb2308a2d0798240b"
				alt="" class="feature-icon" />
			<div class="feature-content">
				<h3 class="feature-title">100% Sucure Payment</h3>
				<p class="feature-description">We ensure your money is save</p>
			</div>
		</article>

		<div class="feature-divider" role="separator" aria-orientation="vertical"></div>

		<article class="feature-card">
			<img src="https://cdn.builder.io/api/v1/image/assets/TEMP/bee1ccbd5367e8eeca1d606a4070909a9cc1686d?placeholderIfAbsent=true&apiKey=4877d8b6a2aa42afb2308a2d0798240b"
				alt="" class="feature-icon" />
			<div class="feature-content">
				<h3 class="feature-title">Money-Back Guarantee</h3>
				<p class="feature-description">30 days money-back guarantee</p>
			</div>
		</article>
	</section>
	<!-- end features list section -->

	<!-- Featured Section Begin -->
	<section class="featured spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="section-title">
						<h2>Introducing Our Products</h2>
					</div>
					<div class="featured__controls">
						<ul>
							<li class="active" data-filter="*">All</li>
							<li data-filter=".vegetables">Vegetable</li>
							<li data-filter=".fruit">Fruit</li>
							<li data-filter=".meat">Meat & Fish</li>
							<li data-filter="*">View All</li>
						</ul>
					</div>
				</div>
			</div>

			<div class="row featured__filter">
				<div class="col-lg-3 col-md-4 col-sm-6 mix vegetables ">
					<div class="featured__item">
						<!-- Product Card-->
						<div class="product-card">
							<div class="product-badge">Sale</div>
							<div class="product-image">
								<img src="assets/img/products/Green Chilli.png"
									alt="Green chilli">
								<div class="product-actions">
									<button class="quick-view"><i class="fas fa-eye"></i></button>
									<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
								</div>
							</div>
							<div class="product-info">
								<h3 class="product-title">Green Chilli</h3>
								<div class="product-price">
									<span class="current-price">$10.99</span>
									<span class="original-price">$21.99</span>
								</div>
								<div class="product-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<span class="rating-count">(128)</span>
								</div>
								<button class="add-to-cart">Add to Cart</button>
							</div>
						</div>
					</div>
				</div>


				<div class="col-lg-3 col-md-4 col-sm-6 mix meat">
					<div class="featured__item">
						<!-- Product Card 2 -->
						<div class="product-card">
							<div class="product-badge">Sale</div>
							<div class="product-image">
								<img src="assets/img/products/pngimg.com - beef_PNG29.png"
									alt="meat">
								<div class="product-actions">
									<button class="quick-view"><i class="fas fa-eye"></i></button>
									<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
								</div>
							</div>
							<div class="product-info">
								<h3 class="product-title">Meat</h3>
								<div class="product-price">
									<span class="current-price">$10.99</span>
									<span class="original-price">$21.99</span>
								</div>
								<div class="product-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<span class="rating-count">(128)</span>
								</div>
								<button class="add-to-cart">Add to Cart</button>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-4 col-sm-6 mix fruit ">
					<div class="featured__item">
						<!-- Product Card 3 -->
						<div class="product-card">
							<div class="product-image">
								<img src="assets/img/products/orange.png" alt="orange">
								<div class="product-actions">
									<button class="quick-view"><i class="fas fa-eye"></i></button>
									<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
								</div>
							</div>
							<div class="product-info">
								<h3 class="product-title">Orange</h3>
								<div class="product-price">
									<span class="current-price">$10.99</span>
									<span class="original-price">$21.99</span>
								</div>
								<div class="product-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<span class="rating-count">(128)</span>
								</div>
								<button class="add-to-cart">Add to Cart</button>
							</div>
						</div>
					</div>
				</div>


				<div class="col-lg-3 col-md-4 col-sm-6 mix vegetables ">
					<div class="featured__item">
						<!-- Product Card 4 -->
						<div class="product-card">

							<div class="product-image">
								<img src="assets/img/products/Fresh Cauliflower.png"
									alt="Fresh Cauliflower">
								<div class="product-actions">
									<button class="quick-view"><i class="fas fa-eye"></i></button>
									<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
								</div>
							</div>
							<div class="product-info">
								<h3 class="product-title">Fresh Cauliflower</h3>
								<div class="product-price">
									<span class="current-price">$10.99</span>
									<span class="original-price">$21.99</span>
								</div>
								<div class="product-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<span class="rating-count">(128)</span>
								</div>
								<button class="add-to-cart">Add to Cart</button>
							</div>
						</div>
					</div>
				</div>


				<div class="col-lg-3 col-md-4 col-sm-6 mix fruit ">
					<div class="featured__item">
						<!-- Product Card 5 -->
						<div class="product-card">
							<div class="product-badge">Sale</div>
							<div class="product-image">
								<img src="assets/img/products/mango.png" alt="Mango">
								<div class="product-actions">
									<button class="quick-view"><i class="fas fa-eye"></i></button>
									<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
								</div>
							</div>
							<div class="product-info">
								<h3 class="product-title">Mango</h3>
								<div class="product-price">
									<span class="current-price">$10.99</span>
									<span class="original-price">$21.99</span>
								</div>
								<div class="product-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<span class="rating-count">(128)</span>
								</div>
								<button class="add-to-cart">Add to Cart</button>
							</div>
						</div>
					</div>
				</div>


				<div class="col-lg-3 col-md-4 col-sm-6 mix vegetables ">
					<div class="featured__item">
						<!-- Product Card 6 -->
						<div class="product-card">
							<div class="product-image">
								<img src="assets/img/products/tomatos.png" alt="Tomatos">
								<div class="product-actions">
									<button class="quick-view"><i class="fas fa-eye"></i></button>
									<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
								</div>
							</div>
							<div class="product-info">
								<h3 class="product-title">Tomatos</h3>
								<div class="product-price">
									<span class="current-price">$10.99</span>
									<span class="original-price">$21.99</span>
								</div>
								<div class="product-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<span class="rating-count">(128)</span>
								</div>
								<button class="add-to-cart">Add to Cart</button>
							</div>
						</div>
					</div>
				</div>


				<div class="col-lg-3 col-md-4 col-sm-6 mix meat ">
					<div class="featured__item">
						<!-- Product Card 7 -->
						<div class="product-card">
							<div class="product-image">
								<img src="assets/img/products/pngimg.com - beef_PNG42.png"
									alt="Meat">
								<div class="product-actions">
									<button class="quick-view"><i class="fas fa-eye"></i></button>
									<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
								</div>
							</div>
							<div class="product-info">
								<h3 class="product-title">Beef Meat</h3>
								<div class="product-price">
									<span class="current-price">$10.99</span>
									<span class="original-price">$21.99</span>
								</div>
								<div class="product-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<span class="rating-count">(128)</span>
								</div>
								<button class="add-to-cart">Add to Cart</button>
							</div>
						</div>
					</div>
				</div>


				<div class="col-lg-3 col-md-4 col-sm-6 mix meat">
					<div class="featured__item">
						<!-- Product Card 8 -->
						<div class="product-card">
							<div class="product-image">
								<img src="assets/img/products/meat.png" alt="Meat">
								<div class="product-actions">
									<button class="quick-view"><i class="fas fa-eye"></i></button>
									<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
								</div>
							</div>
							<div class="product-info">
								<h3 class="product-title">Meat</h3>
								<div class="product-price">
									<span class="current-price">$10.99</span>
									<span class="original-price">$21.99</span>
								</div>
								<div class="product-rating">
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star"></i>
									<i class="fas fa-star-half-alt"></i>
									<span class="rating-count">(128)</span>
								</div>
								<button class="add-to-cart">Add to Cart</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Featured Section End -->

	<!--products banner section-->
	<section class="banner">
		<div class="banner__grid">
			<article class="banner__card">
				<div class="banner__card-container">
					<div class="banner__content-wrapper">
						<img src="assets/img/Image (5).png"
							alt="Fresh Cow Milk" class="banner__image">
						<div class="banner__content banner__content--light">
							<div class="banner__text-content">
								<h2 class="banner__title">
									100% Fresh <br>
									Cow Milk
								</h2>
								<p class="banner__price">
									<span class="banner__price-label">Starting at</span>
									<span class="banner__price-amount">$14.99</span>
								</p>
							</div>
							<button class="shop-button">
								Shop Now
							</button>
						</div>
					</div>
				</div>
			</article>

			<article class="banner__card">
				<div class="banner__card-container">
					<div class="banner__content-wrapper banner__content-wrapper--end">
						<img src="assets/img/Image (6).png"
							alt="Water & Soft Drink" class="banner__image">
						<div class="banner__content">
							<div class="banner__text-content">
								<p class="banner__label">Drink Sale</p>
								<h2 class="banner__title">
									Water &<br>
									Soft Drink
								</h2>
							</div>
							<button class="shop-button">
								Shop Now
							</button>
						</div>
					</div>
				</div>
			</article>

			<article class="banner__card">
				<div class="banner__card-container">
					<div class="banner__content-wrapper">
						<img src="assets/img/Image (7).png"
							alt="Quick Breakfast" class="banner__image">
						<div class="banner__content banner__content--narrow">
							<div class="banner__text-content">
								<p class="banner__label">100% Organic</p>
								<h2 class="banner__title">
									Quick Breakfast
								</h2>
							</div>
							<button class="shop-button">
								Shop Now
							</button>
						</div>
					</div>
				</div>
			</article>
		</div>
	</section>
	<!--products banner section end-->


	<!-- cart banner section -->
	<section class="cart-banner pt-100 pb-100">
		<div class="container">
			<div class="row clearfix">
				<!--Image Column-->
				<div class="image-column col-lg-6">
					<div class="image">
						<img src="assets/img/Image (1).png" alt="">
					</div>

				</div>
				<!--Content Column-->
				<div class="content-column col-lg-6">
					<h4><span class="green-text">Best Deals</span></h4>
					<h3> Our Special Products</h3>
					<h3>Deal of the Month</h3>
					<!--Countdown Timer-->
					<div class="time-counter">
						<div class="time-countdown clearfix" data-countdown="2020/2/01">
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Days</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Hours</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Mins</div>
							</div>
							<div class="counter-column">
								<div class="inner"><span class="count">00</span>Secs</div>
							</div>
						</div>
					</div>
					<button class="shop-button">
						Shop Now
					</button>
				</div>
			</div>
		</div>
	</section>
	<!-- end cart banner section -->



	<!-- product section-->

	<!--section class="related-products-section"-->
	<div class="container">
		<h2 class="section-title">Featured Products</h2>

		<div class="related-products-grid">
			<!--Product Card 1-->
			<div class="product-card">
				<div class="product-badge">Sale</div>
				<div class="product-image">
					<img src="assets/img/products/green apple.png" alt="Green Apple">
					<div class="product-actions">
						<button class="quick-view"><i class="fas fa-eye"></i></button>
						<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
					</div>
				</div>
				<div class="product-info">
					<h3 class="product-title">Green Apple</h3>
					<div class="product-price">
						<span class="current-price">$10.99</span>
						<span class="original-price">$21.99</span>
					</div>
					<div class="product-rating">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
						<span class="rating-count">(128)</span>
					</div>
					<button class="add-to-cart">Add to Cart</button>
				</div>
			</div>
			<!-- Product Card 2-->
			<div class="product-card">
				<div class="product-badge">Sale</div>
				<div class="product-image">
					<img src="assets/img/products/orange.png" alt="Orange">
					<div class="product-actions">
						<button class="quick-view"><i class="fas fa-eye"></i></button>
						<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
					</div>
				</div>
				<div class="product-info">
					<h3 class="product-title">Orange</h3>
					<div class="product-price">
						<span class="current-price">$10.99</span>
						<span class="original-price">$21.99</span>
					</div>
					<div class="product-rating">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
						<span class="rating-count">(128)</span>
					</div>
					<button class="add-to-cart">Add to Cart</button>
				</div>
			</div>
			<!-- Product Card 3 -->
			<div class="product-card">
				<div class="product-badge">Sale</div>
				<div class="product-image">
					<img src="assets/img/products/Eggplant.png" alt="Eggplant">
					<div class="product-actions">
						<button class="quick-view"><i class="fas fa-eye"></i></button>
						<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
					</div>
				</div>
				<div class="product-info">
					<h3 class="product-title">Eggplant</h3>
					<div class="product-price">
						<span class="current-price">$10.99</span>
						<span class="original-price">$21.99</span>
					</div>
					<div class="product-rating">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
						<span class="rating-count">(128)</span>
					</div>
					<button class="add-to-cart">Add to Cart</button>
				</div>
			</div>
			<!-- Product Card 4 -->
			<div class="product-card">
				<div class="product-badge">Sale</div>
				<div class="product-image">
					<img src="assets/img/products/Green Chilli.png" alt="Chilli">
					<div class="product-actions">
						<button class="quick-view"><i class="fas fa-eye"></i></button>
						<button class="add-to-wishlist"><i class="far fa-heart"></i></button>
					</div>
				</div>
				<div class="product-info">
					<h3 class="product-title">Chilli</h3>
					<div class="product-price">
						<span class="current-price">$10.99</span>
						<span class="original-price">$21.99</span>
					</div>
					<div class="product-rating">
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star"></i>
						<i class="fas fa-star-half-alt"></i>
						<span class="rating-count">(128)</span>
					</div>
					<button class="add-to-cart">Add to Cart</button>
				</div>
			</div>
		</div>
	</div>

	<!-- testimonail-section -->
	<div class="testimonail-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 text-center">
					<div class="testimonial-sliders">
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar1.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Saira Hakim <span>Local shop owner</span></h3>
								<p class="testimonial-body">
									" Sed ut perspiciatis unde omnis iste natus error veritatis et quasi
									architecto
									beatae vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde
									omnis
									iste natus error sit voluptatem accusantium "
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar2.png" alt="">
							</div>
							<div class="client-meta">
								<h3>David Niph <span>Local shop owner</span></h3>
								<p class="testimonial-body">
									" Sed ut perspiciatis unde omnis iste natus error veritatis et quasi
									architecto
									beatae vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde
									omnis
									iste natus error sit voluptatem accusantium "
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
						<div class="single-testimonial-slider">
							<div class="client-avater">
								<img src="assets/img/avaters/avatar3.png" alt="">
							</div>
							<div class="client-meta">
								<h3>Jacob Sikim <span>Local shop owner</span></h3>
								<p class="testimonial-body">
									" Sed ut perspiciatis unde omnis iste natus error veritatis et quasi
									architecto
									beatae vitae dict eaque ipsa quae ab illo inventore Sed ut perspiciatis unde
									omnis
									iste natus error sit voluptatem accusantium "
								</p>
								<div class="last-icon">
									<i class="fas fa-quote-right"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end testimonail-section -->

	<!-- video section -->

	<section class="video-section">
		<div class="video-container">
			<img src="assets/img/video.png" alt="Video thumbnail" class="video-thumbnail">
			<div class="video-overlay">
				<p class="video-label">VIDEO</p>
				<h2 class="video-title">We're the Best Organic Farm in the World</h2>
				<button class="play-button" aria-label="Play video"
					data-video-url="https://youtu.be/4tV5NMUd5-0?si=-4ifdRbEM3H7ry-g">
					<svg viewBox="0 0 24 24" fill="white" class="play-icon">
						<path class="play-path" d="M8 5v14l11-7z"></path>
						<path class="pause-path" d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"></path>
					</svg>
				</button>
			</div>
		</div>
	</section>

	<!-- end video section -->


	<!-- latest news -->

	<div class="latest-news pt-150 pb-150">
		<div class="container">

			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">
						<h3>Latest News</h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="single-news.html">
							<div class="latest-news-bg news-bg-1"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="single-news.html">You will vainly look for fruit on it in autumn.</a>
							</h3>
							<p class="blog-meta">
								<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
							</p>
							<p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus
								nisi.
								Praesent vitae mattis nunc, egestas viverra eros.</p>
							<a href="single-news.html" class="read-more-btn">read more <i
									class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6">
					<div class="single-latest-news">
						<a href="single-news.html">
							<div class="latest-news-bg news-bg-2"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="single-news.html">A man's worth has its season, like tomato.</a></h3>
							<p class="blog-meta">
								<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
							</p>
							<p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus
								nisi.
								Praesent vitae mattis nunc, egestas viverra eros.</p>
							<a href="single-news.html" class="read-more-btn">read more <i
									class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 offset-md-3 offset-lg-0">
					<div class="single-latest-news">
						<a href="single-news.html">
							<div class="latest-news-bg news-bg-3"></div>
						</a>
						<div class="news-text-box">
							<h3><a href="single-news.html">Good thoughts bear good fresh juicy fruit.</a></h3>
							<p class="blog-meta">
								<span class="date"><i class="fas fa-calendar"></i> 27 December, 2019</span>
							</p>
							<p class="excerpt">Vivamus lacus enim, pulvinar vel nulla sed, scelerisque rhoncus
								nisi.
								Praesent vitae mattis nunc, egestas viverra eros.</p>
							<a href="single-news.html" class="read-more-btn">read more <i
									class="fas fa-angle-right"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 text-center">
					<a href="news.html" class="boxed-btn">More News</a>
				</div>
			</div>
		</div>
	</div>

	<!-- end latest news -->


	 <!-- Main Navigation Bar -->
    <nav class="navbar pt-0" style="background-color:var(--footer-background);">
      <!-- Top section with logo and newsletter signup -->
      <div class="container-fluid" style="background-color:var(--card-border-color);">
        <div class="container-fluid">
          <a class="navbar-brand" href="#"></a>
        </div>
        <div class="container main-div">
          <div class="container row mb-4 mt-4 dsm"> 
             <!-- Logo section with leaf icon -->
             <div class="col-lg-4 col-sm-12">
              <a href="" class="text-decoration-none d-flex fa-3x mt-3" style="color:var(--black-text-color);font-family:poppins;font-weight: 500;">
                <i class="fas fa-leaf mt-2 me-1 " style="color: var(--green-text);"></i>Ecobazar</a>
             </div>
             <!-- Newsletter heading text -->
             <div class="col-4 d-none d-xl-block">
              <div class="d-flex flex-column">
                <div class="row "><p class="fs-4 fw-bold" style="margin-bottom:-px;color: var(--black-text-color);">Subscribe our Newsletter</p></div>
                <div class="row"><p class="d-flex" style="color: var(--header-text-not-hovered);">Pellentesque eu nibh eget mauris congue mattis matti.</p></div>
               </div>
             </div>
             <!-- Email input form -->
             <div class="col-lg-4 col-sm-12">
              <form class="d-flex h-50 mt-3 mt-sm-4" role="search">
                <input 
                  class="form-control rounded-5 ps-4" 
                  style="width: 100%; max-width: 400px; background-color: var(--white); height: 50px;" 
                  type="search" 
                  placeholder="Your email address" 
                  aria-label="Search">
                <button 
                  class="btn btn-outline-success rounded-5" 
                  style="width: 150px; flex-shrink: 0; position: relative; left: -30px; background-color: var(--sticker-color); color: var(--white); height: 50px; padding: 10px 0; line-height: 1.5;" 
                  type="submit">
                  Subscribe
                </button>
              </form>
             </div>
          </div>
        </div>
      </div>

      <!-- Main footer content section -->
      <div class="container-fluid" style="background-color:var(--footer-background);position: relative;">
        <!-- Decorative food icons at the top -->
        <div class="col ms-5">
          <i class="fas fa-apple-alt food-icon"></i>
          <i class="fas fa-coffee food-icon"></i>
          <i class="fas fa-carrot food-icon"></i>
          <i class="fas fa-utensils food-icon"></i>
          <i class="fas fa-pepper-hot food-icon"></i>
          <i class="fas fa-seedling food-icon"></i>
          <i class="fas fa-leaf food-icon"></i>
          <i class="fas fa-lemon food-icon"></i>
          <i class="fas fa-egg food-icon"></i>
          <i class="fas fa-apple-alt food-icon"></i>
          <i class="fas fa-carrot food-icon"></i>
          <i class="fas fa-coffee food-icon"></i>
          <i class="fas fa-pepper-hot food-icon"></i>
          <i class="fas fa-utensils food-icon"></i>
          <i class="fas fa-leaf food-icon"></i>
          <i class="fas fa-seedling food-icon"></i>
          <i class="fas fa-lemon food-icon"></i>
        </div>

        <!-- Footer content organized in columns -->
        <div class="row" style="margin-top: 100px;margin-bottom: 80px;">
          <div class="col-12 col-lg-10 offset-lg-1">
            <div class="row">
              <!-- About Shopery section -->
              <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">  
                <div class="row fs-4"><p style="color:var(--white);">About Shopery</p></div>
                <div class="row fs-6 mb-4"><p style="color:var(--text-hover-color);">
                  Morbi cursus porttitor enim lobortis molestie. Duis gravida turpis dui, eget bibendum <br class="d-none d-lg-block"> magna congue nec.</p></div>
                <div class="row d-inline"> 
                  <p style="color:var(--white);" >
              <span class="border-bottom pb-2" style="border-color:var(--light-green)!important ;">(219) 555-0114 </span>  
<span class="text-decoration-none m-3" style="color: var(--text-hover-color);">or</span>
<span class="border-bottom pb-2" style="border-color:var(--light-green)!important ;">Proxy@gmail.com</span>
                </div>
              </div>
              
              <!-- My Account links -->
              <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                <ul class="list-unstyled">
                  <li class="mb-4"><a class="fs-5 text-decoration-none" style="color:var(--white);" href="">My Account</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Order List</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Shopping Cart</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Wishlist</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Settings</a></li>
                </ul>
              </div>
              
              <!-- Help links -->
              <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                <ul class="list-unstyled">
                  <li class="mb-4"><a class="fs-5 text-decoration-none" style="color:var(--white);" href="">Helps</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Contact</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Faqs</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Terms & Conditions</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Privacy Policy</a></li>
                </ul>
              </div>
              
              <!-- Proxy links -->
              <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                <ul class="list-unstyled">
                  <li class="mb-4"><a class="fs-5 text-decoration-none" style="color:var(--white);" href="">Proxy</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">About</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Shop</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Product</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Products Details</a></li>
                  <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Track Orders</a></li>
                </ul>
              </div>
              
              <!-- Instagram gallery section -->
              <div class="col-6 col-md-3 col-lg-2">
                <ul class="list-unstyled">
                  <li class="mb-4"><a class="fs-5 text-decoration-none mt-3" style="color:var(--white);" href="">Instagram</a></li>
                  <div class="row">
                    <div class="col-3 p-1">
                      <img src="assets/insta-1.jpg" class="img-fluid" style="height: 70px; width: 70px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-3 p-1">
                      <img src="assets/insta-2.jpg" class="img-fluid" style="height: 70px; width: 70px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-3 p-1">
                      <img src="assets/insta-3.jpg" class="img-fluid" style="height: 70px; width: 70px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-3 p-1">
                      <img src="assets/insta-4.jpg" class="img-fluid" style="height: 70px; width: 70px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-3 p-1">
                      <img src="assets/insta-5.jpg" class="img-fluid" style="height: 70px; width: 70px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-3 p-1">
                      <img src="assets/insta-6.jpg" class="img-fluid" style="height: 70px; width: 70px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-3 p-1">
                      <img src="assets/insta-7.jpg" class="img-fluid" style="height: 70px; width: 70px; object-fit: cover;" alt="">
                    </div>
                    <div class="col-3 p-1">
                      <img src="assets/insta-8.jpg" class="img-fluid" style="height: 70px; width: 70px; object-fit: cover;" alt="">
                    </div>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </div>

        <!-- Decorative food icons at the bottom -->
        <div class="col ms-5">
          <i class="fas fa-apple-alt food-icon"></i>
          <i class="fas fa-coffee food-icon"></i>
          <i class="fas fa-carrot food-icon"></i>
          <i class="fas fa-utensils food-icon"></i>
          <i class="fas fa-pepper-hot food-icon"></i>
          <i class="fas fa-seedling food-icon"></i>
          <i class="fas fa-leaf food-icon"></i>
          <i class="fas fa-lemon food-icon"></i>
          <i class="fas fa-egg food-icon"></i>
          <i class="fas fa-apple-alt food-icon"></i>
          <i class="fas fa-carrot food-icon"></i>
          <i class="fas fa-coffee food-icon"></i>
          <i class="fas fa-pepper-hot food-icon"></i>
          <i class="fas fa-utensils food-icon"></i>
          <i class="fas fa-leaf food-icon"></i>
          <i class="fas fa-seedling food-icon"></i>
          <i class="fas fa-lemon food-icon"></i>
        </div>
        </div>

        <!-- Footer bottom section with social media and payment methods -->
        <div class="row pt-4 mb-4 justify-content-center" style="width: 100%;">
          <div class="col-12 col-lg-10 offset-lg-1 border-top pt-4" style="border-color: var(--text-hover-color) !important;">
            <div class="row flex-column flex-lg-row justify-content-center align-items-center">
              <!-- Social media icons -->
              <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                <div class="d-flex align-items-center">
                  <a href=""><i class="bi bi-facebook fs-2 me-4" style="color: var(--green-text);"></i></a>
                  <a href=""><i class="bi bi-twitter fs-6 me-4" style="color: var(--text-hover-color);"></i></a>
                  <a href=""><i class="bi bi-pinterest fs-6 me-4" style="color: var(--text-hover-color);"></i></a>
                  <a href=""><i class="bi bi-instagram fs-6 me-5" style="color: var(--text-hover-color);"></i></a>
                </div>
              </div>
              <!-- Copyright text -->
              <div class="col-12 col-lg-4 d-flex justify-content-center mb-3 mb-lg-0">
                <p class="text-center" style="color: var(--text-hover-color);">Shopery eCommerce © 2025. All Rights Reserved</p>
              </div>
              <!-- Payment method icons -->
              <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                <div class="d-flex flex-wrap justify-content-center">
                  <img src="assets/ApplePay.png" class="me-2 mb-2" style="height: 31px; width: 45px; object-fit: contain;" alt="">
                  <img src="assets/visa.png" class="me-2 mb-2" style="height: 31px; width: 45px; object-fit: contain;" alt="">
                  <img src="assets/discover.png" class="me-2 mb-2" style="height: 31px; width: 45px; object-fit: contain;" alt="">
                  <img src="assets/two circles.jpg" class="me-2 mb-2" style="height: 31px; width: 45px; object-fit: contain;" alt="">
                  <i class="bi bi-lock d-flex align-items-center ms-2" style="color: var(--white); font-size: 12px;">secure <br> <span style="color: var(--white); font-weight: bold;">payment</span></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
</body>


	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/mixitup@3.3.1/dist/mixitup.min.js"></script>

 <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Custom JavaScript for search toggle -->
    <script>
        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Get search elements
            const searchIcon = document.getElementById('searchIcon');
            const searchBox = document.getElementById('searchBox');

            // Toggle search box visibility on icon click
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
<!-- Bootstrap JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="../../Logics/header.js"></script>
</body>




</html>
