<?php
/**
 * The template for displaying search results pages.
 *
 * @package maizi
 */

get_header();

$container   = get_theme_mod( 'maizi_container_type' );
$sidebar_pos = get_theme_mod( 'maizi_sidebar_position' );
?>

<div class="wrapper" id="search-wrapper">

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

								<h1 class="page-title mb-3">

									<?php
									printf(
										esc_html__( 'Search Results for: %s', 'maizi' ),
										'<span>' . get_search_query() . '</span>' );
									?>

								</h1>

							</header><!-- .page-header -->

							<?php while ( have_posts() ) : ?>

								<?php the_post(); ?>

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
					<?php maizi_pagination(); ?>

				</div><!-- #primary -->

				<?php get_sidebar(); ?>

			</div><!-- .row -->

		</div><!-- Container end -->

	</div><!-- Wrapper end -->

	<?php get_footer(); ?>
