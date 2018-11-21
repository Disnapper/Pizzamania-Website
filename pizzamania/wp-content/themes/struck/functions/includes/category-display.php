<?php
/**
 * Custom category functions
 * Limit the display, reorder, and arrays
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Helper function to sort categories
 * @since 1.0
 *
 * @param $a
 * @param $b
 *
 * @return mixed
 */
if ( ! function_exists( 'tw_sort_by_order' ) ) :
	function tw_sort_by_order( $a, $b ) {
		return $a->term_order - $b->term_order;
	}
endif;

/**
 * Custom category display function
 * @since 1.0
 *
 * @param $num
 * @param null $lister
 *
 * @return bool|string
 */
if ( ! function_exists( 'themewich_get_cats' ) ) :
	function themewich_get_cats( $num, $lister = null ) {

		global $post;

		$t          = get_the_category( $post->ID );
		$count      = count( $t );
		$cat_string = $list = false;

		if ( $lister ) {
			$list = ', ';
		}

		// If sorting is enabled
		if ( isset( $t[0]->term_order ) ) {
			usort( $t, 'tw_sort_by_order' );
		}

		if ( $count < $num ) {
			$num = $count;
		}

		for ( $i = 0; $i < $num; $i ++ ) {
			$url = get_category_link( $t[ $i ]->cat_ID );
			$cat_string .= '<a href="' . esc_url( $url ) . '" class="' . esc_attr( 'category-' . $t[ $i ]->term_id ). '" title="'  . esc_attr( __( 'More', 'themewich' ) . ' ' . $t[ $i ]->cat_name . ' ' . __( 'Posts', 'themewich' ) ) . '">';
			$cat_string .= esc_html( $t[ $i ]->cat_name );
			$cat_string .= '</a>' . esc_html( $list );
		}

		if ( $list == ', ' ) {
			$cat_string = rtrim( $cat_string, ', ' );
		} else {
			$cat_string .= '<div class="clear"></div>';
		}

		return $cat_string;
	}
endif;

/**
 * Custom category array function
 * @since 1.0
 */
if ( ! function_exists( 'themewich_get_cats_array' ) ) :
	function themewich_get_cats_array( $num ) {

		$t = get_the_category();

		// If sorting is enabled
		if ( isset( $t[0]->term_order ) ) {
			usort( $t, 'tw_sort_by_order' );
		}

		return array_slice( $t, 0, $num );
	}
endif;