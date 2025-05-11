<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eco_bazar"; 
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$totalPrice = $_POST['totalHidden'] ?? 0;
$streetAddress = $_POST['streetAddress'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';
$paymentMethod = $_POST['payment'] ?? '';


$sql = "INSERT INTO orders (user_id, total_price, shipping_address, billing_address, phone, email, payment_method) 
        VALUES (1, '$totalPrice', '$streetAddress', '$streetAddress', '$phone', '$email', '$paymentMethod')";
$conn->query($sql);
$orderId = $conn->insert_id;


$cartItems = $_POST['cartItems'] ?? '[]';  
$cartItems = json_decode($cartItems, true);

foreach ($cartItems as $item) {
    $productName = trim($item['productTitle']); 
    $quantity = $item['quantity'];
    $price = floatval(str_replace('$', '', $item['productPrice'])); 

    $sql = "SELECT id FROM products WHERE name = '$productName' LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $productId = $row['id']; 

        $sqlInsert = "INSERT INTO order_items (order_id, product_id, quantity, price)
                    VALUES ('$orderId', '$productId', '$quantity', '$price')";
        $conn->query($sqlInsert);
        if ($conn->query($sqlInsert) === TRUE) {
            echo "<script>
                localStorage.setItem('orderCompleted', 'true');
                window.location.href = '../category.php';
                </script>";
            exit;
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Style/checkout.css" type="text/css">
    <link rel="stylesheet" href="../Logic/checkOut.java">
    <title>Checkout Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Add this script section to your CheckOut.html before the closing     <nav class="navbar pt-0" style="background-color:var(--footer-background);">
        <!-- Top bar with contrasting background color -->
        <div class="container-fluid" style="background-color:var(--card-border-color);">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>
            </div>
            <!-- Newsletter subscription section with logo and form -->
            <div class="container main-div">
                <div class="container row mb-4 mt-4 dsm">
                    <!-- Brand logo with leaf icon -->
                    <div class="col-lg-4 col-sm-12">
                        <a href="" class="text-decoration-none d-flex fa-3x mt-3"
                            style="color:var(--black-text-color);font-family:poppins;font-weight: 500;">
                            <i class="fas fa-leaf mt-2 me-1 " style="color: var(--green-text);"></i>Ecobazar</a>
                    </div>
                    <!-- Newsletter description text (hidden on smaller screens) -->
                    <div class="col-4 d-none d-xl-block">
                        <div class="d-flex flex-column">
                            <div class="row ">
                                <p class="fs-4 fw-bold" style="margin-bottom:-px;color: var(--black-text-color);">Subscribe our
                                    Newsletter</p>
                            </div>
                            <div class="row">
                                <p class="d-flex" style="color: var(--header-text-not-hovered);">Pellentesque eu nibh eget mauris congue
                                    mattis matti.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Email input field with subscribe button -->
                    <div class="col-lg-4 col-sm-12">
                        <form class="d-flex h-50 mt-3 mt-sm-4" role="search">
                            <input class="form-control rounded-5 ps-4"
                                style="width: 100%; max-width: 400px; background-color: var(--white); height: 50px;" type="search"
                                placeholder="Your email address" aria-label="Search">
                            <button class="btn btn-outline-success rounded-5"
                                style="width: 150px; flex-shrink: 0; position: relative; left: -30px; background-color: var(--sticker-color); color: var(--white); height: 50px; padding: 10px 0; line-height: 1.5;"
                                type="submit">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main footer content area -->
        <div class="container-fluid" style="background-color:var(--footer-background);position: relative;">
            <!-- Decorative food icons at the top of footer -->
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

            <!-- Footer content columns -->
            <div class="row" style="margin-top: 100px;margin-bottom: 80px;">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="row">
                        <!-- About Us section with contact information -->
                        <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                            <div class="row fs-4">
                                <p style="color:var(--white);">About Shopery</p>
                            </div>
                            <div class="row fs-6 mb-4">
                                <p style="color:var(--text-hover-color);">
                                    Morbi cursus porttitor enim lobortis molestie. Duis gravida turpis dui, eget bibendum <br
                                        class="d-none d-lg-block"> magna congue nec.</p>
                            </div>
                            <div class="row d-inline">
                                <p style="color:var(--white);">
                                    <span class="border-bottom pb-2" style="border-color:var(--light-green)!important ;">(219) 555-0114
                                    </span>
                                    <span class="text-decoration-none m-3" style="color: var(--text-hover-color);">or</span>
                                    <span class="border-bottom pb-2"
                                        style="border-color:var(--light-green)!important ;">Proxy@gmail.com</span>
                            </div>
                        </div>

                        <!-- My Account links section -->
                        <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                            <ul class="list-unstyled">
                                <li class="mb-4"><a class="fs-5 text-decoration-none" style="color:var(--white);" href="">My Account</a>
                                </li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Order
                                        List</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Shopping
                                        Cart</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">Wishlist</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">Settings</a></li>
                            </ul>
                        </div>

                        <!-- Help and support links section -->
                        <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                            <ul class="list-unstyled">
                                <li class="mb-4"><a class="fs-5 text-decoration-none" style="color:var(--white);" href="">Helps</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">Contact</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Faqs</a>
                                </li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Terms &
                                        Conditions</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Privacy
                                        Policy</a></li>
                            </ul>
                        </div>

                        <!-- Proxy company links section -->
                        <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                            <ul class="list-unstyled">
                                <li class="mb-4"><a class="fs-5 text-decoration-none" style="color:var(--white);" href="">Proxy</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">About</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Shop</a>
                                </li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">Product</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Products
                                        Details</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Track
                                        Orders</a></li>
                            </ul>
                        </div>

                        <!-- Instagram gallery section with image grid -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <ul class="list-unstyled">
                                <li class="mb-4"><a class="fs-5 text-decoration-none mt-3" style="color:var(--white);"
                                        href="">Instagram</a></li>
                                <div class="row">
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-1.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-2.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-3.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-4.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-5.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-6.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-7.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-8.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative food icons at the bottom of footer -->
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

        <!-- Footer bottom bar with social media, copyright and payment methods -->
        <div class="row pt-4 mb-4 justify-content-center" style="width: 100%;">
            <div class="col-12 col-lg-10 offset-lg-1 border-top pt-4"
                style="border-color: var(--text-hover-color) !important;">
                <div class="row flex-column flex-lg-row justify-content-center align-items-center">
                    <!-- Social media icons with different colors -->
                    <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                        <div class="d-flex align-items-center">
                            <a href=""><i class="bi bi-facebook fs-2 me-4" style="color: var(--green-text);"></i></a>
                            <a href=""><i class="bi bi-twitter fs-6 me-4" style="color: var(--text-hover-color);"></i></a>
                            <a href=""><i class="bi bi-pinterest fs-6 me-4" style="color: var(--text-hover-color);"></i></a>
                            <a href=""><i class="bi bi-instagram fs-6 me-5" style="color: var(--text-hover-color);"></i></a>
                        </div>
                    </div>
                    <!-- Copyright notice centered in the middle -->
                    <div class="col-12 col-lg-4 d-flex justify-content-center mb-3 mb-lg-0">
                        <p class="text-center" style="color: var(--text-hover-color);">Shopery eCommerce © 2025. All Rights Reserved
                        </p>
                    </div>
                    <!-- Payment method logos and secure payment indicator -->
                    <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                        <div class="d-flex flex-wrap justify-content-center">
                            <img src="../../Assets/ApplePay.png" class="me-2 mb-2"
                                style="height: 31px; width: 45px; object-fit: contain;" alt="">
                            <img src="../../Assets/visa.png" class="me-2 mb-2" style="height: 31px; width: 45px; object-fit: contain;"
                                alt="">
                            <img src="../../Assets/discover.png" class="me-2 mb-2"
                                style="height: 31px; width: 45px; object-fit: contain;" alt="">
                            <img src="../../Assets/two circles.jpg" class="me-2 mb-2"
                                style="height: 31px; width: 45px; object-fit: contain;" alt="">
                            <i class="bi bi-lock d-flex align-items-center ms-2" style="color: var(--white); font-size: 12px;">secure
                                <br> <span style="color: var(--white); font-weight: bold;">payment</span></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>
    <script src="../../Logics/header.js"></script>
</body> tag -->

<!-- Bootstrap CSS for styling components -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icons for vector icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Font Awesome for additional icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Custom stylesheet -->
    <link rel="stylesheet" href="../Style/main.css">
</head>

<body>
    <!-- Main navigation bar fixed at the top -->
    <nav class="navbar border fixed-top d-flex py-3" style="background-color: var(--white);">
        <div class="container-fluid d-flex justify-content-center">
            <div class="container d-flex align-items-center position-relative">
                <!-- Mobile menu toggle button (hidden on larger screens) -->
                <div class="col-1 me-3 mt-1 d-flex">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2"
                        aria-label="Toggle navigation2">
                        <span class="navbar-toggler-icon d-block d-xxl-none"></span>
                    </button>
                </div>

                <!-- Primary navigation links (hidden on mobile) -->
                <div class="col-3 d-flex d-xxl-flex d-none align-items-center ms-n6" style="margin-left: -100px;">
                    <a class="text-decoration-none me-3 d-flex align-items-center"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Home <i
                            class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Shop<i
                            class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Contact<i
                            class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Blog <i
                            class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none d-flex align-items-center text-nowrap"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">About Us</a>
                </div>

                <!-- Brand logo centered in the navigation -->
                <div class="col-3 d-flex justify-content-center fs-2"
                    style="font-family: Poppins, sans-serif; font-weight: 400; color: var(--black-text-color); position: absolute; left: 50%; transform: translateX(-50%);">
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
                        <a href="#" class="btn btn-sm"
                            style="background-color: var(--green-text); color: white; padding: 0.25rem 0.75rem;">
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
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search"
                                id="searchBox">
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
            <div class="offcanvas offcanvas-start border-0" tabindex="-1" id="offcanvasNavbar2"
                aria-labelledby="offcanvasNavbar2Label">
                <div class="offcanvas-header mt-4">
                    <h5 class="offcanvas-title" id="offcanvasNavbar2Label">
                        <a href="" class="ms-1 border border-black rounded-5 p-3"
                            style="color:var(--black-text-color);">
                            <i class="bi bi-person fa-lg fa-5x"></i>
                        </a>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="text-decoration-none d-flex align-items-center"
                                style="color:var(--black-text-color);" href="">Home <i
                                    class="bi bi-chevron-down ms-1 mt-1"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1"
                                style="color:var(--black-text-color);" href="">Shop<i
                                    class="bi bi-chevron-down ms-1 mt-1"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1"
                                style="color:var(--black-text-color);" href="">Pages<i
                                    class="bi bi-chevron-down ms-1 mt-1"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1"
                                style="color:var(--black-text-color);" href="">Blog <i
                                    class="bi bi-chevron-down ms-1 mt-1"></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1"
                                style="color:var(--black-text-color);" href="">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="text-decoration-none mt-3 d-flex align-items-center border-top p-1"
                                style="color:var(--black-text-color);" href="">Wish list</a>
                        </li>
                    </ul>
                    <!-- Brand logo at bottom of mobile menu -->
                    <div class="fw-bold" style="margin-top:250px;color: var(--black-text-color);">
                        <i class="fas fa-leaf fa-2x" style="color: var(--green-text);"></i>
                    </div>
                </div>
            </div>

            <!-- Shopping cart offcanvas panel -->
            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="offcanvasCart"
                aria-labelledby="offcanvasCartLabel">
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
                                        <p style="font-weight:400;font-family: poppins;color:var(--black-text-color);">
                                            Fresh Indian Orange</p>
                                    </div>
                                    <div class="row" style="margin-top:-18px;margin-left: -240px;">
                                        <p style="color:var(--black-text-color);">1 kg x <span
                                                class="fw-bold">12.00</span></p>
                                    </div>
                                </div>
                                <div class="col position-absolute" style="margin-left: 320px; margin-top:20px;">
                                    <div class="btn-group" role="group" aria-label="Third group">
                                        <button type="button" class="x-button border-0"
                                            style="background-color:var(--white);color:var(--black-text-color);">x</button>
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
                                            <p
                                                style="font-weight:400;font-family: poppins;color:var(--black-text-color);">
                                                Green Apple</p>
                                        </div>
                                        <div class="row" style="margin-top:-18px;margin-left: -185px;">
                                            <p style="color:var(--black-text-color);">1 kg x <span
                                                    class="fw-bold">14.00</span></p>
                                        </div>
                                    </div>
                                    <div class="col position-absolute" style="margin-left: 320px; margin-top:40px;">
                                        <div class="btn-group" role="group" aria-label="Third group">
                                            <button type="button" class="x-button border-0"
                                                style="background-color:var(--white);color:var(--black-text-color);">x</button>
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
                                    <button type="button" class="btn border rounded-5"
                                        style="color: var(--black-text-color); background-color: var(--card-border-color);">Go
                                        To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section class="billing-section">
                    <form action="CheckOut.php" method="POST">
                        <h3 class="title">Billing Information</h3>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="name" name="name" required placeholder="First Name">
                            </div>
                            <div class="col-md-4">
                                <label for="lastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastName" name="lastName" required placeholder="Last Name">
                            </div>
                            <div class="col-md-4">
                                <label for="companyName" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="companyName" name="companyName" placeholder="Company Name">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="streetAddress" class="form-label">Street Address</label>
                                <input type="text" class="form-control" id="streetAddress" name="streetAddress" required placeholder="Street Address">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="country" class="form-label">Country/Region</label>
                                <select id="country" class="form-select" name="country">
                                    <option value="EGYPT">Egypt</option>
                                    <option value="Palastine">Palestine</option>
                                    <option value="Morocoo">Morocco</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State</label>
                                <select id="state" class="form-select" name="state">
                                    <option value="CAIRO">Cairo</option>
                                    <option value="Palastine">Palestine</option>
                                    <option value="Morocoo">Morocco</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="zipCode" name="zipCode" required placeholder="Zip Code">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required placeholder="Email Address">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone" name="phone" required placeholder="Phone Number">
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="differentAddress">
                                    <label class="form-check-label" for="differentAddress">
                                        Ship to a different address
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <input class="totalHidden" type="hidden"  name="totalHidden" >
                            <input type="hidden" name="cartItems" id="cartItems">
                        </div>

                        <h3>Payment Method</h3>
                        <div class="payment-methods">
                            <div class="payment-option">
                                <input class="form-check-input" type="radio" id="cod" name="payment" value="cod" checked>
                                <label class="form-check-label" for="cod">Cash on Delivery</label>
                            </div>
                            <div class="payment-option">
                                <input class="form-check-input" type="radio" id="paypal" name="payment" value="paypal">
                                <label class="form-check-label" for="paypal">Paypal</label>
                            </div>
                            <div class="payment-option">
                                <input class="form-check-input" type="radio" id="amazon" name="payment" value="amazon">
                                <label class="form-check-label" for="amazon">Amazon Pay</label>
                            </div>
                        </div>

                        <hr>
                        
                        <h3 class="title">Additional Info</h3>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="orderNotes" class="form-label">Order Notes (Optional)</label>
                                <textarea class="form-control" id="orderNotes" name="orderNotes" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                            </div>
                        </div>
                        <button class="submit-btn">Place Order</button>
                    </form>
                </section>
            </div>
            
            <div class="col-lg-4">
                <section class="summary-section">
                    <h3>Order Summary</h3>
                    
                    <div class="order-items">

                    </div>
                    
                    <div class="price-summary">
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span>$00.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span>Free</span>
                        </div>
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span>$00.00</span>
                        </div>
                    </div>
                    
                </section>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../Logics/checkout.js"></script>
    <nav class="navbar pt-0" style="background-color:var(--footer-background);">
        <!-- Top bar with contrasting background color -->
        <div class="container-fluid" style="background-color:var(--card-border-color);">
            <div class="container-fluid">
                <a class="navbar-brand" href="#"></a>
            </div>
            <!-- Newsletter subscription section with logo and form -->
            <div class="container main-div">
                <div class="container row mb-4 mt-4 dsm">
                    <!-- Brand logo with leaf icon -->
                    <div class="col-lg-4 col-sm-12">
                        <a href="" class="text-decoration-none d-flex fa-3x mt-3"
                            style="color:var(--black-text-color);font-family:poppins;font-weight: 500;">
                            <i class="fas fa-leaf mt-2 me-1 " style="color: var(--green-text);"></i>Ecobazar</a>
                    </div>
                    <!-- Newsletter description text (hidden on smaller screens) -->
                    <div class="col-4 d-none d-xl-block">
                        <div class="d-flex flex-column">
                            <div class="row ">
                                <p class="fs-4 fw-bold" style="margin-bottom:-px;color: var(--black-text-color);">Subscribe our
                                    Newsletter</p>
                            </div>
                            <div class="row">
                                <p class="d-flex" style="color: var(--header-text-not-hovered);">Pellentesque eu nibh eget mauris congue
                                    mattis matti.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Email input field with subscribe button -->
                    <div class="col-lg-4 col-sm-12">
                        <form class="d-flex h-50 mt-3 mt-sm-4" role="search">
                            <input class="form-control rounded-5 ps-4"
                                style="width: 100%; max-width: 400px; background-color: var(--white); height: 50px;" type="search"
                                placeholder="Your email address" aria-label="Search">
                            <button class="btn btn-outline-success rounded-5"
                                style="width: 150px; flex-shrink: 0; position: relative; left: -30px; background-color: var(--sticker-color); color: var(--white); height: 50px; padding: 10px 0; line-height: 1.5;"
                                type="submit">
                                Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main footer content area -->
        <div class="container-fluid" style="background-color:var(--footer-background);position: relative;">
            <!-- Decorative food icons at the top of footer -->
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

            <!-- Footer content columns -->
            <div class="row" style="margin-top: 100px;margin-bottom: 80px;">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div class="row">
                        <!-- About Us section with contact information -->
                        <div class="col-12 col-md-6 col-lg-4 mb-5 mb-lg-0">
                            <div class="row fs-4">
                                <p style="color:var(--white);">About Shopery</p>
                            </div>
                            <div class="row fs-6 mb-4">
                                <p style="color:var(--text-hover-color);">
                                    Morbi cursus porttitor enim lobortis molestie. Duis gravida turpis dui, eget bibendum <br
                                        class="d-none d-lg-block"> magna congue nec.</p>
                            </div>
                            <div class="row d-inline">
                                <p style="color:var(--white);">
                                    <span class="border-bottom pb-2" style="border-color:var(--light-green)!important ;">(219) 555-0114
                                    </span>
                                    <span class="text-decoration-none m-3" style="color: var(--text-hover-color);">or</span>
                                    <span class="border-bottom pb-2"
                                        style="border-color:var(--light-green)!important ;">Proxy@gmail.com</span>
                            </div>
                        </div>

                        <!-- My Account links section -->
                        <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                            <ul class="list-unstyled">
                                <li class="mb-4"><a class="fs-5 text-decoration-none" style="color:var(--white);" href="">My Account</a>
                                </li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Order
                                        List</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Shopping
                                        Cart</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">Wishlist</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">Settings</a></li>
                            </ul>
                        </div>

                        <!-- Help and support links section -->
                        <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                            <ul class="list-unstyled">
                                <li class="mb-4"><a class="fs-5 text-decoration-none" style="color:var(--white);" href="">Helps</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">Contact</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Faqs</a>
                                </li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Terms &
                                        Conditions</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Privacy
                                        Policy</a></li>
                            </ul>
                        </div>

                        <!-- Proxy company links section -->
                        <div class="col-6 col-md-3 col-lg-2 mb-4 mb-lg-0">
                            <ul class="list-unstyled">
                                <li class="mb-4"><a class="fs-5 text-decoration-none" style="color:var(--white);" href="">Proxy</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">About</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Shop</a>
                                </li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);"
                                        href="">Product</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Products
                                        Details</a></li>
                                <li class="mb-3"><a class="text-decoration-none" style="color:var(--text-hover-color);" href="">Track
                                        Orders</a></li>
                            </ul>
                        </div>

                        <!-- Instagram gallery section with image grid -->
                        <div class="col-6 col-md-3 col-lg-2">
                            <ul class="list-unstyled">
                                <li class="mb-4"><a class="fs-5 text-decoration-none mt-3" style="color:var(--white);"
                                        href="">Instagram</a></li>
                                <div class="row">
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-1.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-2.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-3.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-4.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-5.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-6.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-7.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                    <div class="col-3 p-1">
                                        <img src="../../Assets/insta-8.jpg" class="img-fluid"
                                            style="height: 70px; width: 70px; object-fit: cover;" alt="">
                                    </div>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decorative food icons at the bottom of footer -->
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

        <!-- Footer bottom bar with social media, copyright and payment methods -->
        <div class="row pt-4 mb-4 justify-content-center" style="width: 100%;">
            <div class="col-12 col-lg-10 offset-lg-1 border-top pt-4"
                style="border-color: var(--text-hover-color) !important;">
                <div class="row flex-column flex-lg-row justify-content-center align-items-center">
                    <!-- Social media icons with different colors -->
                    <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-start mb-3 mb-lg-0">
                        <div class="d-flex align-items-center">
                            <a href=""><i class="bi bi-facebook fs-2 me-4" style="color: var(--green-text);"></i></a>
                            <a href=""><i class="bi bi-twitter fs-6 me-4" style="color: var(--text-hover-color);"></i></a>
                            <a href=""><i class="bi bi-pinterest fs-6 me-4" style="color: var(--text-hover-color);"></i></a>
                            <a href=""><i class="bi bi-instagram fs-6 me-5" style="color: var(--text-hover-color);"></i></a>
                        </div>
                    </div>
                    <!-- Copyright notice centered in the middle -->
                    <div class="col-12 col-lg-4 d-flex justify-content-center mb-3 mb-lg-0">
                        <p class="text-center" style="color: var(--text-hover-color);">Shopery eCommerce © 2025. All Rights Reserved
                        </p>
                    </div>
                    <!-- Payment method logos and secure payment indicator -->
                    <div class="col-12 col-lg-4 d-flex justify-content-center justify-content-lg-end">
                        <div class="d-flex flex-wrap justify-content-center">
                            <img src="../../Assets/ApplePay.png" class="me-2 mb-2"
                                style="height: 31px; width: 45px; object-fit: contain;" alt="">
                            <img src="../../Assets/visa.png" class="me-2 mb-2" style="height: 31px; width: 45px; object-fit: contain;"
                                alt="">
                            <img src="../../Assets/discover.png" class="me-2 mb-2"
                                style="height: 31px; width: 45px; object-fit: contain;" alt="">
                            <img src="../../Assets/two circles.jpg" class="me-2 mb-2"
                                style="height: 31px; width: 45px; object-fit: contain;" alt="">
                            <i class="bi bi-lock d-flex align-items-center ms-2" style="color: var(--white); font-size: 12px;">secure
                                <br> <span style="color: var(--white); font-weight: bold;">payment</span></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>
    <script src="../../Logics/header.js"></script>
</body>
</html>