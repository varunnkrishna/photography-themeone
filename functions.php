<?php
/**
 * Theme functions and definitions
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('PHOTO_PORTFOLIO_VERSION')) {
    define('PHOTO_PORTFOLIO_VERSION', '1.0.0');
}

/**
 * Theme Setup
 */
function photo_portfolio_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo');
    add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));
    add_theme_support('customize-selective-refresh-widgets');
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');

    // Register menus
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'photo-portfolio'),
    ));
}
add_action('after_setup_theme', 'photo_portfolio_setup');

/**
 * Register menus
 */
function photo_portfolio_menus() {
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'photo-portfolio'),
        'footer' => esc_html__('Footer Menu', 'photo-portfolio')
    ));
}
add_action('after_setup_theme', 'photo_portfolio_menus');

/**
 * Enqueue scripts and styles
 */
function photo_portfolio_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style(
        'photo-portfolio-fonts',
        'https://fonts.googleapis.com/css2?family=Bubblegum+Sans&family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;600&family=Libre+Franklin:wght@300;400;500;600&display=swap',
        array(),
        null
    );

    // Enqueue Tailwind CSS
    wp_enqueue_style(
        'photo-portfolio-tailwind',
        get_template_directory_uri() . '/dist/output.css',
        array(),
        PHOTO_PORTFOLIO_VERSION
    );

    // Enqueue Swiper CSS
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.5'
    );

    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue Swiper JS
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.5',
        true
    );

    // Enqueue theme scripts
    wp_enqueue_script(
        'photo-portfolio-slider',
        get_template_directory_uri() . '/assets/js/slider.js',
        array('jquery', 'swiper-js'),
        PHOTO_PORTFOLIO_VERSION,
        true
    );

    // Add Alpine.js for FAQ accordion
    wp_enqueue_script('alpinejs', 'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js', array(), null, true);
    wp_script_add_data('alpinejs', 'defer', true);

    // Add Parallax.js for CTA section
    wp_enqueue_script('parallax-js', 'https://cdnjs.cloudflare.com/ajax/libs/parallax.js/1.5.0/parallax.min.js', array(), '1.5.0', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'photo_portfolio_scripts');

/**
 * Enqueue scripts and styles for portfolio
 */
function photography_portfolio_scripts() {
    if (is_singular('portfolio')) {
        // Lightbox CSS
        wp_enqueue_style(
            'lightbox2-css',
            'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css',
            array(),
            '2.11.4'
        );

        // Lightbox JS
        wp_enqueue_script(
            'lightbox2-js',
            'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js',
            array('jquery'),
            '2.11.4',
            true
        );

        // Custom Lightbox settings
        wp_add_inline_script('lightbox2-js', '
            lightbox.option({
                "resizeDuration": 300,
                "wrapAround": true,
                "albumLabel": "Image %1 of %2",
                "fadeDuration": 300,
                "imageFadeDuration": 300,
                "alwaysShowNavOnTouchDevices": true,
                "disableScrolling": true
            });
        ');
    }
}
add_action('wp_enqueue_scripts', 'photography_portfolio_scripts');

/**
 * Add gallery page styles
 */
function photo_portfolio_gallery_styles() {
    if (is_page_template('page-templates/template-gallery.php')) {
        wp_add_inline_style('photo-portfolio-tailwind', '
            .filter-button {
                padding: 0.75rem 1.5rem;
                border-radius: 9999px;
                color: #4A4A4A;
                background-color: rgba(255, 255, 255, 0.5);
                backdrop-filter: blur(8px);
                border: 1px solid #EAE8E1;
                font-family: "Libre Franklin", sans-serif;
                font-size: 0.875rem;
                letter-spacing: 0.05em;
                text-transform: uppercase;
                transition: all 300ms ease-in-out;
            }

            .filter-button:hover {
                color: #9B3322;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                transform: translateY(-2px);
            }

            .filter-button.active {
                background-color: #9B3322;
                color: white;
                border-color: #9B3322;
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }

            .filter-button.active:hover {
                background-color: #8A2E1E;
                border-color: #8A2E1E;
            }

            .gallery-item {
                transition: all 500ms;
                transform-origin: center;
            }

            .gallery-item.hidden {
                opacity: 0;
                transform: scale(0.95);
            }

            .gallery-item.visible {
                opacity: 1;
                transform: scale(1);
            }

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
        ');
    }
}
add_action('wp_enqueue_scripts', 'photo_portfolio_gallery_styles', 20);

/**
 * Disable WordPress caching and add cache-busting
 */
function disable_wp_caching() {
    // Disable WordPress caching
    define('DONOTCACHEPAGE', true);
    
    // Send cache-busting headers
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Cache-Control: post-check=0, pre-check=0", false);
    header("Pragma: no-cache");
}
add_action('init', 'disable_wp_caching');

// Add version number to style and script files
function cache_bust_assets($src) {
    if (strpos($src, '/wp-content/themes/') !== false) {
        $src = add_query_arg('ver', time(), $src);
    }
    return $src;
}
add_filter('style_loader_src', 'cache_bust_assets', 10, 1);
add_filter('script_loader_src', 'cache_bust_assets', 10, 1);

/**
 * Clear all WordPress caches
 */
function clear_all_caches() {
    // Clear all transients
    global $wpdb;
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '%_transient_%'");
    
    // Clear object cache if exists
    wp_cache_flush();
    
    // Clear page cache if exists
    if (function_exists('wp_cache_clear_cache')) {
        wp_cache_clear_cache();
    }
}
add_action('init', 'clear_all_caches');

/**
 * Verify and fix homepage settings
 */
function verify_homepage_settings() {
    // Get all pages with our template
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'page-templates/template-home.php'
    ));
    
    if (!empty($pages)) {
        $homepage = $pages[0];
        
        // Ensure this page is set as the homepage
        update_option('show_on_front', 'page');
        update_option('page_on_front', $homepage->ID);
        
        // Force refresh permalinks
        flush_rewrite_rules();
    }
}
add_action('init', 'verify_homepage_settings');

