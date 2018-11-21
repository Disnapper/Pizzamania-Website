<?php
/**
 * Functions for additional full image in WYSIWYG
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Add class to images based on alignment.
 *
 * @param  string $html string the html to insert into editor
 * @param  integer $id image attachment id
 * @param  string $caption image caption
 * @param  string $alt image alt attribute
 * @param  string $title image title attribute
 * @param  string $align image css alignment property
 * @param  string $url image src url
 * @param  string|bool $rel image rel attribute
 * @param  string $size image size (thumbnail, medium, large, full or added  with add_image_size() )
 *
 * @return string      the html to insert into editor
 */
if ( ! function_exists( 'themewich_addclass_to_images' ) ) :
	function themewich_addclass_to_images( $html, $id, $caption, $title, $align, $url, $size, $alt = '' ) {
		switch ( $align ) {
			case 'full':
				$alignclass = 'fullimg';
				break;
			default:
				$alignclass = 'normal';
				break;
		}

		// Check for image tag in html content
		$found = preg_match( "/<img[^>]*>/", $html, $a_elem );

		// If no image, do nothing
		if ( $found <= 0 ) {
			return wp_kses_post( $html );
		}

		// Convert to string
		$a_elem = $a_elem[0];

		// If image already has class defined inject it to attribute
		if ( strstr( $a_elem, "class=\"" ) !== false ) {
			$a_elem_new = str_replace( "class=\"", "class=\"$alignclass ", $a_elem );
			$html       = str_replace( $a_elem, $a_elem_new, $html );
		} else { // If no class defined, just add class attribute
			$html = str_replace( "<img ", "<img class=\"$alignclass \" ", $html );
		}

		return wp_kses_post( $html );
	}

	add_filter( 'image_send_to_editor', 'themewich_addclass_to_images', 10, 8 );
endif;

/**
 * Adds additional sizes to the gallery thumbnail dropdown
 * @since 1.0
 */
if ( ! function_exists( 'themewich_more_sizes' ) ) :
	function themewich_more_sizes( $sizes ) {
		$sizes['fullslideshownc'] = __( 'Full Width Optimized', 'themewich' );

		return $sizes;
	}

	add_filter( 'image_size_names_choose', 'themewich_more_sizes', 4, 1 );
endif;

/**
 * Modify WordPress Caption to add class and remove inline
 * styles for full images
 *
 * @since 1.0
 */
function tw_img_caption_shortcode( $empty, $attr, $content ) {

	$widthstyle = true;
	$captionclass = false;

	if ( ! isset( $attr['caption'] ) ) :
		// Set initial variables
		$captionclass = 'caption-normal';

		// Get the caption
		if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
			$content         = $matches[1];
			$attr['caption'] = trim( $matches[2] );
		}

		// Find fullimg class
		if ( $c = preg_match_all( "/.*?(fullimg)/is", $content, $matches ) ) {
			$captionclass = sanitize_html_class( 'caption-' . $matches[1][0] );
			$widthstyle   = false;
		}
	endif;

	extract( shortcode_atts( array(
		'id'      => '',
		'align'   => 'alignnone',
		'width'   => '',
		'caption' => ''
	), $attr ) );

	$widthstyle = $widthstyle ? 'style="width:' . (int) $width . 'px;"' : '';

	if ( 1 > (int) $width || empty( $caption ) ) {
		return $content;
	}

	if ( $id ) {
		$id = 'id="' . esc_attr( $id ) . '" ';
	}
    
    // doesn't need final validation because the_content is run through wp_kses filter
    return '<div ' . $id . 'class="wp-caption ' . sanitize_html_class( $align ) . '" style="width: ' . (int) $width . 'px">'
    . do_shortcode( $content ) . '<p class="wp-caption-text"><span>' . $caption . '</span></p></div>';

}

add_filter( 'img_caption_shortcode', 'tw_img_caption_shortcode', 10, 3 );