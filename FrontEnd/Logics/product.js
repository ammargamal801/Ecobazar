/**
 * Ecobazar - Product Page JavaScript
 * 
 * This file contains all the product-specific functionality including:
 * - Product image gallery
 * - Quantity selector
 * - Product tabs
 * - Review form
 * - Related products
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize all product page functionality
    initProductGallery();
    initQuantitySelector();
    initProductTabs();
    initReviewForm();
    initRelatedProducts();
    initWishlistFunctionality();
});

/**
 * Initialize product image gallery
 */
function initProductGallery() {
    const mainImage = document.querySelector('.main-image img');
    const thumbnails = document.querySelectorAll('.thumbnail');
    
    if (thumbnails.length > 0) {
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                // Remove active class from all thumbnails
                thumbnails.forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked thumbnail
                this.classList.add('active');
                
                // Update main image
                const newImageSrc = this.querySelector('img').src;
                mainImage.src = newImageSrc;
                
                // Add fade effect
                mainImage.style.opacity = 0;
                setTimeout(() => {
                    mainImage.style.opacity = 1;
                }, 100);
            });
        });
    }
}

/**
 * Initialize quantity selector
 */
function initQuantitySelector() {
    const minusBtn = document.querySelector('.quantity-selector .minus');
    const plusBtn = document.querySelector('.quantity-selector .plus');
    const qtyInput = document.querySelector('.quantity-selector .qty-input');
    
    if (minusBtn && plusBtn && qtyInput) {
        minusBtn.addEventListener('click', function() {
            let currentValue = parseInt(qtyInput.value);
            if (currentValue > parseInt(qtyInput.min)) {
                qtyInput.value = currentValue - 1;
            }
        });
        
        plusBtn.addEventListener('click', function() {
            let currentValue = parseInt(qtyInput.value);
            if (currentValue < parseInt(qtyInput.max)) {
                qtyInput.value = currentValue + 1;
            }
        });
        
        // Validate input
        qtyInput.addEventListener('change', function() {
            let value = parseInt(this.value);
            const min = parseInt(this.min);
            const max = parseInt(this.max);
            
            if (isNaN(value)) value = min;
            if (value < min) value = min;
            if (value > max) value = max;
            
            this.value = value;
        });
    }
}

/**
 * Initialize product tabs
 */
function initProductTabs() {
    const tabNavItems = document.querySelectorAll('.product-tabs-nav li');
    const tabPanes = document.querySelectorAll('.tab-pane');
    
    if (tabNavItems.length > 0) {
        tabNavItems.forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Remove active class from all nav items
                tabNavItems.forEach(i => i.classList.remove('active'));
                
                // Add active class to clicked item
                this.classList.add('active');
                
                // Hide all tab panes
                tabPanes.forEach(pane => pane.classList.remove('active'));
                
                // Show corresponding tab pane
                const targetPaneId = this.querySelector('a').getAttribute('href');
                const targetPane = document.querySelector(targetPaneId);
                if (targetPane) targetPane.classList.add('active');
            });
        });
        
        // Activate first tab by default
        if (tabNavItems[0]) tabNavItems[0].click();
    }
}

/**
 * Initialize review form
 */
function initReviewForm() {
    const reviewForm = document.querySelector('.review-form');
    
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const rating = this.querySelector('input[name="rating"]:checked');
            const title = this.querySelector('#review-title').value.trim();
            const text = this.querySelector('#review-text').value.trim();
            
            if (!rating) {
                showNotification('Please select a rating', 'error');
                return;
            }
            
            if (!title || !text) {
                showNotification('Please fill in all fields', 'error');
                return;
            }
            
            // In a real app, this would submit to a server
            console.log('Submitting review:', { rating: rating.value, title, text });
            showNotification('Thank you for your review!');
            
            // Reset form
            this.reset();
        });
        
        // Star rating hover effect
        const starInputs = reviewForm.querySelectorAll('.rating-input input');
        const starLabels = reviewForm.querySelectorAll('.rating-input label');
        
        starLabels.forEach(label => {
            label.addEventListener('mouseover', function() {
                const starValue = parseInt(this.previousElementSibling.value);
                highlightStars(starValue);
            });
            
            label.addEventListener('mouseout', function() {
                const checkedStar = reviewForm.querySelector('input[name="rating"]:checked');
                if (checkedStar) {
                    highlightStars(parseInt(checkedStar.value));
                } else {
                    resetStars();
                }
            });
        });
    }
}

