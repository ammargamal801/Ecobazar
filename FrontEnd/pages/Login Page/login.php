<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Style/login.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row align-items-center vh-100">
      <!-- Left Side - Image Section -->
      <div class="col-md-6 text-center d-flex justify-content-center align-items-center">
        <img src="../../Assets/doaa.jpg">
      </div>

      <!-- Right Side - Form Section -->
      <div class="col-md-6">
        <div class="form-container mx-auto">
          <h1 class="text-success fw-bold">Login</h1>
          <p class="text-success">Login to access your travelwise account</p>

          <form action="../../../Backend/Authentication/login_handle.php" method="POST">
            <div class="mb-3">
              <input type="text" name="email" class="form-control" placeholder="Email">
              <small class="text-danger"><?php echo $_SESSION['errors']['email'] ?? ''; ?></small>
            </div>
            <div class="mb-3 position-relative">
              <input type="password" name="password" class="form-control" placeholder="Password" id="password">
              <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
              <small class="text-danger"><?php echo $_SESSION['errors']['password'] ?? ''; ?></small>
            </div>
            <div class="d-flex justify-content-between">
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label for="rememberMe" class="form-check-label">Remember me</label>
              </div>
              <a href="../Forgot Password Page/forgot _password.html" class="text-decoration-none text-red"><span>&larr;</span> forgot password</a>
            </div>
            <button type="submit" class="btn btn-success w-100">Login</button>
          </form>

          <div class="text-center mt-3">
            <p>Don't have an account? <a href="../SignUp Page/signup.php" class="text-danger">Sign up</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../Logics/login.js"></script>
</body>

</html>
<?php
$_SESSION['errors'] = null;
?>