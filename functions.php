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
 * Enqueue scripts and styles
 */
function photo_portfolio_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style(
        'photo-portfolio-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;500;600&family=Libre+Franklin:wght@300;400;500;600&display=swap',
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

    // Enqueue jQuery
    wp_enqueue_script('jquery');

    // Enqueue theme scripts
    wp_enqueue_script(
        'photo-portfolio-slider',
        get_template_directory_uri() . '/assets/js/slider.js',
        array('jquery'),
        PHOTO_PORTFOLIO_VERSION,
        true
    );

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
 * Include required files
 */
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/theme-settings.php';

/**
 * Required Plugins Notice
 */
function photo_portfolio_admin_notice_required_plugins() {
    $plugins = array(
        array(
            'name' => 'Advanced Custom Fields',
            'slug' => 'advanced-custom-fields',
            'required' => true,
        ),
    );

    foreach ($plugins as $plugin) {
        if (!is_plugin_active($plugin['slug'] . '/' . $plugin['slug'] . '.php')) {
            ?>
            <div class="notice notice-warning is-dismissible">
                <p><?php printf(esc_html__('The %1$s plugin is required for the Photo Portfolio theme to work properly. Please install it from WordPress.org.', 'photo-portfolio'), $plugin['name']); ?></p>
            </div>
            <?php
        }
    }
}
add_action('admin_notices', 'photo_portfolio_admin_notice_required_plugins');

/**
 * Register Custom Post Type for Portfolio
 */
function photography_register_portfolio_post_type() {
    $labels = array(
        'name'                  => _x('Portfolio', 'Post Type General Name', 'photography-themeone'),
        'singular_name'         => _x('Portfolio Item', 'Post Type Singular Name', 'photography-themeone'),
        'menu_name'            => __('Portfolio', 'photography-themeone'),
        'name_admin_bar'       => __('Portfolio', 'photography-themeone'),
        'archives'             => __('Portfolio Archives', 'photography-themeone'),
        'add_new'             => __('Add New', 'photography-themeone'),
        'add_new_item'        => __('Add New Portfolio Item', 'photography-themeone'),
        'new_item'            => __('New Portfolio Item', 'photography-themeone'),
        'edit_item'           => __('Edit Portfolio Item', 'photography-themeone'),
        'update_item'         => __('Update Portfolio Item', 'photography-themeone'),
        'view_item'           => __('View Portfolio Item', 'photography-themeone'),
        'search_items'        => __('Search Portfolio', 'photography-themeone'),
        'not_found'          => __('Not found', 'photography-themeone'),
        'not_found_in_trash' => __('Not found in Trash', 'photography-themeone'),
    );

    $rewrite = array(
        'slug'                => 'portfolio',
        'with_front'         => true,
        'pages'              => true,
        'feeds'              => true,
    );

    $args = array(
        'label'               => __('Portfolio', 'photography-themeone'),
        'labels'             => $labels,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies'         => array('portfolio_category', 'portfolio_tag'),
        'hierarchical'       => false,
        'public'             => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-format-gallery',
        'show_in_admin_bar'  => true,
        'show_in_nav_menus'  => true,
        'can_export'         => true,
        'has_archive'        => true,
        'exclude_from_search'=> false,
        'publicly_queryable' => true,
        'rewrite'           => $rewrite,
        'capability_type'    => 'post',
        'show_in_rest'       => true,
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'photography_register_portfolio_post_type');

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
    photography_register_portfolio_post_type();
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
