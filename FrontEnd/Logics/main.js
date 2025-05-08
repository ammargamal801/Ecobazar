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