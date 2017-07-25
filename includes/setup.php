<?php
/**
 * Theme basic setup.
 *
 * @package qiaomi
 */

if ( ! function_exists( 'qiaomi_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function qiaomi_setup() {
		load_theme_textdomain( 'qiaomi', get_template_directory() . '/languages' );

		register_nav_menus( array(
			'primary' => __( 'Primary Menu', 'qiaomi' ),
		) );

		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'customize-selective-refresh-widgets' );
		add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );
		add_theme_support( 'custom-background' );
		add_theme_support( 'custom-logo' );

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$qiaomi_sidebar_position = get_theme_mod( 'qiaomi_sidebar_position' );
		if ( '' == $qiaomi_sidebar_position ) {
			set_theme_mod( 'qiaomi_sidebar_position', 'left' );
		}

		// Container width.
		$qiaomi_container_type = get_theme_mod( 'qiaomi_container_type' );
		if ( '' == $qiaomi_container_type ) {
			set_theme_mod( 'qiaomi_container_type', 'container' );
		}
	}
endif;
add_action( 'after_setup_theme', 'qiaomi_setup' );
