<?php get_header(); ?>

<main class="site-main">
    <!-- Hero Section -->
    <div class="relative pl-2 pr-2">
        <div class="px-4">
            <div class="h-[40vh] md:h-[60vh] relative">
                <?php if(have_rows('hero_slides')): ?>
                    <div class="swiper hero-swiper h-full">
                        <div class="swiper-wrapper">
                            <?php 
                            while(have_rows('hero_slides')): the_row();
                                $image = get_sub_field('image');
                                $title = get_sub_field('title');
                                $subtitle = get_sub_field('subtitle');
                                if($image):
                            ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo esc_url($image['url']); ?>" 
                                         alt="<?php echo esc_attr($image['alt']); ?>" 
                                         class="w-full h-full object-cover" />
                                    <?php if($title || $subtitle): ?>
                                        <div class="absolute inset-0 bg-black bg-opacity-30 flex items-center justify-center">
                                            <div class="text-white text-center">
                                                <?php if($title): ?>
                                                    <h2 class="text-4xl md:text-6xl font-bold mb-4"><?php echo esc_html($title); ?></h2>
                                                <?php endif; ?>
                                                <?php if($subtitle): ?>
                                                    <p class="text-xl md:text-2xl"><?php echo esc_html($subtitle); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php 
                                endif;
                            endwhile; 
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                <?php else: ?>
                    <!-- Fallback if no slides are added -->
                    <div class="h-full flex items-center justify-center bg-gray-100">
                        <p class="text-gray-500">Please add slides in the WordPress admin.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="relative bg-white">
        <!-- Hero Content -->
        <div class="container mx-auto px-4 py-12">
            <div class="text-center max-w-6xl mx-auto">
                <?php 
                $heading = get_field('hero_heading');
                $subheading = get_field('hero_subheading');
                $description = get_field('hero_description');
                $button_text = get_field('hero_button_text');
                $button_link = get_field('hero_button_link');
                $secondary_button_text = get_field('hero_secondary_button_text');
                $secondary_button_link = get_field('hero_secondary_button_link');
                ?>

                <?php if($heading): ?>
                    <h1 class="text-4xl md:text-5xl font-inter-bold tracking-tighter text-gray-900 mb-4">
                        <?php echo esc_html($heading); ?>
                    </h1>
                <?php endif; ?>

                <?php if($subheading): ?>
                    <h2 class="text-xl md:text-2xl text-gray-600 mb-6">
                        <?php echo esc_html($subheading); ?>
                    </h2>
                <?php endif; ?>

                <?php if($description): ?>
                    <p class="text-lg text-gray-600 mb-8 max-w-3xl mx-auto">
                        <?php echo esc_html($description); ?>
                    </p>
                <?php endif; ?>

                <?php if($button_text || $secondary_button_text): ?>
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        <?php if($button_text && $button_link): ?>
                            <a href="<?php echo esc_url($button_link['url']); ?>" 
                               class="font-inter-medium bg-brand-primary text-white px-8 py-3 rounded-lg hover:bg-brand-primary-dark transition-colors tracking-tight"
                               <?php echo $button_link['target'] ? 'target="' . esc_attr($button_link['target']) . '"' : ''; ?>>
                                <?php echo esc_html($button_text); ?>
                            </a>
                        <?php endif; ?>

                        <?php if($secondary_button_text && $secondary_button_link): ?>
                            <a href="<?php echo esc_url($secondary_button_link['url']); ?>" 
                               class="font-inter-medium bg-brand-secondary-light/10 text-brand-secondary-dark px-8 py-3 rounded-lg hover:bg-brand-secondary-dark hover:text-white transition-colors tracking-tight border-2 border-gray-200"
                               <?php echo $secondary_button_link['target'] ? 'target="' . esc_attr($secondary_button_link['target']) . '"' : ''; ?>>
                                <?php echo esc_html($secondary_button_text); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if(have_rows('hero_stats')): ?>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mt-16">
                        <?php while(have_rows('hero_stats')): the_row(); 
                            $number = get_sub_field('number');
                            $label = get_sub_field('label');
                        ?>
                            <div class="text-center">
                                <div class="text-4xl md:text-5xl font-inter-bold text-brand-primary mb-2">
                                    <?php echo esc_html($number); ?>
                                </div>
                                <div class="text-gray-600">
                                    <?php echo esc_html($label); ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>


