<?php
session_start();

// Check if user is logged in and is an admin
if (!isset($_SESSION['user'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Not authorized']);
    exit();
}

// Check if product_id is provided
if (!isset($_POST['product_id']) || empty($_POST['product_id'])) {
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'Product ID is required']);
    exit();
}

$product_id = (int)$_POST['product_id'];

// Include the Admin class
require_once '../Authentication/users.php';

// Call the deleteProduct method
$result = Admin::deleteProduct($product_id);

// Return JSON response
header('Content-Type: application/json');
if ($result) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
}
?>