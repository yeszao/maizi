<?php
/**
 * Single post partial template.
 *
 */
?>
<article <?php post_class( 'article-content' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title mb-3">', '</h1>' ); ?>

		<div class="entry-meta mb-4 small text-muted">

			<?php maizi_post_meta(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

        <p class="text-center">
            <?php previous_post_link(); ?>
            <?php next_post_link(); ?>
        </p>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'maizi' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->