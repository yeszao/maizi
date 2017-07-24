<?php

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
require get_template_directory() . '/inc/widgets-position.php';
require get_template_directory() . '/inc/widget-singular-menu.php';
require get_template_directory() . '/inc/widget-slider-unit.php';

/**
 * Load functions to secure your WP install.
 */
require get_template_directory() . '/inc/security.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
//require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';
require get_template_directory() . '/inc/bs4Navwalker.php';

/**
 * Load WooCommerce functions.
 */
require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load Editor functions.
 */
require get_template_directory() . '/inc/editor.php';

/**
 * register javascript and css file
 */
if (!function_exists('add_script'))
{
    function add_script()
    {
        // css file
        wp_enqueue_style('bootstrap-css', get_stylesheet_directory_uri() . '/assets/css/bootstrap.min.css', array(),
            '4.0.0');
        wp_enqueue_style('style-css', get_stylesheet_directory_uri() . '/style.css', array(),
            '1.0.0');

        // js file
        wp_enqueue_script('tether', get_template_directory_uri() . '/assets/js/tether.min.js', array(),
            '1.4.0', true);
        wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array(),
            '4.0.0', true);
        wp_enqueue_script('theme-js', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0.0', true);

        // Code Highlight
        $code_highlight   = get_theme_mod( 'qiaomi_code_highlight', false );
        if ($code_highlight && (is_page() || is_singular())) {
            wp_enqueue_style('highlight-css', get_stylesheet_directory_uri() . '/assets/css/github-gist.css', array(),
                '9.9.0');
            wp_enqueue_script('highlight-js', get_template_directory_uri() . '/assets/js/highlight.min.js', array(), '9.9.0', true);
            wp_add_inline_script( 'highlight-js', 'jQuery(document).ready(function(){jQuery("pre,code").each(function(i,block){hljs.highlightBlock(block);});});' );
        }
    }
}
add_action('wp_enqueue_scripts', 'add_script');