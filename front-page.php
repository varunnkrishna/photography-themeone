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
    <section class="bg-background py-24 md:py-32">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="font-secondary text-4xl md:text-5xl lg:text-6xl text-text mb-8 leading-tight">Capturing Life's Beautiful Moments</h2>
                <p class="text-text-muted text-lg md:text-xl mb-12 leading-relaxed">Every photograph tells a story, and I'm here to help you tell yours. With a keen eye for detail and a passion for capturing authentic moments, I create timeless memories that you'll cherish forever.</p>
                <a href="/about" class="inline-block bg-accent hover:bg-accent-dark text-white font-primary px-8 py-4 rounded-lg transition-all duration-300 transform hover:scale-105">Discover My Story</a>
            </div>
        </div>
    </section>

    <!-- Featured Work Section -->
    <section class="bg-background-alt py-24 md:py-32">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-secondary text-4xl md:text-5xl text-text text-center mb-16">Featured Work</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    $args = array(
                        'post_type' => 'portfolio',
                        'posts_per_page' => 6,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) :
                        while ($query->have_posts()) : $query->the_post();
                            // Get categories for the image
                            $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                            $category_names = array();
                            if ($categories) {
                                foreach ($categories as $category) {
                                    $category_names[] = $category->name;
                                }
                            }
                    ?>
                            <article class="group relative overflow-hidden rounded-xl shadow-lg bg-white">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>" class="block aspect-[4/3]">
                                        <img src="<?php the_post_thumbnail_url('large'); ?>" 
                                             alt="<?php the_title_attribute(); ?>" 
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                            <div class="absolute bottom-0 left-0 right-0 p-6">
                                                <h3 class="text-xl text-white font-primary mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                                    <?php the_title(); ?>
                                                </h3>
                                                <?php if (!empty($category_names)) : ?>
                                                    <p class="text-white/80 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75">
                                                        <?php echo implode(', ', $category_names); ?>
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>
                            </article>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
                <div class="text-center mt-12">
                    <a href="<?php echo get_permalink(get_page_by_path('gallery')); ?>" 
                       class="inline-block border-2 border-accent hover:bg-accent text-accent hover:text-white font-primary px-8 py-3 rounded-lg transition-all duration-300">
                        View Full Gallery
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="bg-background py-24 md:py-32">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-secondary text-4xl md:text-5xl text-text text-center mb-16">Photography Services</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Wedding Photography -->
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-accent" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 8h-3.2l-1.2-1.6c-.2-.3-.5-.4-.8-.4h-6.4c-.3 0-.6.1-.8.4L7.2 8H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                            </svg>
                        </div>
                        <h3 class="font-secondary text-2xl text-text text-center mb-4">Wedding Photography</h3>
                        <p class="text-text-muted text-center mb-6">Capturing your special day with elegance and authenticity</p>
                        <a href="/services#wedding" class="block text-center text-accent hover:text-accent-dark font-primary transition-colors duration-300">Learn More →</a>
                    </div>
                    <!-- Portrait Photography -->
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-accent" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 12c2.2 0 4-1.8 4-4s-1.8-4-4-4-4 1.8-4 4 1.8 4 4 4zm0 2c-2.7 0-8 1.3-8 4v2h16v-2c0-2.7-5.3-4-8-4z"/>
                            </svg>
                        </div>
                        <h3 class="font-secondary text-2xl text-text text-center mb-4">Portrait Photography</h3>
                        <p class="text-text-muted text-center mb-6">Professional portraits that capture your true personality</p>
                        <a href="/services#portrait" class="block text-center text-accent hover:text-accent-dark font-primary transition-colors duration-300">Learn More →</a>
                    </div>
                    <!-- Event Photography -->
                    <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300">
                        <div class="w-16 h-16 bg-accent/10 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg class="w-8 h-8 text-accent" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3h-1V2c0-.6-.4-1-1-1s-1 .4-1 1v1H8V2c0-.6-.4-1-1-1s-1 .4-1 1v1H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11z"/>
                            </svg>
                        </div>
                        <h3 class="font-secondary text-2xl text-text text-center mb-4">Event Photography</h3>
                        <p class="text-text-muted text-center mb-6">Documenting your special events with style and creativity</p>
                        <a href="/services#event" class="block text-center text-accent hover:text-accent-dark font-primary transition-colors duration-300">Learn More →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="bg-background-alt py-24 md:py-32">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-secondary text-4xl md:text-5xl text-text text-center mb-16">Client Love Notes</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php
                    $testimonials = get_posts(array(
                        'post_type' => 'testimonial',
                        'posts_per_page' => 3
                    ));

                    foreach ($testimonials as $testimonial) :
                        $client_name = get_post_meta($testimonial->ID, 'client_name', true);
                        $client_role = get_post_meta($testimonial->ID, 'client_role', true);
                    ?>
                        <div class="bg-white rounded-xl p-8 shadow-lg">
                            <div class="flex items-center justify-center mb-6">
                                <svg class="w-8 h-8 text-accent" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                                </svg>
                            </div>
                            <blockquote class="text-text-muted text-center mb-6"><?php echo wp_trim_words($testimonial->post_content, 30); ?></blockquote>
                            <div class="text-center">
                                <cite class="font-primary text-text block not-italic"><?php echo esc_html($client_name); ?></cite>
                                <?php if ($client_role) : ?>
                                    <span class="text-text-muted text-sm"><?php echo esc_html($client_role); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="bg-background py-24 md:py-32">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="font-secondary text-4xl md:text-5xl text-text mb-8">Ready to Create Something Beautiful?</h2>
                <p class="text-text-muted text-lg mb-12">Let's work together to capture your precious moments in stunning photographs that will last a lifetime.</p>
                <a href="/contact" class="inline-block bg-accent hover:bg-accent-dark text-white font-primary px-8 py-4 rounded-lg transition-all duration-300 transform hover:scale-105">Get in Touch</a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
