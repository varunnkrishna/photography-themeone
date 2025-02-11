<?php
/**
 * Custom Theme Settings
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Theme Settings Page
 */
function photo_portfolio_add_theme_page() {
    add_theme_page(
        __('Theme Settings', 'photo-portfolio'),
        __('Theme Settings', 'photo-portfolio'),
        'manage_options',
        'theme-settings',
        'photo_portfolio_render_theme_settings'
    );
}
add_action('admin_menu', 'photo_portfolio_add_theme_page');

/**
 * Register Settings
 */
function photo_portfolio_register_settings() {
    register_setting('photo_portfolio_settings', 'photo_portfolio_hero_slides');
    register_setting('photo_portfolio_settings', 'photo_portfolio_slider_settings');
}
add_action('admin_init', 'photo_portfolio_register_settings');

/**
 * Get Hero Slides
 */
function photo_portfolio_get_hero_slides() {
    $slides = get_option('photo_portfolio_hero_slides', array());
    if (empty($slides)) {
        // Default slides
        $slides = array(
            array(
                'image' => get_template_directory_uri() . '/assets/images/slide1.jpg',
                'title' => 'Karthik Clicks',
                'subtitle' => 'Capturing Life\'s Extraordinary Moments'
            ),
            array(
                'image' => get_template_directory_uri() . '/assets/images/slide2.jpg',
                'title' => 'Karthik Clicks',
                'subtitle' => 'Capturing Life\'s Extraordinary Moments'
            ),
            array(
                'image' => get_template_directory_uri() . '/assets/images/slide3.jpg',
                'title' => 'Karthik Clicks',
                'subtitle' => 'Capturing Life\'s Extraordinary Moments'
            ),
            array(
                'image' => get_template_directory_uri() . '/assets/images/slide4.jpg',
                'title' => 'Karthik Clicks',
                'subtitle' => 'Capturing Life\'s Extraordinary Moments'
            )
        );
    }
    return $slides;
}

/**
 * Get Slider Settings
 */
function photo_portfolio_get_slider_settings() {
    $settings = get_option('photo_portfolio_slider_settings', array());
    return wp_parse_args($settings, array(
        'autoplay' => true,
        'autoplay_speed' => 5000
    ));
}

/**
 * Render Theme Settings Page
 */
