<?php
/**
 * Template part for displaying posts
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() && !is_singular() ) : ?>
        <div class="post-thumbnail">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('large'); ?>
            </a>
        </div>
    <?php endif; ?>

    <header class="entry-header">
        <?php
        if ( is_singular() ) :
            the_title( '<h1 class="entry-title">', '</h1>' );
        else :
            the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
        endif;

        if ( 'post' === get_post_type() ) :
            ?>
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

    <div class="entry-content">
        <?php
        if ( is_singular() ) :
            the_content();
        else :
            the_excerpt();
            ?>
            <a href="<?php the_permalink(); ?>" class="read-more">
                <?php esc_html_e( 'Read More', 'photo-portfolio' ); ?>
            </a>
            <?php
        endif;
        ?>
    </div>
</article>
