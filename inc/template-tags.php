<?php
/**
 * Custom template tags for this theme
 */

if ( ! function_exists( 'photo_portfolio_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function photo_portfolio_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() )
        );

        echo '<span class="posted-on">' . $time_string . '</span>';
    }
endif;

if ( ! function_exists( 'photo_portfolio_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function photo_portfolio_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'photo-portfolio' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>';
    }
endif;

if ( ! function_exists( 'photo_portfolio_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for categories, tags and comments.
     */
    function photo_portfolio_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            $categories_list = get_the_category_list( esc_html__( ', ', 'photo-portfolio' ) );
            if ( $categories_list ) {
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'photo-portfolio' ) . '</span>', $categories_list );
            }

            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'photo-portfolio' ) );
            if ( $tags_list ) {
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'photo-portfolio' ) . '</span>', $tags_list );
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'photo-portfolio' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post( get_the_title() )
                )
            );
            echo '</span>';
        }
    }
endif;