<!-- About us section -->
<!-- About us section -->
<section>
    <div class="bg-[#FFF5F6] py-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="w-full md:w-1/2">
                    <?php if($image = get_field('about_image')): ?>
                        <div class="relative">
                            <img src="<?php echo esc_url($image['url']); ?>" 
                                 alt="<?php echo esc_attr($image['alt']); ?>" 
                                 class="w-full rounded-3xl shadow-lg relative z-10">
                            <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-brand-primary rounded-full opacity-10"></div>
                            <div class="absolute -top-6 -left-6 w-24 h-24 bg-brand-secondary rounded-full opacity-10"></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="w-full md:w-1/2">
                    <h2 class="text-4xl font-inter-bold mb-6">
                        <span class="text-brand-primary"><?php echo esc_html(get_field('about_highlight_text')); ?></span>
                        <span class="text-gray-900"><?php echo esc_html(get_field('about_title')); ?></span>
                    </h2>
                    <div class="text-gray-600 mb-8 leading-relaxed">
                        <?php echo nl2br(esc_html(get_field('about_content'))); ?>
                    </div>
                    <?php if($link = get_field('about_button_link')): ?>
                        <a href="<?php echo esc_url($link['url']); ?>" 
                           class="inline-flex items-center px-8 py-3 bg-brand-primary text-white rounded-lg hover:bg-brand-primary-dark transition-colors font-inter-medium group">
                            <?php echo esc_html(get_field('about_button_text')); ?>
                            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Services Section -->
