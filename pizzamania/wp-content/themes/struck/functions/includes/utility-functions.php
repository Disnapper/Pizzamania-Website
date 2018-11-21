<?php
/**
 * Utility functions used for the theme
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Adds http to url if needed
 * @since 1.0
 *
 * @param $url
 *
 * @return string
 */
if ( ! function_exists( 'tw_addhttp' ) ) :
	function tw_addhttp( $url ) {
		if ( ! preg_match( "~^(?:f|ht)tps?://~i", $url ) ) {
			$url = "http://" . $url;
		}

		return esc_url( $url );
	}
endif;

/**
 * Check to see if variable is set then return default or false
 * @since 1.0
 *
 * @param $var
 * @param bool $default
 *
 * @return bool
 */
if ( ! function_exists( 'tw_issetor' ) ) :
	function tw_issetor( &$var, $default = false ) {
		return isset( $var ) ? $var : $default;
	}
endif;

/**
 * Function to convert hex to rgba
 * @since 1.0
 *
 * @param $hex
 * @param $alpha
 *
 * @return string
 */
if ( ! function_exists( 'tw_hex2rgba' ) ) :
	function tw_hex2rgba( $hex, $alpha ) {
		$hex = str_replace( "#", "", $hex );

		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgba = array( $r, $g, $b, $alpha );

		return implode( ",", $rgba ); // returns the rgb values separated by commas
	}
endif;