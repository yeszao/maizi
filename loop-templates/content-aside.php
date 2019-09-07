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
        <ul class="nav nav-tabs" id="myTab" role="tablist">

            <li class="nav-item">
                <a class="nav-link active" id="analyse-tab" data-toggle="tab" href="#analyse" role="tab" aria-controls="analyse" aria-selected="true">

                    <?php if ( $content = get_the_content() ): ?>
                        <span class="dashicons dashicons-yes-alt text-success"></span>
                    <?php else: ?>
                        <span class="dashicons dashicons-warning text-muted"></span>
                    <?php endif; ?>

                    答案解析
                </a>
            </li>

            <?php foreach ($languages as $name => $title) : ?>
            <li class="nav-item">
                <a class="nav-link" id="<?php echo $name?>-tab" data-toggle="tab" href="#<?php echo $name ?>" role="tab" aria-controls="<?php echo $name ?>" aria-selected="false">

                    <?php if ( get_field($name) ): ?>
                        <span class="dashicons dashicons-yes-alt text-success"></span>
                    <?php else: ?>
                        <span class="dashicons dashicons-warning text-muted"></span>
                    <?php endif; ?>

                    <?php echo $title ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>

        <div class="tab-content my-4" id="myTabContent">
            <div class="tab-pane fade show active" id="analyse" role="tabpanel" aria-labelledby="analyse-tab">
                <?php echo $content; ?>
            </div>

            <?php foreach ($languages as $name => $title) : ?>
            <div class="tab-pane fade<?php if ($name == 'cpp'): ?> show active<?php endif ?>" id="<?php echo $name ?>" role="tabpanel" aria-labelledby="<?php echo $name ?>-tab">

                <?php if ($field = get_field($name)): ?>
                    <?php echo $field ?>
                <?php else: ?>
                    <p class="text-muted"><i>暂无<?php echo $title ?>解法</i></p>
                <?php endif; ?>

            </div>
            <?php endforeach; ?>
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
