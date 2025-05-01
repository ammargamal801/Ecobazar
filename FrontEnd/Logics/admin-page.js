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
});