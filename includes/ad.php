<?php
/**
 * Ad.
 *
 * @package maizi
 */

if ( ! function_exists( 'maizi_ad_content' ) ) :
	/**
	 * Custom pagination
	 */
	function maizi_ad_content($content) {
		if ( !is_singular()) {
			return;
		}

		$ad_before = str_replace('[url]', get_permalink(), get_theme_mod( 'maizi_ad_before_content' ));
        $ad_before_option = get_theme_mod( 'maizi_ad_before_content_option' );

		$ad_after = str_replace('[url]', get_permalink(), get_theme_mod( 'maizi_ad_after_content' ));
        $ad_after_option = get_theme_mod( 'maizi_ad_after_content_option' );

		if (is_single() && ($ad_before_option == 'both' || $ad_before_option == 'post')
			|| is_page() && ($ad_before_option == 'both' || $ad_before_option == 'page')) {
			$content = $ad_before . $content;
		}

		if (is_single() && ($ad_after_option == 'both' || $ad_after_option == 'post')
			|| is_page() && ($ad_after_option == 'both' || $ad_after_option == 'page')) {
			$content = $content . $ad_after;
		}

		return str_replace('[url]', get_url(), $content);
	}
	add_filter( 'the_content', 'maizi_ad_content' );

endif;
