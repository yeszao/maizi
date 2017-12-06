<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package maizi
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'maizi_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">

                        <span>Theme: <a href="https://www.awaimai.com/maizi">Maizi</a>.</span>

                        <span>Powered by <a href="https://wordpress.org/" target="_blank">WordPress</a>.</span>

                        <span><a href="http://www.miitbeian.gov.cn/" target="_blank"><?php echo get_option( 'zh_cn_l10n_icp_num' );?></a></span>

						<?php dynamic_sidebar( 'footer-copyright' ); ?>

					</div><!-- .site-info -->

					<a href="#" class="scroll-top">

						<i class="icon10 icon-arrow-up icon-white"></i>

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

