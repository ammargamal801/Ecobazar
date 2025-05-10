<?php
session_start();
$errors = [];
$email = htmlspecialchars(trim($_REQUEST["email"]));
$password = htmlspecialchars($_REQUEST["password"]);

if(empty($_POST['email'])) {
    $errors['email'] = "Please fill email field";
}
if(empty($_POST['password'])) {
    $errors['password'] = "Please fill password field";
}

// If there are validation errors, store them and redirect back
if(!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location:../../FrontEnd/pages/Login Page/login.php");
    exit();
}

require_once("users.php");
$user = User::login($_REQUEST["email"], $_REQUEST["password"]);

if(empty($user)) {
    // Check if email exists but password is wrong
    $emailExists = Customer::checkEmailExists($_REQUEST["email"]);
    if($emailExists) {
        $_SESSION['errors'] = [
            'password' => "Invalid password"
        ];
    } else {
        $_SESSION['errors'] = [
            'email' => "Invalid email",
            'password' => "Invalid password"
        ];
    }
    header("Location:../../FrontEnd/pages/Login Page/login.php");
    exit();
}

$_SESSION["user"] = serialize($user);

if($user->getRole() == "admin") {
    header("Location:../../FrontEnd/pages/Admin Page/admin-page.php");
    exit();
} elseif($user->getRole() == "customer") {
    header("Location:../../FrontEnd/pages/category.php");
    exit();
}
?>