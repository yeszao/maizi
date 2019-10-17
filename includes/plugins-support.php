<?php

/**
 * Add prismatic to support ACF programming language support
 * @return string
 */
function acf_code_field_support_prismatic()
{
    if (!is_singular()) {
        return;
    }

    global $post;

    $metas = get_programing_language_metas($post->ID);

    $post->post_content .= '<!--';
    foreach ($metas as $key => $value) {
        $post->post_content .= ' '. $key;
    }
    $post->post_content .= ' -->';
}
add_action('wp_enqueue_scripts', 'acf_code_field_support_prismatic', 5);

/**
 * Get programing language metas from post metas, programing
 * languages metas are defined start with 'lang-' or 'language-'.
 *
 * @param $post_id
 * @return array
 */
function get_programing_language_metas($post_id) {
    if (!is_singular()) {
        return array();
    }

    $metas = get_post_meta($post_id);

    $languages = array();
    foreach ($metas as $key => $value) {
        if ( is_programing_language_meta($key) && $value[0]) {
            $languages[$key]['value'] = $value[0];
            $languages[$key]['label'] = get_programing_language_label($key);
        }
    }

    return $languages;
}

/**
 * Check if a string is start with 'lang-' or 'language-'
 *
 * @param $key
 * @return bool
 */
function is_programing_language_meta($key) {
    return substr($key, 0, 5) === 'lang-' || substr($key, 0, 9) === 'language-';
}

/**
 * Get language label
 * @param $key
 * @return string
 */
function get_programing_language_label($key) {
    if (function_exists('get_field_object')) {
        return get_field_object($key)['label'];
    } else {
        return ucwords( substr($key, strpos($key, '-') + 1) );
    }
}