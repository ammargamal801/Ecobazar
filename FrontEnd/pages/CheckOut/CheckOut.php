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
    <!-- Add this script section to your CheckOut.html before the closing </body> tag -->

</head>
<body>
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
</body>
</html>