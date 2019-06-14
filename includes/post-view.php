<?php

const POST_META_VIEWS_KEY = 'views';

function get_post_views($postID)
{
    return shorten_number((int)get_post_meta($postID, POST_META_VIEWS_KEY, true));
}

function shorten_number($n, $precision = 1)
{
    if ($n < 1e+3) {
        $out = number_format($n);
    } else if ($n < 1e+6) {
        $out = number_format($n / 1e+3, $precision) . 'k';
    } else if ($n < 1e+9) {
        $out = number_format($n / 1e+6, $precision) . 'm';
    } else if ($n < 1e+12) {
        $out = number_format($n / 1e+9, $precision) . 'b';
    }

    return $out;
}

function add_post_views_script() {
    if ( is_singular() ) {
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
add_action( 'wp_ajax_update_post_views', 'update_post_views' );       // for login user
add_action( 'wp_ajax_nopriv_update_post_views', 'update_post_views' );  // for users that are not logged in