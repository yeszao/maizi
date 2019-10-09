<?php
/**
 * Get previous and Next post link
 */

function get_previous_and_next_post() {
    ?>
    <div class="d-flex justify-content-between flex-wrap my-4 font-weight-bold">

        <div>
            <?php if ($link = get_next_post_link('%link')) : ?>
                <?php _e('Previous post:', 'maizi') ?> <?php echo $link; ?>
            <?php endif; ?>
        </div>

        <div>
            <?php if ($link = get_previous_post_link('%link')) : ?>
                <?php _e('Next post:', 'maizi') ?> <?php echo $link; ?>
            <?php endif; ?>
        </div>

    </div>

<?php
}