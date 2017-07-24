<?php
/**
 * Partial template for content in page.php
 *
 */

?>
<article <?php post_class('article-content'); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<?php edit_post_link( __( 'Edit', 'qiaomi' ), '<div class="entry-meta my-2 small"><span class="edit-link">', '</span></div>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'qiaomi' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
