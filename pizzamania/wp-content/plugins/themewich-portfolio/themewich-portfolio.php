<?php
/**
 * Plugin Name: Themewich Portfolio Items
 * Plugin URI: http://themewich.com
 * Description: Portfolio Items post type for your Themewich theme.
 * Version: 1.0
 * Author: Andre Gagnon
 * Author URI: http://www.themewich.com
 * License: GPL2
 */
if ( ! function_exists('create_portfolio_post_types') ) :
	/**
	 * Add sectinon post type
	 * @since Edition 1.0
	 */
	function create_portfolio_post_types() {
		register_post_type( 'portfolio',
			array(
				'labels' => array(
					'name' 					=> __( 'Portfolio', 'themewich' ),
					'singular_name' 		=> __( 'Portfolio Item', 'themewich' ),
					'add_new' 				=> __( 'Add New', 'themewich' ),
					'add_new_item' 			=> __( 'Add New Portfolio Item', 'themewich' ),
					'edit' 					=> __( 'Edit', 'themewich' ),
					'edit_item' 			=> __( 'Edit Portfolio Item', 'themewich' ),
					'new_item' 				=> __( 'New Portfolio Item', 'themewich' ),
					'view' 					=> __( 'View Portfolio Item', 'themewich' ),
					'view_item' 			=> __( 'View Portfolio Item', 'themewich' ),
					'search_items' 			=> __( 'Search Portfolio Items', 'themewich' ),
					'not_found' 			=> __( 'No Portfolio Item Found', 'themewich' ),
					'not_found_in_trash' 	=> __( 'No Portfolio Items found in Trash', 'themewich' ),
					'parent' 				=> __( 'Parent Portfolio Item', 'themewich' ),
				),
				'exclude_from_search' => false,
				'menu_icon' => 'dashicons-schedule',
				'public' 	=> true,
				'rewrite'	=> array( 'slug' => 'portfolio'), //  Change this to change the url of your "portfolio".
				'supports'	=> array( 
					'title', 
					'editor',  
					'excerpt',
					'thumbnail',
					'revisions',
					'post-formats'
				),
			)
		);
	}
	add_action( 'init', 'create_portfolio_post_types' );
endif;

/**
 * Creates the "Filter" taxonomy.
 * @since 1.0
 */
if ( ! function_exists( 'themewich_create_taxonomies' ) ) :
	function themewich_create_taxonomies() {
		$labels = array(
			'name'              => _x( 'Filter', 'taxonomy general name', 'framework' ),
			'singular_name'     => _x( 'Filter', 'taxonomy singular name', 'framework' ),
			'search_items'      => __( 'Search Filters', 'framework' ),
			'all_items'         => __( 'All Filters', 'framework' ),
			'parent_item'       => __( 'Parent Filter', 'framework' ),
			'parent_item_colon' => __( 'Parent Filter:', 'framework' ),
			'edit_item'         => __( 'Edit Filter', 'framework' ),
			'update_item'       => __( 'Update Filter', 'framework' ),
			'add_new_item'      => __( 'Add New Filter', 'framework' ),
			'new_item_name'     => __( 'New Filter Name', 'framework' ),
			'menu_name'         => __( 'Filters', 'framework' ),
		);

		register_taxonomy( 'filter',
			array( 'portfolio', 'post' ),
			array(
				'hierarchical' => true,
				'labels'       => $labels,
				'show_ui'      => true,
				'query_var'    => true,
				'rewrite'      => array( 'slug' => 'filter' ), // This is the url slug
			)
		);
	}

	add_action( 'init', 'themewich_create_taxonomies', 0 );
endif;