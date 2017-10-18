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

							<?php printf(
								esc_html__( '%1$s by %2$s', 'mai' ), $the_theme->get( 'Name' ),  '<a href="'.esc_url( __('https://www.awaimai.com', 'mai')).'" target="_blank">歪麦博客</a>' ); ?>

						<span class="mr-0"><script src="https://s95.cnzz.com/z_stat.php?id=1256189163&web_id=1256189163" language="JavaScript"></script></span>
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

