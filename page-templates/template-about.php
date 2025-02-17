<?php
/**
 * Template Name: About
 */

get_header();
?>

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
                <img src="<?php echo get_theme_file_uri('assets/images/about-banner.jpg'); ?>" 
                     alt="About Hero" 
                     class="w-full h-full object-cover">
            <?php endif; ?>
        </div>

        <!-- Content Container (includes overlay) -->
        <div class="absolute inset-0 z-10">
            <!-- Dark Overlay -->
            <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-black/40"></div>
            
            <!-- Content -->
            <div class="relative h-full container mx-auto px-4 flex flex-col justify-center items-center text-center">
                <h1 class="font-secondary text-4xl md:text-5xl lg:text-6xl text-white mb-6">
                    <?php echo get_the_title(); ?>
                </h1>
                <?php if (get_the_excerpt()) : ?>
                    <p class="text-lg md:text-xl text-white/90 max-w-2xl leading-relaxed">
                        <?php echo get_the_excerpt(); ?>
                    </p>
                <?php else : ?>
                    <p class="text-lg md:text-xl text-white/90 max-w-2xl leading-relaxed">
                        Capturing life's precious moments with artistry and passion
                    </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Curved Bottom -->
        <div class="absolute bottom-0 left-0 right-0 z-20">
            <!-- Overlay that matches the curve -->
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-black/40" style="clip-path: ellipse(75% 100% at 50% 100%);"></div>
            <!-- Background curve -->
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-background" style="clip-path: ellipse(75% 100% at 50% 100%);"></div>
        </div>
    </section>

    <!-- About Content -->
    <!-- <section class="py-12 md:py-16">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-4xl mx-auto">
                <div class="prose prose-lg mx-auto">
                    <?php while (have_posts()) : the_post(); ?>
                        <?php the_content(); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Experience Section -->
    <section class="py-16 md:py-20 bg-background-alt">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-secondary text-3xl md:text-4xl text-primary text-center mb-12 md:mb-16">Why Choose Us</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-12">
                    <!-- Experience -->
                    <div class="bg-white rounded-lg p-8 text-center shadow-md">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-accent/10 mb-6">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3">10+ Years Experience</h3>
                        <p class="text-text-light text-base">A decade of capturing beautiful moments and creating lasting memories for our clients.</p>
                    </div>

                    <!-- Professional Equipment -->
                    <div class="bg-white rounded-lg p-8 text-center shadow-md">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-accent/10 mb-6">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3">Professional Equipment</h3>
                        <p class="text-text-light text-base">Using top-of-the-line cameras and lenses to ensure the highest quality photos.</p>
                    </div>

                    <!-- Customer Satisfaction -->
                    <div class="bg-white rounded-lg p-8 text-center shadow-md">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-accent/10 mb-6">
                            <svg class="w-8 h-8 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3">100% Satisfaction</h3>
                        <p class="text-text-light text-base">Committed to exceeding your expectations with our dedication to excellence.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-16 md:py-20">
        <div class="container mx-auto px-4 md:px-6">
            <div class="max-w-3xl mx-auto">
                <h2 class="font-secondary text-3xl md:text-4xl text-primary text-center mb-12">Client Testimonials</h2>
                <div class="bg-white p-8 md:p-10 rounded-lg shadow-lg">
                    <div class="flex justify-center mb-6">
                        <div class="w-16 h-16 rounded-full bg-accent/10 flex items-center justify-center">
                            <svg class="w-8 h-8 text-accent" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                            </svg>
                        </div>
                    </div>
                    <blockquote class="text-lg text-text-light text-center mb-6">
                        "Working with this photography studio was an absolute pleasure. They captured our wedding day perfectly, creating memories that will last a lifetime."
                    </blockquote>
                    <div class="text-center">
                        <cite class="text-primary font-bold block not-italic">Sarah & Michael Johnson</cite>
                        <span class="text-text-light text-sm">Wedding Photography</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>