/**
 * Set up the homepage
 */
function setup_homepage() {
    // Check if homepage is already set
    $current_homepage_id = get_option('page_on_front');
    $current_show_on_front = get_option('show_on_front');
    
    if (!$current_homepage_id || $current_show_on_front !== 'page') {
        // Create homepage if it doesn't exist
        $homepage = array(
            'post_type' => 'page',
            'post_title' => 'Home',
            'post_status' => 'publish',
            'post_author' => 1,
        );
        
        $homepage_id = wp_insert_post($homepage);
        
        if (!is_wp_error($homepage_id)) {
            // Set the template
            update_post_meta($homepage_id, '_wp_page_template', 'page-templates/template-home.php');
            
            // Set as static homepage
            update_option('show_on_front', 'page');
            update_option('page_on_front', $homepage_id);
        }
    }
}
add_action('after_switch_theme', 'setup_homepage');
add_action('init', 'setup_homepage');

/**
 * Force homepage template
 */
function force_homepage_template($template) {
    if (is_front_page()) {
        $new_template = locate_template(array('front-page.php'));
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'force_homepage_template', 99);

/**
 * Register theme templates
 */
function register_theme_templates($post_templates, $wp_theme, $post, $post_type) {
    // Add custom templates
    if ($post_type === 'page') {
        $post_templates['front-page.php'] = 'Front Page Template';
    }
    return $post_templates;
}
add_filter('theme_templates', 'register_theme_templates', 10, 4);

/**
 * Debug homepage settings
 */
function debug_homepage_settings() {
    if (is_admin()) {
        $show_on_front = get_option('show_on_front');
        $page_on_front = get_option('page_on_front');
        $front_page_id = get_option('page_on_front');
        $front_page = get_post($front_page_id);
        
        error_log('Homepage Settings:');
        error_log('show_on_front: ' . $show_on_front);
        error_log('page_on_front: ' . $page_on_front);
        error_log('front_page_id: ' . $front_page_id);
        error_log('front_page title: ' . ($front_page ? $front_page->post_title : 'Not set'));
        error_log('front_page template: ' . ($front_page ? get_page_template_slug($front_page_id) : 'Not set'));
    }
}
add_action('admin_init', 'debug_homepage_settings');

/**
 * Include required files
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Register Portfolio Categories
 */
function photography_register_portfolio_taxonomies() {
    // Register Portfolio Categories
    $category_labels = array(
        'name'              => _x('Portfolio Categories', 'taxonomy general name', 'photography-themeone'),
        'singular_name'     => _x('Portfolio Category', 'taxonomy singular name', 'photography-themeone'),
        'search_items'      => __('Search Categories', 'photography-themeone'),
        'all_items'         => __('All Categories', 'photography-themeone'),
        'parent_item'       => __('Parent Category', 'photography-themeone'),
        'parent_item_colon' => __('Parent Category:', 'photography-themeone'),
        'edit_item'         => __('Edit Category', 'photography-themeone'),
        'update_item'       => __('Update Category', 'photography-themeone'),
        'add_new_item'      => __('Add New Category', 'photography-themeone'),
        'new_item_name'     => __('New Category Name', 'photography-themeone'),
        'menu_name'         => __('Categories', 'photography-themeone'),
    );

    $category_args = array(
        'hierarchical'      => true,
        'labels'           => $category_labels,
        'show_ui'          => true,
        'show_admin_column'=> true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'portfolio-category'),
        'show_in_rest'     => true,
    );

    register_taxonomy('portfolio_category', array('portfolio'), $category_args);

    // Register Portfolio Tags
    $tag_labels = array(
        'name'              => _x('Portfolio Tags', 'taxonomy general name', 'photography-themeone'),
        'singular_name'     => _x('Portfolio Tag', 'taxonomy singular name', 'photography-themeone'),
        'search_items'      => __('Search Tags', 'photography-themeone'),
        'all_items'         => __('All Tags', 'photography-themeone'),
        'edit_item'         => __('Edit Tag', 'photography-themeone'),
        'update_item'       => __('Update Tag', 'photography-themeone'),
        'add_new_item'      => __('Add New Tag', 'photography-themeone'),
        'new_item_name'     => __('New Tag Name', 'photography-themeone'),
        'menu_name'         => __('Tags', 'photography-themeone'),
    );

    $tag_args = array(
        'hierarchical'      => false,
        'labels'           => $tag_labels,
        'show_ui'          => true,
        'show_admin_column'=> true,
        'query_var'        => true,
        'rewrite'          => array('slug' => 'portfolio-tag'),
        'show_in_rest'     => true,
    );

    register_taxonomy('portfolio_tag', array('portfolio'), $tag_args);

    // Add default categories
    $default_categories = array(
        'Wedding Photography' => array(
            'description' => 'Capturing beautiful wedding moments',
            'slug' => 'wedding-photography'
        ),
        'Pre-Wedding Shoots' => array(
            'description' => 'Romantic pre-wedding photo sessions',
            'slug' => 'pre-wedding-shoots'
        ),
        'Maternity' => array(
            'description' => 'Beautiful maternity photography',
            'slug' => 'maternity'
        ),
        'Newborn' => array(
            'description' => 'Precious newborn photo sessions',
            'slug' => 'newborn'
        ),
        'Family Portraits' => array(
            'description' => 'Family portrait photography',
            'slug' => 'family-portraits'
        ),
        'Events' => array(
            'description' => 'Event photography coverage',
            'slug' => 'events'
        ),
        'Fashion' => array(
            'description' => 'Fashion and model photography',
            'slug' => 'fashion'
        ),
        'Commercial' => array(
            'description' => 'Commercial photography services',
            'slug' => 'commercial'
        )
    );

    foreach ($default_categories as $cat_name => $cat_args) {
        if (!term_exists($cat_name, 'portfolio_category')) {
            wp_insert_term(
                $cat_name,
                'portfolio_category',
                array(
                    'description' => $cat_args['description'],
                    'slug' => $cat_args['slug']
                )
            );
        }
    }
}
add_action('init', 'photography_register_portfolio_taxonomies');

