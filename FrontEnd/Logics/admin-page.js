document.addEventListener('DOMContentLoaded', () => {
  // Example: Update total users dynamically (mock data)
  const totalUsersElement = document.getElementById('total-users');
  const totalSalesElement = document.getElementById('total-sales');
  const totalProductsElement = document.getElementById('total-products');

  // Mock dynamic data
  const totalUsers = 150;
  const totalSales = 20000;
  const totalProducts = 350;

  // Update UI
  totalUsersElement.textContent = totalUsers;
  totalSalesElement.textContent = `EG 20000`;
  totalProductsElement.textContent = totalProducts;

  // toggele between items without reload the page
  const btns = document.querySelectorAll('.nav-link');
  btns.forEach((btn , idx) => {
    btn.addEventListener('click' , () => {
      const details = document.querySelectorAll('.btn-details');

      btns.forEach(btn => {
        btn.classList.remove('active');
      });
      btn.classList.add('active');

      details.forEach(detail => {
        detail.classList.remove('active');
    });

    details[idx].classList.add('active');
    });
  });
  
  // Form validation
  const forms = document.querySelectorAll('.needs-validation');
  
  Array.from(forms).forEach(form => {
    form.addEventListener('submit', event => {
      if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
      }
      
      form.classList.add('was-validated');
    }, false);
  });
  
  // Preview image when selected
  const imageInput = document.getElementById('main_image');
  if (imageInput) {
    imageInput.addEventListener('change', function() {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          // You could add an image preview element here if needed
          console.log('Image selected:', e.target.result);
        }
        reader.readAsDataURL(file);
      }
    });
  }
  
  // Validate discounted price is less than original price
  const originalPriceInput = document.getElementById('original_price');
  const discountedPriceInput = document.getElementById('discounted_price');
  
  if (discountedPriceInput && originalPriceInput) {
    discountedPriceInput.addEventListener('input', function() {
      const originalPrice = parseFloat(originalPriceInput.value);
      const discountedPrice = parseFloat(this.value);
      
      if (discountedPrice >= originalPrice) {
        this.setCustomValidity('Discounted price must be less than original price');
      } else {
        this.setCustomValidity('');
      }
    });
  }
  
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
            alert('Failed to delete product: ' + data.message);
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