<?php
/**
 * A reusable posts items loop with terms
 *
 * Uses a transient to cache the loop, decreasing database queries
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// Get Current Page for Pagination
$pagething = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
$paged     = $pagething ? $pagething : 1;
$post_ID   = get_the_id();

// Check for cached transient to improve speed and reduce server load.
$loop = get_transient( 'themewich_posts_loop_' . $post_ID . '_' . $paged );

// allow hook to turn off transient
$loop = apply_filters( 'tw_posts_transient', $loop );

// if transient isn't set, run query
if ( false === $loop ) {

	// reset query
	wp_reset_query();

	$args = array(
			// Ignore Sticky Posts
			//'ignore_sticky_posts' => 1,
			// Get post items
			'post_type' => array( 'post' ),
			// Get only the most recent
			'posts_per_page' => (int) $tw_page['posts_per_page'], // Set posts per page,
			// Add pagination
			'paged' => (int) $paged,
		);

	$loop = new WP_Query( apply_filters( 'tw_posts_query', $args ) );

	// transient set to last for 1 hour
	set_transient( 'themewich_posts_loop_' . $post_ID . '_' . $paged, $loop, 60 * 60 );
}