/**
 * Flush rewrite rules on theme activation
 */
function photography_rewrite_flush() {
    photography_register_portfolio_taxonomies();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'photography_rewrite_flush');

/**
 * Add Custom Meta Box for Portfolio Details
 */
function photography_add_portfolio_meta_boxes() {
    add_meta_box(
        'portfolio_details',
        __('Portfolio Details', 'photography-themeone'),
        'photography_portfolio_details_callback',
        'portfolio',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'photography_add_portfolio_meta_boxes');

/**
 * Portfolio Meta Box Callback
 */
function photography_portfolio_details_callback($post) {
    wp_nonce_field('photography_portfolio_details', 'portfolio_details_nonce');

    $client_name = get_post_meta($post->ID, '_portfolio_client_name', true);
    $location = get_post_meta($post->ID, '_portfolio_location', true);
    $shoot_date = get_post_meta($post->ID, '_portfolio_shoot_date', true);
    ?>
    <div class="portfolio-meta-box">
        <style>
            .portfolio-meta-box {
                padding: 12px;
                background: <?php echo '#F0EFEA'; ?>;
                border-radius: 6px;
            }
            .portfolio-meta-box p {
                margin: 1em 0;
            }
            .portfolio-meta-box label {
                display: block;
                font-weight: 600;
                margin-bottom: 5px;
                color: <?php echo '#1A1A1A'; ?>;
            }
            .portfolio-meta-box input[type="text"],
            .portfolio-meta-box input[type="date"] {
                width: 100%;
                padding: 8px;
                border: 1px solid <?php echo '#D8D6CF'; ?>;
                border-radius: 4px;
            }
            .portfolio-meta-box input[type="text"]:focus,
            .portfolio-meta-box input[type="date"]:focus {
                border-color: <?php echo '#9B3322'; ?>;
                outline: none;
                box-shadow: 0 0 0 1px <?php echo '#9B3322'; ?>;
            }
        </style>
        <p>
            <label for="portfolio_client_name"><?php _e('Client Name:', 'photography-themeone'); ?></label>
            <input type="text" id="portfolio_client_name" name="portfolio_client_name" 
                   value="<?php echo esc_attr($client_name); ?>" />
        </p>
        <p>
            <label for="portfolio_location"><?php _e('Location:', 'photography-themeone'); ?></label>
            <input type="text" id="portfolio_location" name="portfolio_location" 
                   value="<?php echo esc_attr($location); ?>" />
        </p>
        <p>
            <label for="portfolio_shoot_date"><?php _e('Shoot Date:', 'photography-themeone'); ?></label>
            <input type="date" id="portfolio_shoot_date" name="portfolio_shoot_date" 
                   value="<?php echo esc_attr($shoot_date); ?>" />
        </p>
    </div>
    <?php
}

/**
 * Save Portfolio Meta Box Data
 */
function photography_save_portfolio_meta($post_id) {
    if (!isset($_POST['portfolio_details_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['portfolio_details_nonce'], 'photography_portfolio_details')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'portfolio_client_name' => '_portfolio_client_name',
        'portfolio_location' => '_portfolio_location',
        'portfolio_shoot_date' => '_portfolio_shoot_date'
    );

    foreach ($fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post_portfolio', 'photography_save_portfolio_meta');

// Register Testimonial Custom Post Type
function register_testimonial_post_type() {
    $labels = array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonials',
        'add_new'            => 'Add New',
        'add_new_item'       => 'Add New Testimonial',
        'edit_item'          => 'Edit Testimonial',
        'new_item'           => 'New Testimonial',
        'view_item'          => 'View Testimonial',
        'search_items'       => 'Search Testimonials',
        'not_found'          => 'No testimonials found',
        'not_found_in_trash' => 'No testimonials found in Trash'
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'exclude_from_search' => true,
        'publicly_queryable'  => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'testimonial'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-quote',
        'supports'           => array('title', 'editor'),
    );

    register_post_type('testimonial', $args);
}
add_action('init', 'register_testimonial_post_type');

// Add custom meta box for testimonial details
function add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_details',
        'Testimonial Details',
        'render_testimonial_meta_box',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

// Render meta box content
function render_testimonial_meta_box($post) {
    $client_name = get_post_meta($post->ID, 'client_name', true);
    $client_role = get_post_meta($post->ID, 'client_role', true);

    wp_nonce_field('testimonial_meta_box', 'testimonial_meta_box_nonce');
    ?>
    <p>
        <label for="client_name">Client Name:</label><br>
        <input type="text" id="client_name" name="client_name" value="<?php echo esc_attr($client_name); ?>" class="widefat">
    </p>
    <p>
        <label for="client_role">Client Role/Event Type:</label><br>
        <input type="text" id="client_role" name="client_role" value="<?php echo esc_attr($client_role); ?>" class="widefat">
    </p>
    <?php
}

// Save meta box data
function save_testimonial_meta_box($post_id) {
    if (!isset($_POST['testimonial_meta_box_nonce'])) {
        return;
    }

    if (!wp_verify_nonce($_POST['testimonial_meta_box_nonce'], 'testimonial_meta_box')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['client_name'])) {
        update_post_meta($post_id, 'client_name', sanitize_text_field($_POST['client_name']));
    }

    if (isset($_POST['client_role'])) {
        update_post_meta($post_id, 'client_role', sanitize_text_field($_POST['client_role']));
    }
}
add_action('save_post_testimonial', 'save_testimonial_meta_box');

/**
 * Register ACF Fields
 */
if (function_exists('acf_add_local_field_group')):

    // Debug ACF registration
    add_action('admin_notices', function() {
        if (WP_DEBUG) {
            echo '<div class="notice notice-info is-dismissible">';
            echo '<p>ACF Field Groups Registration Status:</p>';
            echo '<ul>';
            echo '<li>Instagram Feed Group: ' . (acf_get_field_group('group_instagram_feed') ? 'Registered' : 'Not Registered') . '</li>';
            echo '</ul>';
            echo '</div>';
        }
    });

    acf_add_local_field_group(array(
        'key' => 'group_hero_slider',
        'title' => 'Hero Slider',
        'fields' => array(
            array(
                'key' => 'field_hero_slides',
                'label' => 'Hero Slides',
                'name' => 'hero_slides',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add Slide',
                'sub_fields' => array(
                    array(
                        'key' => 'field_slide_image',
                        'label' => 'Slide Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => '',
                        'required' => 1,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array(
                        'key' => 'field_slide_title',
                        'label' => 'Slide Title',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                    array(
                        'key' => 'field_slide_subtitle',
                        'label' => 'Slide Subtitle',
                        'name' => 'subtitle',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
            array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => get_option('page_on_front'),
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_hero_content',
        'title' => 'Hero Content',
        'fields' => array(
            array(
                'key' => 'field_hero_heading',
                'label' => 'Main Heading',
                'name' => 'hero_heading',
                'type' => 'text',
                'instructions' => 'Enter the main heading for the hero section',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_hero_subheading',
                'label' => 'Sub Heading',
                'name' => 'hero_subheading',
                'type' => 'text',
                'instructions' => 'Enter the sub heading text',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'field_hero_description',
                'label' => 'Description',
                'name' => 'hero_description',
                'type' => 'textarea',
                'instructions' => 'Enter the description text',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'field_hero_button_text',
                'label' => 'Button Text',
                'name' => 'hero_button_text',
                'type' => 'text',
                'instructions' => 'Enter the button text',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'field_hero_button_link',
                'label' => 'Button Link',
                'name' => 'hero_button_link',
                'type' => 'link',
                'instructions' => 'Select the button link',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
            ),
            array(
                'key' => 'field_hero_secondary_button_text',
                'label' => 'Secondary Button Text',
                'name' => 'hero_secondary_button_text',
                'type' => 'text',
                'instructions' => 'Enter the secondary button text (e.g., "View Gallery")',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
            ),
            array(
                'key' => 'field_hero_secondary_button_link',
                'label' => 'Secondary Button Link',
                'name' => 'hero_secondary_button_link',
                'type' => 'link',
                'instructions' => 'Select the secondary button link',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
            array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => get_option('page_on_front'),
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_about_section',
        'title' => 'About Section',
        'fields' => array(
            array(
                'key' => 'field_about_highlight_text',
                'label' => 'Highlight Text',
                'name' => 'about_highlight_text',
                'type' => 'text',
                'instructions' => 'Enter the highlighted part of the title (e.g., "About")',
                'required' => 0,
            ),
            array(
                'key' => 'field_about_title',
                'label' => 'Title',
                'name' => 'about_title',
                'type' => 'text',
                'instructions' => 'Enter the main title (e.g., "Our Studio")',
                'required' => 0,
            ),
            array(
                'key' => 'field_about_content',
                'label' => 'Content',
                'name' => 'about_content',
                'type' => 'textarea',
                'instructions' => 'Enter the about section content',
                'required' => 0,
            ),
            array(
                'key' => 'field_about_image',
                'label' => 'Image',
                'name' => 'about_image',
                'type' => 'image',
                'instructions' => 'Upload the about section image',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_about_button_text',
                'label' => 'Button Text',
                'name' => 'about_button_text',
                'type' => 'text',
                'instructions' => 'Enter the button text',
                'required' => 0,
            ),
            array(
                'key' => 'field_about_button_link',
                'label' => 'Button Link',
                'name' => 'about_button_link',
                'type' => 'link',
                'instructions' => 'Select the button link',
                'required' => 0,
                'return_format' => 'array',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
            array(
                array(
                    'param' => 'page',
                    'operator' => '==',
                    'value' => get_option('page_on_front'),
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_services_section',
        'title' => 'Services Section',
        'fields' => array(
            array(
                'key' => 'field_services_highlight_text',
                'label' => 'Highlight Text',
                'name' => 'services_highlight_text',
                'type' => 'text',
                'instructions' => 'Enter the highlighted part of the title (e.g., "Our")',
                'required' => 0,
            ),
            array(
                'key' => 'field_services_title',
                'label' => 'Title',
                'name' => 'services_title',
                'type' => 'text',
                'instructions' => 'Enter the main title (e.g., "Services")',
                'required' => 0,
            ),
            array(
                'key' => 'field_services_description',
                'label' => 'Description',
                'name' => 'services_description',
                'type' => 'textarea',
                'instructions' => 'Enter a brief description for the services section',
                'required' => 0,
            ),
            array(
                'key' => 'field_services',
                'label' => 'Services',
                'name' => 'services',
                'type' => 'repeater',
                'instructions' => 'Add your services',
                'required' => 0,
                'min' => 0,
                'max' => 0,
                'layout' => 'block',
                'button_label' => 'Add Service',
                'sub_fields' => array(
                    array(
                        'key' => 'field_service_image',
                        'label' => 'Service Image',
                        'name' => 'image',
                        'type' => 'image',
                        'instructions' => 'Upload an image for this service',
                        'required' => 1,
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                    ),
                    array(
                        'key' => 'field_service_title',
                        'label' => 'Service Title',
                        'name' => 'title',
                        'type' => 'text',
                        'instructions' => 'Enter the service title',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_service_description',
                        'label' => 'Service Description',
                        'name' => 'description',
                        'type' => 'textarea',
                        'instructions' => 'Enter a brief description of the service',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_service_price',
                        'label' => 'Starting Price',
                        'name' => 'price',
                        'type' => 'text',
                        'instructions' => 'Enter the starting price (e.g., "$299")',
                        'required' => 0,
                    ),
                    array(
                        'key' => 'field_service_link',
                        'label' => 'Service Link',
                        'name' => 'link',
                        'type' => 'link',
                        'instructions' => 'Add a link to learn more about this service',
                        'required' => 0,
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_service_background_color',
                        'label' => 'Background Color Class',
                        'name' => 'background_color',
                        'type' => 'select',
                        'instructions' => 'Select the background color for the service card',
                        'choices' => array(
                            'bg-brand-primary-light' => 'Primary Light',
                            'bg-accent-yellow' => 'Accent Yellow',
                            'bg-accent-purple' => 'Accent Purple',
                            'bg-accent-pink' => 'Accent Pink',
                        ),
                        'default_value' => 'bg-brand-primary-light',
                        'required' => 0,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 2,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_instagram_feed',
        'title' => 'Instagram Feed Section',
        'fields' => array(
            array(
                'key' => 'field_instagram_title',
                'label' => 'Section Title',
                'name' => 'instagram_title',
                'type' => 'text',
                'default_value' => 'Follow Our Journey on Instagram @tinytotsstudio',
                'required' => 1,
            ),
            array(
                'key' => 'field_instagram_handle',
                'label' => 'Instagram Handle',
                'name' => 'instagram_handle',
                'type' => 'text',
                'default_value' => '@tinytotsstudio',
                'required' => 1,
            ),
            array(
                'key' => 'field_instagram_url',
                'label' => 'Instagram Profile URL',
                'name' => 'instagram_url',
                'type' => 'url',
                'default_value' => 'https://instagram.com/tinytotsstudio',
                'required' => 1,
            ),
            array(
                'key' => 'field_instagram_images_top',
                'label' => 'Top Row Images (Left to Right)',
                'name' => 'instagram_images_top',
                'type' => 'gallery',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'min' => 6,
                'max' => 6,
                'insert' => 'append',
                'library' => 'all',
                'mime_types' => 'jpg, jpeg, png',
                'required' => 1,
                'instructions' => 'Select exactly 6 images for the top row carousel (moves left to right)',
            ),
            array(
                'key' => 'field_instagram_images_bottom',
                'label' => 'Bottom Row Images (Right to Left)',
                'name' => 'instagram_images_bottom',
                'type' => 'gallery',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'min' => 6,
                'max' => 6,
                'insert' => 'append',
                'library' => 'all',
                'mime_types' => 'jpg, jpeg, png',
                'required' => 1,
                'instructions' => 'Select exactly 6 images for the bottom row carousel (moves right to left)',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Configure the Instagram feed section on the homepage',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_testimonials_section',
        'title' => 'Testimonials Section',
        'fields' => array(
            array(
                'key' => 'field_testimonials_title',
                'label' => 'Section Title',
                'name' => 'testimonials_title',
                'type' => 'text',
                'default_value' => 'What Our Clients Say',
                'required' => 1,
            ),
            array(
                'key' => 'field_testimonials_subtitle',
                'label' => 'Section Subtitle',
                'name' => 'testimonials_subtitle',
                'type' => 'text',
                'default_value' => 'Real stories from our happy clients',
                'required' => 1,
            ),
            array(
                'key' => 'field_testimonials',
                'label' => 'Testimonials',
                'name' => 'testimonials',
                'type' => 'repeater',
                'required' => 1,
                'min' => 3,
                'max' => 6,
                'layout' => 'block',
                'button_label' => 'Add Testimonial',
                'sub_fields' => array(
                    array(
                        'key' => 'field_testimonial_client_image',
                        'label' => 'Client Image',
                        'name' => 'client_image',
                        'type' => 'image',
                        'required' => 1,
                        'return_format' => 'array',
                        'preview_size' => 'thumbnail',
                        'library' => 'all',
                        'instructions' => 'Upload a square image of the client (recommended size: 100x100px)',
                    ),
                    array(
                        'key' => 'field_testimonial_client_name',
                        'label' => 'Client Name',
                        'name' => 'client_name',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_testimonial_client_location',
                        'label' => 'Client Location',
                        'name' => 'client_location',
                        'type' => 'text',
                        'required' => 1,
                        'instructions' => 'e.g., "Mumbai, India"',
                    ),
                    array(
                        'key' => 'field_testimonial_rating',
                        'label' => 'Rating',
                        'name' => 'rating',
                        'type' => 'number',
                        'required' => 1,
                        'min' => 1,
                        'max' => 5,
                        'default_value' => 5,
                        'instructions' => 'Rate from 1 to 5 stars',
                    ),
                    array(
                        'key' => 'field_testimonial_content',
                        'label' => 'Testimonial Content',
                        'name' => 'content',
                        'type' => 'textarea',
                        'required' => 1,
                        'rows' => 4,
                        'instructions' => 'The client\'s testimonial (recommended: 150-200 characters)',
                    ),
                    array(
                        'key' => 'field_testimonial_service_type',
                        'label' => 'Service Type',
                        'name' => 'service_type',
                        'type' => 'text',
                        'required' => 1,
                        'instructions' => 'e.g., "Baby Photoshoot", "Family Portrait"',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 4,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Configure the testimonials section on the homepage',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_faq_section',
        'title' => 'FAQ Section',
        'fields' => array(
            array(
                'key' => 'field_faq_title',
                'label' => 'Section Title',
                'name' => 'faq_title',
                'type' => 'text',
                'default_value' => 'Frequently Asked Questions',
                'required' => 1,
            ),
            array(
                'key' => 'field_faq_subtitle',
                'label' => 'Section Subtitle',
                'name' => 'faq_subtitle',
                'type' => 'text',
                'default_value' => 'Find answers to common questions about our photography services',
                'required' => 1,
            ),
            array(
                'key' => 'field_faqs',
                'label' => 'FAQs',
                'name' => 'faqs',
                'type' => 'repeater',
                'required' => 1,
                'min' => 4,
                'max' => 8,
                'layout' => 'block',
                'button_label' => 'Add FAQ',
                'sub_fields' => array(
                    array(
                        'key' => 'field_faq_question',
                        'label' => 'Question',
                        'name' => 'question',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_faq_answer',
                        'label' => 'Answer',
                        'name' => 'answer',
                        'type' => 'textarea',
                        'required' => 1,
                        'rows' => 3,
                    ),
                ),
            ),
            array(
                'key' => 'field_faq_cta_text',
                'label' => 'CTA Text',
                'name' => 'faq_cta_text',
                'type' => 'text',
                'default_value' => 'Still have questions?',
                'required' => 1,
            ),
            array(
                'key' => 'field_faq_cta_button_text',
                'label' => 'CTA Button Text',
                'name' => 'faq_cta_button_text',
                'type' => 'text',
                'default_value' => 'Contact Us',
                'required' => 1,
            ),
            array(
                'key' => 'field_faq_cta_button_url',
                'label' => 'CTA Button URL',
                'name' => 'faq_cta_button_url',
                'type' => 'url',
                'default_value' => '#contact',
                'required' => 1,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 5,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Configure the FAQ section on the homepage',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_cta_section',
        'title' => 'CTA Section',
        'fields' => array(
            array(
                'key' => 'field_cta_background',
                'label' => 'Background Image',
                'name' => 'cta_background',
                'type' => 'image',
                'required' => 0,
                'return_format' => 'array',
                'preview_size' => 'large',
                'library' => 'all',
                'instructions' => 'Choose a high-resolution image (recommended: 1920x1080px)',
            ),
            array(
                'key' => 'field_cta_overlay_opacity',
                'label' => 'Overlay Opacity',
                'name' => 'cta_overlay_opacity',
                'type' => 'range',
                'required' => 0,
                'min' => 0,
                'max' => 90,
                'step' => 5,
                'default_value' => 50,
                'instructions' => 'Adjust the dark overlay opacity (0-90%)',
            ),
            array(
                'key' => 'field_cta_title',
                'label' => 'Title',
                'name' => 'cta_title',
                'type' => 'text',
                'required' => 0,
                'default_value' => 'Let\'s Capture Your Family\'s Beautiful Story',
            ),
            array(
                'key' => 'field_cta_description',
                'label' => 'Description',
                'name' => 'cta_description',
                'type' => 'textarea',
                'required' => 0,
                'rows' => 3,
                'default_value' => 'Book now and receive a complimentary 8x10 print with your session package',
            ),
            array(
                'key' => 'field_cta_buttons',
                'label' => 'CTA Buttons',
                'name' => 'cta_buttons',
                'type' => 'repeater',
                'required' => 0,
                'min' => 0,
                'max' => 2,
                'layout' => 'table',
                'button_label' => 'Add Button',
                'sub_fields' => array(
                    array(
                        'key' => 'field_cta_button_text',
                        'label' => 'Button Text',
                        'name' => 'button_text',
                        'type' => 'text',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_cta_button_url',
                        'label' => 'Button URL',
                        'name' => 'button_url',
                        'type' => 'url',
                        'required' => 1,
                    ),
                    array(
                        'key' => 'field_cta_button_style',
                        'label' => 'Button Style',
                        'name' => 'button_style',
                        'type' => 'select',
                        'required' => 1,
                        'choices' => array(
                            'primary' => 'Primary (Solid)',
                            'secondary' => 'Secondary (Outline)',
                        ),
                        'default_value' => 'primary',
                    ),
                ),
            ),
            array(
                'key' => 'field_cta_scroll_text',
                'label' => 'Banner Text',
                'name' => 'cta_scroll_text',
                'type' => 'text',
                'required' => 0,
                'default_value' => 'Limited Time Offer',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
        ),
        'menu_order' => 6,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => 'Configure the CTA section with parallax effect',
    ));

endif;

/**
 * Register Portfolio Custom Post Type
 */
function register_portfolio_post_type() {
    $labels = array(
        'name'               => _x('Portfolio', 'post type general name', 'photo-portfolio'),
        'singular_name'      => _x('Portfolio Item', 'post type singular name', 'photo-portfolio'),
        'menu_name'          => _x('Portfolio', 'admin menu', 'photo-portfolio'),
        'name_admin_bar'     => _x('Portfolio Item', 'add new on admin bar', 'photo-portfolio'),
        'add_new'            => _x('Add New', 'portfolio item', 'photo-portfolio'),
        'add_new_item'       => __('Add New Portfolio Item', 'photo-portfolio'),
        'new_item'           => __('New Portfolio Item', 'photo-portfolio'),
        'edit_item'          => __('Edit Portfolio Item', 'photo-portfolio'),
        'view_item'          => __('View Portfolio Item', 'photo-portfolio'),
        'all_items'          => __('All Portfolio Items', 'photo-portfolio'),
        'search_items'       => __('Search Portfolio Items', 'photo-portfolio'),
        'parent_item_colon'  => __('Parent Portfolio Items:', 'photo-portfolio'),
        'not_found'          => __('No portfolio items found.', 'photo-portfolio'),
        'not_found_in_trash' => __('No portfolio items found in Trash.', 'photo-portfolio')
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'portfolio'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-gallery',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'show_in_rest'       => true
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'register_portfolio_post_type');