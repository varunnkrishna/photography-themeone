// Main JavaScript file for Photo Portfolio theme

document.addEventListener('DOMContentLoaded', function() {
    // Navbar scroll effect
    const header = document.querySelector('header');
    let lastScroll = 0;

    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 50) {
            header.classList.add('scrolled');
            header.classList.remove('top-5');
            header.classList.add('top-0');
        } else {
            header.classList.remove('scrolled');
            header.classList.remove('top-0');
            header.classList.add('top-5');
        }

        lastScroll = currentScroll;
    });

    // Mobile menu toggle
    const mobileMenuBtn = document.querySelector('button[aria-label="Toggle Menu"]');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            const isExpanded = mobileMenuBtn.getAttribute('aria-expanded') === 'true';
            mobileMenuBtn.setAttribute('aria-expanded', !isExpanded);
            
            // Toggle menu visibility
            mobileMenu.classList.toggle('hidden');
            
            // Update menu icon
            const menuIcon = mobileMenuBtn.querySelector('svg');
            if (!isExpanded) {
                menuIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                `;
            } else {
                menuIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                `;
            }
        });

        // Close mobile menu on window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { // md breakpoint
                mobileMenu.classList.add('hidden');
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
                const menuIcon = mobileMenuBtn.querySelector('svg');
                menuIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                `;
            }
        });
    }

    // Image gallery lightbox (basic implementation)
    const galleryImages = document.querySelectorAll('.gallery-grid img');
    
    galleryImages.forEach(image => {
        image.addEventListener('click', function() {
            // Add your lightbox implementation here
            console.log('Image clicked:', this.src);
        });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});
