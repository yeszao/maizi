<?php
/**
 * The template for displaying search results pages.
 *
 * @package qiaomi
 */

get_header();

$container   = get_theme_mod( 'qiaomi_container_type' );
$sidebar_pos = get_theme_mod( 'qiaomi_sidebar_position' );
?>

<div class="wrapper" id="search-wrapper">

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
						
							<h1 class="page-title"><?php printf(
							/* translators:*/
							 esc_html__( 'Search Results for: %s', 'qiaomi' ),
								'<span>' . get_search_query() . '</span>' ); ?></h1>

					</header><!-- .page-header -->

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php
						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
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

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
