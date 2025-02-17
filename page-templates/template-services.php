<?php
/**
 * Template Name: Services Page
 */

get_header(); ?>

<div class="bg-background min-h-screen">
    <!-- Hero Section -->
    <section class="relative h-[60vh] bg-primary overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10">
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-background" style="clip-path: ellipse(75% 100% at 50% 100%);"></div>
        </div>
        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
            <?php else : ?>
                <img src="<?php echo get_theme_file_uri('assets/images/services-banner.jpg'); ?>" 
                     alt="Services Hero" 
                     class="w-full h-full object-cover">
            <?php endif; ?>
        </div>
        <div class="relative z-20 container mx-auto px-4 h-full flex flex-col justify-center items-center text-center">
            <h1 class="font-secondary text-4xl md:text-5xl lg:text-6xl text-white mb-6">
                <?php echo get_the_title(); ?>
            </h1>
            <?php if (get_the_excerpt()) : ?>
                <p class="text-lg md:text-xl text-white/90 max-w-2xl leading-relaxed">
                    <?php echo get_the_excerpt(); ?>
                </p>
            <?php else : ?>
                <p class="text-lg md:text-xl text-white/90 max-w-2xl leading-relaxed">
                    Professional photography services tailored to capture your special moments
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-20 md:py-32">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12">
                    <!-- Wedding Photography -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg group">
                        <div class="relative h-64 md:h-72">
                            <img src="<?php echo get_theme_file_uri('assets/images/services/wedding.jpg'); ?>" 
                                 alt="Wedding Photography" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <h3 class="font-secondary text-2xl md:text-3xl mb-2">Wedding Photography</h3>
                                <p class="text-white/90">Starting from ₹25,000</p>
                            </div>
                        </div>
                        <div class="p-6 md:p-8">
                            <ul class="space-y-3 text-text-light mb-6">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Full day coverage (Up to 12 hours)
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Two photographers
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    High-resolution digital images
                                </li>
                            </ul>
                            <a href="/contact" class="inline-block w-full text-center px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent-hover transition-colors duration-300">
                                Book Now
                            </a>
                        </div>
                    </div>

                    <!-- Pre-Wedding Photography -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg group">
                        <div class="relative h-64 md:h-72">
                            <img src="<?php echo get_theme_file_uri('assets/images/services/pre-wedding.jpg'); ?>" 
                                 alt="Pre-Wedding Photography" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <h3 class="font-secondary text-2xl md:text-3xl mb-2">Pre-Wedding Photography</h3>
                                <p class="text-white/90">Starting from ₹15,000</p>
                            </div>
                        </div>
                        <div class="p-6 md:p-8">
                            <ul class="space-y-3 text-text-light mb-6">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    4-hour creative session
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Multiple locations
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Outfit changes included
                                </li>
                            </ul>
                            <a href="/contact" class="inline-block w-full text-center px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent-hover transition-colors duration-300">
                                Book Now
                            </a>
                        </div>
                    </div>

                    <!-- Maternity Photography -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg group">
                        <div class="relative h-64 md:h-72">
                            <img src="<?php echo get_theme_file_uri('assets/images/services/maternity.jpg'); ?>" 
                                 alt="Maternity Photography" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <h3 class="font-secondary text-2xl md:text-3xl mb-2">Maternity Photography</h3>
                                <p class="text-white/90">Starting from ₹12,000</p>
                            </div>
                        </div>
                        <div class="p-6 md:p-8">
                            <ul class="space-y-3 text-text-light mb-6">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    2-hour studio session
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Professional styling
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Props and outfits provided
                                </li>
                            </ul>
                            <a href="/contact" class="inline-block w-full text-center px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent-hover transition-colors duration-300">
                                Book Now
                            </a>
                        </div>
                    </div>

                    <!-- Newborn Photography -->
                    <div class="bg-white rounded-xl overflow-hidden shadow-lg group">
                        <div class="relative h-64 md:h-72">
                            <img src="<?php echo get_theme_file_uri('assets/images/services/newborn.jpg'); ?>" 
                                 alt="Newborn Photography" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-primary/90 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <h3 class="font-secondary text-2xl md:text-3xl mb-2">Newborn Photography</h3>
                                <p class="text-white/90">Starting from ₹10,000</p>
                            </div>
                        </div>
                        <div class="p-6 md:p-8">
                            <ul class="space-y-3 text-text-light mb-6">
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    3-4 hour gentle session
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Safety-first approach
                                </li>
                                <li class="flex items-center">
                                    <svg class="w-5 h-5 text-accent mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    All props and wraps included
                                </li>
                            </ul>
                            <a href="/contact" class="inline-block w-full text-center px-6 py-3 bg-accent text-white rounded-lg hover:bg-accent-hover transition-colors duration-300">
                                Book Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Information -->
    <section class="py-16 md:py-24 bg-background-alt">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-3xl mx-auto text-center">
                <h2 class="font-secondary text-3xl md:text-4xl text-primary mb-6">Custom Photography Packages</h2>
                <p class="text-text-light mb-8">
                    Don't see exactly what you're looking for? We offer custom photography packages tailored to your specific needs. 
                    Contact us to discuss your vision and create a personalized photography experience.
                </p>
                <a href="/contact" class="inline-block px-8 py-3 bg-accent text-white rounded-lg hover:bg-accent-hover transition-colors duration-300">
                    Get in Touch
                </a>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
