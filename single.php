<?php
/**
 * The template for displaying all single posts.
 *
 * @package maizi
 */

get_header();
$container   = get_theme_mod( 'maizi_container_type' );
$sidebar_pos = get_theme_mod( 'maizi_sidebar_position' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row d-flex <?php echo 'left' === $sidebar_pos ? 'flex-row-reverse' : 'flex-row'; ?>">

			<?php if ( 'none' !== $sidebar_pos ) : ?>

			<div class="col-md-9 content-area" id="primary">

				<?php else : ?>

				<div class="col-md-12 content-area" id="primary">

					<?php endif; ?>

					<main class="site-main" id="main">

						<?php while ( have_posts() ) : ?>

							<?php the_post(); ?>

							<?php get_template_part( 'loop-templates/content', 'single' ); ?>

							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
							?>

						<?php endwhile; ?>

					</main><!-- #main -->

				</div><!-- #primary -->

				<?php get_sidebar(); ?>

			</div><!-- .row -->

		</div><!-- Container end -->

	</div><!-- Wrapper end -->

	<?php get_footer(); ?>
