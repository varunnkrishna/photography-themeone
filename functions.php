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
