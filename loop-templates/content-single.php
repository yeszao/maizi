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

			<?php qiaomi_posted_on(); ?>

		</div><!-- .entry-meta -->

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

	<footer class="entry-footer">

		<?php $tags_list = get_the_tag_list( '', esc_html__( ', ', 'qiaomi' ) ); ?>

		<?php if ( $tags_list ) : ?>

			<span class="tags-links meta-item">

				<i class="icon-tag icon12"></i>

				<?php echo $tags_list ?>

			</span>

		<?php endif; ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
