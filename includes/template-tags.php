<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package maizi
 */

if ( ! function_exists( 'maizi_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function maizi_posted_on() {
		$posted_on = '<time class="published" datetime="%1$s">%2$s</time>';
		$posted_on = sprintf( $posted_on, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );

		echo '<span class="posted-date meta-item mr-3 text-muted"><i class="icon-time icon12"></i> ',
			$posted_on,
		'</span>';

		// Display author name.
		$display_author = get_theme_mod( 'maizi_display_author', 'no' );
		if ( 'yes' === $display_author ) {
			$byline = sprintf(
				'<span class="author vcard"><a class="url fn n text-muted" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
			);
			echo '<span class="byline meta-item mr-3 text-muted"><i class="icon-user icon12"></i> ', $byline, '</span>';
		}

		if ( in_array( 'wp-postviews-plus/wp-postviews-plus.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			echo '<span class="posted-view meta-item mr-3 text-muted"><i class="ico icon-eye-open icon12"></i> ',
			(int) get_post_meta( get_the_ID(), 'views', true ),
			esc_html__( 'View', 'maizi' ),
			'</span>';
		}

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'maizi' ) );
			$categories_list = str_replace( '<a href="', '<a class="text-muted" href="', $categories_list );
			if ( $categories_list && maizi_categorized_blog() ) {
				printf( '<span class="cat-links meta-item mr-3 text-muted"><i class="icon-list icon12"></i> ' . esc_html__( 'Posted in %1$s', 'maizi' ) . '</span>', $categories_list );
			}
		}

		$comments_number = get_comments_number();
		if ( ! post_password_required() && ( comments_open() || $comments_number ) ) {
			echo '<span class="comments-link meta-item mr-3"><i class="icon-comment icon12"></i> ';
			comments_popup_link( __( 'Leave a Comment' ), __( '1 Comment' ), esc_html__('% Comments', 'maizi' ),
				'text-muted' );
			echo '</span>';
		}

		edit_post_link(
			__( 'Edit' ),
			'<span class="edit-link meta-item mr-3"><i class="icon-edit icon12"></i> ',
			'</span>',
			0,
			'text-muted'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function maizi_categorized_blog() {
	$all_the_cool_cats = get_transient( 'maizi_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );
		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );
		set_transient( 'maizi_categories', $all_the_cool_cats );
	}
	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so components_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so components_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in maizi_categorized_blog.
 */
function maizi_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'maizi_categories' );
}

add_action( 'edit_category', 'maizi_category_transient_flusher' );
add_action( 'save_post', 'maizi_category_transient_flusher' );

/**
 * Custom excerpt function
 *
 * @param int $limit int excerpt word limit.
 */
function maizi_excerpt( $limit = 180 ) {
	$excerpt = get_the_content();
	$excerpt = preg_replace( '/\s+/', ' ', strip_tags( $excerpt ) );
	if ( mb_strwidth( $excerpt ) > $limit ) {
		$excerpt = mb_strimwidth( $excerpt, 0, $limit, '&hellip;' );
	}

	echo $excerpt;
}
