<?php
session_start();
require_once("../../../Backend/Authentication/config.php");
$conn = getConnection();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrator Page - Ecobazar</title>
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
              <a class="nav-link active" href="#" id="dashboard-link">
                <span>🏠</span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="orders-link">
                <span>👤</span>
                Manage Order
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="products-link">
                <span>📦</span>
                Manage Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="reports-link">
                <span>💰</span>
                Sales Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" id="settings-link">
                <span>⚙️</span>
                Settings
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-danger" href="../../../Backend/Authentication/logout.php">
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
          $sql = "SELECT id, user_id, total_price, status, created_at FROM orders";
          $result = $conn->query($sql);
          
          if ($result && $result->num_rows > 0) {
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
          // Don't close the connection here
          ?>
        </div>
      <!-- Manage orders End-->
      
      <!-- Manage Products Start-->
      <div class="btn-details">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
          <h1 class="h2">Manage Products</h1>
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">Add New Product</button>
        </div>
        <!-- Products Table -->
        <div class="table-responsive">
          <table class="table table-striped table-sm">
            <thead>
              <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="products-table">
              <?php
              require_once("../../../Backend/Authentication/users.php");
              $products = Admin::viewProducts();
              ?>
            </tbody>
          </table>
        </div>
      </div>
    <!-- Manage Products End-->
      </main>
    </div>
  </div>

  <!-- Add Product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="../../../Backend/Products Management/handle_products.php" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="name" class="form-label">Product Name*</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <div class="invalid-feedback">Please enter a product name.</div>
              </div>
              <div class="col-md-6">
                <label for="category_id" class="form-label">Category*</label>
                <select class="form-select" id="category_id" name="category_id" required>
                  <option value="">Select Category</option>
                  <?php
                  $cat_sql = "SELECT id, name FROM categories ORDER BY name";
                  $cat_result = $conn->query($cat_sql);
                  if ($cat_result && $cat_result->num_rows > 0) {
                    while($cat_row = $cat_result->fetch_assoc()) {
                      echo '<option value="'.$cat_row["id"].'">'.$cat_row["name"].'</option>';
                    }
                  }
                  ?>
                </select>
                <div class="invalid-feedback">Please select a category.</div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="brand_id" class="form-label">Brand</label>
                <select class="form-select" id="brand_id" name="brand_id">
                  <option value="">Select Brand</option>
                  <?php
                  $brand_sql = "SELECT id, name FROM brands ORDER BY name";
                  $brand_result = $conn->query($brand_sql);
                  if ($brand_result && $brand_result->num_rows > 0) {
                    while($brand_row = $brand_result->fetch_assoc()) {
                      echo '<option value="'.$brand_row["id"].'">'.$brand_row["name"].'</option>';
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="col-md-6">
                <label for="main_image" class="form-label">Main Image</label>
                <input type="file" class="form-control" id="main_image" name="main_image">
                <div class="form-text">Recommended size: 800x800px</div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="original_price" class="form-label">Original Price*</label>
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" step="0.01" class="form-control" id="original_price" name="original_price" required>
                </div>
                <div class="invalid-feedback">Please enter the original price.</div>
              </div>
              <div class="col-md-6">
                <label for="discounted_price" class="form-label">Discounted Price</label>
                <div class="input-group">
                  <span class="input-group-text">$</span>
                  <input type="number" step="0.01" class="form-control" id="discounted_price" name="discounted_price">
                </div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-4">
                <label for="stock_quantity" class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="100">
              </div>
              <div class="col-md-4">
                <label for="weight" class="form-label">Weight</label>
                <input type="text" class="form-control" id="weight" name="weight" placeholder="e.g. 500g, 1kg">
              </div>
              <div class="col-md-4">
                <label for="color" class="form-label">Color</label>
                <input type="text" class="form-control" id="color" name="color">
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="type" class="form-label">Type</label>
                <input type="text" class="form-control" id="type" name="type" placeholder="e.g. Fruit, Vegetable">
              </div>
              <div class="col-md-6">
                <label for="sold_count" class="form-label">Sold Count</label>
                <input type="number" class="form-control" id="sold_count" name="sold_count" value="0">
              </div>
            </div>
            
            <div class="mb-3">
              <label for="features" class="form-label">Features</label>
              <textarea class="form-control" id="features" name="features" rows="3" placeholder="Enter features, one per line"></textarea>
              <div class="form-text">Enter each feature on a new line</div>
            </div>
            
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
              <label for="tags" class="form-label">Tags</label>
              <input type="text" class="form-control" id="tags" name="tags" placeholder="e.g. Organic, Fresh, Fruit">
              <div class="form-text">Separate tags with commas</div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1">
                  <label class="form-check-label" for="is_featured">Featured Product</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="is_new" name="is_new" value="1">
                  <label class="form-check-label" for="is_new">New Arrival</label>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="is_organic" name="is_organic" value="1">
                  <label class="form-check-label" for="is_organic">Organic Product</label>
                </div>
              </div>
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add Product</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../../Logics/admin-page.js"></script>
  
  <!-- Add this script for product management -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Handle delete product button clicks
      document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('delete-product')) {
          const productId = e.target.getAttribute('data-id');
          
          if (confirm('Are you sure you want to delete this product?')) {
            // Send AJAX request to delete the product
            fetch('../../../Backend/Products Management/delete_product.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: `product_id=${productId}`
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                // Remove the product row from the table
                e.target.closest('tr').remove();
                alert('Product deleted successfully!');
              } else {
                alert('Failed to delete product: ' + (data.message || 'Unknown error'));
              }
            })
            .catch(error => {
              console.error('Error:', error);
              alert('An error occurred while deleting the product.');
            });
          }
        }
      });
    });
  </script>
</body>
</html>
<?php
// Clear any session errors after displaying them
unset($_SESSION['errors']);
$conn->close();
?>