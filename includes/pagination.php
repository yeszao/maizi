<?php
/**
 * Pagination.
 *
 * @package maizi
 */

if ( ! function_exists( 'maizi_pagination' ) ) :
	/**
	 * Custom pagination
	 */
	function maizi_pagination() {
		if ( is_singular() ) {
			return;
		}

        posts_nav_link('&nbsp;&nbsp;&nbsp;');
	}

endif;
