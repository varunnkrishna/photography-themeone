<?php
/**
 * Template for displaying 404 pages (not found)
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <section class="error-404 not-found">
            <header class="page-header">
                <h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'photo-portfolio' ); ?></h1>
            </header>

            <div class="page-content">
                <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'photo-portfolio' ); ?></p>
                <?php get_search_form(); ?>
            </div>
        </section>
    </div>
</main>

<?php
get_footer();
