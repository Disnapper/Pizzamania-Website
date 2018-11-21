<?php
/**
 * A reusable featured items loop with terms
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
$loop = get_transient( 'themewich_featured_loop_' . $post_ID . '_' . $paged);

// allow hook to turn off transient
$loop = apply_filters( 'tw_featured_transient', $loop );

// if transient isn't set, run query
if ( false === $loop ) {

	// reset query
	wp_reset_query();

	$args = array(
		'ignore_sticky_posts' 	=> 1, 	// Ignore Sticky Posts
		'post_type' 			=> array( 'post', 'portfolio' ), // Get portfolio items and Posts
		'posts_per_page' 		=> (int) $tw_page['posts_per_page'], // Set posts per page
		'paged' 				=> (int) $paged, 	// Add pagination
		'orderby' 		 		=> 'meta_value_num', // Custom order value
		'meta_key' 		 		=> 'homepage_order', // Custom order field
		'order'          		=> 'ASC', // Order by ascending values
		'meta_query' 			=> array(
			array( // Query only marked as featured
				'key' 		=> 'tw_featured',
				'value' 	=> 'Yes',
				'compare' 	=> '=='
				)
			)
		);

	$loop = new WP_Query( apply_filters( 'tw_featured_query', $args ) );

	// transient set to last for 1 hour
	set_transient('themewich_featured_loop_' . $post_ID . '_' . $paged, $loop, 60*60);
}