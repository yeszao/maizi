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

		$ad_before = trim(get_theme_mod( 'maizi_ad_before_content' ));
		$ad_before = htmlspecialchars_decode(str_replace('[url]', get_permalink(), $ad_before));
        $ad_before_option = get_theme_mod( 'maizi_ad_before_content_option' );

        $ad_after = trim(get_theme_mod( 'maizi_ad_after_content' ));
		$ad_after = htmlspecialchars_decode(str_replace('[url]', get_permalink(), $ad_after));
        $ad_after_option = get_theme_mod( 'maizi_ad_after_content_option' );

		if (is_single() && ($ad_before_option == 'both' || $ad_before_option == 'post')
			|| is_page() && ($ad_before_option == 'both' || $ad_before_option == 'page')) {
			$content = $ad_before . $content;
		}

		if (is_single() && ($ad_after_option == 'both' || $ad_after_option == 'post')
			|| is_page() && ($ad_after_option == 'both' || $ad_after_option == 'page')) {
			if (mb_strlen($content) > 2500 || empty($ad_before)) {
				$content = $content . $ad_after;
			}
		}

		return str_replace('[url]', get_url(), $content);
	}
	add_filter( 'the_content', 'maizi_ad_content' );

endif;
