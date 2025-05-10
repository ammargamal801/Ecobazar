<?php

$host = "localhost";
$username = "root"; 
$password = ""; 
$database = "eco_bazar";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("disconnect " . $conn->connect_error);
}

$conn->set_charset("utf8");

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 1; 


$product_query = "SELECT p.*, c.name as category_name
                 FROM products p
                 JOIN categories c ON p.category_id = c.id
                 WHERE p.id = $product_id";
$product_result = $conn->query($product_query);

if ($product_result && $product_result->num_rows > 0) {
    $product = $product_result->fetch_assoc();
} else {
    die("the product is unavailable");
}


// $reviews_query = "SELECT r.*, u.name as user_name
//                  FROM reviews r
//                  JOIN users u ON r.user_id = u.id
//                  WHERE r.product_id = $product_id
//                  ORDER BY r.created_at DESC
//                  LIMIT 4"; 
// $reviews_result = $conn->query($reviews_query);

// $rating_query = "SELECT AVG(rating) as average_rating, COUNT(*) as review_count 
//                 FROM reviews
//                 WHERE product_id = $product_id";
// $rating_result = $conn->query($rating_query);
// $rating_data = $rating_result->fetch_assoc();
// $average_rating = round($rating_data['average_rating'], 1);
// $review_count = $rating_data['review_count'];

// $related_query = "SELECT p.*
//                  FROM products p
//                  WHERE p.category_id = {$product['category_id']}
//                  AND p.id != $product_id
//                  LIMIT 4"; 
// $related_result = $conn->query($related_query);

// function displayStars($rating) {
//     $fullStars = floor($rating);
//     $halfStar = ($rating - $fullStars) >= 0.5;
//     $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
    
//     $stars = '';
//    
//     for ($i = 0; $i < $fullStars; $i++) {
//         $stars .= '★';
//     }

//     if ($halfStar) {
//         $stars .= '★';
//     }

//     for ($i = 0; $i < $emptyStars; $i++) {
//         $stars .= '☆';
//     }
    
//     return $stars;
// }


// function formatPrice($price) {
//     return "$" . number_format($price, 2);
// }


// function calculateDiscount($original, $discounted) {
//     if ($original <= 0) return 0;
//     $discount = (($original - $discounted) / $original) * 100;
//     return round($discount);
// }

// $in_stock = $product['stock_quantity'] > 0;
// $stock_status = $in_stock ? "available({$product['stock_quantity']})" : "unavailable";

// $tags = explode(',', $product['tags']);
// ?>
