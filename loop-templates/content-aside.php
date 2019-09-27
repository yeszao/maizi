<?php
/**
 * Single post partial template.
 *
 */
?>
<article <?php post_class( 'article-content aside-content' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title mb-3">', '</h1>' ); ?>

        <p><?php echo get_field('title_desc') ?></p>

		<div class="entry-meta mb-4 small text-muted">

			<?php maizi_post_meta(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

    <?php $languages = [
        'python' =>'Python',
        'java' => 'Java',
        'c' => 'C',
        'cpp' => 'C++',
    ]
    ?>

	<div class="entry-content">

        <div class="d-flex justify-content-between flex-wrap">
            <h2>答案</h2>
            <div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <?php $content = get_the_content() ?>

                    <?php foreach ($languages as $name => $title) : ?>
                    <li class="nav-item">
                        <a class="nav-link<?php if ( !get_field($name) ): ?> text-muted<?php endif ?>" id="<?php echo $name?>-tab"
                           data-toggle="tab" href="#<?php echo $name ?>" role="tab" aria-controls="<?php echo $name ?>" aria-selected="false">
                            <span><?php echo $title ?></span>
                        </a>
                    </li>
                    <?php endforeach; ?>

                    <li class="nav-item">
                        <a class="nav-link text-muted" id="empty-tab"
                           data-toggle="tab" href="#empty" role="tab" aria-controls="empty" aria-selected="false">
                            <span>不显示</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content my-4" id="myTabContent">
            <?php foreach ($languages as $name => $title) : ?>
            <div class="tab-pane fade" id="<?php echo $name ?>" role="tabpanel" aria-labelledby="<?php echo $name ?>-tab">

                <?php if ($field = get_field($name)): ?>
                    <pre><code  class="language language-<?php echo $name ?>"><?php echo $field ?></code></pre>
                <?php else: ?>
                    <p class="text-muted"><i>暂无<?php echo $title ?>语言解法</i></p>
                <?php endif; ?>

            </div>
            <?php endforeach; ?>

            <div class="tab-pane fade" id="empty" role="tabpanel" aria-labelledby="empty-tab">
                    <p class="text-muted"><i>（不显示答案）</i></p>
            </div>
        </div>

        <h2>解析</h2>
        <div class="answer-analysis">
            <?php echo $content; ?>
        </div>

        <p class="text-center">
            <?php previous_post_link(); ?>
            <?php next_post_link(); ?>
        </p>

		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'maizi' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

</article><!-- #post-## -->
