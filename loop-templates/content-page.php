<?php
/**
 * Partial template for content in page.php
 *
 */

?>
<article <?php post_class( 'article-content' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title mb-3">', '</h1>' ); ?>

		<?php
			edit_post_link(
				__( 'Edit' ),
				'<div class="entry-meta mb-4"><span class="edit-link">',
				'</span></div>',
				0,
				'small text-muted'
			);
		?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'maizi' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
