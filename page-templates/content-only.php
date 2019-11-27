<?php
/**
 * Template Name: Content Only Template
 *
 * Template with content only, no left sidebar, right sidebar and post meta.
 *
 */

get_header();
$container   = get_theme_mod( 'maizi_container_type' );

?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

        <div class="row d-flex flex-row">

            <div class="col-md-12 content-area" id="primary">

                <main class="site-main" id="main">

                    <?php while ( have_posts() ) : ?>

                        <?php the_post(); ?>

                        <article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

                            <div class="card">
                                <header class="card-header bg-light">

                                    <?php the_title( '<h1 class="card-title">', '</h1>' ); ?>

                                </header><!-- .entry-header -->

                                <div class="card-body">

                                    <?php the_content(); ?>

                                </div>
                            </div>

                        </article><!-- #post-## -->

                        <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                        ?>

                    <?php endwhile; ?>

                </main><!-- #main -->

            </div><!-- #primary -->

        </div><!-- .row -->

    </div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
