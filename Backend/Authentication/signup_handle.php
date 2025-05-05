<?php 
session_start();

$errors = [];
$fields = ['f_name', 'l_name', 'email', 'phone', 'password', 'confirmPassword'];

$f_name = htmlspecialchars(trim($_REQUEST["f_name"]));
$l_name = htmlspecialchars(trim($_REQUEST["l_name"]));
$email = htmlspecialchars(trim($_REQUEST["email"]));
$phone = htmlspecialchars(trim($_REQUEST["phone"]));
$password = htmlspecialchars($_REQUEST["password"]);
$confirmPassword = htmlspecialchars($_REQUEST["confirmPassword"]);

// Basic validation
foreach($fields as $field) {
    if(empty($_POST[$field])) {
        $errors[$field] = ucfirst(str_replace('_', ' ', $field)) . " is required";
    }
}
// Email validation
if(!empty($_POST['email'])) {
    if(strpos($_POST['email'], ' ') !== false) {
        $errors['email'] = "Email cannot contain spaces";
    } elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }
}

if(!empty($_POST['phone']) && strlen($_POST['phone']) < 11) {
    $errors['password'] = "Password must be at least 8 characters";
}
// Password validation
if(!empty($_POST['password']) && strlen($_POST['password']) < 8) {
    $errors['phone'] = "Invalid phone format";
}
// Password match validation
if(!empty($_POST['password']) && !empty($_POST['confirmPassword']) && $_POST['password'] !== $_POST['confirmPassword']) {
    $errors['confirmPassword'] = "Passwords do not match";
}
// Check if email already exists in database
require_once 'config.php';
$conn = new mysqli( DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email_check_query = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($email_check_query);
$stmt->bind_param("s", $email);
$stmt->execute();
$email_result = $stmt->get_result();
if($email_result->num_rows > 0) {
    $errors['email'] = "Email already exists";
}

// Check if phone already exists in database
$phone_check_query = "SELECT * FROM users WHERE phone = ?";
$stmt = $conn->prepare($phone_check_query);
$stmt->bind_param("s", $phone);
$stmt->execute();
$phone_result = $stmt->get_result();
if($phone_result->num_rows > 0) {
    $errors['phone'] = "Phone already exists";
}

$stmt->close();
$conn->close();

// If there are errors, redirect back to signup page
if(empty($errors)) {
    require_once 'users.php';
    $rslt = Customer::register($f_name, $l_name, $email, $phone, $password);
    header("Location: ../../FrontEnd/pages/Login Page/login.php");
    exit();
}
else {
    $_SESSION['errors'] = $errors;
    header("Location: ../../FrontEnd/pages/SignUp Page/signup.php?msg=fr");
    exit();
}

?>