<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package maizi
 */

get_header();
$container   = get_theme_mod( 'maizi_container_type' );
$sidebar_pos = get_theme_mod( 'maizi_sidebar_position' );
?>


<div class="wrapper" id="author-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row d-flex <?php echo 'left' === $sidebar_pos ? 'flex-row-reverse' : 'flex-row'; ?>">

			<?php if ( 'none' !== $sidebar_pos ) : ?>

			<div class="col-md-9 content-area" id="primary">

				<?php else : ?>

				<div class="col-md-12 content-area" id="primary">

					<?php endif; ?>

					<main class="site-main" id="main">

						<header class="page-header author-header">

							<?php
							$curauth = isset( $_GET['author_name'] )
								? get_user_by( 'slug', $author_name )
								: get_userdata( intval( $author ) );
							?>

							<h1><?php esc_html_e( 'About:', 'maizi' ); ?><?php echo esc_html( $curauth->nickname ); ?></h1>

							<?php if ( ! empty( $curauth->ID ) ) : ?>
								<?php echo get_avatar( $curauth->ID ); ?>
							<?php endif; ?>

							<dl>
								<?php if ( ! empty( $curauth->user_url ) ) : ?>
									<dt><?php esc_html_e( 'Website', 'maizi' ); ?></dt>
									<dd>
										<a href="<?php echo esc_html( $curauth->user_url ); ?>"><?php echo esc_html( $curauth->user_url ); ?></a>
									</dd>
								<?php endif; ?>

								<?php if ( ! empty( $curauth->user_description ) ) : ?>
									<dt><?php esc_html_e( 'Profile', 'maizi' ); ?></dt>
									<dd><?php echo esc_html( $curauth->user_description ); ?></dd>
								<?php endif; ?>
							</dl>

							<h2><?php esc_html_e( 'Posts by', 'maizi' ); ?> <?php echo esc_html( $curauth->nickname ); ?>
								:</h2>

						</header><!-- .page-header -->

						<ul>

							<!-- The Loop -->
							<?php if ( have_posts() ) : ?>
								<?php while ( have_posts() ) : ?>

									<?php the_post(); ?>

									<li>
										<a rel="bookmark" href="<?php the_permalink(); ?>"
										   title="Permanent Link: <?php the_title(); ?>">
											<?php the_title(); ?></a>
										<?php maizi_posted_on(); ?>
									</li>
								<?php endwhile; ?>

							<?php else : ?>

								<?php get_template_part( 'loop-templates/content', 'none' ); ?>

							<?php endif; ?>

							<!-- End Loop -->

						</ul>

					</main><!-- #main -->

					<!-- The pagination component -->
					<?php maizi_pagination(); ?>

				</div><!-- #primary -->

				<?php get_sidebar(); ?>

			</div> <!-- .row -->

		</div><!-- Container end -->

	</div><!-- Wrapper end -->

	<?php get_footer(); ?>
