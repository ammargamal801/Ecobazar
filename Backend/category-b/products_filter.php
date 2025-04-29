<?php

session_start();

$conn = new mysqli("localhost", "root", "", "market");
if ($conn->connect_error) {
    die("no connect: " . $conn->connect_error);
}

function getAllCategories($conn) {
    $categories = [];
    $cat_query = $conn->query("SELECT id, name FROM categories ORDER BY name");
    if ($cat_query && $cat_query->num_rows > 0) {
        while ($cat = $cat_query->fetch_assoc()) {
            $categories[] = $cat;
        }
    }
    return $categories;
}

function getProductsByCategories($conn, $selectedCategories = []) {
    $products = [];
    
    if (empty($selectedCategories)) {
        $sql = "SELECT p.id, p.name, p.image, p.price, c.name as category_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                ORDER BY p.name";
    } else {
        $cat_ids = implode(',', $selectedCategories);
        $sql = "SELECT p.id, p.name, p.image, p.price, c.name as category_name 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.category_id IN ($cat_ids) 
                ORDER BY p.name";
    }

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    
    return $products;
}

$selected_categories = [];
if (isset($_GET['categories']) && is_array($_GET['categories'])) {
    $selected_categories = array_map('intval', $_GET['categories']);
}

$categories = getAllCategories($conn);
$products = getProductsByCategories($conn, $selected_categories);

$conn->close();

if (isset($_GET['api']) && $_GET['api'] == 'json') {
    header('Content-Type: application/json');
    echo json_encode([
        'categories' => $categories,
        'products' => $products,
        'selected_categories' => $selected_categories
    ]);
    exit;
}
?>