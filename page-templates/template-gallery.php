<?php
/**
 * Template Name: Gallery
 */

get_header();
?>

<div class="bg-background min-h-screen">
    <!-- Hero Section -->
    <section class="relative h-[60vh] bg-primary overflow-hidden">
        <div class="absolute inset-0 bg-black/50 z-10">
            <div class="absolute bottom-0 left-0 right-0 h-16 bg-background" style="clip-path: ellipse(75% 100% at 50% 100%);"></div>
        </div>
        <div class="absolute inset-0 z-0">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover']); ?>
            <?php else : ?>
                <img src="<?php echo get_theme_file_uri('assets/images/gallery-hero.jpg'); ?>" 
                     alt="Gallery Hero" 
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
                    Discover our diverse collection of stunning photographs capturing life's most precious moments
                </p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-16 bg-background">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-wrap justify-center items-center gap-3 mb-12" id="category-filters">
                    <button class="filter-button active" data-filter="all">
                        All Work
                    </button>
                    <?php
                    $categories = get_terms([
                        'taxonomy' => 'portfolio_category',
                        'hide_empty' => true
                    ]);

                    if (!empty($categories) && !is_wp_error($categories)) {
                        foreach ($categories as $category) {
                            printf(
                                '<button class="filter-button" data-filter="%s">%s</button>',
                                esc_attr($category->slug),
                                esc_html($category->name)
                            );
                        }
                    }
                    ?>
                </div>

                <!-- Category Description -->
                <div class="text-center mb-12 opacity-0 transition-opacity duration-300" id="category-description">
                    <p class="text-text-muted text-lg"></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="gallery-grid">
                <?php
                $args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => -1,
                );

                $query = new WP_Query($args);

                if ($query->have_posts()) :
                    while ($query->have_posts()) : $query->the_post();
                        // Get categories for filtering
                        $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                        $category_classes = '';
                        if ($categories) {
                            foreach ($categories as $category) {
                                $category_classes .= ' ' . $category->slug;
                            }
                        }
                        ?>
                        <div class="gallery-item<?php echo esc_attr($category_classes); ?>" 
                             data-categories="<?php echo esc_attr(trim($category_classes)); ?>">
                            <div class="relative group overflow-hidden rounded-xl shadow-lg bg-white">
                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="aspect-w-4 aspect-h-3">
                                        <img src="<?php the_post_thumbnail_url('large'); ?>" 
                                             alt="<?php the_title_attribute(); ?>" 
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    </div>
                                <?php endif; ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                    <div class="absolute bottom-0 left-0 right-0 p-6">
                                        <h3 class="text-xl text-white font-semibold mb-2 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                            <?php the_title(); ?>
                                        </h3>
                                        <?php if ($categories) : ?>
                                            <p class="text-white/80 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75">
                                                <?php echo wp_list_pluck($categories, 'name')[0]; ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>
</div>

<?php
// Add this before get_footer()
add_action('wp_footer', function() {
?>
<style>
    /* Filter Buttons */
    .filter-button {
        @apply px-6 py-3 rounded-full text-text-muted bg-white/50 backdrop-blur-sm 
               border border-background-alt hover:border-accent 
               font-primary text-sm tracking-wide uppercase
               transition-all duration-300 ease-in-out;
    }

    .filter-button:hover {
        @apply text-accent shadow-md transform -translate-y-0.5;
    }

    .filter-button.active {
        @apply bg-accent text-white border-accent shadow-lg;
    }

    .filter-button.active:hover {
        @apply bg-accent-dark border-accent-dark;
    }

    /* Gallery Items */
    .gallery-item {
        @apply transition-all duration-500 transform;
    }

    .gallery-item.hidden {
        @apply opacity-0 scale-95;
    }

    .gallery-item.visible {
        @apply opacity-100 scale-100;
    }

    /* Aspect Ratio */
    .aspect-w-4 {
        position: relative;
        padding-bottom: 75%;
    }
    .aspect-w-4 > * {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const filters = document.querySelectorAll('.filter-button');
    const items = document.querySelectorAll('.gallery-item');
    const description = document.getElementById('category-description');
    const descriptionText = description.querySelector('p');

    // Category descriptions
    const categoryDescriptions = {
        'all': 'Explore our complete collection of stunning photographs',
        // Add more descriptions as needed for each category
    };

    filters.forEach(filter => {
        filter.addEventListener('click', function() {
            const category = this.getAttribute('data-filter');
            
            // Update active state
            filters.forEach(f => f.classList.remove('active'));
            this.classList.add('active');

            // Update description
            const desc = categoryDescriptions[category] || '';
            descriptionText.textContent = desc;
            description.classList.toggle('opacity-0', !desc);

            // Filter items
            items.forEach(item => {
                const itemCategories = item.getAttribute('data-categories');
                const shouldShow = category === 'all' || itemCategories.includes(category);
                
                item.classList.add('hidden');
                item.classList.remove('visible');

                setTimeout(() => {
                    item.style.display = shouldShow ? 'block' : 'none';
                    if (shouldShow) {
                        setTimeout(() => {
                            item.classList.remove('hidden');
                            item.classList.add('visible');
                        }, 50);
                    }
                }, 300);
            });
        });
    });
});
</script>
<?php
});

get_footer();
?>
