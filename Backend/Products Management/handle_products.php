<?php
session_start();

require_once '../Authentication/config.php';
$conn = getConnection();
$errors = [];

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if this is an edit operation
    $is_edit = isset($_POST['edit']) && $_POST['edit'] == 'true';
    $product_id = $is_edit ? (int)$_POST['product_id'] : null;
    
    // Define required fields
    $required_fields = ['name', 'category_id', 'original_price'];
    
    // Validate required fields
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " is required";
        }
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        // Get form data with proper validation
        $name = htmlspecialchars($_POST["name"]);
        $category_id = (int)$_POST["category_id"];
        $original_price = (float)$_POST["original_price"];
        $discounted_price = !empty($_POST["discounted_price"]) ? (float)$_POST["discounted_price"] : null;
        $brand_id = !empty($_POST["brand_id"]) ? (int)$_POST["brand_id"] : null;
        $stock_quantity = !empty($_POST["stock_quantity"]) ? (int)$_POST["stock_quantity"] : 0;
        $weight = htmlspecialchars($_POST["weight"] ?? '');
        $color = htmlspecialchars($_POST["color"] ?? '');
        $type = htmlspecialchars($_POST["type"] ?? '');
        $features = htmlspecialchars($_POST["features"] ?? '');
        $description = htmlspecialchars($_POST["description"] ?? '');
        $tags = htmlspecialchars($_POST["tags"] ?? '');
        $sold_count = !empty($_POST["sold_count"]) ? (int)$_POST["sold_count"] : 0;
        $is_featured = isset($_POST["is_featured"]) ? $_POST["is_featured"] : 0;
        $is_new = isset($_POST["is_new"]) ? $_POST["is_new"] : 0;
        $is_organic = isset($_POST["is_organic"]) ? $_POST["is_organic"] : 0;
        $status = isset($_POST["status"]) ? $_POST["status"] : null;
        
        // Handle image upload
        $main_image = null; // Default to null for edit mode (no image change)
        
        if (isset($_FILES['main_image']) && $_FILES['main_image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['main_image']['name'];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            
            if (in_array(strtolower($ext), $allowed)) {
                $new_filename = uniqid() . '.' . $ext;
                $upload_dir = '../../Assets/products/';
                
                // Create directory if it doesn't exist
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                if (move_uploaded_file($_FILES['main_image']['tmp_name'], $upload_dir . $new_filename)) {
                    $main_image = $new_filename;
                }
            } else {
                $errors['main_image'] = "Invalid file type. Allowed types: " . implode(', ', $allowed);
            }
        } else if (!$is_edit) {
            // For new products, set default image
            $main_image = 'placeholder.png';
        }
        
        // If still no errors after image processing, add or update the product
        if (empty($errors)) {
            require_once '../Authentication/users.php';
            
            if ($is_edit) {
                // Update existing product
                $result = Admin::modifyProduct(
                    $product_id, $name, $category_id, $original_price, $discounted_price, $brand_id, 
                    $main_image, $stock_quantity, $weight, $color, $type, 
                    $features, $description, $tags, $sold_count, 
                    $is_featured, $is_new, $is_organic, $status
                );
                
                if ($result) {
                    $_SESSION['success_message'] = "Product updated successfully!";
                } else {
                    $_SESSION['error_message'] = "Failed to update product. Please try again.";
                }
            } else {
                // Add new product
                $product_id = Admin::addProduct(
                    $name, $category_id, $original_price, $discounted_price, $brand_id, 
                    $main_image, $stock_quantity, $weight, $color, $type, 
                    $features, $description, $tags, $sold_count, 
                    $is_featured, $is_new, $is_organic
                );
                
                if ($product_id) {
                    $_SESSION['success_message'] = "Product added successfully!";
                } else {
                    $_SESSION['error_message'] = "Failed to add product. Please try again.";
                }
            }
            
            header("Location: ../../FrontEnd/pages/Admin Page/admin-page.php");
            exit();
        }
    }
    
    // If there are errors, store them in session and redirect back
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: ../../FrontEnd/pages/Admin Page/admin-page.php");
        exit();
    }
} else {
    // If not a POST request, redirect to admin page
    header("Location: ../../FrontEnd/pages/Admin Page/admin-page.php");
    exit();
}
?>