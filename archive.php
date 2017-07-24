<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 */

get_header();
?>

<?php
$container   = get_theme_mod( 'qiaomi_container_type' );
$sidebar_pos = get_theme_mod( 'qiaomi_sidebar_position' );
?>

<div class="wrapper" id="archive-wrapper">

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

				<?php if ( have_posts() ) : ?>

					<header class="page-header container">
						<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

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
			<?php qiaomi_pagination(); ?>

		</div><!-- #primary -->

		<?php if ( $sidebar_pos === 'right' ) : ?>

			<?php get_sidebar(); ?>

		<?php endif; ?>

	</div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
