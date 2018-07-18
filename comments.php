<?php
/**
 * The template for displaying comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package maizi
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

/**
 * Bootstrap Comment Walker
 */
require get_template_directory() . '/includes/wp-bootstrap-comments.php';
$comments_number = get_comments_number();
?>

<div class="comments-area mt-5 text-small" id="comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">

			<?php echo sprintf(_n('%s Comment', '%s Comments', $comments_number), number_format_i18n
			($comments_number)); ?>
			
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>
			<nav class="comment-navigation" id="comment-nav-above">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'maizi' ); ?></h1>
				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments',
					'maizi' ) ); ?></div>
				<?php }
if ( get_next_comments_link() ) { ?>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;',
					'maizi' ) ); ?></div>
				<?php } ?>
			</nav><!-- #comment-nav-above -->
		<?php endif; // check for comment navigation. ?>

		<div class="comment-list">
			<?php
			wp_list_comments( array(
				'style'             => 'div',
				'short_ping' 		=> true,
				'avatar_size'       => 36,
                'max_depth'         => 2,
                'walker'            => new WP_Bootstrap_Comments_Walker(),
			) );
			?>
		</div><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through. ?>
			<nav class="comment-navigation" id="comment-nav-below">
				<h1 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'maizi' ); ?></h1>
				<?php if ( get_previous_comments_link() ) { ?>
					<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments',
					'maizi' ) ); ?></div>
				<?php }
if ( get_next_comments_link() ) { ?>
					<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;',
					'maizi' ) ); ?></div>
				<?php } ?>
			</nav><!-- #comment-nav-below -->
		<?php endif; // check for comment navigation. ?>

	<?php endif; // endif have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'maizi' ); ?></p>

	<?php endif; ?>

	<?php comment_form(); // Render comments form. ?>

</div><!-- #comments -->
