<?php
/**
 * Sidebar register
 */

/**
 * Get widget number in a sidebar
 * @param $sidebar_id string sidebar id
 * @return int Number of the widgets
 */
function count_widgets( $sidebar_id ) {
    global $_wp_sidebars_widgets;
    $_wp_sidebars_widgets = $_wp_sidebars_widgets ?: get_option( 'sidebars_widgets', array() );

    return isset($_wp_sidebars_widgets[$sidebar_id]) ? count($_wp_sidebars_widgets[$sidebar_id]) : 0;
}

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
function widgets_css_class( $sidebar_id ) {

    $count = count_widgets( $sidebar_id );
	$css_class = "widget-count-{$count} col-md-";
    
	if ($count % 4 == 0 || $count > 6) :
		$css_class .= '3';
	elseif ($count == 6):
		$css_class .= '2';
	elseif ($count == 3 || $count == 5):
		$css_class .= '4';
	elseif ($count == 2):
		$css_class .= '6';
	elseif ($count == 1):
		$css_class .= '12';
	endif;

	return $css_class;
}


if ( ! function_exists( 'maizi_widgets_init' ) ) {
	/**
	 * Initializes themes widgets.
	 */
	function maizi_widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Global Sidebar', 'maizi' ),
			'id'            => 'global-sidebar',
			'description'   => 'Global sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Index Sidebar', 'maizi' ),
			'id'            => 'index-sidebar',
			'description'   => 'Index sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Single Sidebar', 'maizi' ),
			'id'            => 'single-sidebar',
			'description'   => 'Single sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Page Sidebar', 'maizi' ),
			'id'            => 'page-sidebar',
			'description'   => 'page sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		register_sidebar( array(
			'name'          => __( 'Archive Sidebar', 'maizi' ),
			'id'            => 'archive-sidebar',
			'description'   => 'Archive sidebar widget area',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );

		if ( function_exists( 'is_woocommerce' ) ) {
			register_sidebar( array(
				'name'          => __( 'Shop Sidebar', 'maizi' ),
				'id'            => 'shop-sidebar',
				'description'   => 'WooCommerce sidebar widget area',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}

		register_sidebar( array(
			'name'          => __( 'Index Slider', 'maizi' ),
			'id'            => 'index-slider',
			'description'   => 'Index slider area. Place two or more widgets here and they will slide!',
			'before_widget' => '<div class="carousel-item">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Full', 'maizi' ),
			'id'            => 'footerfull',
			'description'   => 'Widget area below main content and above footer',
		    'before_widget'  => '<div id="%1$s" class="footer-widget %2$s '. widgets_css_class( 'footerfull' ) .'">',
		    'after_widget'   => '</div>' . PHP_EOL,
		    'before_title'   => '<h3 class="widget-title">', 
		    'after_title'    => '</h3>', 
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Copyright', 'maizi' ),
			'id'            => 'footer-copyright',
			'description'   => 'Widget area below Footer Full and above page bottom',
			'before_widget'  => '<div class="footer-copyright">',
			'after_widget'   => '</div>',
			'before_title'   => '',
			'after_title'    => '',
		) );

	}
}
add_action( 'widgets_init', 'maizi_widgets_init' );

