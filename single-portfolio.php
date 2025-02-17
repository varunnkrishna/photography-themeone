<?php
get_header();

while (have_posts()) : the_post();
    // Get meta data
    $client_name = get_post_meta(get_the_ID(), '_portfolio_client_name', true);
    $location = get_post_meta(get_the_ID(), '_portfolio_location', true);
    $shoot_date = get_post_meta(get_the_ID(), '_portfolio_shoot_date', true);
    $categories = get_the_terms(get_the_ID(), 'portfolio_category');
?>

<article class="min-h-screen bg-background">
    <!-- Hero Section -->
    <section class="relative h-[60vh] md:h-[80vh] bg-primary">
        <?php if (has_post_thumbnail()) : ?>
            <div class="absolute inset-0">
                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
            </div>
            <div class="absolute inset-0 bg-black/40"></div>
        <?php endif; ?>
        
        <div class="relative container mx-auto px-4 h-full flex flex-col justify-end pb-12">
            <div class="text-white max-w-3xl">
                <?php if ($categories) : ?>
                    <div class="mb-4 flex flex-wrap gap-2">
                        <?php foreach ($categories as $category) : ?>
                            <span class="px-4 py-1 bg-accent/80 rounded-full text-sm">
                                <?php echo esc_html($category->name); ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4"><?php the_title(); ?></h1>
                
                <div class="flex flex-wrap gap-x-8 gap-y-2 text-white/90">
                    <?php if ($client_name) : ?>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span><?php echo esc_html($client_name); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($location) : ?>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span><?php echo esc_html($location); ?></span>
                        </div>
                    <?php endif; ?>
                    
                    <?php if ($shoot_date) : ?>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span><?php echo date('F j, Y', strtotime($shoot_date)); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section class="py-12 md:py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="prose prose-lg">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-12 bg-background-alt">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php
                // Get all attached images
                $images = get_attached_media('image', get_the_ID());
                
                // Create an array to store image data
                $gallery_images = array();
                foreach ($images as $image) {
                    $full_image_url = wp_get_attachment_image_url($image->ID, 'full');
                    $thumb_image_url = wp_get_attachment_image_url($image->ID, 'large');
                    $image_title = $image->post_title;
                    $image_caption = $image->post_excerpt;
                    
                    $gallery_images[] = array(
                        'full' => $full_image_url,
                        'thumb' => $thumb_image_url,
                        'title' => $image_title,
                        'caption' => $image_caption
                    );
                }

                // Output gallery items
                foreach ($gallery_images as $index => $image) :
                ?>
                    <a href="<?php echo esc_url($image['full']); ?>" 
                       class="gallery-image block relative group overflow-hidden rounded-lg"
                       data-lightbox="portfolio-gallery"
                       data-title="<?php echo esc_attr($image['caption'] ? $image['caption'] : $image['title']); ?>">
                        <img src="<?php echo esc_url($image['thumb']); ?>" 
                             alt="<?php echo esc_attr($image['title']); ?>"
                             class="w-full h-[300px] object-cover transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" />
                            </svg>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Navigation -->
    <section class="py-12 bg-background">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <?php
                $prev_post = get_previous_post();
                $next_post = get_next_post();
                ?>
                
                <?php if ($prev_post) : ?>
                    <a href="<?php echo get_permalink($prev_post); ?>" class="flex items-center text-primary hover:text-accent transition-colors duration-300">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        <span>Previous Project</span>
                    </a>
                <?php endif; ?>

                <a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="px-6 py-2 bg-accent text-white rounded-full hover:bg-accent/90 transition-colors duration-300">
                    View All Projects
                </a>

                <?php if ($next_post) : ?>
                    <a href="<?php echo get_permalink($next_post); ?>" class="flex items-center text-primary hover:text-accent transition-colors duration-300">
                        <span>Next Project</span>
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>
</article>

<?php
endwhile;
get_footer();
?>
