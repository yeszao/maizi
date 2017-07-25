<?php
/**
 * Functions file.
 *
 * @package         Qiaomi
 * @description     Multipurpose Wordpress theme
 * @author          qiaomi.org
 * @version         Release: 1.0
 */

require get_template_directory() . '/includes/setup.php';
require get_template_directory() . '/includes/widgets-position.php';
require get_template_directory() . '/includes/widget-singular-menu.php';
require get_template_directory() . '/includes/widget-slider-unit.php';
require get_template_directory() . '/includes/security.php';
require get_template_directory() . '/includes/template-tags.php';
require get_template_directory() . '/includes/pagination.php';
require get_template_directory() . '/includes/extras.php';
require get_template_directory() . '/includes/customizer.php';
require get_template_directory() . '/includes/custom-comments.php';
require get_template_directory() . '/includes/jetpack.php';
require get_template_directory() . '/includes/bs4Navwalker.php';
require get_template_directory() . '/includes/woocommerce.php';
require get_template_directory() . '/includes/editor.php';

if ( ! function_exists( 'add_script' ) ) {
	/**
	 * Register javascript and css file.
	 */
	function add_script() {
		// CSS file.
		wp_enqueue_style( 'bootstrap-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(),
		'4.0.0' );
		wp_enqueue_style( 'style-css', get_stylesheet_directory_uri() . '/style.css', array(),
		'1.0.0' );

		// JS file.
		wp_enqueue_script( 'tether', get_template_directory_uri() . '/assets/js/tether.min.js', array(), '1.4.0',
		true );
		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), '4.0
		.0', true );
		wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0.0', true );

		// Code Highlight.
		$code_highlight   = get_theme_mod( 'qiaomi_code_highlight', false );
		if ( $code_highlight && (is_page() || is_singular()) ) {
			wp_enqueue_style( 'highlight-css', get_stylesheet_directory_uri() . '/assets/css/github-gist.css', array(),
			'9.9.0' );
			wp_enqueue_script( 'highlight-js', get_template_directory_uri() . '/assets/js/highlight.min.js', array(),
			'9.9.0', true );
			wp_add_inline_script( 'highlight-js', 'jQuery(document).ready(function(){jQuery("pre,code").each(function(i,block){hljs.highlightBlock(block);});});' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'add_script' );

/**
 * Use custom title for page.
 */
function qiaomi_wp_title( $title, $sep, $seplocation ) {
	$paged = get_query_var( 'paged' );
	$blog_name = get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description' );

	// Add page number.
	$page_num = $paged > 1 ? sprintf( __( 'Page %s' ), $paged ) : '';

	// is front.
	if ( $site_description && ( is_front_page() || is_home() ) ) {
		if ( $paged > 1 ) {
			return sprintf( '%s %s %s', $page_num, $sep, $blog_name );
		}
		return sprintf( '%s %s %s', $blog_name, $sep, $site_description );
	}

	if ( is_archive() ) {
		$title = sanitize_text_field( get_the_archive_title() );
	} else {
		$title = trim( str_replace( '&#8211;', $sep, $title ), $sep . ' ' );
	}

	if ( 'left' === $seplocation ) {
		$title = sprintf( '%s %s %s %s %s', $blog_name, $sep, $title, $sep, $page_num );
	}
	$title = sprintf( '%s %s %s %s %s', $page_num, $sep, $title, $sep, $blog_name );

	return trim( $title, $sep . ' ' );
}

add_filter( 'wp_title', 'qiaomi_wp_title', 10, 3 );
