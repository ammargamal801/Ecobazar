<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Style/signup.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row align-items-center vh-100">
      <!-- Left Side - Image Section -->
      <div class="col-md-6 text-center d-flex justify-content-center align-items-center">
        <img src="../../Assets/doaa.jpg">
      </div>

      <!-- Right Side - Form Section -->
      <div class="col-md-6">
        <div class="form-container mx-auto">
          <h1 class="text-success fw-bold">Ecobazar</h1>
          <h2 class="mt-4">Sign up</h2>
          <p>Let's get you all set up so you can access your personal account.</p>
          <form action="../../../Backend/Authentication/signup_handle.php" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <input type="text" name="f_name" class="form-control" placeholder="First Name">
                <small class="text-danger"><?php echo $_SESSION['errors']['f_name'] ?? ''; ?></small>
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" name="l_name" class="form-control" placeholder="Last Name">
                <small class="text-danger"><?php echo $_SESSION['errors']['l_name'] ?? ''; ?></small>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <input type="text" name="email" class="form-control" placeholder="Email">
                <small class="text-danger"><?php echo $_SESSION['errors']['email'] ?? ''; ?></small>
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                <small class="text-danger"><?php echo $_SESSION['errors']['phone'] ?? ''; ?></small>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3 position-relative">
                <input type="password" name="password" class="form-control" placeholder="Password" id="password">
                <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                <small class="text-danger"><?php echo $_SESSION['errors']['password'] ?? ''; ?></small>
              </div>
              <div class="col-md-6 mb-3 position-relative">
                <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" id="confirmPassword">
                <span class="toggle-password" onclick="togglePassword('confirmPassword')">👁️</span>
                <small class="text-danger"><?php echo $_SESSION['errors']['confirmPassword'] ?? ''; ?></small>
              </div>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="terms"  >
              <label for="terms" class="form-check-label">I agree to all the <a href="#" class="text-success">Terms and Privacy Policies</a></label>
            </div>
            <button type="submit" class="btn btn-success w-100">Create account</button>
          </form>

          <div class="text-center mt-3">
            <p>Already have an account? <a href="../Login Page/login.php" class="text-success">Login</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../Logics/script.js"></script>
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

<?php
$_SESSION['errors'] = null;
?>