document.querySelector('.filter-button').addEventListener('click', function () {
    document.querySelector('.filter-content').classList.toggle('active');
});

document.querySelectorAll('.section-title').forEach(title => {
    title.addEventListener('click', function () {
        this.querySelector('.chevron').classList.toggle('up');
        const content = this.nextElementSibling;
        content.style.display = content.style.display === 'none' ? 'block' : 'none';
    });
});

// Price slider functionality
document.addEventListener('DOMContentLoaded', function () {
    const minPrice = document.getElementById('min-price');
    const maxPrice = document.getElementById('max-price');
    const minValue = document.getElementById('min-value');
    const maxValue = document.getElementById('max-value');
    const range = document.querySelector('.slider-range');

    // Set initial positions of the range
    if (minPrice && maxPrice && range) {
        const minPercent = ((minPrice.value - minPrice.min) / (minPrice.max - minPrice.min)) * 100;
        const maxPercent = ((maxPrice.value - maxPrice.min) / (maxPrice.max - maxPrice.min)) * 100;

        range.style.left = minPercent + '%';
        range.style.width = (maxPercent - minPercent) + '%';

        // Update values and range when min slider changes
        minPrice.addEventListener('input', function () {
            // Prevent min from exceeding max
            if (parseInt(minPrice.value) > parseInt(maxPrice.value)) {
                minPrice.value = maxPrice.value;
            }

            minValue.textContent = minPrice.value;

            const minPercent = ((minPrice.value - minPrice.min) / (minPrice.max - minPrice.min)) * 100;
            const maxPercent = ((maxPrice.value - maxPrice.min) / (maxPrice.max - maxPrice.min)) * 100;

            range.style.left = minPercent + '%';
            range.style.width = (maxPercent - minPercent) + '%';
        });

        // Update values and range when max slider changes
        maxPrice.addEventListener('input', function () {
            // Prevent max from being less than min
            if (parseInt(maxPrice.value) < parseInt(minPrice.value)) {
                maxPrice.value = minPrice.value;
            }

            maxValue.textContent = maxPrice.value;

            const minPercent = ((minPrice.value - minPrice.min) / (minPrice.max - minPrice.min)) * 100;
            const maxPercent = ((maxPrice.value - maxPrice.min) / (maxPrice.max - maxPrice.min)) * 100;

            range.style.left = minPercent + '%';
            range.style.width = (maxPercent - minPercent) + '%';
        });
    }
});

// Function to update price filter and submit form
function updatePriceFilter() {
    const minPrice = document.getElementById('min-price').value;
    const maxPrice = document.getElementById('max-price').value;

    document.getElementById('min-value').textContent = minPrice;
    document.getElementById('max-value').textContent = maxPrice;

    // Update hidden inputs in form
    let minPriceInput = document.querySelector('input[name="min_price"]');
    let maxPriceInput = document.querySelector('input[name="max_price"]');

    minPriceInput.value = minPrice;
    maxPriceInput.value = maxPrice;

    // Submit form after a short delay to allow user to finish adjusting
    clearTimeout(window.priceUpdateTimeout);
    window.priceUpdateTimeout = setTimeout(() => {
        document.getElementById('filterForm').submit();
    }, 1000);
}

// Function to set rating filter
function setRatingFilter(rating) {
    // Uncheck all other rating checkboxes
    for (let i = 1; i <= 5; i++) {
        if (i !== rating) {
            document.getElementById('rating-' + i).checked = false;
        }
    }

    // Create or update hidden input for rating
    let ratingInput = document.querySelector('input[name="rating"]');
    if (!ratingInput) {
        ratingInput = document.createElement('input');
        ratingInput.type = 'hidden';
        ratingInput.name = 'rating';
        document.getElementById('filterForm').appendChild(ratingInput);
    }

    // If the clicked checkbox was already checked and is now unchecked, clear the filter
    const isChecked = document.getElementById('rating-' + rating).checked;
    ratingInput.value = isChecked ? rating : 0;

    document.getElementById('filterForm').submit();
}

// Function to toggle tag selection
function toggleTag(tag) {
    // Find if tag is already selected
    const tagInputs = document.querySelectorAll('input[name="tags[]"]');
    let tagExists = false;
    let tagIndex = -1;

    tagInputs.forEach((input, index) => {
        if (input.value === tag) {
            tagExists = true;
            tagIndex = index;
        }
    });

    if (tagExists) {
        // Remove tag if already selected
        tagInputs[tagIndex].remove();
    } else {
        // Add tag if not selected
        const tagInput = document.createElement('input');
        tagInput.type = 'hidden';
        tagInput.name = 'tags[]';
        tagInput.value = tag;
        document.getElementById('filterForm').appendChild(tagInput);
    }

    document.getElementById('filterForm').submit();
}

// Handle sort selection change
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.querySelector('.sort-select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            // Update the hidden sort input
            const sortInput = document.querySelector('input[name="sort"]');
            if (sortInput) {
                sortInput.value = this.value;
            } else {
                // Create a new input if it doesn't exist
                const newSortInput = document.createElement('input');
                newSortInput.type = 'hidden';
                newSortInput.name = 'sort';
                newSortInput.value = this.value;
                document.getElementById('filterForm').appendChild(newSortInput);
            }
            
            // Submit the form
            document.getElementById('filterForm').submit();
        });
    }
    
    // Set up wishlist functionality
    const wishlists = document.querySelectorAll('.wishlist');

    wishlists.forEach(item => {
        item.addEventListener('click', () => {
            const icon = item.querySelector('i');

            item.classList.toggle('active');

            if (item.classList.contains('active')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
            }
        });
    });
    
    // Set up add to cart buttons
    const addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-product-id');
            addToCart(productId);
        });
    });
});

// Function to add products to cart
function addToCart(productId) {
    // You can implement AJAX request to add product to cart
    console.log('Adding product ' + productId + ' to cart');
    
    // Example AJAX implementation
    /*
    fetch('add_to_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'product_id=' + productId
    })
    .then(response => response.json())
    .then(data => {
        if(data.success) {
            alert('Product added to cart!');
        } else {
            alert('Failed to add product to cart: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
    */
    
    // For now, just show an alert
    alert('Product added to cart!');
}