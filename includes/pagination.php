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

		$pages = paginate_links( array(
			'type' => 'array',
		) );

		$pagination = '';
		if ( ! empty( $pages ) ) :
			$pagination = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';

			foreach ( $pages as $key => $page_link ) :
				$active    = strpos( $page_link, 'current' ) !== false ? 'active' : '';
				$page_link = str_replace( 'page-numbers', 'page-link', $page_link );
				$pagination .= sprintf( '<li class="page-item %s">%s</li>', $active, $page_link );
			endforeach;

			$pagination .= '</ul></nav>';
		endif;

		echo wp_kses_post( $pagination );
	}

endif;
