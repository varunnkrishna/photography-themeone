<?php
/**
 * Template part for displaying results in search pages
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

        <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php
                $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
                $time_string = sprintf(
                    $time_string,
                    esc_attr( get_the_date( 'c' ) ),
                    esc_html( get_the_date() )
                );
                echo '<span class="posted-on">' . $time_string . '</span>';
                ?>
            </div>
        <?php endif; ?>
    </header>

    <div class="entry-summary">
        <?php the_excerpt(); ?>
    </div>

    <footer class="entry-footer">
        <?php
        $post_type = get_post_type();
        printf(
            '<span class="entry-type">%s</span>',
            esc_html( get_post_type_object( $post_type )->labels->singular_name )
        );
        ?>
    </footer>
</article>
