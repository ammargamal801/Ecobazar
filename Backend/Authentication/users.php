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