function photo_portfolio_render_theme_settings() {
    if (!current_user_can('manage_options')) {
        return;
    }

    // Save Settings
    if (isset($_POST['photo_portfolio_save_settings']) && check_admin_referer('photo_portfolio_settings_nonce')) {
        $slides = array();
        if (isset($_POST['slides']) && is_array($_POST['slides'])) {
            foreach ($_POST['slides'] as $slide) {
                if (empty($slide['image'])) continue;
                $slides[] = array(
                    'image' => esc_url_raw($slide['image']),
                    'title' => sanitize_text_field($slide['title']),
                    'subtitle' => sanitize_text_field($slide['subtitle'])
                );
            }
        }

        $settings = array(
            'autoplay' => isset($_POST['autoplay']),
            'autoplay_speed' => absint($_POST['autoplay_speed'])
        );

        update_option('photo_portfolio_hero_slides', $slides);
        update_option('photo_portfolio_slider_settings', $settings);
        
        echo '<div class="notice notice-success"><p>' . __('Settings saved successfully!', 'photo-portfolio') . '</p></div>';
    }

    $slides = photo_portfolio_get_hero_slides();
    $settings = photo_portfolio_get_slider_settings();
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        
        <form method="post" action="">
            <?php wp_nonce_field('photo_portfolio_settings_nonce'); ?>
            
            <h2><?php _e('Hero Slider Settings', 'photo-portfolio'); ?></h2>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('Enable Autoplay', 'photo-portfolio'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="autoplay" value="1" <?php checked($settings['autoplay']); ?>>
                            <?php _e('Automatically advance slides', 'photo-portfolio'); ?>
                        </label>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Autoplay Speed (ms)', 'photo-portfolio'); ?></th>
                    <td>
                        <input type="number" name="autoplay_speed" value="<?php echo esc_attr($settings['autoplay_speed']); ?>"
                               min="2000" max="10000" step="500">
                        <p class="description"><?php _e('Time between slides in milliseconds (2000 - 10000)', 'photo-portfolio'); ?></p>
                    </td>
                </tr>
            </table>
            
            <h2><?php _e('Slides', 'photo-portfolio'); ?></h2>
            
            <div id="hero-slides">
                <?php foreach ($slides as $index => $slide) : ?>
                <div class="slide-item" style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border: 1px solid #ddd;">
                    <h3><?php printf(__('Slide %d', 'photo-portfolio'), $index + 1); ?></h3>
                    
                    <p>
                        <label><?php _e('Image:', 'photo-portfolio'); ?></label><br>
                        <input type="hidden" name="slides[<?php echo $index; ?>][image]" 
                               value="<?php echo esc_url($slide['image']); ?>" 
                               class="slide-image-input">
                        <img src="<?php echo esc_url($slide['image']); ?>" 
                             style="max-width: 200px; margin: 10px 0; display: <?php echo empty($slide['image']) ? 'none' : 'block'; ?>"
                             class="slide-image-preview">
                        <button type="button" class="button upload-image">
                            <?php _e('Choose Image', 'photo-portfolio'); ?>
                        </button>
                        <button type="button" class="button remove-image" style="display: <?php echo empty($slide['image']) ? 'none' : 'inline-block'; ?>">
                            <?php _e('Remove Image', 'photo-portfolio'); ?>
                        </button>
                    </p>
                    
                    <p>
                        <label><?php _e('Title:', 'photo-portfolio'); ?></label><br>
                        <input type="text" name="slides[<?php echo $index; ?>][title]" 
                               value="<?php echo esc_attr($slide['title']); ?>" 
                               class="regular-text">
                    </p>
                    
                    <p>
                        <label><?php _e('Subtitle:', 'photo-portfolio'); ?></label><br>
                        <input type="text" name="slides[<?php echo $index; ?>][subtitle]" 
                               value="<?php echo esc_attr($slide['subtitle']); ?>" 
                               class="regular-text">
                    </p>

                    <p>
                        <button type="button" class="button remove-slide">
                            <?php _e('Remove Slide', 'photo-portfolio'); ?>
                        </button>
                    </p>
                </div>
                <?php endforeach; ?>
            </div>
            
            <p>
                <button type="button" class="button" id="add-slide">
                    <?php _e('Add Slide', 'photo-portfolio'); ?>
                </button>
            </p>
            
            <p class="submit">
                <input type="submit" name="photo_portfolio_save_settings" class="button-primary" 
                       value="<?php _e('Save Settings', 'photo-portfolio'); ?>">
            </p>
        </form>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Media Uploader
        var mediaUploader;
        
        function initMediaUploader(button) {
            mediaUploader = wp.media({
                title: '<?php _e('Select Image', 'photo-portfolio'); ?>',
                button: {
                    text: '<?php _e('Use this image', 'photo-portfolio'); ?>'
                },
                multiple: false
            });

            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                var container = $(button).closest('.slide-item');
                container.find('.slide-image-input').val(attachment.url);
                container.find('.slide-image-preview').attr('src', attachment.url).show();
                container.find('.remove-image').show();
            });

            mediaUploader.open();
        }

        // Upload Image
        $('#hero-slides').on('click', '.upload-image', function(e) {
            e.preventDefault();
            initMediaUploader(this);
        });

        // Remove Image
        $('#hero-slides').on('click', '.remove-image', function(e) {
            e.preventDefault();
            var container = $(this).closest('.slide-item');
            container.find('.slide-image-input').val('');
            container.find('.slide-image-preview').hide();
            $(this).hide();
        });

        // Add Slide
        $('#add-slide').click(function() {
            var index = $('.slide-item').length;
            var template = `
                <div class="slide-item" style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border: 1px solid #ddd;">
                    <h3><?php _e('New Slide', 'photo-portfolio'); ?></h3>
                    
                    <p>
                        <label><?php _e('Image:', 'photo-portfolio'); ?></label><br>
                        <input type="hidden" name="slides[${index}][image]" class="slide-image-input">
                        <img src="" style="max-width: 200px; margin: 10px 0; display: none" class="slide-image-preview">
                        <button type="button" class="button upload-image">
                            <?php _e('Choose Image', 'photo-portfolio'); ?>
                        </button>
                        <button type="button" class="button remove-image" style="display: none">
                            <?php _e('Remove Image', 'photo-portfolio'); ?>
                        </button>
                    </p>
                    
                    <p>
                        <label><?php _e('Title:', 'photo-portfolio'); ?></label><br>
                        <input type="text" name="slides[${index}][title]" class="regular-text">
                    </p>
                    
                    <p>
                        <label><?php _e('Subtitle:', 'photo-portfolio'); ?></label><br>
                        <input type="text" name="slides[${index}][subtitle]" class="regular-text">
                    </p>

                    <p>
                        <button type="button" class="button remove-slide">
                            <?php _e('Remove Slide', 'photo-portfolio'); ?>
                        </button>
                    </p>
                </div>
            `;
            $('#hero-slides').append(template);
        });

        // Remove Slide
        $('#hero-slides').on('click', '.remove-slide', function() {
            if ($('.slide-item').length > 1) {
                $(this).closest('.slide-item').remove();
            } else {
                alert('<?php _e('You must have at least one slide!', 'photo-portfolio'); ?>');
            }
        });
    });
    </script>
    <?php
}

// Enqueue admin scripts
function photo_portfolio_admin_scripts($hook) {
    if ('appearance_page_theme-settings' !== $hook) {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker');
}
add_action('admin_enqueue_scripts', 'photo_portfolio_admin_scripts');
