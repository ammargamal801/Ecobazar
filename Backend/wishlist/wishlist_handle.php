<?php
session_start();
require_once '../Authentication/users.php';

// Check if user is logged in
if (!isset($_SESSION['user'])) {
    $response = [
        'success' => false,
        'message' => 'You must be logged in to manage your wishlist'
    ];
    echo json_encode($response);
    exit();
}

// Get the user object from session
$user = unserialize($_SESSION['user']);
$user_id = $user->getId();

// Check if action and product_id are provided
if (!isset($_POST['action']) || !isset($_POST['product_id'])) {
    $response = [
        'success' => false,
        'message' => 'Missing required parameters'
    ];
    echo json_encode($response);
    exit();
}

$action = $_POST['action'];
$product_id = (int)$_POST['product_id'];

// Process the action
switch ($action) {
    case 'add':
        $result = Customer::addToWishlist($user_id, $product_id);
        if ($result) {
            $response = [
                'success' => true,
                'message' => 'Product added to wishlist successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Product is already in your wishlist or could not be added'
            ];
        }
        break;
        
    case 'remove':
        $result = Customer::removeFromWishlist($user_id, $product_id);
        if ($result) {
            $response = [
                'success' => true,
                'message' => 'Product removed from wishlist successfully'
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Product could not be removed from wishlist'
            ];
        }
        break;
        
    default:
        $response = [
            'success' => false,
            'message' => 'Invalid action'
        ];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>