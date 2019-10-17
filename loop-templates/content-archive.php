<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 */

$list_type = get_theme_mod( 'maizi_post_list_type', 'thumbnail' );
$margin_bottom = in_array($list_type, ['title', 'meta']) ? 'mb-2 pb-2' : 'mb-4 pb-4';
$has_thumbnail = has_post_thumbnail();
?>

<article <?php post_class( "" ) ?> id="post-<?php the_ID(); ?>">

	<div class="card mb-4">

        <div class="<?php if ( $has_thumbnail ): ?>row<?php endif; ?> no-gutters">

            <?php if (has_post_thumbnail()): ?>
            <div class="col-md-3  pt-4 pl-4 pb-4">
                <?php if ( 'thumbnail' === $list_type && has_post_thumbnail() ) : ?>

                    <?php echo get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'card-img-top bg-gray' ) ); ?>

                <?php endif; ?>
            </div>
            <?php endif; ?>

            <div class="<?php if ( has_post_thumbnail() ): ?>col-md-9<?php endif; ?>">
                <div class="card-body p-4">

                    <?php the_title( sprintf( '<h2 class="card-title font-weight-bold"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

                    <?php if ( 'post' == get_post_type() && $list_type !== 'title') : ?>
                        <div class="card-subtitle text-muted small mt-2">
                            <?php maizi_post_meta(); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( $list_type === 'excerpt' || $list_type === 'thumbnail') : ?>
                    <div class="card-subtitle mt-2">
                        <?php $word_number = get_theme_mod( 'maizi_excerpt_word_number', 180 ); ?>
                        <?php maizi_excerpt($word_number); ?>
                    </div>
                    <?php endif; ?>


                </div>

                <div class="card-"
            </div>
        </div>

</div>
</article>
