<?php
/**
 * Single post partial template.
 *
 */
?>
<article <?php post_class( 'article-content' ); ?> id="post-<?php the_ID(); ?>">

    <div class="card">
        <header class="card-header bg-light">

            <?php the_title( '<h1 class="card-title">', '</h1>' ); ?>

            <div class="card-text small text-muted">

                <?php maizi_post_meta(); ?>

            </div>

        </header><!-- .entry-header -->

        <div class="card-body">

            <?php the_content(); ?>

            <?php get_previous_and_next_post() ?>

            <?php
            wp_link_pages( array(
                'before' => '<div class="page-links">' . __( 'Pages:', 'maizi' ),
                'after'  => '</div>',
            ) );
            ?>

        </div>
    </div>

</article><!-- #post-## -->
