<?php
/**
 * Template for displaying all single posts
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        while ( have_posts() ) :
            the_post();
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="entry-header">
                    <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

                    <div class="entry-meta">
                        <?php
                        // Posted on
                        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                        $time_string = sprintf(
                            $time_string,
                            esc_attr( get_the_date( 'c' ) ),
                            esc_html( get_the_date() )
                        );
                        echo '<span class="posted-on">' . $time_string . '</span>';
                        ?>
                    </div>
                </header>

                <div class="entry-content">
                    <?php
                    the_content();

                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'photo-portfolio' ),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div>

                <footer class="entry-footer">
                    <?php
                    $categories_list = get_the_category_list( esc_html__( ', ', 'photo-portfolio' ) );
                    if ( $categories_list ) {
                        printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'photo-portfolio' ) . '</span>', $categories_list );
                    }

                    $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'photo-portfolio' ) );
                    if ( $tags_list ) {
                        printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'photo-portfolio' ) . '</span>', $tags_list );
                    }
                    ?>
                </footer>
            </article>

            <?php
            // Previous/next post navigation.
            the_post_navigation(
                array(
                    'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'photo-portfolio' ) . '</span> <span class="nav-title">%title</span>',
                    'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'photo-portfolio' ) . '</span> <span class="nav-title">%title</span>',
                )
            );

            // If comments are open or we have at least one comment, load up the comment template.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile;
        ?>
    </div>
</main>

<?php
get_footer();
