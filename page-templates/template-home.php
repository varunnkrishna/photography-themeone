<?php
/**
 * Template Name: Home Page
 * 
 * This is the template that displays the home page.
 */

get_header();

// Get slider settings
$settings = photo_portfolio_get_slider_settings();
$slides = photo_portfolio_get_hero_slides();
?>

<main>
    <!-- Hero Section -->
    <div class="relative w-full h-screen">
        <section id="hero-slider" class="absolute inset-0" 
                 data-autoplay="<?php echo esc_attr($settings['autoplay'] ? 'true' : 'false'); ?>"
                 data-autoplay-speed="<?php echo esc_attr($settings['autoplay_speed']); ?>">
            
            <!-- Slides Container -->
            <div class="slides-container relative h-full">
                <?php foreach ($slides as $index => $slide): ?>
                    <div class="slide absolute inset-0 <?php echo $index === 0 ? 'active' : ''; ?> transition-opacity duration-1000">
                        <!-- Background Image -->
                        <div class="absolute inset-0">
                            <?php if ($slide['image']): ?>
                                <img src="<?php echo esc_url($slide['image']); ?>" 
                                     alt="<?php echo esc_attr($slide['title']); ?>"
                                     class="w-full h-full object-cover">
                            <?php endif; ?>
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black/80"></div>
                        </div>
                        
                        <!-- Slide Content -->
                        <div class="relative h-full flex items-center justify-center text-center text-white px-4">
                            <div class="max-w-3xl mx-auto">
                                <?php if ($slide['title']): ?>
                                    <h2 class="font-secondary text-4xl md:text-5xl lg:text-6xl mb-6 opacity-0 translate-y-8 transition-all duration-1000 delay-300">
                                        <?php echo esc_html($slide['title']); ?>
                                    </h2>
                                <?php endif; ?>
                                
                                <?php if ($slide['description']): ?>
                                    <p class="text-lg md:text-xl text-white/90 mb-8 opacity-0 translate-y-8 transition-all duration-1000 delay-500">
                                        <?php echo esc_html($slide['description']); ?>
                                    </p>
                                <?php endif; ?>
                                
                                <?php if ($slide['button_text'] && $slide['button_url']): ?>
                                    <a href="<?php echo esc_url($slide['button_url']); ?>" 
                                       class="inline-block px-8 py-3 bg-white text-gray-900 rounded-lg hover:bg-gray-100 
                                              transition-all duration-300 opacity-0 translate-y-8 delay-700">
                                        <?php echo esc_html($slide['button_text']); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Navigation Arrows -->
            <button class="slider-nav prev absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 
                         bg-white/10 hover:bg-white/20 backdrop-blur rounded-full 
                         flex items-center justify-center transition-all duration-300 
                         border border-white/10 hover:border-white/20 group z-20"
                    aria-label="Previous slide">
                <svg class="w-6 h-6 text-white transform transition-transform duration-300 group-hover:-translate-x-0.5" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            
            <button class="slider-nav next absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 
                         bg-white/10 hover:bg-white/20 backdrop-blur rounded-full 
                         flex items-center justify-center transition-all duration-300 
                         border border-white/10 hover:border-white/20 group z-20"
                    aria-label="Next slide">
                <svg class="w-6 h-6 text-white transform transition-transform duration-300 group-hover:translate-x-0.5" 
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </section>
    </div>

    <!-- Mission Statement Section -->
    <section class="bg-background-alt py-32 md:py-40">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-secondary text-3xl md:text-4xl lg:text-5xl text-text text-center mb-16">
                    Capturing Life's Beautiful Moments
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
                    <!-- Feature 1 -->
                    <div class="text-center">
                        <div class="mb-6">
                            <svg class="w-12 h-12 mx-auto text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                      d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                      d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Professional Equipment</h3>
                        <p class="text-text-secondary">Using top-of-the-line cameras and lenses to ensure the highest quality photos.</p>
                    </div>
                    
                    <!-- Feature 2 -->
                    <div class="text-center">
                        <div class="mb-6">
                            <svg class="w-12 h-12 mx-auto text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Passion for Photography</h3>
                        <p class="text-text-secondary">Dedicated to capturing authentic moments and creating timeless memories.</p>
                    </div>
                    
                    <!-- Feature 3 -->
                    <div class="text-center">
                        <div class="mb-6">
                            <svg class="w-12 h-12 mx-auto text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" 
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">Quick Turnaround</h3>
                        <p class="text-text-secondary">Fast delivery of your edited photos without compromising on quality.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-background-alt py-24 md:py-32">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-secondary text-3xl md:text-4xl lg:text-5xl text-text text-center mb-16">Client Love Notes</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Testimonial 1 -->
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?php echo get_theme_file_uri('assets/images/testimonial-1.jpg'); ?>" 
                                     alt="Sarah Johnson" 
                                     class="w-12 h-12 rounded-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold">Sarah Johnson</h3>
                                <p class="text-sm text-text-secondary">Wedding Photography</p>
                            </div>
                        </div>
                        <p class="text-text-secondary">"Absolutely amazing! Captured our special day perfectly. The photos are beyond what we could have imagined."</p>
                    </div>
                    
                    <!-- Testimonial 2 -->
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?php echo get_theme_file_uri('assets/images/testimonial-2.jpg'); ?>" 
                                     alt="Michael Smith" 
                                     class="w-12 h-12 rounded-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold">Michael Smith</h3>
                                <p class="text-sm text-text-secondary">Family Portrait</p>
                            </div>
                        </div>
                        <p class="text-text-secondary">"Professional, patient with kids, and delivered stunning family photos. Will definitely book again!"</p>
                    </div>
                    
                    <!-- Testimonial 3 -->
                    <div class="bg-white p-8 rounded-lg shadow-lg">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <img src="<?php echo get_theme_file_uri('assets/images/testimonial-3.jpg'); ?>" 
                                     alt="Emily Davis" 
                                     class="w-12 h-12 rounded-full object-cover">
                            </div>
                            <div class="ml-4">
                                <h3 class="font-bold">Emily Davis</h3>
                                <p class="text-sm text-text-secondary">Corporate Event</p>
                            </div>
                        </div>
                        <p class="text-text-secondary">"Excellent work at our corporate event. Captured all the key moments without being intrusive."</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
