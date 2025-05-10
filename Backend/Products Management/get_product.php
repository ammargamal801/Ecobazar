<?php
header('Content-Type: application/json');
require_once '../Authentication/config.php';

// Check if ID is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo json_encode(['error' => 'Product ID is required']);
    exit;
}

$product_id = (int)$_GET['id'];
$conn = getConnection();

// Use prepared statement to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
    echo json_encode($product);
} else {
    echo json_encode(['error' => 'Product not found']);
}

$stmt->close();
$conn->close();
?>