
document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const mainNav = document.querySelector('.main-nav');
    
    mobileMenuBtn.addEventListener('click', function() {
        mainNav.style.display = mainNav.style.display === 'block' ? 'none' : 'block';
    });
    
    // Update cart count (example)
    function updateCartCount() {
        const cartCount = document.querySelector('.cart-count');
        // يمكنك استبدال هذا الرقم ببيانات حقيقية من السلة
        cartCount.textContent = '3';
    }
    
    updateCartCount();
    
    // Window resize handler
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            mainNav.style.display = 'block';
        } else {
            mainNav.style.display = 'none';
        }
    });
});  
    // Handle window resize to show/hide mobile menu appropriately
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            mainNav.style.display = 'flex';
        } else {
            mainNav.style.display = 'none';
        }
    });
    
    // Tab Switching Functionality
    const tabNavItems = document.querySelectorAll('.tab-nav li');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    tabNavItems.forEach(item => {
        item.addEventListener('click', function() {
            // Remove active class from all tabs and panes
            tabNavItems.forEach(tab => tab.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));
            
            // Add active class to clicked tab
            this.classList.add('active');
            
            // Show corresponding pane
            const targetPaneId = this.querySelector('a').getAttribute('href').substring(1);
            document.getElementById(targetPaneId).classList.add('active');
        });
    });
    // Add this to your existing script.js file or create a new one
document.addEventListener('DOMContentLoaded', function() {
    // Related Products functionality
    const productCards = document.querySelectorAll('.related-products-grid .product-card');
    
    productCards.forEach(card => {
      // Make entire card clickable (except the add to cart button)
      card.addEventListener('click', function(e) {
        // Don't navigate if clicking on the add to cart button
        if (!e.target.classList.contains('add-to-cart-btn')) {
          // In a real implementation, this would navigate to the product page
          console.log('Navigating to product: ' + this.querySelector('.product-title').textContent);
          // window.location.href = '/product-detail.html';
        }
      });
      
      // Add to cart button functionality
      const addToCartBtn = card.querySelector('.add-to-cart-btn');
      addToCartBtn.addEventListener('click', function(e) {
        e.stopPropagation(); // Prevent the card click event from firing
        
        const productName = card.querySelector('.product-title').textContent;
        const productPrice = card.querySelector('.current-price').textContent;
        
        // Here you would typically add the product to the cart
        // For this demo, we'll just show an alert
        alert(`${productName} (${productPrice}) has been added to your cart!`);
        
        // Visual feedback
        this.textContent = 'Added!';
        this.style.backgroundColor = '#388E3C';
        
        setTimeout(() => {
          this.textContent = 'Add to Cart';
          this.style.backgroundColor = '#4CAF50';
        }, 2000);
      });
      
      // Hover effects
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px)';
        this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.15)';
      });
      
      card.addEventListener('mouseleave', function() {
        this.style.transform = '';
        this.style.boxShadow = '0 3px 10px rgba(0, 0, 0, 0.1)';
      });
    });
  });
    
    // Add to Cart Button Functionality
    const addToCartBtn = document.querySelector('.btn-add-to-cart');
    
    addToCartBtn.addEventListener('click', function() {
        // Here you would typically add the product to the cart
        // For this demo, we'll just show an alert
        alert('Chinese Cabbage has been added to your cart!');
        
        // You could also add animation or other feedback
        this.textContent = 'Added to Cart!';
        this.style.backgroundColor = '#388E3C';
        
        setTimeout(() => {
            this.textContent = 'Add to Cart';
            this.style.backgroundColor = '#4CAF50';
        }, 2000);
    });
    
    // Load More Reviews Functionality
    const loadMoreBtn = document.querySelector('.btn-load-more');
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // In a real implementation, this would fetch more reviews from the server
            // For this demo, we'll just simulate loading more reviews
            const reviewsContainer = document.querySelector('#customer-feedback');
            
            // Create a new review element
            const newReview = document.createElement('div');
            newReview.className = 'review';
            newReview.innerHTML = `
                <div class="review-header">
                    <h4>New Customer</h4>
                    <span class="review-time">Just now</span>
                </div>
                <p>This is an additional review loaded dynamically. In a real implementation, this would come from your database.</p>
            `;
            
            // Insert before the load more button
            reviewsContainer.insertBefore(newReview, loadMoreBtn);
        });
    }
    
    // Newsletter Form Submission
    const newsletterForm = document.querySelector('.newsletter-form');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value;
            
            // Here you would typically send the email to your server
            // For this demo, we'll just show an alert
            alert(`Thank you for subscribing with ${email}!`);
            emailInput.value = '';
        });
    }
    
    // Product Card Hover Effects
    const productCards = document.querySelectorAll('.product-card');
    
    productCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
        
        // Make entire card clickable (in a real implementation, this would go to the product page)
        card.addEventListener('click', function() {
            // window.location.href = '/product-page.html';
            console.log('Navigating to product page');
        });
    });
