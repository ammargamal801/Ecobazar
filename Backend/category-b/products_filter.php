<?php

session_start();

$conn = new mysqli("localhost", "root", "", "eco_bazar");
if ($conn->connect_error) {
    die("failed: " . $conn->connect_error);
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
    
    $baseSql = "SELECT p.id, p.name, p.description, p.main_image, p.original_price, p.stock_quantity,
                c.name as category_name, c.id as category_id 
                FROM products p 
                JOIN categories c ON p.category_id = c.id";
    
    if (!empty($selectedCategories)) {
        
        $safeCategories = array_map(function($id) use ($conn) {
            return (int)$conn->real_escape_string($id);
        }, $selectedCategories);
        
        $cat_ids = implode(',', $safeCategories);
        $sql = "$baseSql WHERE p.category_id IN ($cat_ids) ORDER BY p.name";
    } else {
        
        $sql = "$baseSql ORDER BY p.name";
    }

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $row['formatted_price'] = number_format($row['original_price'], 2) . '$';
            $products[] = $row;
        }
    }
    
    return $products;
}

function searchProducts($conn, $searchTerm = '') {
    $products = [];
    
    if (!empty($searchTerm)) {
        $search = '%' . $conn->real_escape_string($searchTerm) . '%';
        $sql = "SELECT p.id, p.name, p.description, p.main_image, p.original_price, p.stock_quantity, 
                c.name as category_name, c.id as category_id 
                FROM products p 
                JOIN categories c ON p.category_id = c.id 
                WHERE p.name LIKE ? OR p.description LIKE ? 
                ORDER BY p.name";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $row['formatted_price'] = number_format($row['original_price'], 2) . ' $';
                $products[] = $row;
            }
        }
        $stmt->close();
    }
    
    return $products;
}


$selected_categories = [];
if (isset($_GET['categories']) && is_array($_GET['categories'])) {
    $selected_categories = array_map('intval', $_GET['categories']);
}

$search_term = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search_term = trim($_GET['search']);
    $products = searchProducts($conn, $search_term);
} else {
    
    $products = getProductsByCategories($conn, $selected_categories);
}

$categories = getAllCategories($conn);


$conn->close();

if (isset($_GET['api']) && $_GET['api'] == 'json') {
    header('Content-Type: application/json');
    echo json_encode([
        'categories' => $categories,
        'products' => $products,
        'selected_categories' => $selected_categories,
        'search_term' => $search_term
    ]);
    exit;
}
?>
