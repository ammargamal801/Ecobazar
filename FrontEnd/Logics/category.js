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
// //////////////////////////
document.addEventListener('DOMContentLoaded', function () {
    const minPrice = document.getElementById('min-price');
    const maxPrice = document.getElementById('max-price');
    const minValue = document.getElementById('min-value');
    const maxValue = document.getElementById('max-value');
    const range = document.querySelector('.slider-range');
    const priceHeader = document.querySelector('.price-header');
    const priceFilter = document.querySelector('.price-filter');

    // Set initial positions of the range
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

    // Toggle collapse functionality
    priceHeader.addEventListener('click', function () {
        priceFilter.classList.toggle('collapsed');
    });
});
// ////////////////////////////////////////////////////////
document.addEventListener('DOMContentLoaded', () => {
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
});
