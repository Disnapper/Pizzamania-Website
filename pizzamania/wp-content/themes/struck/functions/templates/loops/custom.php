<?php
/**
 * A reusable custom user selected items loop with terms
 *
 * This does not use a transient because each loop is unique
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// Get Current Page for Pagination
$pagething  = get_query_var('paged') ? get_query_var('paged') : get_query_var('page');
$paged      = $pagething ? $pagething : 1;

// get ids of selected items for loop
$ids = $fields_installed ? get_field( 'items_pick', false, false ) : array();

// reset query
wp_reset_query();

$args = array(
	// Ignore Sticky Posts
	'ignore_sticky_posts' => 1,
	// Get post items
	'post_type'           => array( 'post', 'portfolio', 'page' ),
	// custom selected posts
	'post__in'            => $ids,
	// user defined order
	'orderby'             => 'post__in',
	// Get only the most recent
	'posts_per_page'      => (int) $tw_page['posts_per_page'], // Set posts per page,
	// Add pagination
	'paged'               => (int) $paged,
);

// store query
$loop = new WP_Query( apply_filters( 'tw_custom_query_' . get_the_ID(), $args ) );