<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package mai
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'mai_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

                        <span>Theme: <a href="https://www.awaimai.com/mai">Mai</a>.</span>

                        <span>Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>.</span>

					</div><!-- .site-info -->

					<a href="#" class="scroll-top">
						<i class="icon12 icon-arrow-up icon-white"></i>
					</a>
				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>

