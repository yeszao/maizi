<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 */

get_header();
?>

<?php
$container   = get_theme_mod( 'maizi_container_type' );
$sidebar_pos = get_theme_mod( 'maizi_sidebar_position' );
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row d-flex <?php echo 'left' === $sidebar_pos ? 'flex-row-reverse' : 'flex-row'; ?>">

			<?php if ( 'none' !== $sidebar_pos ) : ?>

			<div class="col-md-9 content-area" id="primary">

				<?php else : ?>

				<div class="col-md-12 content-area" id="primary">

			<?php endif; ?>

			<main class="site-main" id="main">

				<?php if ( have_posts() ) : ?>

					<header class="page-header container">
						<?php
						the_archive_title( '<h1 class="page-title mb-3">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description text-muted mb-4">', '</div>' );
						?>
					</header><!-- .page-header -->

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

	</div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
