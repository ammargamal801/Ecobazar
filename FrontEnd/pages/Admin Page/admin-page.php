<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eco_bazar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
 

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrator Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../Style/admin-page.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
        <div class="position-sticky pt-3">
          <h3 class="text-center text-success fw-bold">Admin Panel</h3>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" href="#">
                <span>🏠</span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span>👤</span>
                Manage Order
              </a>
              
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span>📦</span>
                Manage Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span>💰</span>
                Sales Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span>⚙️</span>
                Settings
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="#">
                <span>🚪</span>
                Logout
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Main Content -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <!-- Dashboard Start -->
        <div class="btn-details active">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
            </div>
          </div>

          <!-- Dashboard Cards -->
          <div class="row">
            <div class="col-md-4">
              <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                  <h5 class="card-title">Total Users</h5>
                  <p class="card-text" id="total-users">120</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card text-white bg-success mb-3">
                <div class="card-body">
                  <h5 class="card-title">Total Sales</h5>
                  <p class="card-text" id="total-sales">$15,000</p>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                  <h5 class="card-title">Products</h5>
                  <p class="card-text" id="total-products">320</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Table Section -->
          <h2>Recent Activities</h2>
          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>User</th>
                  <th>Activity</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody id="activity-table">
                <tr>
                  <td>1</td>
                  <td>Doaa Essam</td>
                  <td>Added a new product</td>
                  <td>2025-04-29</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Abdelrhman Hosny</td>
                  <td>Updated user settings</td>
                  <td>2025-04-28</td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>Fahd Mohamed</td>
                  <td>Deleted a product</td>
                  <td>2025-04-27</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      <!-- Dashboard End-->

      <!-- Manage orders Start-->
        <div class="btn-details">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Orders</h1>
          </div>
          <ul class="flex__row order__ul">
            <li>User ID</li>
            <li>Order ID</li>
            <li>Date</li>
            <li>Total</li>
            <li>Status</li>
        </ul>

        <?php
          $sql = "SELECT  id,user_id ,total_price, status, created_at FROM orders";
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo '<ul class="flex__row order__ul acount-info__order--ul">';
                  echo '<li>#'. $row["id"] . '</li>';
                  echo '<li>#'. $row["user_id"] . '</li>';
                  echo '<li>' . $row["created_at"] . '</li>';
                  echo '<li>$'. $row["total_price"] . '</li>';
                  echo '<li>' . $row["status"] . '</li>';
                  echo '<li><a href="#">View Details</a></li>';

                  echo '</ul>';
              }
          } else {
              echo "0 results";
          }
          
          $conn->close();
          ?>
        </div>
      <!-- Manage orders End-->
      
      <!-- Manage Products Start-->
      <div class="btn-details">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Manage Orders</h1>
        </div>
      </div>
    <!-- Manage Products End-->
      </main>
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../Logics/admin-page.js"></script>
</body>

</html>