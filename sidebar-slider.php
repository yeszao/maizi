<?php
/**
 * Index slider
 *
 */

$count = count_widgets( 'index-slider' ) ?: 0;
?>

<?php if ( is_active_sidebar( 'index-slider' ) && $count > 0 ) : ?>

	<div class="wrapper py-0">

		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

			<?php if ( $count > 1 ) : ?>

				<ol class="carousel-indicators">

					<?php for ( $i = 0; $i < $count; $i ++ ) : ?>

						<li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $i ?>"
							<?php if ( $i === 0 ): ?>class="active" <?php endif; ?>></li>

					<?php endfor; ?>

				</ol>

			<?php endif; ?>

			<div class="carousel-inner" role="listbox">

				<?php dynamic_sidebar( 'index-slider' ); ?>

			</div>

			<?php if ( $count > 1 ) : ?>

				<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">

					<span class="carousel-control-prev-icon" aria-hidden="true"></span>

					<span class="sr-only">Previous</span>

				</a>

				<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">

					<span class="carousel-control-next-icon" aria-hidden="true"></span>

					<span class="sr-only">Next</span>

				</a>

			<?php endif; ?>

		</div><!-- .carousel -->

		<script>
			jQuery(".carousel-item").first().addClass("active");
		</script>

	</div>

<?php endif; ?>