/**
 * Highlight stars up to the specified value
 */
function highlightStars(value) {
    const stars = document.querySelectorAll('.rating-input label');
    stars.forEach((star, index) => {
        if (index < value) {
            star.style.color = '#FF9800'; // Orange color for active stars
        } else {
            star.style.color = '#e0e0e0'; // Gray color for inactive stars
        }
    });
}

/**
 * Reset stars to default state
 */
function resetStars() {
    const stars = document.querySelectorAll('.rating-input label');
    stars.forEach(star => {
        star.style.color = '#e0e0e0';
    });
}

/**
 * Initialize related products carousel
 */
function initRelatedProducts() {
    const relatedProducts = document.querySelector('.products-grid');
    
    if (relatedProducts) {
        // In a real app, this would be a proper carousel/slider
        // For now, just add hover effects
        
        const productCards = relatedProducts.querySelectorAll('.product-card');
        
        productCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                const img = this.querySelector('.product-image img');
                if (img) {
                    img.style.transform = 'scale(1.05)';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                const img = this.querySelector('.product-image img');
                if (img) {
                    img.style.transform = 'scale(1)';
                }
            });
        });
    }
}

/**
 * Initialize wishlist functionality
 */
function initWishlistFunctionality() {
    const wishlistIcons = document.querySelectorAll('.wishlist-icon, .wishlist-btn, .add-to-wishlist');
    const wishlistCount = document.querySelector('.wishlist-count');
    
    // Load wishlist count from localStorage
    updateWishlistCount();
    
    wishlistIcons.forEach(icon => {
        icon.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const productCard = this.closest('.product-card') || document.querySelector('.product-details');
            const productId = productCard ? productCard.dataset.productId || 'default-id' : 'default-id';
            const productName = productCard ? productCard.querySelector('.product-title').textContent : 'Organic Chinese Cabbage';
            
            toggleWishlistItem(productId, productName);
            
            // Toggle active class for visual feedback
            if (this.classList.contains('far')) {
                this.classList.remove('far');
                this.classList.add('fas', 'active');
            } else {
                this.classList.remove('fas', 'active');
                this.classList.add('far');
            }
        });
    });
}

/**
 * Toggle item in wishlist
 */
function toggleWishlistItem(productId, productName) {
    let wishlist = JSON.parse(localStorage.getItem('ecobazar-wishlist')) || [];
    
    const itemIndex = wishlist.findIndex(item => item.id === productId);
    
    if (itemIndex > -1) {
        // Remove from wishlist
        wishlist.splice(itemIndex, 1);
        showNotification(`${productName} removed from wishlist`);
    } else {
        // Add to wishlist
        wishlist.push({
            id: productId,
            name: productName,
            date: new Date().toISOString()
        });
        showNotification(`${productName} added to wishlist`);
    }
    
    localStorage.setItem('ecobazar-wishlist', JSON.stringify(wishlist));
    updateWishlistCount();
}

/**
 * Update wishlist count in header
 */
function updateWishlistCount() {
    const wishlistCountElements = document.querySelectorAll('.wishlist-count');
    const wishlist = JSON.parse(localStorage.getItem('ecobazar-wishlist')) || [];
    
    // Update all wishlist count elements
    wishlistCountElements.forEach(element => {
        element.textContent = wishlist.length;
        element.style.display = wishlist.length > 0 ? 'flex' : 'none';
    });
}

// Export functions for testing if needed
if (typeof module !== 'undefined' && module.exports) {
    module.exports = {
        initProductGallery,
        initQuantitySelector,
        initProductTabs,
        initReviewForm,
        toggleWishlistItem,
        updateWishlistCount
    };
}