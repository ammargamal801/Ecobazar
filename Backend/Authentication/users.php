<?php
abstract class User {
    public $id;
    public $f_name;
    public $l_name;
    public $email;
    protected $password;
    public $role;
    public $created_at;

    public function __construct($id, $f_name, $l_name, $email, $password, $role, $created_at) {
        $this->id = $id;
        $this->f_name = $f_name;
        $this->l_name = $l_name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->created_at = $created_at;
    }

    public static function hashPassword($password) {
        return md5($password);
    }

    public static function login($email, $password) {
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
    public function logout() {
        // TODO: Add logout logic here
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->f_name;
    }

    public function getLastName() {
        return $this->l_name;
    }

    public function getFullName() {
        return $this->f_name . ' ' . $this->l_name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    // Setters
    public function setFirstName($f_name) {
        $this->f_name = $f_name;
    }

    public function setLastName($l_name) {
        $this->l_name = $l_name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
}

class Admin extends User {
    public function __construct($id, $f_name, $l_name, $email, $password, $created_at) {
        parent::__construct($id, $f_name, $l_name, $email, $password, 'admin', $created_at);
    }

    // Admin specific methods
    public function manageUsers() {
        // Implementation for managing users
    }

    public function manageProducts() {
        // Implementation for managing products
    }

    public function viewReports() {
        // Implementation for viewing reports
    }
}

class Customer extends User {
    public function __construct($id, $f_name, $l_name, $email, $password, $created_at) {
        parent::__construct($id, $f_name, $l_name, $email, $password, 'customer', $created_at);
    }

    public static function register($f_name, $l_name, $email, $phone, $password) {
        $hashedPassword = self::hashPassword($password);
        $qry = "INSERT INTO users (name,l_name,email,phone,password) VALUES ('$f_name', '$l_name', '$email', '$phone', '$hashedPassword')";
        require_once 'config.php';
        $cnn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        if (!$cnn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $rslt = mysqli_query($cnn, $qry);
        mysqli_close($cnn);
        return $rslt;
    }

    // Customer specific methods
    public function viewProducts() {
        // Implementation for viewing products
    }

    public function makePurchase() {
        // Implementation for making purchases
    }

    public function viewOrderHistory() {
        // Implementation for viewing order history
    }
    
    /**
     * Check if an email exists in the database
     * 
     * @param string $email The email to check
     * @return bool True if the email exists, false otherwise
     */
    public static function checkEmailExists($email) {
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
