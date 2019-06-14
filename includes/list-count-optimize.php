<?php
/**
 * Set wordpress WP_Query SQL_CALC_FOUND_ROWS to false,
 * And replace with MySQL `EXPLAIN` statement to speed up pagination count.
 * @reference https://wpartisan.me/tutorials/wordpress-database-queries-speed-sql_calc_found_rows
 */


if ( ! function_exists( 'maizi_set_no_found_rows' ) ) {
    /**
     * Sets the 'no_found_rows' param to true.
     *
     * In the WP_Query class this stops the use of SQL_CALC_FOUND_ROWS in the
     * MySql query it generates. It's slow so we're going to replace it with
     * a EXPLAIN instead.
     *
     * @param  WP_Query $wp_query The WP_Query instance. Passed by reference.
     * @return void
     */
    function maizi_set_no_found_rows(\WP_Query $wp_query)
    {
        $wp_query->set('no_found_rows', true);
    }
}
add_filter( 'pre_get_posts', 'maizi_set_no_found_rows', 10, 1 );


if ( ! function_exists( 'maizi_set_found_posts' ) ) {

    /**
     * Workout the pagination values.
     *
     * Uses the query parts to run a custom count(*) query against the database
     * then constructs and sets the pagination results for this wp_query.
     *
     * @param array $clauses Array of clauses that make up the SQL query.
     * @param WP_Query $wp_query The WP_Query instance. Passed by reference.
     * @return array
     */
    function maizi_set_found_posts($clauses, \WP_Query $wp_query)
    {
        // Don't proceed if it's a singular page.
        if ($wp_query->is_singular()) {
            return $clauses;
        }

        global $wpdb;

        // Check if they're set.
        $where = isset($clauses['where']) ? $clauses['where'] : '';
        $join = isset($clauses['join']) ? $clauses['join'] : '';
        $distinct = isset($clauses['distinct']) ? $clauses['distinct'] : '';

        // Construct and run the query. Set the result as the 'found_posts'
        // param on the main query we want to run.
        $wp_query->found_posts = (int)$wpdb->get_row("EXPLAIN SELECT $distinct * FROM {$wpdb->posts} $join WHERE 1=1 $where")->rows;

        // Work out how many posts per page there should be.
        $posts_per_page = (!empty($wp_query->query_vars['posts_per_page']) ? absint($wp_query->query_vars['posts_per_page']) : absint(get_option('posts_per_page')));

        // Set the max_num_pages.
        $wp_query->max_num_pages = ceil($wp_query->found_posts / $posts_per_page);

        // Return the $clauses so the main query can run.
        return $clauses;
    }
}
add_filter( 'posts_clauses', 'maizi_set_found_posts', 10, 2 );