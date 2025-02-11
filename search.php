<?php
/**
 * Template for displaying search results pages
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title">
                    <?php
                    /* translators: %s: search query. */
                    printf( esc_html__( 'Search Results for: %s', 'photo-portfolio' ), '<span>' . get_search_query() . '</span>' );
                    ?>
                </h1>
            </header>

            <?php
            while ( have_posts() ) :
                the_post();
                get_template_part( 'template-parts/content/content', 'search' );
            endwhile;

            the_posts_navigation();

        else :
            get_template_part( 'template-parts/content/content', 'none' );
        endif;
        ?>
    </div>
</main>

<?php
get_footer();
