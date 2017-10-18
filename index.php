<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package maizi
 */

get_header();

$container   = get_theme_mod( 'maizi_container_type' );
$sidebar_pos = get_theme_mod( 'maizi_sidebar_position' );
?>

<div class="wrapper" id="wrapper-index">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row d-flex <?php echo 'left' === $sidebar_pos ? 'flex-row-reverse' : 'flex-row'; ?>">

			<?php if ( 'none' !== $sidebar_pos ) : ?>

				<div class="col-md-9 content-area" id="primary">

			<?php else : ?>

				<div class="col-md-12 content-area" id="primary">

			<?php endif; ?>

				<main class="site-main" id="main">

					<?php if ( have_posts() ) : ?>

						<?php while ( have_posts() ) : ?>

							<?php the_post(); ?>

							<?php

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'loop-templates/content', 'archive' );
							?>

						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

				</main><!-- #main -->

			<!-- The pagination component -->
			<?php maizi_pagination(); ?>

		</div><!-- #primary -->

		<?php get_sidebar(); ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
