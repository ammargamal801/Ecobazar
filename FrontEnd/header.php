<title>Document</title>
<link rel="stylesheet" href="../Style/main.css">
<div class="he">
    <!-- Main navigation bar fixed at top -->
    <nav class="navbar border fixed-top d-flex py-3" style="background-color: var(--white);">
        <div class="container-fluid d-flex justify-content-center">
            <div class="container d-flex align-items-center position-relative">
                <!-- Mobile menu toggle button (visible on small screens) -->
                <div class="col-1 me-3 mt-1 d-flex">
                    <button class="navbar-toggler border-0" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasNavbar2" aria-controls="offcanvasNavbar2"
                        aria-label="Toggle navigation2">
                        <span class="navbar-toggler-icon d-block d-xxl-none"></span>
                    </button>
                </div>
                <!-- Main navigation links (hidden on mobile) -->
                <div class="col-3 d-flex d-xxl-flex d-none align-items-center ms-n6" style="margin-left: -100px;">
                    <a class="text-decoration-none me-3 d-flex align-items-center"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Home <i
                            class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Shop<i
                            class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Pages<i
                            class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none me-3 d-flex align-items-center"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">Blog <i
                            class="bi bi-chevron-down ms-1 mt-1"></i></a>
                    <a class="text-decoration-none d-flex align-items-center text-nowrap"
                        style="font-size: 13px;font-weight:550;color:var(--black-text-color);" href="">About Us</a>
                </div>
                <!-- Center logo -->
                <div class="col-3 d-flex justify-content-center fs-2"
                    style="font-family: Poppins, sans-serif; font-weight: 400; color: var(--black-text-color); position: absolute; left: 50%; transform: translateX(-50%);">
                    <a href="" class="text-decoration-none d-flex" style="color: var(--black-text-color);">
                        <i class="fas fa-leaf me-1 mt-2" style="color: var(--green-text);"></i>
                        Ecobazar
                    </a>
                </div>
                <!-- Right side icons and search -->
                <div class="col-3 justify-content-end align-self-center d-flex ms-auto">
                    <!-- Search icon with click handler -->
                    <i class="bi bi-search fa-lg me-3" id="searchIcon" style="cursor: pointer;"></i>
                    <!-- Wishlist icon -->
                    <a href="" class="align-self-center d-lg-flex d-none" style="color:var(--black-text-color);"><i
                            class="bi bi-heart fa-lg me-3"></i></a>
                    <!-- Cart icon with offcanvas trigger -->
                    <a href="#" style="color: var(--black-text-color);" class="me-3" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasCart" aria-controls="offcanvasCart"><i
                            class="bi bi-handbag fa-lg"></i></a>
                    <!-- Account icon -->
                    <a href="" class="d-lg-flex d-none" style="color:var(--black-text-color);"><i
                            class="bi bi-person fa-lg"></i></a>
                    <!-- Search input field -->
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            id="searchBox">
                    </form>
                </div>
            </div>
            <!-- Secondary mobile menu toggle (hidden) -->
            <button class="navbar-toggler border-0 ms-2 d-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavMenu" aria-controls="offcanvasNavMenu" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Mobile menu offcanvas -->
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
                <!-- Mobile menu items -->
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
                    <!-- Footer decoration in mobile menu -->
                    <div class="fw-bold" style="margin-top:250px;color: var(--black-text-color);">
                        <i class="fas fa-leaf fa-2x" style="color: var(--green-text);"></i>
                    </div>
                </div>
            </div>
            <!-- Shopping cart offcanvas -->
            <div class="offcanvas offcanvas-end border-0" tabindex="-1" id="offcanvasCart"
                aria-labelledby="offcanvasCartLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasCartLabel">Shopping Cart (2)</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <!-- Cart contents -->
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

    <!-- Banner image below header -->
    <div class="container-fluid" style="margin-top: 120px; height: 100px;">
        <div class="row">
            <img src="../Assets/pic under header.jpg" alt="" class="img-fluid"
                style="height: 100px; object-fit: cover;">
        </div>
    </div>

</div>

<!-- Bootstrap JS bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

<!-- Custom JavaScript for search toggle -->
<script>
    // Initialize when DOM is loaded
    document.addEventListener('DOMContentLoaded', function () {
        // Get search elements
        const searchIcon = document.getElementById('searchIcon');
        const searchBox = document.getElementById('searchBox');

        // Toggle search box visibility on icon click
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