<section class="py-20">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16 fade-up">
            <h2 class="text-4xl md:text-5xl font-inter-bold text-gray-900 mb-6 ultra-tight-tracking">
                <?php if($highlight = get_field('services_highlight_text')): ?>
                    <span class="text-brand-primary"><?php echo esc_html($highlight); ?></span>
                <?php endif; ?>
                <?php if($title = get_field('services_title')): ?>
                    <?php echo esc_html($title); ?>
                <?php endif; ?>
            </h2>
            <?php if($description = get_field('services_description')): ?>
                <p class="text-lg text-gray-600">
                    <?php echo esc_html($description); ?>
                </p>
            <?php endif; ?>
        </div>

        <?php if(have_rows('services')): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 pt-12">
                <?php while(have_rows('services')): the_row(); 
                    $image = get_sub_field('image');
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $price = get_sub_field('price');
                    $link = get_sub_field('link');
                    $bg_color = get_sub_field('background_color');
                ?>
                    <div class="group fade-up hover-card bg-white rounded-2xl overflow-hidden shadow-lg">
                        <?php if($image): ?>
                            <div class="relative h-64 overflow-hidden">
                                <?php if($bg_color): ?>
                                    <div class="absolute inset-0 <?php echo esc_attr($bg_color); ?> opacity-20"></div>
                                <?php endif; ?>
                                <img src="<?php echo esc_url($image['url']); ?>" 
                                     alt="<?php echo esc_attr($image['alt']); ?>" 
                                     class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                            </div>
                        <?php endif; ?>
                        <div class="p-6">
                            <?php if($title): ?>
                                <h3 class="text-2xl font-inter-bold text-gray-900 mb-3"><?php echo esc_html($title); ?></h3>
                            <?php endif; ?>
                            <?php if($description): ?>
                                <p class="text-gray-600 mb-4"><?php echo esc_html($description); ?></p>
                            <?php endif; ?>
                            <?php if($price): ?>
                                <p class="text-brand-primary font-inter-medium mb-4">Starting at <?php echo esc_html($price); ?></p>
                            <?php endif; ?>
                            <?php if($link): ?>
                                <a href="<?php echo esc_url($link['url']); ?>" 
                                   class="inline-flex items-center text-brand-primary hover:text-brand-primary-dark transition-colors group-hover:translate-x-2 transform transition-transform"
                                   <?php echo $link['target'] ? 'target="' . esc_attr($link['target']) . '"' : ''; ?>>
                                    <?php echo esc_html($link['title']); ?>
                                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>


 
  <!-- Instagram Feed Section -->
  <div class="py-20 overflow-hidden">
            <?php
            // Debug ACF fields
            if (WP_DEBUG) {
                $page_id = get_option('page_on_front');
                echo '<!-- Debug: ACF Fields -->';
                echo '<!-- Getting fields for page ID: ' . $page_id . ' -->';
                
                // Try getting fields directly with page ID
                $test_title = get_field('instagram_title', $page_id);
                $test_images_top = get_field('instagram_images_top', $page_id);
                
                echo '<!-- Title from ID: ' . esc_html($test_title) . ' -->';
                echo '<!-- Top Images from ID: ' . (is_array($test_images_top) ? count($test_images_top) : 'Not an array') . ' -->';
                
                if ($test_images_top) {
                    echo '<!-- Sample Image Data: ' . json_encode(array_slice($test_images_top, 0, 1)) . ' -->';
                }
            }
            ?>

            <!-- Section Header -->
            <div class="text-center max-w-3xl mx-auto mb-12 fade-up">
                <h2 class="text-4xl md:text-5xl font-inter-bold text-gray-900 mb-6 ultra-tight-tracking">
                    <?php 
                    // Try getting field with explicit page ID
                    $instagram_title = get_field('instagram_title', get_option('page_on_front'));
                    echo esc_html($instagram_title ? $instagram_title : 'Follow Our Journey on Instagram');
                    ?>
                </h2>
            </div>

            <!-- Instagram Carousel -->
            <div class="relative">
                <!-- First Carousel (Left to Right) -->
                <div class="swiper instagram-slider-1 mb-6">
                    <div class="swiper-wrapper">
                        <?php
                        $page_id = get_option('page_on_front');
                        $top_images = get_field('instagram_images_top', $page_id);
                        
                        if ($top_images && is_array($top_images)) :
                            foreach ($top_images as $image) :
                                if (isset($image['url'])) : ?>
                                    <div class="swiper-slide" style="width: 280px !important;">
                                        <div class="mx-2">
                                            <img src="<?php echo esc_url($image['url']); ?>" 
                                                 alt="<?php echo esc_attr($image['alt'] ? $image['alt'] : 'Instagram Feed Image'); ?>" 
                                                 class="w-full h-[280px] object-cover rounded-xl" />
                                        </div>
                                    </div>
                                    <?php 
                                endif;
                            endforeach;
                        else:
                            // Debug output
                            echo '<!-- Debug: Top Images not found or invalid format -->';
                            if ($top_images) {
                                echo '<!-- Debug: $top_images exists but is: ' . gettype($top_images) . ' -->';
                            }
                        endif; ?>
                    </div>
                </div>

                <!-- Second Carousel (Right to Left) -->
                <div class="swiper instagram-slider-2">
                    <div class="swiper-wrapper">
                        <?php
                        $bottom_images = get_field('instagram_images_bottom', $page_id);
                        if ($bottom_images && is_array($bottom_images)) :
                            foreach ($bottom_images as $image) :
                                if (isset($image['url'])) : ?>
                                    <div class="swiper-slide" style="width: 280px !important;">
                                        <div class="mx-2">
                                            <img src="<?php echo esc_url($image['url']); ?>" 
                                                 alt="<?php echo esc_attr($image['alt'] ? $image['alt'] : 'Instagram Feed Image'); ?>" 
                                                 class="w-full h-[280px] object-cover rounded-xl" />
                                        </div>
                                    </div>
                                    <?php 
                                endif;
                            endforeach;
                        else:
                            // Debug output
                            echo '<!-- Debug: Bottom Images not found or invalid format -->';
                            if ($bottom_images) {
                                echo '<!-- Debug: $bottom_images exists but is: ' . gettype($bottom_images) . ' -->';
                            }
                        endif; ?>
                    </div>
                </div>
            </div>

            <!-- Instagram Link -->
            <div class="text-center mt-12">
                <a href="<?php echo esc_url(get_field('instagram_url', $page_id) ? get_field('instagram_url', $page_id) : '#'); ?>" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-[#833AB4] via-[#FD1D1D] to-[#F77737] text-white rounded-lg hover:shadow-lg transition-all duration-300 font-inter-medium group">
                    <svg class="w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
            </svg>
            Follow us <?php echo esc_html(get_field('instagram_handle', $page_id) ? get_field('instagram_handle', $page_id) : '@tinytotsstudio'); ?>
            <svg class="w-5 h-5 ml-2 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
            </svg>
        </a>
    </div>
</div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize first slider (Left to Right)
                new Swiper('.instagram-slider-1', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    loop: true,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                    },
                    speed: 5000,
                    grabCursor: true,
                    mousewheelControl: true,
                    keyboardControl: true,
                    breakpoints: {
                        640: { slidesPerView: 2 },
                        768: { slidesPerView: 3 },
                        1024: { slidesPerView: 4 },
                    }
                });

                // Initialize second slider (Right to Left)
                new Swiper('.instagram-slider-2', {
                    slidesPerView: 'auto',
                    spaceBetween: 16,
                    loop: true,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                        reverseDirection: true
                    },
                    speed: 5000,
                    grabCursor: true,
                    mousewheelControl: true,
                    keyboardControl: true,
                    breakpoints: {
                        640: { slidesPerView: 2 },
                        768: { slidesPerView: 3 },
                        1024: { slidesPerView: 4 },
                    }
                });
            });
        </script>
        
  <!-- Testimonials Section -->
  <section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-4xl md:text-5xl font-inter-bold text-gray-900 mb-4">
                <?php echo esc_html(get_field('testimonials_title')); ?>
            </h2>
            <p class="text-xl text-gray-600">
                <?php echo esc_html(get_field('testimonials_subtitle')); ?>
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            if (have_rows('testimonials')) :
                while (have_rows('testimonials')) : the_row();
                    $client_image = get_sub_field('client_image');
                    $rating = get_sub_field('rating');
                    ?>
                    <div class="bg-white rounded-xl p-8 shadow-sm hover:shadow-md transition-shadow duration-300">
                        <!-- Client Info -->
                        <div class="flex items-center mb-6">
                            <?php if ($client_image) : ?>
                                <img src="<?php echo esc_url($client_image['url']); ?>"
                                     alt="<?php echo esc_attr($client_image['alt']); ?>"
                                     class="w-16 h-16 rounded-full object-cover mr-4"
                                />
                            <?php endif; ?>
                            <div>
                                <h3 class="font-inter-semibold text-lg text-gray-900">
                                    <?php echo esc_html(get_sub_field('client_name')); ?>
                                </h3>
                                <p class="text-gray-600 text-sm">
                                    <?php echo esc_html(get_sub_field('client_location')); ?>
                                </p>
                            </div>
                        </div>

                        <!-- Rating -->
                        <div class="flex items-center mb-4">
                            <?php for ($i = 0; $i < 5; $i++) : ?>
                                <svg class="w-5 h-5 <?php echo $i < $rating ? 'text-yellow-400' : 'text-gray-300'; ?>" 
                                     fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            <?php endfor; ?>
                        </div>

                        <!-- Testimonial Content -->
                        <p class="text-gray-600 leading-relaxed italic mb-4">
                            <?php echo esc_html(get_sub_field('content')); ?>
                        </p>

                        <!-- Service Type -->
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <p class="text-sm text-gray-500">
                                Service: <span class="font-inter-medium text-gray-700"><?php echo esc_html(get_sub_field('service_type')); ?></span>
                            </p>
                        </div>
                    </div>
                <?php 
                endwhile;
            endif; 
            ?>
        </div>
    </div>
