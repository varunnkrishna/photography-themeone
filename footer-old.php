<?php
/**
 * The template for displaying the footer
 */
?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-info">
                    <?php
                    /* translators: %s: Current year. */
                    printf( esc_html__( '© %s ', 'photo-portfolio' ), date_i18n( 'Y' ) );
                    bloginfo( 'name' );
                    ?>
                </div>

                <nav class="footer-navigation">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'footer',
                            'menu_id'        => 'footer-menu',
                            'depth'          => 1,
                        )
                    );
                    ?>
                </nav>

                <div class="social-links">
                    <!-- Add your social media links here -->
                </div>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
