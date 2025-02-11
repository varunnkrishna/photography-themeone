<?php
/**
 * The template for displaying the front page
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
            <div class="relative w-full h-full">
                <!-- Slides -->
                <?php foreach ($slides as $index => $slide) :
                    $isActive = $index === 0 ? 'active' : '';
                ?>
                <div id="slide<?php echo $index + 1; ?>" class="slide <?php echo $isActive; ?> absolute inset-0">
                    <!-- Background Image with Overlay -->
                    <div class="absolute inset-0">
                        <img src="<?php echo esc_url($slide['image']); ?>" 
                             alt="<?php echo esc_attr($slide['title']); ?>" 
                             class="w-full h-full object-cover">
                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/60"></div>
                    </div>
                    
                    <!-- Content Container -->
                    <div class="absolute inset-0 flex items-end pb-20 md:pb-32 z-10">
                        <div class="container mx-auto px-4 md:px-8"> 
                            
                            <!-- Two Column Layout -->
                            <div class="flex flex-col md:flex-row justify-between items-end gap-8 md:gap-12 backdrop-blur-sm bg-black/20 rounded-lg p-8 md:p-12">
                                <!-- Left Column - Brand -->
                                <div class="md:max-w-md">
                                    <h1 class="font-secondary text-white/90 text-3xl md:text-5xl lg:text-6xl tracking-tight drop-shadow-lg mb-6">
                                        <?php echo esc_html($slide['title']); ?>
                                    </h1>
                                    <p class="font-nav text-white/80 text-sm md:text-base tracking-widest uppercase mb-6">
                                        <?php echo esc_html($slide['subtitle']); ?>
                                    </p>
                                </div>

                                <!-- Right Column - Stats -->
                                <div class="space-y-4 text-right">
                                    <div class="font-nav tracking-widest">
                                        <p class="text-white/90 text-sm md:text-base mb-1">FEATURED IN</p>
                                        <p class="text-white text-lg md:text-xl font-bold">VOGUE & NATIONAL GEOGRAPHIC</p>
                                    </div>
                                    <div class="font-nav tracking-widest">
                                        <p class="text-white/90 text-sm md:text-base mb-1">EXPERIENCE</p>
                                        <p class="text-white text-lg md:text-xl">450+ PREMIUM WEDDINGS</p>
                                    </div>
                                    <div class="font-nav tracking-widest">
                                        <p class="text-white/90 text-sm md:text-base mb-1">SPECIALIZATION</p>
                                        <p class="text-white text-lg md:text-xl">LUXURY DESTINATION WEDDINGS</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Slide Indicators -->
            <div class="absolute bottom-4 left-1/2 -translate-x-1/2 z-20 flex gap-2">
                <?php foreach ($slides as $index => $slide) : ?>
                <button class="slide-indicator w-10 h-1 bg-white/30 hover:bg-white/50 transition-all <?php echo $index === 0 ? 'active w-16' : ''; ?>"
                        data-slide="<?php echo $index + 1; ?>"
                        aria-label="Go to slide <?php echo $index + 1; ?>">
                </button>
                <?php endforeach; ?>
            </div>

            <!-- Navigation Buttons -->
            <button class="slider-nav prev absolute left-4 md:left-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 
                         bg-white/10 hover:bg-white/20 backdrop-blur rounded-full 
                         flex items-center justify-center transition-all duration-300 
                         border border-white/10 hover:border-white/20 group z-20"
                    aria-label="Previous slide">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-6 h-6 text-white/90 group-hover:text-white transition-colors" 
                     viewBox="0 0 24 24" 
                     fill="none" 
                     stroke="currentColor" 
                     stroke-width="2" 
                     stroke-linecap="round" 
                     stroke-linejoin="round">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </button>

            <button class="slider-nav next absolute right-4 md:right-8 top-1/2 -translate-y-1/2 w-10 h-10 md:w-12 md:h-12 
                         bg-white/10 hover:bg-white/20 backdrop-blur rounded-full 
                         flex items-center justify-center transition-all duration-300 
                         border border-white/10 hover:border-white/20 group z-20"
                    aria-label="Next slide">
                <svg xmlns="http://www.w3.org/2000/svg" 
                     class="w-6 h-6 text-white/90 group-hover:text-white transition-colors" 
                     viewBox="0 0 24 24" 
                     fill="none" 
                     stroke="currentColor" 
                     stroke-width="2" 
                     stroke-linecap="round" 
                     stroke-linejoin="round">
                    <polyline points="9 18 15 12 9 6"></polyline>
                </svg>
            </button>
        </section>
    </div>

    <!-- Mission Statement Section -->
    <section class="bg-background-alt py-32 md:py-40">
        <div class="container mx-auto px-4 md:px-8">
            <div class="flex flex-col md:flex-row items-start gap-12 md:gap-24 max-w-6xl mx-auto">
                <div class="w-full md:w-1/3">
                    <h2 class="font-secondary text-3xl md:text-4xl lg:text-5xl text-text">
                        Capturing Love Stories Worldwide
                    </h2>
                </div>

                <div class="hidden md:block w-px self-stretch bg-text/10"></div>

                <div class="w-full md:w-2/3">
                    <p class="font-nav text-lg text-text-light leading-relaxed mb-8">
                        With over a decade of experience in luxury wedding photography, we've had the privilege of documenting 
                        love stories across the globe. From intimate beach ceremonies in Bali to grand celebrations in historic 
                        European castles, our lens captures not just images, but emotions, moments, and memories that last a lifetime.
                    </p>
                    <a href="/about" class="inline-flex items-center gap-2 text-accent hover:text-accent-hover font-nav tracking-wider">
                        Learn more about our journey
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Work Section -->
    <section class="py-24 md:py-32">
        <div class="container mx-auto px-4 md:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16 md:mb-24">
                <h2 class="font-secondary text-3xl md:text-4xl lg:text-5xl text-text mb-6">Featured Collections</h2>
                <p class="font-nav text-text-light">Explore our most cherished wedding collections, each telling a unique story of love and celebration.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php
                $featured_posts = get_posts(array(
                    'posts_per_page' => 6,
                    'post_type' => 'post',
                    'category_name' => 'featured'
                ));

                foreach ($featured_posts as $post) :
                    setup_postdata($post);
                    $image = get_the_post_thumbnail_url($post->ID, 'large');
                ?>
                <article class="group relative overflow-hidden rounded-lg">
                    <a href="<?php the_permalink(); ?>" class="block aspect-[3/4]">
                        <img src="<?php echo esc_url($image); ?>" 
                             alt="<?php echo esc_attr(get_the_title()); ?>"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-6 translate-y-full group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="font-secondary text-xl text-white mb-2"><?php the_title(); ?></h3>
                            <p class="font-nav text-sm text-white/80"><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </a>
                </article>
                <?php
                endforeach;
                wp_reset_postdata();
                ?>
            </div>

            <div class="text-center mt-16">
                <a href="/portfolio" class="inline-flex items-center justify-center px-8 py-3 border-2 border-accent 
                                        text-accent hover:text-accent-hover font-nav tracking-wider 
                                        transition-colors duration-300">
                    View Full Portfolio
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-background-alt py-24 md:py-32">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-secondary text-3xl md:text-4xl lg:text-5xl text-text text-center mb-16">Client Love Notes</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                    <blockquote class="bg-white/50 backdrop-blur p-8 rounded-lg">
                        <svg class="w-8 h-8 text-accent mb-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="font-nav text-text-light leading-relaxed mb-6">
                            "Working with this team was the best decision we made for our wedding. They captured every moment 
                            perfectly, from the smallest details to the grandest celebrations. The photos are beyond beautiful!"
                        </p>
                        <footer class="font-nav">
                            <cite class="text-text not-italic">Sarah & James</cite>
                            <p class="text-text-light text-sm">Destination Wedding in Santorini</p>
                        </footer>
                    </blockquote>

                    <blockquote class="bg-white/50 backdrop-blur p-8 rounded-lg">
                        <svg class="w-8 h-8 text-accent mb-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                        <p class="font-nav text-text-light leading-relaxed mb-6">
                            "Their attention to detail and artistic vision is unmatched. They didn't just take photos, they 
                            created art that tells our love story in the most beautiful way possible."
                        </p>
                        <footer class="font-nav">
                            <cite class="text-text not-italic">Michael & Emma</cite>
                            <p class="text-text-light text-sm">Luxury Wedding in Lake Como</p>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="relative py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/cta-bg.jpg" 
                 alt="Contact background" 
                 class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-overlay backdrop-blur-sm"></div>
        </div>

        <div class="container mx-auto px-4 md:px-8 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="font-secondary text-3xl md:text-4xl lg:text-5xl text-white mb-6">
                    Let's Create Something Beautiful Together
                </h2>
                <p class="font-nav text-lg text-white/80 mb-12 leading-relaxed">
                    Every love story is unique and deserves to be told in its own special way. 
                    We'd be honored to be part of yours.
                </p>
                <a href="/contact" class="inline-flex items-center justify-center px-8 py-3 bg-accent 
                                    hover:bg-accent-hover text-white font-nav tracking-wider 
                                    transition-colors duration-300">
                    Start the Conversation
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
