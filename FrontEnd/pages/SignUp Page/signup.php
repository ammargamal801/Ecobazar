<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Style/signup.css">
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
          <h1 class="text-success fw-bold">Ecobazar</h1>
          <h2 class="mt-4">Sign up</h2>
          <p>Let's get you all set up so you can access your personal account.</p>
          <form action="../../../Backend/Authentication/signup_handle.php" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <input type="text" name="f_name" class="form-control" placeholder="First Name">
                <small class="text-danger"><?php echo $_SESSION['errors']['f_name'] ?? ''; ?></small>
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" name="l_name" class="form-control" placeholder="Last Name">
                <small class="text-danger"><?php echo $_SESSION['errors']['l_name'] ?? ''; ?></small>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <input type="text" name="email" class="form-control" placeholder="Email">
                <small class="text-danger"><?php echo $_SESSION['errors']['email'] ?? ''; ?></small>
              </div>
              <div class="col-md-6 mb-3">
                <input type="text" name="phone" class="form-control" placeholder="Phone Number">
                <small class="text-danger"><?php echo $_SESSION['errors']['phone'] ?? ''; ?></small>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 mb-3 position-relative">
                <input type="password" name="password" class="form-control" placeholder="Password" id="password">
                <span class="toggle-password" onclick="togglePassword('password')">👁️</span>
                <small class="text-danger"><?php echo $_SESSION['errors']['password'] ?? ''; ?></small>
              </div>
              <div class="col-md-6 mb-3 position-relative">
                <input type="password" name="confirmPassword" class="form-control" placeholder="Confirm Password" id="confirmPassword">
                <span class="toggle-password" onclick="togglePassword('confirmPassword')">👁️</span>
                <small class="text-danger"><?php echo $_SESSION['errors']['confirmPassword'] ?? ''; ?></small>
              </div>
            </div>
            <div class="mb-3 form-check">
              <input type="checkbox" class="form-check-input" id="terms"  >
              <label for="terms" class="form-check-label">I agree to all the <a href="#" class="text-success">Terms and Privacy Policies</a></label>
            </div>
            <button type="submit" class="btn btn-success w-100">Create account</button>
          </form>

          <div class="text-center mt-3">
            <p>Already have an account? <a href="../Login Page/login.php" class="text-success">Login</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../Logics/script.js"></script>
</body>

</html>

<?php
$_SESSION['errors'] = null;
?>