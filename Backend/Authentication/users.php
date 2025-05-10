<?php
abstract class User
{
    public $id;
    public $f_name;
    public $l_name;
    public $email;
    protected $password;
    public $role;
    public $created_at;

    public function __construct($id, $f_name, $l_name, $email, $password, $role, $created_at)
    {
        $this->id = $id;
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->created_at = $created_at;
    }

    public static function hashPassword($password)
    {
        return md5($password);
    }

    public static function login($email, $password)
    {
        require_once 'config.php';

        $conn = getConnection();

        // Hash the password before comparing
        $hashedPassword = self::hashPassword($password);
        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $stmt->bind_param("ss", $email, $hashedPassword);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Log successful login attempt
            // self::logLoginAttempt($email, true);

            // Create appropriate user type based on role
            if ($user['role'] === 'admin') {
                return new Admin(
                    $user['id'],
                    $user['f_name'],
                    $user['l_name'],
                    $user['email'],
                    $user['password'],
                    $user['created_at']
                );
            } else {
                return new Customer(
                    $user['id'],
                    $user['f_name'],
                    $user['l_name'],
                    $user['email'],
                    $user['password'],
                    $user['created_at']
                );
            }
        }
        return null;
        // Log failed login attempt
        // self::logLoginAttempt($email, false);
    }

    // private static function logLoginAttempt($email, $success) {
    //     try {
    //         $conn = getConnection();
    //         $stmt = $conn->prepare("INSERT INTO login_attempts (email, success, attempt_time, ip_address) VALUES (?, ?, NOW(), ?)");
    //         $success = $success ? 1 : 0;
    //         $ipAddress = $_SERVER['REMOTE_ADDR'];
    //         $stmt->bind_param("sis", $email, $success, $ipAddress);
    //         $stmt->execute();
    //     } catch (Exception $e) {
    //         error_log("Failed to log login attempt: " . $e->getMessage());
    //     } finally {
    //         if (isset($stmt)) {
    //             $stmt->close();
    //         }
    //         if (isset($conn)) {
    //             $conn->close();
    //         }
    //     }
    // }

    // Static method for consistent password hashing
    public function logout()
    {
        // TODO: Add logout logic here
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getFirstName()
    {
        return $this->f_name;
    }

    public function getLastName()
    {
        return $this->l_name;
    }

    public function getFullName()
    {
        return $this->f_name . ' ' . $this->l_name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    // Setters
    public function setFirstName($f_name)
    {
        $this->f_name = $f_name;
    }

    public function setLastName($l_name)
    {
        $this->l_name = $l_name;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}

class Admin extends User
{
    public function __construct($id, $f_name, $l_name, $email, $password, $created_at)
    {
        parent::__construct($id, $f_name, $l_name, $email, $password, 'admin', $created_at);
    }

    public static function viewProducts(){
        // Reconnect to database
        require_once 'config.php';
        $conn = getConnection();
        // Fetch products with category names
        $sql = "SELECT p.id, p.name, p.main_image, p.original_price, p.discounted_price, 
                    p.stock_quantity, p.status, c.name as category_name 
                    FROM products p 
                    LEFT JOIN categories c ON p.category_id = c.id 
                    ORDER BY p.id DESC";
        $rslt = $conn->query($sql);

        if ($rslt->num_rows > 0) {
            while ($row = $rslt->fetch_assoc()) {
                $price = $row["discounted_price"] ?? $row["original_price"];
                $status_class = '';
                switch ($row["status"]) {
                    case 'active':
                        $status_class = 'bg-success';
                        break;
                    case 'inactive':
                        $status_class = 'bg-warning';
                        break;
                    case 'out_of_stock':
                        $status_class = 'bg-danger';
                        break;
                }

                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td><img src="' . ($row["main_image"] ? '../../Assets/products/' . $row["main_image"] : '../../Assets/placeholder.png') . '" width="50" height="50" class="img-thumbnail"></td>';
                echo '<td>' . $row["name"] . '</td>';
                echo '<td>' . $row["category_name"] . '</td>';
                echo '<td>$' . $price . '</td>';
                echo '<td>' . $row["stock_quantity"] . '</td>';
                echo '<td><span class="badge ' . $status_class . '">' . $row["status"] . '</span></td>';
                echo '<td>
                        <button class="btn btn-sm btn-primary edit-product" data-id="' . $row["id"] . '" data-bs-toggle="modal" data-bs-target="#editProductModal">Edit</button>
                        <button class="btn btn-sm btn-danger delete-product" data-id="' . $row["id"] . '">Delete</button>
                        </td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="8" class="text-center">No products found</td></tr>';
        }
    }
    
    public static function addProduct($name, $category_id, $original_price, $discount_price, $brand_id, $main_image, 
                                    $stock_quantity, $weight, $color, $type, $features, $description, 
                                    $tags, $sold_count, $is_featured, $is_new, $is_organic) {
        require_once 'config.php';
        $conn = getConnection();
        
        // Convert checkbox values to boolean (0 or 1)
        $is_featured = isset($is_featured) ? 1 : 0;
        $is_new = isset($is_new) ? 1 : 0;
        $is_organic = isset($is_organic) ? 1 : 0;
        
        // Set default status based on stock quantity
        $status = ($stock_quantity > 0) ? 'active' : 'out_of_stock';
        
        // Prepare SQL statement
        $sql = "INSERT INTO products (name, category_id, brand_id, main_image, original_price, 
                discounted_price, stock_quantity, weight, color, type, features, description, 
                tags, sold_count, is_featured, is_new, is_organic, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        
        // Fix: Make sure the number of type specifiers matches the number of parameters
        $stmt->bind_param("siisddissssssiiiis", 
            $name, $category_id, $brand_id, $main_image, $original_price, 
            $discount_price, $stock_quantity, $weight, $color, $type,
            $features, $description, $tags, $sold_count, $is_featured, 
            $is_new, $is_organic, $status);
        
        $result = $stmt->execute();
        
        if ($result) {
            $product_id = $conn->insert_id;
            $stmt->close();
            $conn->close();
            return $product_id;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }
    
    public static function deleteProduct($product_id) {
        require_once 'config.php';
        $conn = getConnection();
        
        // Use prepared statement to prevent SQL injection
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        
        $result = $stmt->execute();
        
        // Check if the deletion was successful
        if ($result) {
            $affected_rows = $stmt->affected_rows;
            $stmt->close();
            $conn->close();
            
            // Return true if at least one row was affected
            return $affected_rows > 0;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }
    
    public static function modifyProduct($product_id, $name, $category_id, $original_price, $discount_price, $brand_id, 
                                      $main_image, $stock_quantity, $weight, $color, $type, $features, $description, 
                                      $tags, $sold_count, $is_featured, $is_new, $is_organic, $status) {
        require_once 'config.php';
        $conn = getConnection();
        
        // Set default status based on stock quantity if not provided
        if (empty($status)) {
            $status = ($stock_quantity > 0) ? 'active' : 'out_of_stock';
        }
        
        // Check if a new image was provided
        $image_clause = "";
        $params = [];
        
        // Build the base parameter array
        $params[] = $name;
        $params[] = $category_id;
        $params[] = $brand_id;
        
        // Add image parameter if provided
        if (!empty($main_image)) {
            $image_clause = ", main_image = ?";
            $params[] = $main_image;
        }
        
        // Add remaining parameters
        $params[] = $original_price;
        $params[] = $discount_price;
        $params[] = $stock_quantity;
        $params[] = $weight;
        $params[] = $color;
        $params[] = $type;
        $params[] = $features;
        $params[] = $description;
        $params[] = $tags;
        $params[] = $sold_count;
        $params[] = $is_featured;
        $params[] = $is_new;
        $params[] = $is_organic;
        $params[] = $status;
        $params[] = $product_id;
        
        // Prepare SQL statement
        $sql = "UPDATE products SET name = ?, category_id = ?, brand_id = ?" . $image_clause . ", 
                original_price = ?, discounted_price = ?, stock_quantity = ?, weight = ?, 
                color = ?, type = ?, features = ?, description = ?, tags = ?, 
                sold_count = ?, is_featured = ?, is_new = ?, is_organic = ?, status = ? 
                WHERE id = ?";
        
        $stmt = $conn->prepare($sql);
        
        // Create the types string dynamically based on parameters
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_double($param) || is_float($param)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
        }
        
        // Dynamically bind parameters
        $stmt->bind_param($types, ...$params);
        
        $result = $stmt->execute();
        
        if ($result) {
            $affected_rows = $stmt->affected_rows;
            $stmt->close();
            $conn->close();
            return $affected_rows > 0;
        } else {
            $stmt->close();
            $conn->close();
            return false;
        }
    }
}


class Customer extends User
{
    public function __construct($id, $f_name, $l_name, $email, $password, $created_at)
    {
        parent::__construct($id, $f_name, $l_name, $email, $password, 'customer', $created_at);
    }

    public static function register($f_name, $l_name, $email, $phone, $password)
    {
        require_once 'config.php';
        $cnn = getConnection();
        $hashedPassword = self::hashPassword($password);
        $qry = "INSERT INTO users (name,l_name,email,phone,password) VALUES ('$f_name', '$l_name', '$email', '$phone', '$hashedPassword')";
        $rslt = mysqli_query($cnn, $qry);
        mysqli_close($cnn);
        return $rslt;
    }

    

    // Customer specific methods
    public function viewProducts()
    {
        // Implementation for viewing products
    }

    public function makePurchase()
    {
        // Implementation for making purchases
    }

    public function viewOrderHistory()
    {
        // Implementation for viewing order history
    }

    /**
     * Add a product to the user's wishlist
     * 
     * @param int $user_id The ID of the user
     * @param int $product_id The ID of the product to add to wishlist
     * @return bool True if the product was added successfully, false otherwise
     */
    public static function addToWishlist($user_id, $product_id)
    {
        require_once 'config.php';
        $conn = getConnection();
        
        // Check if the product already exists in the user's wishlist
        $check_query = "SELECT * FROM wishlist WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        // If the product is already in the wishlist, return false
        if ($result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            return false;
        }
        
        // Add the product to the wishlist
        $insert_query = "INSERT INTO wishlist (user_id, product_id, created_at) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    /**
     * Remove a product from the user's wishlist
     * 
     * @param int $user_id The ID of the user
     * @param int $product_id The ID of the product to remove from wishlist
     * @return bool True if the product was removed successfully, false otherwise
     */
    public static function removeFromWishlist($user_id, $product_id)
    {
        require_once 'config.php';
        $conn = getConnection();
        
        $delete_query = "DELETE FROM wishlist WHERE user_id = ? AND product_id = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("ii", $user_id, $product_id);
        $success = $stmt->execute();
        
        $stmt->close();
        $conn->close();
        
        return $success;
    }
    
    /**
     * Get all products in the user's wishlist
     * 
     * @param int $user_id The ID of the user
     * @return array An array of products in the user's wishlist
     */
    public static function getWishlist($user_id)
    {
        require_once 'config.php';
        $conn = getConnection();
        
        $query = "SELECT p.*, w.created_at as added_date 
                FROM wishlist w
                JOIN products p ON w.product_id = p.id
                WHERE w.user_id = ?
                ORDER BY w.created_at DESC";
        
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $wishlist_items = [];
        while ($row = $result->fetch_assoc()) {
            $wishlist_items[] = $row;
        }
        
        $stmt->close();
        $conn->close();
        
        return $wishlist_items;
    }

    /**
     * Check if an email exists in the database
     * 
     * @param string $email The email to check
     * @return bool True if the email exists, false otherwise
     */
    public static function checkEmailExists($email)
    {
        require_once 'config.php';
        $conn = getConnection();

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // If we found at least one row, the email exists
        $exists = $result->num_rows > 0;

        $stmt->close();
        $conn->close();

        return $exists;
    }
}
