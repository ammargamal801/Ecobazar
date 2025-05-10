<?php
if (!isset($conn)) {
    $host = "localhost";
    $username = "root"; 
    $password = ""; 
    $database = "eco_bazar";

    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
        die("disconnect " . $conn->connect_error);
    }
    $conn->set_charset("utf8");
}

if (!isset($product_id)) {
    $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;
}

$category_query = "SELECT category_id FROM products WHERE id = ?";
$stmt1 = $conn->prepare($category_query);
$stmt1->bind_param("i", $product_id);
$stmt1->execute();
$result1 = $stmt1->get_result();
$category = $result1->fetch_assoc()['category_id'];
$stmt1->close();

$related_query = "SELECT * FROM products 
                  WHERE category_id = ? 
                  AND id != ? 
                  LIMIT 4";
$stmt2 = $conn->prepare($related_query);
$stmt2->bind_param("ii", $category, $product_id);
$stmt2->execute();
$related_result = $stmt2->get_result();
$stmt2->close();
?>