</section>

        <!-- FAQ Section -->
        <div class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-4xl md:text-5xl font-inter-bold text-gray-900 mb-4">
                        <?php echo esc_html(get_field('faq_title')); ?>
                    </h2>
                    <p class="text-xl text-gray-600">
                        <?php echo esc_html(get_field('faq_subtitle')); ?>
                    </p>
                </div>

                <!-- FAQ Grid -->
                <div class="max-w-3xl mx-auto" x-data="{ activeTab: null }">
                    <?php
                    if (have_rows('faqs')) :
                        $faq_index = 0;
                        while (have_rows('faqs')) : the_row();
                            $question = get_sub_field('question');
                            $answer = get_sub_field('answer');
                            ?>
                            <div class="mb-4">
                                <button 
                                    @click="activeTab = activeTab === <?php echo $faq_index; ?> ? null : <?php echo $faq_index; ?>"
                                    class="flex justify-between items-center w-full px-6 py-4 text-left bg-gray-50 hover:bg-gray-100 rounded-lg focus:outline-none focus:ring-2 focus:ring-brand-primary focus:ring-opacity-50 transition-all duration-200"
                                >
                                    <span class="text-lg font-inter-medium text-gray-900"><?php echo esc_html($question); ?></span>
                                    <svg 
                                        class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
                                        :class="{ 'rotate-180': activeTab === <?php echo $faq_index; ?> }"
                                        fill="none" 
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24"
                                    >
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </button>
                                <div 
                                    x-show="activeTab === <?php echo $faq_index; ?>"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 transform -translate-y-2"
                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                    x-transition:leave-end="opacity-0 transform -translate-y-2"
                                    class="px-6 py-4"
                                >
                                    <p class="text-gray-600 leading-relaxed">
                                        <?php echo nl2br(esc_html($answer)); ?>
                                    </p>
                                </div>
                            </div>
                            <?php
                            $faq_index++;
                        endwhile;
                    endif;
                    ?>
                </div>

                <!-- FAQ CTA -->
                <div class="text-center mt-12">
                    <p class="text-xl text-gray-600 mb-6"><?php echo esc_html(get_field('faq_cta_text')); ?></p>
                    <a 
                        href="<?php echo esc_url(get_field('faq_cta_button_url')); ?>"
                        class="inline-flex items-center px-8 py-4 bg-brand-primary text-white rounded-lg hover:bg-brand-primary-dark transition-colors duration-200"
                    >
                        <?php echo esc_html(get_field('faq_cta_button_text')); ?>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

    
