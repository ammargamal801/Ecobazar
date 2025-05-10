const filterButton = document.querySelector('.filter-button');
if (filterButton) {
    filterButton.addEventListener('click', function () {
        const filterContent = document.querySelector('.filter-content');
        if (filterContent) {
            filterContent.classList.toggle('active');
        }
    });
}

document.querySelectorAll('.section-title').forEach(title => {
    title.addEventListener('click', function () {
        const chevron = this.querySelector('.chevron');
        if (chevron) {
            chevron.classList.toggle('up');
        }
        const content = this.nextElementSibling;
        if (content) {
            content.style.display = content.style.display === 'none' ? 'block' : 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const minPrice = document.getElementById('min-price');
    const maxPrice = document.getElementById('max-price');
    const minValue = document.getElementById('min-value');
    const maxValue = document.getElementById('max-value');
    const range = document.querySelector('.slider-range');

    if (minPrice && maxPrice && range && minValue && maxValue) {
        const minPercent = ((minPrice.value - minPrice.min) / (minPrice.max - minPrice.min)) * 100;
        const maxPercent = ((maxPrice.value - maxPrice.min) / (maxPrice.max - maxPrice.min)) * 100;

        range.style.left = minPercent + '%';
        range.style.width = (maxPercent - minPercent) + '%';

        minPrice.addEventListener('input', function () {
            if (parseInt(minPrice.value) > parseInt(maxPrice.value)) {
                minPrice.value = maxPrice.value;
            }

            minValue.textContent = minPrice.value;

            const minPercent = ((minPrice.value - minPrice.min) / (minPrice.max - minPrice.min)) * 100;
            const maxPercent = ((maxPrice.value - maxPrice.min) / (maxPrice.max - maxPrice.min)) * 100;

            range.style.left = minPercent + '%';
            range.style.width = (maxPercent - minPercent) + '%';
        });

        maxPrice.addEventListener('input', function () {
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

function updatePriceFilter() {
    const minPrice = document.getElementById('min-price');
    const maxPrice = document.getElementById('max-price');
    const minValue = document.getElementById('min-value');
    const maxValue = document.getElementById('max-value');
    const filterForm = document.getElementById('filterForm');
    
    if (!minPrice || !maxPrice || !minValue || !maxValue || !filterForm) {
        return; 
    }

    minValue.textContent = minPrice.value;
    maxValue.textContent = maxPrice.value;

    let minPriceInput = document.querySelector('input[name="min_price"]');
    let maxPriceInput = document.querySelector('input[name="max_price"]');

    if (!minPriceInput) {
        minPriceInput = document.createElement('input');
        minPriceInput.type = 'hidden';
        minPriceInput.name = 'min_price';
        filterForm.appendChild(minPriceInput);
    }
    
    if (!maxPriceInput) {
        maxPriceInput = document.createElement('input');
        maxPriceInput.type = 'hidden';
        maxPriceInput.name = 'max_price';
        filterForm.appendChild(maxPriceInput);
    }

    minPriceInput.value = minPrice.value;
    maxPriceInput.value = maxPrice.value;

    clearTimeout(window.priceUpdateTimeout);
    window.priceUpdateTimeout = setTimeout(() => {
        filterForm.submit();
    }, 1000);
}

function setRatingFilter(rating) {
    const filterForm = document.getElementById('filterForm');
    if (!filterForm) return;
    
    // إلغاء تحديد جميع مربعات اختيار التقييم الأخرى
    for (let i = 1; i <= 5; i++) {
        const ratingCheckbox = document.getElementById('rating-' + i);
        if (ratingCheckbox && i !== rating) {
            ratingCheckbox.checked = false;
        }
    }

    let ratingInput = document.querySelector('input[name="rating"]');
    if (!ratingInput) {
        ratingInput = document.createElement('input');
        ratingInput.type = 'hidden';
        ratingInput.name = 'rating';
        filterForm.appendChild(ratingInput);
    }

    const ratingCheckbox = document.getElementById('rating-' + rating);
    const isChecked = ratingCheckbox ? ratingCheckbox.checked : false;
    ratingInput.value = isChecked ? rating : 0;

    filterForm.submit();
}

function toggleTag(tag) {
    const filterForm = document.getElementById('filterForm');
    if (!filterForm) return;
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
        tagInputs[tagIndex].remove();
    } else {
        const tagInput = document.createElement('input');
        tagInput.type = 'hidden';
        tagInput.name = 'tags[]';
        tagInput.value = tag;
        filterForm.appendChild(tagInput);
    }

    filterForm.submit();
}

document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.querySelector('.sort-select');
    const filterForm = document.getElementById('filterForm');
    
    if (sortSelect && filterForm) {
        sortSelect.addEventListener('change', function() {
           
            let sortInput = document.querySelector('input[name="sort"]');
            if (sortInput) {
                sortInput.value = this.value;
            } else {
                
                const newSortInput = document.createElement('input');
                newSortInput.type = 'hidden';
                newSortInput.name = 'sort';
                newSortInput.value = this.value;
                filterForm.appendChild(newSortInput);
            }
            
            filterForm.submit();
        });
    }
});

document.addEventListener('DOMContentLoaded', function() {
    
    const minPrice = document.getElementById('min-price');
    const maxPrice = document.getElementById('max-price');
    const applyPriceButton = document.getElementById('apply-price');
    
    if (minPrice && maxPrice) {
        minPrice.addEventListener('change', updatePriceFilter);
        maxPrice.addEventListener('change', updatePriceFilter);
    }
    
    if (applyPriceButton) {
        applyPriceButton.addEventListener('click', updatePriceFilter);
    }
});