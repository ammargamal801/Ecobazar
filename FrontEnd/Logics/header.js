document.addEventListener('DOMContentLoaded', function() {
    const searchIcon = document.getElementById('searchIcon');
    const searchBox = document.getElementById('searchBox');

    // Toggle search box visibility when search icon is clicked
    searchIcon.addEventListener('click', function(event) {
        event.preventDefault();
        if (searchBox.style.display === 'none' || searchBox.style.display === '') {
            searchBox.style.display = 'block';
        } else {
            searchBox.style.display = 'none';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.getElementById('darkModeToggle');
    const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
    const currentTheme = localStorage.getItem('theme');
    
    // Apply theme based on user preference or system setting
    function applyTheme(isDark) {
        document.body.classList.toggle('dark-mode', isDark);
        // Update icon based on current theme
        darkModeToggle.innerHTML = isDark ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon"></i>';
        
        // Update hover colors for all links and icons
        const hoverElements = document.querySelectorAll('a, .bi');
        hoverElements.forEach(el => {
            if (el.classList.contains('dark-mode-toggle')) return;
            el.style.setProperty('--hover-color', isDark ? 'var(--light-green)' : 'var(--light-green)');
        });
        
        // Update login button styles
        const loginButtons = document.querySelectorAll('.btn-login');
        loginButtons.forEach(btn => {
            if (isDark) {
                btn.style.backgroundColor = 'var(--light-green)';
                btn.style.color = 'var(--black-text-color)';
            } else {
                btn.style.backgroundColor = 'var(--green-text)';
                btn.style.color = 'white';
            }
        });
    }
    
    // Initialize theme based on saved preference or system setting
    if (currentTheme === 'dark' || (!currentTheme && prefersDarkScheme.matches)) {
        applyTheme(true);
    } else {
        applyTheme(false);
    }
    
    // Toggle theme when dark mode button is clicked
    darkModeToggle.addEventListener('click', function() {
        const isDark = !document.body.classList.contains('dark-mode');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        applyTheme(isDark);
    });
});