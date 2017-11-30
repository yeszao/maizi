<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package maizi
 */

$sidebar_pos = get_theme_mod( 'maizi_sidebar_position' );
?>

<?php if ( 'none' !== $sidebar_pos ) : ?>

<div class="col-md-3 widget-area" id="global-sidebar" role="complementary">
	<?php if ( is_active_sidebar( 'index-sidebar' ) && is_home() && is_front_page() ) : ?>
		<?php dynamic_sidebar( 'index-sidebar' ); ?>
	<?php endif; ?>


	<?php if ( is_active_sidebar( 'single-sidebar' ) && is_single() ) : ?>
		<?php dynamic_sidebar( 'single-sidebar' ); ?>
	<?php endif; ?>


	<?php if ( is_active_sidebar( 'page-sidebar' ) && is_page() ) : ?>
		<?php dynamic_sidebar( 'page-sidebar' ); ?>
	<?php endif; ?>


	<?php if ( is_active_sidebar( 'archive-sidebar' ) && is_archive() && ! ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) ) : ?>
		<?php dynamic_sidebar( 'archive-sidebar' ); ?>
	<?php endif; ?>


	<?php if ( is_active_sidebar( 'shop-sidebar' ) && function_exists( 'is_woocommerce' ) && is_woocommerce() ) : ?>
		<?php dynamic_sidebar( 'shop-sidebar' ); ?>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'global-sidebar' ) ) : ?>
		<?php dynamic_sidebar( 'global-sidebar' ); ?>
	<?php endif; ?>
</div>

<?php endif; ?>
