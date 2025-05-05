/**
 * Ecobazar - Main JavaScript File
 * 
 * This file contains all the core functionality for the Ecobazar website
 * including navigation, mobile menu, cart functionality, and general utilities.
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all core functionality when DOM is fully loaded
    initMobileMenu();
    initCartFunctionality();
    initSearchFunctionality();
    initLocationSelector();
    initScrollToTop();
    initNewsletterForm();
    initTooltips();
});

/**
 * Initialize mobile menu functionality
 */
function initMobileMenu() {
    const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
    const mainNav = document.querySelector('.main-navigation');
    const mobileNavItems = document.querySelectorAll('.mobile-nav-item');
    
    if (mobileMenuBtn && mainNav) {
        mobileMenuBtn.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            this.classList.toggle('open');
        });
    }
    
    // Close mobile menu when clicking on a nav item
    mobileNavItems.forEach(item => {
        item.addEventListener('click', () => {
            if (mainNav) mainNav.classList.remove('active');
            if (mobileMenuBtn) mobileMenuBtn.classList.remove('open');
        });
    });
}

/**
 * Initialize cart functionality
 */
function initCartFunctionality() {
    const cartIcon = document.querySelector('.cart-icon');
    const cartCount = document.querySelector('.cart-count');
    const addToCartBtns = document.querySelectorAll('.add-to-cart, .add-to-cart-btn');
    
    // Load cart count from localStorage
    updateCartCount();
    
    // Add to cart functionality
    addToCartBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get product details (this would be dynamic in a real app)
            const productCard = this.closest('.product-card') || this.closest('.product-details');
            const productId = productCard ? productCard.dataset.productId || 'default-id' : 'default-id';
            const productName = productCard ? productCard.querySelector('.product-title').textContent : 'Organic Chinese Cabbage';
            const productPrice = productCard ? productCard.querySelector('.current-price').textContent : '$17.28';
            
            addToCart(productId, productName, productPrice);
            
            // Show added to cart notification
            showNotification(`${productName} added to cart!`);
        });
    });
    
    // Cart icon click event
    if (cartIcon) {
        cartIcon.addEventListener('click', function(e) {
            // In a real app, this would open a cart dropdown or navigate to cart page
            e.preventDefault();
            window.location.href = 'cart.html';
        });
    }
}

/**
 * Add item to cart (simplified for demo)
 */
function addToCart(productId, productName, productPrice) {
    // Get current cart from localStorage
    let cart = JSON.parse(localStorage.getItem('ecobazar-cart')) || [];
    
    // Check if product already in cart
    const existingItem = cart.find(item => item.id === productId);
    
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({
            id: productId,
            name: productName,
            price: productPrice,
            quantity: 1
        });
    }
    
    // Save back to localStorage
    localStorage.setItem('ecobazar-cart', JSON.stringify(cart));
    
    // Update cart count display
    updateCartCount();
}

/**
 * Update cart count in header
 */
function updateCartCount() {
    const cartCountElements = document.querySelectorAll('.cart-count');
    const cart = JSON.parse(localStorage.getItem('ecobazar-cart')) || [];
    
    // Calculate total quantity
    const totalQuantity = cart.reduce((total, item) => total + item.quantity, 0);
    
    // Update all cart count elements
    cartCountElements.forEach(element => {
        element.textContent = totalQuantity;
        element.style.display = totalQuantity > 0 ? 'flex' : 'none';
    });
}

/**
 * Initialize search functionality
 */
function initSearchFunctionality() {
    const searchForm = document.querySelector('.search-form');
    
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const searchInput = this.querySelector('.search-input');
            const searchTerm = searchInput.value.trim();
            
            if (searchTerm) {
                // In a real app, this would trigger a search
                console.log('Searching for:', searchTerm);
                // For demo, just show a notification
                showNotification(`Searching for "${searchTerm}"`);
                
                // Clear the input
                searchInput.value = '';
            }
        });
    }
}

/**
 * Initialize location selector
 */
function initLocationSelector() {
    const locationSelector = document.querySelector('.location-selector select');
    
    if (locationSelector) {
        locationSelector.addEventListener('change', function() {
            const selectedLocation = this.value;
            showNotification(`Location changed to ${selectedLocation}`);
            
            // In a real app, this would update location-based content
            localStorage.setItem('selected-location', selectedLocation);
        });
        
        // Load saved location if exists
        const savedLocation = localStorage.getItem('selected-location');
        if (savedLocation) {
            locationSelector.value = savedLocation;
        }
    }
}

/**
 * Initialize scroll to top button
 */
function initScrollToTop() {
    const scrollToTopBtn = document.createElement('div');
    scrollToTopBtn.className = 'scroll-to-top';
    scrollToTopBtn.innerHTML = '<i class="fas fa-chevron-up"></i>';
    document.body.appendChild(scrollToTopBtn);
    
    // Show/hide button based on scroll position
    window.addEventListener('scroll', function() {
        if (window.pageYOffset > 300) {
            scrollToTopBtn.classList.add('show');
        } else {
            scrollToTopBtn.classList.remove('show');
        }
    });
    
    // Scroll to top when clicked
    scrollToTopBtn.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

/**
 * Initialize newsletter form
 */
function initNewsletterForm() {
    const newsletterForm = document.querySelector('.newsletter-form');
    
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = this.querySelector('input[type="email"]');
            const email = emailInput.value.trim();
            
            if (validateEmail(email)) {
                // In a real app, this would submit to a server
                console.log('Subscribing email:', email);
                showNotification('Thank you for subscribing!');
                emailInput.value = '';
            } else {
                showNotification('Please enter a valid email address', 'error');
            }
        });
    }
}

/**
 * Initialize tooltips
 */
function initTooltips() {
    const tooltipElements = document.querySelectorAll('[title]');
    
    tooltipElements.forEach(element => {
        const tooltipText = element.getAttribute('title');
        element.removeAttribute('title');
        
        const tooltip = document.createElement('span');
        tooltip.className = 'tooltip';
        tooltip.textContent = tooltipText;
        element.appendChild(tooltip);
        
        element.addEventListener('mouseenter', function() {
            tooltip.classList.add('visible');
        });
        
        element.addEventListener('mouseleave', function() {
            tooltip.classList.remove('visible');
        });
    });
}

/**
 * Show notification message
 */
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    // Show notification
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    // Hide after 3 seconds
    setTimeout(() => {
        notification.classList.remove('show');
        
        // Remove after animation completes
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

/**
 * Validate email address
 */
function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

/**
 * Debounce function for performance optimization
 */
function debounce(func, wait) {
    let timeout;
    return function() {
        const context = this, args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            func.apply(context, args);
        }, wait);
    };
}

// Export functions for use in other modules if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        addToCart,
        updateCartCount,
        showNotification,
        validateEmail
    };
}