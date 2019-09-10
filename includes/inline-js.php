<?php

function rename_jquery() {
    wp_add_inline_script('inline-js', 'var $ = jQuery;');
}
add_action( 'wp_enqueue_scripts', 'rename_jquery' );


function add_aside_tab_cookie_script() {
    if ( is_singular() ) {
        $js = "
            var cookieName = 'aside-content-tab-id';

            var tabId = Cookies.get(cookieName);
            if (tabId !== undefined) {
                $('#myTab a[href=\"#' + tabId + '\"]').tab('show');
            }
            

            $('.aside-content').find('.nav-link').on('click', function() {
                tabId = \$(this).attr('aria-controls');
                Cookies.set(cookieName, tabId, { expires: 7, path: '/' })
            });
        ";

        wp_add_inline_script('inline-js', $js);
    }
}
add_action( 'wp_enqueue_scripts', 'add_aside_tab_cookie_script' );