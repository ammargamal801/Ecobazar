<?php

    // Database configuration
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');      // Default XAMPP username
    define('DB_PASSWORD', '');          // Default XAMPP password is empty
    define('DB_NAME', 'market');     // Your database name

    // Attempt to connect to MySQL database
    function getConnection() {
        $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        
        // Check connection
        if($conn === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        
        return $conn;
    }

?>
