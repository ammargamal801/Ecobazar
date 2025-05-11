// script.js - Main JavaScript for Ecobazar Blog

document.addEventListener('DOMContentLoaded', function() {
    // 1. Image hover effects
    const blogImages = document.querySelectorAll('.img-fluid');
    blogImages.forEach(img => {
        img.classList.add('img-hover-effect');
        
        // Add click effect to images
        img.addEventListener('click', function() {
            this.classList.toggle('img-expanded');
        });
    });

    // 2. Load More Comments button functionality
    const loadMoreBtn = document.querySelector('.btn-outline-primary');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Simulate loading more comments (replace with actual AJAX call)
            const fakeComments = [
                {name: "New User", date: "Today", content: "This is a dynamically loaded comment!"}
            ];
            
            fakeComments.forEach(comment => {
                const commentDiv = document.createElement('div');
                commentDiv.className = 'comment mb-4';
                commentDiv.innerHTML = `
                    <div class="d-flex align-items-center mb-2">
                        <img src="https://randomuser.me/api/portraits/lego/5.jpg" class="comment-author-img" alt="${comment.name}">
                        <div>
                            <div class="d-flex justify-content-between">
                                <span class="comment-author fw-bold">${comment.name}</span>
                                <span class="comment-date text-muted small">${comment.date}</span>
                            </div>
                            <p class="mb-0 mt-1">${comment.content}</p>
                        </div>
                    </div>
                `;
                document.querySelector('.comments-section').insertBefore(commentDiv, loadMoreBtn);
            });
            
            // Disable button after "loading" all comments
            loadMoreBtn.textContent = "No More Comments";
            loadMoreBtn.disabled = true;
        });
    }

    // 3. Social media icon effects
    const socialIcons = document.querySelectorAll('.social-icons a');
    socialIcons.forEach(icon => {
        icon.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-3px)';
        });
        icon.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });

    // 4. Comment form validation
    const commentForm = document.querySelector('.comment-form form');
    if (commentForm) {
        commentForm.addEventListener('submit', function(e) {
            const emailInput = this.querySelector('input[type="email"]');
            const messageInput = this.querySelector('textarea');
            
            // Simple validation
            if (emailInput && !emailInput.value.includes('@')) {
                e.preventDefault();
                alert('Please enter a valid email address');
                emailInput.focus();
                return;
            }
            
            if (messageInput && messageInput.value.trim().length < 10) {
                e.preventDefault();
                alert('Please write a longer comment (minimum 10 characters)');
                messageInput.focus();
                return;
            }
            
            // If validation passes
            alert('Thank you for your comment!');
        });
    }

    // 5. Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });

    // 6. Add active class to current category
    const currentCategory = document.querySelector('.badge.bg-primary');
    if (currentCategory) {
        currentCategory.classList.add('active-category');
    }
});

// Function to test if JavaScript is working
function testJavaScript() {
    console.log('JavaScript is working correctly!');
    return true;
}

// Initialize test when window loads
window.onload = testJavaScript;