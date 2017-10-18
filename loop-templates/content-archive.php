<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 */

$list_type = get_theme_mod( 'maizi_post_list_type', 'none' );
?>

<article <?php post_class( 'container mb-5' ) ?> id="post-<?php the_ID(); ?>">

	<div class="row">

		<?php if ( 'thumbnail' === $list_type ) : ?>

			<div class="col-sm-3 align-middle">

				<?php if ( has_post_thumbnail() ) : ?>

					<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'thumbnail' ) ); ?>

				<?php else : ?>

					<img class="thumbnail" src="<?php echo get_template_directory_uri() ?>/assets/img/thumbnail.png"/>

				<?php endif; ?>

			</div>

		<?php endif; ?>


		<div class="entry-content <?php echo ( $list_type === 'thumbnail' ) ? 'col-sm-9' : 'col-sm-12'; ?>">


			<header class="entry-header">

				<?php the_title( sprintf( '<h2 class="entry-title font-weight-bold"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			</header><!-- .entry-header -->

			<?php if ( 'post' == get_post_type() ) : ?>

				<div class="entry-meta my-1 text-muted small">

					<?php maizi_posted_on(); ?>

				</div><!-- .entry-meta -->

			<?php endif; ?>

			<?php maizi_excerpt(); ?>

		</div>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
