<?php
/**
 * The header for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-template-url="<?php echo esc_url(get_template_directory_uri()); ?>">
<?php wp_body_open(); ?>

<header class="fixed top-5 left-0 right-0 z-50 px-4 md:px-16">
    <div class="max-w-8xl mx-auto">
        <nav class="flex justify-between items-center px-6 md:px-10 py-4 md:py-5 
                    bg-black/85 backdrop-blur-lg rounded-lg 
                    border border-white/10 shadow-xl
                    transition-all duration-300 ease-in-out">
            
            <!-- Site Branding -->
            <div class="flex items-center gap-4">
                <?php if (has_custom_logo()): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <a href="<?php echo esc_url(home_url('/')); ?>" 
                       class="text-white/95 text-xl md:text-2xl font-bold font-nav 
                              hover:text-white transition-colors duration-300
                              drop-shadow-[0_2px_4px_rgba(0,0,0,0.2)]">
                        <?php bloginfo('name'); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Navigation Menu -->
            <div class="hidden md:flex items-center text-white">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu' => 'Main-menu',
                    'menu_class' => 'flex items-center gap-10 text-white',
                    'container' => 'nav',
                    'container_class' => 'text-white',
                    'menu_id' => 'primary-menu',
                    'fallback_cb' => false,
                    'items_wrap' => '<ul id="%1$s" class="%2$s text-white">%3$s</ul>'
                ));
                ?>
                <a href="/book-event" class="ml-10 bg-primary/90 text-white/95 px-7 py-3 rounded-lg 
                                       font-bold transition-all hover:-translate-y-0.5 hover:bg-primary 
                                       hover:shadow-lg border border-white/10">
                    Book Your Event
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden p-2 text-white/90 hover:text-white" 
                    aria-label="Toggle Menu"
                    onclick="document.getElementById('mobile-menu').classList.toggle('hidden')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden mt-2 mx-4">
            <nav class="bg-black/95 backdrop-blur-lg rounded-2xl p-4 
                        border border-white/10 shadow-xl">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu' => 'Main-menu',
                    'menu_class' => 'flex flex-col gap-2',
                    'container' => false,
                    'menu_id' => 'mobile-primary-menu',
                    'fallback_cb' => false,
                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>'
                ));
                ?>
                <a href="/book-event" class="block mt-4 bg-primary/90 text-white/95 text-center px-6 py-3 
                                       rounded-lg font-bold transition-all hover:bg-primary 
                                       hover:shadow-lg border border-white/10">
                    Book Your Event
                </a>
            </nav>
        </div>
    </div>
</header>

<div id="page" class="site">
    <div class="site-content">
        <!-- Rest of the content -->
    </div>
</div>
