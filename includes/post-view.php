<?php

const POST_VIEWS_KEY = 'post_views_count';


function getPostViews($postID) {
    $count = get_post_meta($postID, POST_VIEWS_KEY, true);

    if ($count == '') {
        delete_post_meta($postID, POST_VIEWS_KEY);
        add_post_meta($postID, POST_VIEWS_KEY, '0');

        return 0;
    }

    return $count;
}

function setPostViews($postID)
{
    $count = get_post_meta($postID, POST_VIEWS_KEY, true);

    if ($count == '') {
        delete_post_meta($postID, POST_VIEWS_KEY);
        add_post_meta($postID, POST_VIEWS_KEY, '0');
    } else {
        $count++;
        update_post_meta($postID, POST_VIEWS_KEY, $count);
    }
}

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);