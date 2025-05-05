<?php
session_start();
session_destroy();
header('location:../../FrontEnd/pages/Login Page/login.php');
?>