<!-- CTA Section with Parallax -->
<?php
$background = get_field('cta_background');
$overlay_opacity = get_field('cta_overlay_opacity') ?: 50;
$opacity_decimal = $overlay_opacity / 100;
?>
<section class="relative min-h-screen flex items-center justify-center overflow-hidden py-20">
    <!-- Parallax Background -->
    <div class="absolute inset-0 z-0">
        <?php if ($background) : ?>
            <div class="absolute inset-0 w-full h-full">
                <img 
                    src="<?php echo esc_url($background['url']); ?>" 
                    alt="<?php echo esc_attr($background['alt']); ?>"
                    class="w-full h-full object-cover transform scale-110"
                    data-parallax="scroll"
                    data-speed="0.3"
                    loading="eager"
                    decoding="async"
                />
            </div>
        <?php endif; ?>
        <!-- Overlay -->
        <div 
            class="absolute inset-0 bg-gray-900 pointer-events-none" 
            style="opacity: <?php echo esc_attr($opacity_decimal); ?>;"
        ></div>
    </div>

    <!-- Content -->
    <div class="relative z-10 text-center text-white px-4 max-w-4xl mx-auto">
        <?php if (get_field('cta_title')) : ?>
            <h2 class="text-4xl md:text-5xl font-inter-bold mb-6 leading-tight">
                <?php echo wp_kses_post(get_field('cta_title')); ?>
            </h2>
        <?php endif; ?>
        
        <?php if (get_field('cta_description')) : ?>
            <div class="text-xl md:text-2xl text-gray-200 mb-12 leading-relaxed">
                <?php echo wp_kses_post(get_field('cta_description')); ?>
            </div>
        <?php endif; ?>

        <!-- CTA Buttons -->
        <?php if (have_rows('cta_buttons')) : ?>
            <div class="flex flex-wrap justify-center gap-4">
                <?php 
                while (have_rows('cta_buttons')) : the_row(); 
                    $style = get_sub_field('button_style');
                    $button_classes = $style === 'primary' 
                        ? 'bg-brand-primary hover:bg-brand-primary-dark text-white' 
                        : 'bg-transparent hover:bg-white/90 hover:text-gray-900 border-2 border-white text-white';
                    $button_url = get_sub_field('button_url');
                    $button_text = get_sub_field('button_text');
                    
                    if ($button_url && $button_text) :
                ?>
                    <a 
                        href="<?php echo esc_url($button_url); ?>"
                        class="group inline-flex items-center px-8 py-4 rounded-lg transition-colors duration-300 text-lg font-inter-medium <?php echo esc_attr($button_classes); ?>"
                    >
                        <span><?php echo esc_html($button_text); ?></span>
                        <svg class="w-5 h-5 ml-2 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                <?php 
                    endif;
                endwhile; 
                ?>
            </div>
        <?php endif; ?>

        <!-- Scroll Indicator -->
        <?php if (get_field('cta_scroll_text')) : ?>
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-center">
                <p class="text-gray-300 mb-4"><?php echo esc_html(get_field('cta_scroll_text')); ?></p>
                <div class="animate-bounce">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                    </svg>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Parallax Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const parallaxImage = document.querySelector('[data-parallax="scroll"]');
    if (!parallaxImage) return;

    let ticking = false;
    let lastScrollY = window.scrollY;
    const speed = 0.3;

    function updateParallax() {
        const currentScrollY = window.scrollY;
        const scrollDiff = (currentScrollY - lastScrollY) * speed;
        const currentTransform = parallaxImage.style.transform || 'translateY(0) scale(1.1)';
        const currentY = parseFloat(currentTransform.match(/translateY\(([-\d.]+)?px\)/) ? 
                                  currentTransform.match(/translateY\(([-\d.]+)?px\)/)[1] : 0);
        
        // Apply the new transform with both translation and scale
        const newY = currentY + scrollDiff;
        parallaxImage.style.transform = `translateY(${newY}px) scale(1.1)`;
        
        lastScrollY = currentScrollY;
        ticking = false;
    }

    window.addEventListener('scroll', function() {
        if (!ticking) {
            window.requestAnimationFrame(function() {
                updateParallax();
            });
            ticking = true;
        }
    }, { passive: true });

    // Reset parallax on window resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(function() {
            lastScrollY = window.scrollY;
            parallaxImage.style.transform = 'translateY(0) scale(1.1)';
        }, 100);
    }, { passive: true });
});
</script>

        <!-- Initialize Fade Animations -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fadeElements = document.querySelectorAll('.fade-up');
                
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                        }
                    });
                }, {
                    threshold: 0.1
                });

                fadeElements.forEach(element => {
                    observer.observe(element);
                });
            });
        </script>

        <style>
            .hero-swiper {
                width: 100%;
                height: 100%;
            }
            .hero-swiper .swiper-slide {
                width: 100%;
                height: 100%;
            }
            .hero-swiper .swiper-pagination {
                bottom: 20px !important;
            }
            .hero-swiper .swiper-pagination-bullet {
                width: 8px;
                height: 8px;
                background: white;
                opacity: 0.5;
                margin: 0 4px;
            }
            .hero-swiper .swiper-pagination-bullet-active {
                opacity: 1;
            }
        </style>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.hero-swiper', {
                    slidesPerView: 1,
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                    speed: 1000,
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true
                    }
                });
            });
        </script>

<?php
// Debug front page settings
if (WP_DEBUG) {
    $page_on_front = get_option('page_on_front');
    $current_page_id = get_the_ID();
    echo '<!-- Debug: Front Page Settings -->';
    echo '<!-- Page on Front ID: ' . $page_on_front . ' -->';
    echo '<!-- Current Page ID: ' . $current_page_id . ' -->';
    echo '<!-- Is Front Page: ' . (is_front_page() ? 'Yes' : 'No') . ' -->';
}
?>

<?php get_footer(); ?>