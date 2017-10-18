<?php
/**
 * Theme basic setup.
 *
 * @package maizi
 */

if ( ! function_exists( 'maizi_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function maizi_setup() {
		load_theme_textdomain( 'maizi', get_template_directory() . '/languages' );

		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'maizi' ),
		) );

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
		add_theme_support( 'custom-background' );
		add_theme_support( 'custom-logo' );

		add_editor_style( 'editor-style.css' );

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$maizi_sidebar_position = get_theme_mod( 'maizi_sidebar_position' );
		if ( '' == $maizi_sidebar_position ) {
			set_theme_mod( 'maizi_sidebar_position', 'left' );
		}

		// Container width.
		$maizi_container_type = get_theme_mod( 'maizi_container_type' );
		if ( '' == $maizi_container_type ) {
			set_theme_mod( 'maizi_container_type', 'container' );
		}
	}
endif;
add_action( 'after_setup_theme', 'maizi_setup' );


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
		wp_enqueue_script( 'popper-js', get_template_directory_uri() . '/assets/js/popper.min.js', array(), '1.12.5',
			true );
		wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array(), '4.0
		.0', true );
		wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0.0', true );

		// Code Highlight.
		$code_highlight   = get_theme_mod( 'maizi_code_highlight', false );
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
 * Use custom title
 */
function maizi_wp_title( $title, $sep, $seplocation ) {
	$paged = get_query_var( 'paged' );
	$blog_name = get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description' );

	// Add page number.
	$page_num = $paged > 1 ? sprintf( __( 'Page %s' ), $paged ) : '';

	// is front.
	if ( is_front_page() || is_home() ) {
		if ( $paged > 1 ) {
			return sprintf( '%s %s %s', $page_num, $sep, $blog_name );
		}
		if ( $site_description ) {
			return sprintf( '%s %s %s', $blog_name, $sep, $site_description );
		}
	}

	$title = trim( str_replace( '&#8211;', $sep, $title ), $sep . ' ' );

	if ( 'left' === $seplocation ) {
		$title = sprintf( '%s %s %s %s %s', $blog_name, $sep, $title, $sep, $page_num );
	}
	$title = sprintf( '%s %s %s %s %s', $page_num, $sep, $title, $sep, $blog_name );

	return trim( $title, $sep . ' ' );
}

add_filter( 'wp_title', 'maizi_wp_title', 10, 3 );


/**
 * Replace image url if use https
 * @param $content
 *
 * @return mixed
 */
function https_image_replacer( $content ) {
	if ( is_ssl() ) {
		$host_name       = $_SERVER['HTTP_HOST'];
		$http_host_name  = 'http://' . $host_name . '/wp-content/uploads';
		$https_host_name = 'https://' . $host_name . '/wp-content/uploads';
		$content         = str_replace( $http_host_name, $https_host_name, $content );
	}

	return $content;
}
add_filter('the_content', 'https_image_replacer');