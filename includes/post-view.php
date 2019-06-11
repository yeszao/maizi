<?php

const POST_META_VIEWS_KEY = 'views';

function get_post_views($postID)
{
    return (int)get_post_meta($postID, POST_META_VIEWS_KEY, true);
}


function add_post_views_script() {
    if ( is_single() || is_page() ) {
        $url = admin_url('admin-ajax.php');
        $postID = get_the_ID();
        $data = "jQuery.post('$url', {
                action  : 'update_post_views',
                post_id : $postID
            });";

        wp_add_inline_script('inline-js', $data);
    }
}
add_action( 'wp_enqueue_scripts', 'add_post_views_script' );


function update_post_views() {
    if ( isset( $_POST['post_id'] ) && $_POST['post_id'] ) {
        $postID = intval( $_POST['post_id'] );
        $count = get_post_meta($postID, POST_META_VIEWS_KEY, true);

        if ($count == '') {
            delete_post_meta($postID, POST_META_VIEWS_KEY);
            add_post_meta($postID, POST_META_VIEWS_KEY, '1');
        } else {
            $count++;
            update_post_meta($postID, POST_META_VIEWS_KEY, $count);
        }
    }

    wp_die();
}
//add_action( 'wp_ajax_update_post_views', 'update_post_views' );       // for login user
add_action( 'wp_ajax_nopriv_update_post_views', 'update_post_views' );  // for users that are not logged in