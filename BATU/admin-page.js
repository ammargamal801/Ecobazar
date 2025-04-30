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
  });