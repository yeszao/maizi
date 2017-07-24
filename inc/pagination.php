<?php
/**
 * Pagination layout.
 *
 * @package qiaomi
 */

/**
 * Custom Pagination with numbers
 * Credits to http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/
 */

if ( ! function_exists( 'qiaomi_pagination' ) ) :
function qiaomi_pagination()
{
    if (is_singular()) {
        return;
    }

    global $wp_query;

    $current = max(1, absint(get_query_var('paged')));
    $pages = paginate_links(array(
        'base' => str_replace(PHP_INT_MAX, '%#%', esc_url(get_pagenum_link(PHP_INT_MAX))),
        'format' => '?paged=%#%',
        'current' => $current,
        'total' => $wp_query->max_num_pages,
        'type' => 'array',
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'end_size' => 1,
        'mid_size' => 3,
    ));

    if (!empty($pages)) :
        $pagination = '<nav aria-label="Page navigation"><ul class="pagination justify-content-center">';

        foreach ($pages as $key => $page_link) :
            $active = strpos($page_link, 'current') !== false ? 'active' : '';
            $page_link = str_replace('page-numbers', 'page-link', $page_link);
            $pagination .= sprintf('<li class="page-item %s">%s</a></li>', $active, $page_link);
        endforeach;

        $pagination .= '</ul></nav>';
        echo $pagination;
    endif;
}

endif;
