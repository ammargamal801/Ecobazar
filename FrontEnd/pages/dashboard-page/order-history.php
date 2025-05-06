<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "market";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UFT-8" />
        <link rel="icon" href="dashbroad-image/header-logo.svg" />
        <link rel="stylesheet" href="order-history.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <title>Order History</title>
    </head>
    <body>
        <header>
            <div class="flex__row start__header__container">
                <div class="flex__row box-width start__header__box">
                    <div class="flex__row header__box__location">
                        <img src="dashbroad-image/location-icon.svg" alt="location icon" />
                        <p>Store Location: Lincoln- 344, Illinois, Chicago, USA</p> 
                    </div>
                    <div class="flex__row">
                        <div>
                            <span>Eng</span>
                            <img src="dashbroad-image/bottom-arrow.svg" alt="or icon" />
                        </div>
                        <div>
                            <span>USD</span>
                            <img src="dashbroad-image/bottom-arrow.svg" alt="or icon" />
                        </div>
                        <span>|</span>
                        <p>Sign In / Sign Up</p>
                    </div>
                </div>
            </div>

            <div class="flex__row middle__header__container">
                <div class="flex__row box-width">
                    <img src="dashbroad-image/header-logo.svg" alt="ecobazar logo" />
                    <form class="flex__row middle__box__form">
                        <label>
                            <img src="dashbroad-image/search-icon.svg" alt="search icon" />
                        </label>
                        <input type="text" placeholder="Search" class="header__input__text"/>
                        <input type="submit" value="Search" />
                    </form>
                    <div class="flex__row">
                        <img src="dashbroad-image/header-logo.svg" alt="heart icon" />
                        <span>|</span>
                        <div class="flex__row bag__with__two">
                            <img src="dashbroad-image/bag-with-2.svg" alt="bag with 2" />
                            <div class="flex__colamn">
                                <span>Shopping cart:</span>
                                <p>$57.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nav__container flex__row">
                <div class="box-width flex__row">
                    <ul class="nav__bar flex__row">
                        <li><a href="#">Home &or;</a></li>
                        <li><a href="#">Shop &or;</a></li>
                        <li><a href="#">Pages &or;</a></li>
                        <li><a href="#">Blog &or;</a></li>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
    
                    <div class="nav__tel flex__row">
                        <img src="dashbroad-image/tel-icon.svg" alt="tel icon" />
                        <span>(219) 555-0114</span>
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section>
                <div class="baner__container flex__row">
                    <div class="flex__row box-width">
                        <img src="dashbroad-image/home-icon.svg" alt="home icon" />
                        <img src="dashbroad-image/right-arrow.svg" alt="right arrow" />
                        <h6><a href="#">Account</a></h6>
                        <img src="dashbroad-image/right-arrow.svg" alt="right arrow" />
                        <h6><a href="#" class="baner__a">Order History</a></h6>
                    </div>
                </div>
            </section>


            <article>
                <div class="flex__row acount-info__container">
                    <div class="flex__row box-width acount-info__box">
                        <aside>
                            <div class="flex__colamn acount-info__aside box-border">
                                <h5>Navigation</h5>
                                <button class="flex__row">
                                    <a href="dashbroad.html" class="flex__row acount-info__aside--button">
                                        <img src="dashbroad-image/dashbroad-icon.svg" alt="dashbroad icon" />
                                        <p>Dashboard</p>
                                    </a>
                                </button>
                                <button class="flex__row">
                                    <a href="order-history.html" class="acount-info__aside--button flex__row acount-info__aside--order-button">
                                        <img src="dashbroad-image/refresh-icon.svg" alt="refresh-icon" />
                                        <p>Order History</p>
                                    </a>
                                </button>
                                <button class="flex__row">
                                    <a href="#" class="flex__row acount-info__aside--button">
                                        <img src="dashbroad-image/white-heart.svg" alt="heart icon" />
                                        <p>Wishlist</p>
                                    </a>
                                </button>
                                <button class="flex__row">
                                    <a href="#" class="flex__row acount-info__aside--button">
                                        <img src="dashbroad-image/white-bag.svg" alt="bag-icon" />
                                        <p>Shopping Cart</p>
                                    </a>
                                </button>
                                <button class="flex__row">
                                    <a href="settings.html" class="flex__row acount-info__aside--button">
                                        <img src="dashbroad-image/setting-icon.svg" alt="Settings icon" />
                                        <p>Settings</p>
                                    </a>
                                </button>
                                <button class="flex__row">
                                    <a href="#" class="flex__row acount-info__aside--button">
                                        <img src="dashbroad-image/log-out.svg" alt="log-out icon" />
                                        <p>Log-out</p>
                                    </a>
                                </button>
                            </div>
                        </aside>
                        <div class="flex__colamn acount-info__dashbroead-container">
                            
                            <div class="flex__colamn box-border acount-info__order-box">
                                <div class="flex__row acount-info__order-box--h5">
                                    <h5>Order History</h5>
                                    
                                </div>

                                <ul class="flex__row order__ul">
                                    <li>Order ID</li>
                                    <li>Date</li>
                                    <li>Total</li>
                                    <li>Status</li>
                                    <li></li>
                                </ul>
                                <?php
                                $sql = "SELECT id, total_price, status, created_at FROM orders";
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo '<ul class="flex__row order__ul acount-info__order--ul">';
                                        echo '<li>#'. $row["id"] . '</li>';
                                        echo '<li>' . $row["created_at"] . '</li>';
                                        echo '<li>$'. $row["total_price"] . '</li>';
                                        echo '<li>' . $row["status"] . '</li>';
                                        echo '<li><a href="#">View Details</a></li>';

                                        
                                        echo '</ul>';
                                    }
                                } else {
                                    echo "0 results";
                                }
                                
                                $conn->close();
                                ?>                      
                                    <div class="flex__row order-list__buttons">
                                        <button class="flex__row order-list__grey-button">
                                            <img src="dashbroad-image/order-left-arrow.svg" alt="right arrow" />
                                        </button>
                                        <div class="flex__row">
                                            <button class="flex__row order-list__focus-button">1</button>
                                            <button class="flex__row order-list__focus-button">2</button>
                                            <button class="flex__row order-list__focus-button">3</button>
                                        </div>
                                        <button class="flex__row order-list__opasity-button">
                                            <img src="dashbroad-image/order-right-arrow.svg" alt="right arrow" />
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                
            </article>


            <section>
                <div class="flex__row end__section__container">
                    <div class="flex__row box-width end__section__box">
                        <div class="end__section__p flex__colamn">
                            <h4>Subcribe our Newsletter</h4>
                            <p>Pellentesque eu nibh eget mauris congue mattis mattis nec tellus. Phasellus imperdiet elit eu magna.</p>
                        </div>
                        <div class="flex__row">
                            <form>
                                <input type="text" placeholder="Your email address" class="end__section__input" />
                                <input type="button" value="Subscribe" />
                            </form>
                            <div class="social__buttons flex__row">
                                <button>
                                    <img src="dashbroad-image/facebook-icon.svg" alt="facebook" />
                                </button>
                                <button>
                                    <img src="dashbroad-image/twetter-icon.svg" alt="twiter" />
                                </button>
                                <button>
                                    <img src="dashbroad-image/pinterest-icon.svg" alt="pinterest" />
                                </button>
                                <button>
                                    <img src="dashbroad-image/instagram-icon.svg" alt="instagram" />
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <footer>
            <div class="flex__row main__footer__container">
                <div class="flex__colamn box-width">
                    <div class="footer__logo__container flex__row">
                        <div class="flex__colamn footer__logo">
                            <img src="dashbroad-image/footer-logo.svg" alt="footer logo" />
                            <p>Morbi cursus porttitor enim lobortis molestie. Duis gravida turpis dui, eget bibendum magna congue nec.</p>
                            <div class="flex__row">
                                <p>(219) 555-0114</p>
                                <span>or</span>
                                <p>Proxy@gmail.com</p>
                            </div>
                        </div>
                        <div class="flex__row footer__logo__text">
                            <div class="flex__colamn">
                                <h6>My Account</h6>
                                <ul class="flex__colamn ">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="#">Order History</a></li>
                                    <li><a href="#">Shoping Cart</a></li>
                                    <li><a href="#">Wishlist</a></li>
                                </ul>
                            </div>

                            <div class="flex__colamn">
                                <h6>Helps</h6>
                                <ul class="flex__colamn ">
                                    <li><a href="#">Contact</a></li>
                                    <li><a href="#">Faqs</a></li>
                                    <li><a href="#">Terms & Condition</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul>
                            </div>

                            <div class="flex__colamn">
                                <h6>Proxy</h6>
                                <ul class="flex__colamn ">
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Shop</a></li>
                                    <li><a href="#">Product</a></li>
                                    <li><a href="#">Track Order</a></li>
                                </ul>
                            </div>
                            
                            <div class="flex__colamn">
                                <h6>Categories</h6>
                                <ul class="flex__colamn ">
                                    <li><a href="#">Fruit & Vegetables</a></li>
                                    <li><a href="#">Meat & Fish</a></li>
                                    <li><a href="#">Bread & Bakery</a></li>
                                    <li><a href="#">Beauty & Health</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="flex__row copyright__box">
                        <p>Ecobazar eCommerce © 2021. All Rights Reserved</p>
                        <div class="flex__row">
                            <img src="dashbroad-image/pay-icon.svg" alt="pay cart" />
                            <img src="dashbroad-image/visa-icon.svg" alt="visa cart" />
                            <img src="dashbroad-image/discover-icon.svg" alt="discover cart" />
                            <img src="dashbroad-image/mastercard-icon.svg" alt="mastercard cart" />
                            <img src="dashbroad-image/secure-icon.svg" alt="secure-img" />
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
