// Simple slider functionality
document.addEventListener('DOMContentLoaded', function() {
  // Slider elements
  const slides = document.querySelectorAll('.slide');
  const prevBtn = document.querySelector('.prev-slide');
  const nextBtn = document.querySelector('.next-slide');
  const indicators = document.querySelectorAll('.indicator');
  
  let currentSlide = 0;
  
  // Function to show a specific slide
  function showSlide(index) {
    // Remove active class from all slides
    slides.forEach(slide => slide.classList.remove('active'));
    indicators.forEach(indicator => indicator.classList.remove('active'));
    
    // Add active class to current slide
    slides[index].classList.add('active');
    indicators[index].classList.add('active');
    
    currentSlide = index;
  }
  
  // Event listeners for navigation
  prevBtn.addEventListener('click', () => {
    currentSlide = (currentSlide - 1 + slides.length) % slides.length;
    showSlide(currentSlide);
  });
  
  nextBtn.addEventListener('click', () => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
  });
  
  // Event listeners for indicators
  indicators.forEach((indicator, index) => {
    indicator.addEventListener('click', () => {
      showSlide(index);
    });
  });
  
  // Auto slide every 5 seconds
  setInterval(() => {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
  }, 5000);
});