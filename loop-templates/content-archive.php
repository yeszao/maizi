<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 */

$list_type = get_theme_mod( 'maizi_post_list_type', 'thumbnail' );
$margin_bottom = ($list_type === 'meta') ? 'mb-1' : 'mb-5';
?>

<article <?php post_class( "container $margin_bottom" ) ?> id="post-<?php the_ID(); ?>">

	<div class="row">

		<?php if ( 'thumbnail' === $list_type ) : ?>

			<div class="col-sm-3 align-middle">

				<?php if ( has_post_thumbnail() ) : ?>

					<?php echo get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'class' => 'thumbnail' ) ); ?>

				<?php else : ?>

					<img class="thumbnail" src="<?php echo get_template_directory_uri() ?>/assets/img/thumbnail.png"/>

				<?php endif; ?>

			</div>

		<?php endif; ?>


		<div class="entry-content <?php echo ( $list_type === 'thumbnail' ) ? 'col-sm-9' : 'col-sm-12'; ?>">

            <div class="row">

                <header class="entry-header p-0 <?php echo ( $list_type === 'meta' ) ? 'col-sm-9' : 'col-sm-12'; ?>">
                    <?php the_title( sprintf( '<h2 class="entry-title font-weight-bold"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                </header>

                <?php if ( 'post' == get_post_type() && $list_type !== 'title') : ?>
                    <div class="entry-meta my-1 text-muted small p-0 <?php echo ( $list_type === 'meta' ) ? 'col-sm-3 text-right' : 'col-sm-12'; ?>">
                        <?php maizi_post_meta(); ?>
                    </div>
                <?php endif; ?>

                <?php if ( $list_type === 'excerpt' || $list_type === 'thumbnail') : ?>
                <div class="col-sm-12 p-0">
                    <?php maizi_excerpt(); ?>
                </div>
                <?php endif; ?>
            </div>

        </div>

	</div>

</article>
