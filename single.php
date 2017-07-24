<?php
/**
 * The template for displaying all single posts.
 *
 * @package qiaomi
 */

get_header();
$container   = get_theme_mod( 'qiaomi_container_type' );
$sidebar_pos = get_theme_mod( 'qiaomi_sidebar_position' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<?php if ( $sidebar_pos === 'left' ): ?>
				<?php get_sidebar(); ?>
			<?php endif; ?>

			<?php if ( $sidebar_pos === 'left' || $sidebar_pos === 'right' ) : ?>
			<div class="col-md-9 content-area" id="primary">
				<?php else: ?>
				<div class="col-md-12 content-area" id="primary">
					<?php endif; ?>
					

			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'loop-templates/content', 'single' ); ?>

						<?php qiaomi_post_nav(); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->

		</div><!-- #primary -->

		<?php if ( $sidebar_pos === 'right' ) : ?>

			<?php get_sidebar(); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
