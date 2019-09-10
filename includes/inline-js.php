<?php

function rename_jquery() {
    wp_add_inline_script('inline-js', 'var $ = jQuery;');
}
add_action( 'wp_enqueue_scripts', 'rename_jquery' );


function add_cookie_js_script() {
    if ( is_singular() ) {
        $js = "
            var cookieName = 'singular-tab-id';

            var tabId = Cookies.get(cookieName);
            if (tabId !== undefined) {
                $('#myTab a[href=\"#' + tabId + '\"]').tab('show');
            }
            

            $('.nav-link').on('click', function() {
                tabId = \$(this).attr('aria-controls');
                Cookies.set(cookieName, tabId, { expires: 7, path: '/' })
            });
        ";

        wp_add_inline_script('inline-js', $js);
    }
}
add_action( 'wp_enqueue_scripts', 'add_cookie_js_script' );