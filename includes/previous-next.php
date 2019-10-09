<?php
/**
 * Get previous and Next post link
 */

function get_previous_and_next_post() {
    ?>
    <div class="d-flex justify-content-between flex-wrap my-4 font-weight-bold">
        <div class="">
            <?php _e('Previous post:', 'maizi') ?>
            <?php next_post_link('%link') ?>
        </div>
        <div class="">
            <?php _e('Next post:', 'maizi') ?>
            <?php previous_post_link('%link') ?>
        </div>
    </div>

<?php
}