<?php
// Database connection
$host = 'localhost';
$dbname = 'eco_bazar';
$username = 'root'; // Update with your database username
$password = ''; // Update with your database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Initialize variables
$selected_categories = isset($_GET['categories']) ? $_GET['categories'] : [];
$min_price = isset($_GET['min_price']) ? (int)$_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 50;
$sort_by = isset($_GET['sort']) ? $_GET['sort'] : 'latest';
$rating_filter = isset($_GET['rating']) ? (int)$_GET['rating'] : 0;
$tags = isset($_GET['tags']) ? $_GET['tags'] : [];

// Fetch all categories
$stmt = $conn->prepare("SELECT * FROM categories ORDER BY display_order");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Build query for products
$query = "SELECT DISTINCT p.*, 
          (SELECT AVG(rating) FROM reviews WHERE product_id = p.id) as avg_rating 
          FROM products p";

// Add necessary joins
if (!empty($tags)) {
    $query .= " LEFT JOIN product_tags pt ON p.id = pt.product_id";
    $query .= " LEFT JOIN tags t ON pt.tag_id = t.id";
}

// Add WHERE clause
$conditions = [];
$params = [];

// Filter by category
if (!empty($selected_categories)) {
    $placeholders = implode(',', array_fill(0, count($selected_categories), '?'));
    $conditions[] = "p.category_id IN ($placeholders)";
    $params = array_merge($params, $selected_categories);
}

// Filter by price
$conditions[] = "p.original_price BETWEEN ? AND ?";
$params[] = $min_price;
$params[] = $max_price;

// Filter by rating if selected
if ($rating_filter > 0) {
    $conditions[] = "(SELECT AVG(rating) FROM reviews WHERE product_id = p.id) >= ?";
    $params[] = $rating_filter;
}

// Filter by tags if selected
if (!empty($tags)) {
    $placeholders = implode(',', array_fill(0, count($tags), '?'));
    $conditions[] = "t.name IN ($placeholders)";
    $params = array_merge($params, $tags);
    
    // Count the number of matching tags to ensure products with all selected tags are shown
    if (count($tags) > 1) {
        $query .= " GROUP BY p.id HAVING COUNT(DISTINCT t.name) = " . count($tags);
    }
}

// Add conditions to query
if (!empty($conditions)) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

// Add ORDER BY based on sort selection
switch ($sort_by) {
    case 'price-low':
        $query .= " ORDER BY p.original_price ASC";
        break;
    case 'price-high':
        $query .= " ORDER BY p.original_price DESC";
        break;
    case 'popular':
        $query .= " ORDER BY p.sold_count DESC";
        break;
    case 'latest':
    default:
        $query .= " ORDER BY p.created_at DESC";
        break;
}

// Prepare and execute the query
try {
    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Query error: " . $e->getMessage() . "<br>Query: " . $query);
}

// Process products to ensure they have all necessary fields
foreach ($products as &$product) {
    // Format the rating
    $product['avg_rating'] = isset($product['avg_rating']) ? round($product['avg_rating'], 1) : 0;
}

// Fetch popular tags
$stmt = $conn->prepare("SELECT name FROM tags ORDER BY (
    SELECT COUNT(*) FROM product_tags pt WHERE pt.tag_id = tags.id
) DESC LIMIT 13");
$stmt->execute();
$popular_tags = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Fetch sale products (products with discounted price)
$stmt = $conn->prepare("SELECT id, name, main_image, original_price, discounted_price, 
                       (SELECT AVG(rating) FROM reviews WHERE product_id = products.id) as avg_rating
                       FROM products 
                       WHERE discounted_price IS NOT NULL AND discounted_price < original_price
                       ORDER BY (original_price - discounted_price) / original_price DESC
                       LIMIT 3");
$stmt->execute();
$sale_products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Format ratings for sale products
foreach ($sale_products as &$product) {
    $product['avg_rating'] = $product['avg_rating'] ? round($product['avg_rating'], 1) : 0;
}
?>