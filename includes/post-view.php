<?php

const POST_META_VIEWS_KEY = 'views';


function getPostViews($postID)
{
    return (int)get_post_meta($postID, POST_META_VIEWS_KEY, true);
}


function setPostViews()
{
    if ( !is_page() && !is_single()) {
        return;
    }

    $postID = get_the_ID();
    $count = get_post_meta($postID, POST_META_VIEWS_KEY, true);

    if ($count == '') {
        delete_post_meta($postID, POST_META_VIEWS_KEY);
        add_post_meta($postID, POST_META_VIEWS_KEY, '1');
    } else {
        $count++;
        update_post_meta($postID, POST_META_VIEWS_KEY, $count);
    }
}
add_action('wp_head', 'setPostViews', 100, 0);

// Remove issues with prefetching adding extra views
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10);