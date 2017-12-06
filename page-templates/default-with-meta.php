<?php
/**
 * Template Name: Without Meta Template
 *
 * Template that DO NOT carry with meta info, such as create time, author, view, and comment.
 *
 */

get_header();

$container   = get_theme_mod( 'maizi_container_type' );
$sidebar_pos = get_theme_mod( 'maizi_sidebar_position' );

?>

<div class="wrapper" id="page-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row d-flex <?php echo 'left' === $sidebar_pos ? 'flex-row-reverse' : 'flex-row'; ?>">

			<?php if ( 'none' !== $sidebar_pos ) : ?>

			<div class="col-md-9 content-area" id="primary">

				<?php else : ?>

				<div class="col-md-12 content-area" id="primary">

					<?php endif; ?>

				<main class="site-main" id="main">

						<?php while ( have_posts() ) : ?>

						<?php the_post(); ?>

					<article <?php post_class( 'article-content' ); ?> id="post-<?php the_ID(); ?>">

						<header class="entry-header">

							<?php the_title( '<h1 class="entry-title mb-3">', '</h1>' ); ?>

							<?php
							edit_post_link(
								__( 'Edit' ),
								'<div class="entry-meta mb-4"><span class="edit-link">',
								'</span></div>',
								0,
								'small text-muted'
							);
							?>

					   </header><!-- .entry-header -->

					   <div class="entry-content">

							<?php the_content(); ?>

							<?php
							wp_link_pages( array(
								'before' => '<div class="page-links">' . __( 'Pages:', 'maizi' ),
								'after'  => '</div>',
							) );
							?>

						</div><!-- .entry-content -->

					</article><!-- #post-## -->

							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) :
								comments_template();
							endif;
							?>

						<?php endwhile; ?>

				</main><!-- #main -->

			 </div><!-- #primary -->

				<?php get_sidebar(); ?>
			 
		  </div><!-- .row -->

	   </div><!-- Container end -->

    </div><!-- Wrapper end -->

<?php get_footer(); ?>