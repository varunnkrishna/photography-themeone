jQuery(document).ready(function($) {
    console.log('Slider script loaded');

    // Get slider elements
    const slider = document.getElementById('hero-slider');
    if (!slider) {
        console.error('Hero slider not found');
        return;
    }

    // Get slider settings
    const autoplay = slider.dataset.autoplay === 'true';
    const autoplaySpeed = parseInt(slider.dataset.autoplaySpeed) || 5000;

    const slides = slider.querySelectorAll('.slide');
    const indicators = slider.querySelectorAll('.slide-indicator');
    const prevBtn = slider.querySelector('.slider-nav.prev');
    const nextBtn = slider.querySelector('.slider-nav.next');

    let currentSlide = 0;
    let autoplayInterval = null;

    // Functions
    function goToSlide(index) {
        // Remove active class from all slides and indicators
        slides.forEach(slide => {
            slide.classList.remove('active');
            slide.style.opacity = '0';
            slide.style.visibility = 'hidden';
        });
        indicators.forEach(indicator => {
            indicator.classList.remove('active', 'w-16');
            indicator.classList.add('w-10');
        });

        // Add active class to current slide and indicator
        slides[index].classList.add('active');
        slides[index].style.opacity = '1';
        slides[index].style.visibility = 'visible';
        indicators[index].classList.add('active', 'w-16');
        indicators[index].classList.remove('w-10');

        currentSlide = index;
    }

    function nextSlide() {
        goToSlide((currentSlide + 1) % slides.length);
    }

    function prevSlide() {
        goToSlide((currentSlide - 1 + slides.length) % slides.length);
    }

    function startAutoplay() {
        if (autoplay && !autoplayInterval) {
            autoplayInterval = setInterval(nextSlide, autoplaySpeed);
        }
    }

    function stopAutoplay() {
        if (autoplayInterval) {
            clearInterval(autoplayInterval);
            autoplayInterval = null;
        }
    }

    // Add styles for transitions
    slides.forEach(slide => {
        slide.style.transition = 'opacity 0.5s ease-in-out';
        slide.style.opacity = '0';
        slide.style.visibility = 'hidden';
    });

    // Show first slide
    goToSlide(0);

    // Event Listeners
    prevBtn.addEventListener('click', function(e) {
        e.preventDefault();
        stopAutoplay();
        prevSlide();
    });

    nextBtn.addEventListener('click', function(e) {
        e.preventDefault();
        stopAutoplay();
        nextSlide();
    });

    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function(e) {
            e.preventDefault();
            stopAutoplay();
            goToSlide(index);
        });
    });

    // Start autoplay if enabled
    startAutoplay();

    // Handle visibility change
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            stopAutoplay();
        } else {
            startAutoplay();
        }
    });
});
