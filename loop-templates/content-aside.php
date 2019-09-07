<?php
/**
 * Single post partial template.
 *
 */
?>
<article <?php post_class( 'article-content' ); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title mb-3">', '</h1>' ); ?>

        <p><?php echo get_field('title_desc') ?></p>

		<div class="entry-meta mb-4 small text-muted">

			<?php maizi_post_meta(); ?>

		</div><!-- .entry-meta -->

	</header><!-- .entry-header -->

    <?php $languages = [
        'cpp' => 'C++',
        'java' => 'Java',
        'python' =>'Python',
        'c' => 'C',
        'c-sharp' => 'C#',
        'javascript' => 'JavaScript',
        'ruby' => 'Ruby',
        'swift' => 'Swift',
        'go' => 'Go',
        'scala' => 'Scala',
        'kotlin' => 'Kotlin',
        'rust' => 'Rust',
        'php' => 'PHP'
    ]
    ?>

	<div class="entry-content">
        <h3>答案</h3>
        <div class="row">
            <div class="col-3 text-left">
                <div class="nav flex-column nav-pills" id="myTab" role="tablist" aria-orientation="vertical">
                    <?php foreach ($languages as $name => $title) : ?>

                        <a class="nav-link<?php if ($name == 'cpp'): ?> active<?php endif; ?>" id="<?php echo $name?>-tab" data-toggle="pill" href="#<?php echo $name ?>" role="tab" aria-controls="<?php echo $name ?>" aria-selected="<?php if ($name == 'cpp'): ?>true<?php else: ?>false<?php endif ?>">

                            <?php if (get_field($name)): ?>
                                <span class="dashicons dashicons-yes-alt text-success"></span>
                            <?php else: ?>
                                <span class="dashicons dashicons-warning text-muted"></span>
                            <?php endif; ?>

                            <?php echo $title ?>
                        </a>

                    <?php endforeach; ?>
                </div>
            </div>

            <div class="col-9">
                <div class="tab-content" id="myTabContent">
                    <?php foreach ($languages as $name => $title) : ?>

                    <div class="tab-pane fade<?php if ($name == 'cpp'): ?> show active<?php endif ?>" id="<?php echo $name ?>" role="tabpanel" aria-labelledby="<?php echo $name ?>-tab">

                        <?php if (get_field($name)): ?>
                            <?php echo get_field($name) ?>
                        <?php else: ?>
                            <p class="text-muted my-3"><i>暂无<?php echo $title ?>解法</i></p>
                        <?php endif; ?>

                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <h3>解析</h3>
		<?php the_content(); ?>

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
