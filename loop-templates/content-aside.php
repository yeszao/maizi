<?php
/**
 * Single post partial template.
 *
 */
?>
<article <?php post_class( 'article-content aside-content' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title mb-3">', '</h1>' ); ?>

        <p><?php echo get_post_field('post_excerpt') ?></p>

		<div class="entry-meta mb-4 small text-muted">

			<?php maizi_post_meta(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

    <?php $metas = get_programing_language_metas(get_the_ID()); ?>

	<div class="entry-content">

        <div class="d-flex justify-content-between flex-wrap">
            <h2><?php _e('Answer', 'maizi') ?></h2>
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php foreach ($metas as $key => $value) : ?>

                    <li class="nav-item">
                        <a class="nav-link" id="<?php echo $key ?>-tab"
                           data-toggle="tab" href="#<?php echo $key ?>" role="tab"
                           aria-controls="<?php echo $key ?>" aria-selected="false">
                            <span><?php echo $value['label'] ?></span>
                        </a>
                    </li>

                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="tab-content my-4" id="myTabContent">
            <?php foreach ($metas as $key => $value) : ?>

                <div class="tab-pane fade" id="<?php echo $key ?>" role="tabpanel" aria-labelledby="<?php echo $key ?>-tab">
                    <pre><code class="language <?php echo $key ?>"><?php echo $value['value'] ?></code></pre>
                </div>

            <?php endforeach; ?>
        </div>

        <h2><?php _e('Analysis', 'maizi') ?></h2>
        <div class="answer-analysis">
            <?php the_content(); ?>
        </div>

        <?php get_previous_and_next_post() ?>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'maizi' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
