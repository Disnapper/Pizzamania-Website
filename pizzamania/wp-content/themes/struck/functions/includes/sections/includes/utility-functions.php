<?php
/**
 * Utility functions for sections
 *
 * @package WordPress
 * @since 1.0
 */

// create inline style attributes from multi-dimensional array
if ( ! function_exists( 'tw_get_inline_style' ) ) :
	function tw_get_inline_style( $args ) { //$array, $key=false){

		// if no styles are set, return
		if ( ! $args || ! isset( $args['styles'] ) || ! is_array( $args['styles'] ) ) {
			return false;
		}

		// defaults
		$defaults = array(
			'styles'     => false,
			'key'        => false,
			'style_attr' => array(
				'style="',
				'"'
			)
		);

		// Parse incoming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );

		// set initial output string
		$styles = '';

		// if no specific key is set, get all styles of array
		if ( ! $args['key'] ) {

			foreach ( $args['styles'] as $style => $value ) {
				if ( $value ) {
					$styles .=  esc_attr( $style ) . ':' . esc_attr( $value ) . '; ';
				}
			}

			if ( $styles != '' ) {
				$inline_style = $args['style_attr'][0] . $styles . $args['style_attr'][1];

				return $inline_style;
			}

			// let's only return a specific style
		} else {
			if ( $args['styles']['key'] ) {
				$inline_style = $args['style_attr'][0] . esc_attr( $args['key'] ) . ':' . esc_attr( $args['styles']['key'] ) . $args['style_attr'][1];

				return $inline_style;
			}
		}
	}
endif;

// function to echo value
if ( ! function_exists( 'tw_inline_style' ) ) :
	function tw_inline_style( $args ) {
		echo tw_get_inline_style( $args );
	}
endif;

// gets youtube ID from a URL
if ( ! function_exists( 'get_yt_id_from_url' ) ) :
	function get_yt_id_from_url( $url ) {
		if ( preg_match( '/youtube\.com\/watch\?v=([^\&\?\/]+)/', $url, $id ) ) {
			$values = $id[1];
		} else if ( preg_match( '/youtube\.com\/embed\/([^\&\?\/]+)/', $url, $id ) ) {
			$values = $id[1];
		} else if ( preg_match( '/youtube\.com\/v\/([^\&\?\/]+)/', $url, $id ) ) {
			$values = $id[1];
		} else if ( preg_match( '/youtu\.be\/([^\&\?\/]+)/', $url, $id ) ) {
			$values = $id[1];
		} else {
			$values = '';
		}

		return $values;
	}
endif;