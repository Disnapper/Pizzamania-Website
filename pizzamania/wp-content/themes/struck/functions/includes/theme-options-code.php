<?php
/**
 * Theme Options functions that output code on the page
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Adds inline styles from custom css box after theme styles
 * @return string
 */
if ( ! function_exists( 'themewich_custom_css' ) ) :
	function themewich_custom_css() {
		global $tw_options;
		if ( ! isset( $tw_options['custom-css'] ) && ! $tw_options['custom-css'] ) {
			return;
		}
		wp_add_inline_style( 'style', $tw_options['custom-css'] );
	}

	add_action( 'wp_enqueue_scripts', 'themewich_custom_css' );
endif;