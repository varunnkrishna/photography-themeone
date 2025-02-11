<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function photo_portfolio_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'photo_portfolio_pingback_header' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function photo_portfolio_body_classes( $classes ) {
    // Adds a class of hfeed to non-singular pages.
    if ( ! is_singular() ) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if ( ! is_active_sidebar( 'sidebar-1' ) ) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_action( 'body_class', 'photo_portfolio_body_classes' );

/**
 * Add a custom class to the navigation menu items
 */
function photo_portfolio_nav_menu_css_class( $classes, $item ) {
    $classes[] = 'nav-item';
    return $classes;
}
add_filter( 'nav_menu_css_class', 'photo_portfolio_nav_menu_css_class', 10, 2 );

/**
 * Add a custom class to the navigation menu links
 */
function photo_portfolio_nav_menu_link_attributes( $atts, $item, $args ) {
    $atts['class'] = 'nav-link';
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'photo_portfolio_nav_menu_link_attributes', 10, 3 );
