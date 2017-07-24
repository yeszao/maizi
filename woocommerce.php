<?php
/**
 * The template for displaying all woocommerce pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package qiaomi
 */

get_header();

$container   = get_theme_mod( 'qiaomi_container_type' );
$sidebar_pos = get_theme_mod( 'qiaomi_sidebar_position' );

?>

<div class="wrapper" id="woocommerce-wrapper">

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

				<?php woocommerce_content(); ?>

			</main><!-- #main -->

		</div><!-- #primary -->


		<?php if ( $sidebar_pos === 'right' ) : ?>

			<?php get_sidebar(); ?>

		<?php endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
