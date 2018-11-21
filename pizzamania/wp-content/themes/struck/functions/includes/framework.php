<?php
/**
 * Standard Themewich Framework Functionality
 * Functions used across multiple themes
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Replaces [...] with ... for excerpts to make them human again.
 * @since  1.0
 */
if ( ! function_exists( 'tw_excerpt_more' ) ) :
	function tw_excerpt_more( $excerpt ) {
		return str_replace( '[...]', '...', $excerpt );
	}

	add_filter( 'wp_trim_excerpt', 'tw_excerpt_more' );
endif;

/**
 * Browser detection body class
 * @since  1.0
 */
if ( ! function_exists( 'tw_browser_body_class' ) ) :
	function tw_browser_body_class( $classes ) {
		global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
		if ( $is_lynx ) {
			$classes[] = 'lynx';
		} elseif ( $is_gecko ) {
			$classes[] = 'gecko';
		} elseif ( $is_opera ) {
			$classes[] = 'opera';
		} elseif ( $is_NS4 ) {
			$classes[] = 'ns4';
		} elseif ( $is_safari ) {
			$classes[] = 'safari';
		} elseif ( $is_chrome ) {
			$classes[] = 'chrome';
		} elseif ( $is_IE ) {
			$classes[] = 'ie';
			if ( preg_match( '/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version ) ) {
				$classes[] = 'ie' . $browser_version[1];
			}
		} else {
			$classes[] = 'unknown';
		}
		if ( $is_iphone ) {
			$classes[] = 'iphone';
		}
		if ( stristr( $_SERVER['HTTP_USER_AGENT'], "mac" ) ) {
			$classes[] = 'osx';
		} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], "linux" ) ) {
			$classes[] = 'linux';
		} elseif ( stristr( $_SERVER['HTTP_USER_AGENT'], "windows" ) ) {
			$classes[] = 'windows';
		}

		$classes[] = strtolower( wp_get_theme() ); // add theme name
		$classes[] = wp_is_mobile() ? 'mobile-device' : 'desktop-device'; // add mobile device class

		return $classes;
	}

	add_filter( 'body_class', 'tw_browser_body_class' );
endif;

/**
 * Enqueue comment reply script
 * @since 1.0
 */
if ( ! function_exists( 'tw_enqueue_comment_reply' ) ) :
	function tw_enqueue_comment_reply() {
		// on single blog post pages with comments open and threaded comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			// enqueue the javascript that performs in-link comment reply fanciness
			wp_enqueue_script( 'comment-reply' );
		}
	}

	// Hook into wp_enqueue_scripts
	add_action( 'wp_enqueue_scripts', 'tw_enqueue_comment_reply' );
endif;

/**
 * Remove the jarring jump link when read more is clicked
 * @since 1.0
 */
if ( ! function_exists( 'tw_remove_more_jump_link' ) ) :
	function tw_remove_more_jump_link( $link ) {
		$offset = strpos( $link, '#more-' );
		if ( $offset ) {
			$end = strpos( $link, '"', $offset );
		}
		if ( $end ) {
			$link = substr_replace( $link, '', $offset, $end - $offset );
		}

		return $link;
	}

	add_filter( 'the_content_more_link', 'tw_remove_more_jump_link' );
endif;

/**
 * Wrap All Read More Tags In A Span for additional styling options
 * @since 1.0
 */
if ( ! function_exists( 'tw_wrap_readmore' ) ) :
	function tw_wrap_readmore( $more_link ) {
		return '<span class="more-link">' . $more_link . '</span>';
	}

	add_filter( 'the_content_more_link', 'tw_wrap_readmore', 10, 1 );
endif;

/**
 * Add lightbox to image attachment links
 * @since  1.0
 */
if ( ! function_exists( 'tw_lightbox' ) ) :
	function tw_lightbox( $content ) {
		$content = preg_replace( "/<a/", "<a class=\"themewich-lightbox no-ajaxy\"", $content, 1 );

		return $content;
	}

	add_filter( 'wp_get_attachment_link', 'tw_lightbox' );
endif;

/**
 * Automatically add lightbox to images linking to images.
 * @since 1.0
 */
if ( ! function_exists( 'tw_add_lightbox' ) ) :
	function tw_add_lightbox( $content ) {

		//Check the page for link images direct to image (no trailing attributes)
		$string = '/<a href="(.*?).(jpg|jpeg|png|gif|bmp|ico)"><img(.*?)class="(.*?)wp-image-(.*?)" \/><\/a>/i';
		preg_match_all( $string, $content, $matches, PREG_SET_ORDER );

		//Check which attachment is referenced
		foreach ( $matches as $val ) :
			$post = get_post( $val[5] );

			//Replace the instance with the lightbox and title(caption) references. Won't fail if caption is empty.
			$string  = '<a href="' . $val[1] . '.' . $val[2] . '"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
			$replace = '<a href="' . $val[1] . '.' . $val[2] . '" class="themewich-lightbox"><img' . $val[3] . 'class="' . $val[4] . 'wp-image-' . $val[5] . '" /></a>';
			$content = str_replace( $string, $replace, $content );
		endforeach;

		return $content;
	}

	add_filter( 'the_content', 'tw_add_lightbox', 2 );
endif;

/**
 * Remove default menu container div
 * @since 1.0
 */
if ( ! function_exists( 'tw_nav_menu' ) ) :
	function tw_nav_menu( $args = '' ) {
		$args['container'] = false;

		return $args;
	}

	add_filter( 'wp_nav_menu_args', 'tw_nav_menu' );
endif;

/**
 * Add additional functionality for Qtranslate
 * @since 1.0
 */
if ( function_exists( 'qtrans_modifyTermFormFor' ) ) {
	add_action( 'filter_add_form', 'qtrans_modifyTermFormFor' );
	add_action( 'filter_edit_form', 'qtrans_modifyTermFormFor' );
}

/**
 * Replace full size image in gallery with large
 * @since 1.0
 */
if ( ! function_exists( 'tw_get_attachment_link_filter' ) ) :
	function tw_get_attachment_link_filter( $content, $post_id, $size, $permalink ) {
		// Only do this if we're getting the file URL
		if ( ! $permalink ) {
			// This returns an array of (url, width, height)
			$image       = wp_get_attachment_image_src( $post_id, 'large' );
			$new_content = preg_replace( '/href=\'(.*?)\'/', 'href=\'' . $image[0] . '\'', $content );

			return $new_content;
		} else {
			return $content;
		}
	}

	add_filter( 'wp_get_attachment_link', 'tw_get_attachment_link_filter', 10, 4 );
endif;

/**
 * Automatic Excerpt Trim
 * @since 1.0
 */
if ( ! function_exists( 'ag_wp_trim_excerpt' ) ) :
	function ag_wp_trim_excerpt( $text ) {
		global $post;
		$raw_excerpt = $text;
		if ( '' == $text ) {
			//Retrieve the post content.
			$text = get_the_content( '' );

			//Delete all shortcode tags from the content.
			$text = strip_shortcodes( $text );

			$text = apply_filters( 'the_content', $text );
			$text = str_replace( ']]>', ']]&gt;', $text );

			$allowed_tags = '<p>,<em>,<strong>,<b>,<ul>,<li>,<ol>,<blockquote>';
			/*** Add the allowed HTML tags separated by a comma.***/
			$text = strip_tags( $text, $allowed_tags );

			$excerpt_word_count = 30;
			/*** change the excerpt word count to any integer you like.***/
			$excerpt_length = apply_filters( 'excerpt_length', $excerpt_word_count );

			$excerpt_end = '... <br /><a href="' . get_permalink( $post->ID ) . '" class="more-link">' . __( 'Read More', 'themewich' ) . '</a>';
			/*** change the excerpt endind to something else.***/
			$excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end );

			$words = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
			if ( count( $words ) > $excerpt_length ) {
				array_pop( $words );
				$text = implode( ' ', $words );
				$text = $text . $excerpt_more;
				$text = balanceTags( $text ); //close any unclosed tags
			} else {
				$text = implode( ' ', $words );
			}

		}

		return apply_filters( 'wp_trim_excerpt', $text, $raw_excerpt );
	}

	remove_filter( 'get_the_excerpt', 'wp_trim_excerpt' );
	add_filter( 'get_the_excerpt', 'ag_wp_trim_excerpt' );
endif;

/**
 * Automatic Excerpt Trim and Add Read More Button
 * @since 1.0
 */
if ( ! function_exists( 'themewich_custom_excerpt_more' ) ) :
	function themewich_custom_excerpt_more( $output ) {
		global $post;

		if ( has_excerpt() && ! is_attachment() ) {

			$output = wp_kses_post( $output );
			$output = $output . '<br /><a href="' . get_permalink( $post->ID ) . '" class="more-link">' . __( 'Read More', 'themewich' ) . '</a>';
			/*** change the excerpt endind to something else.***/

		} else { // if there's no excerpt, trim the content and display read more

			//Retrieve the post content.
			$text = get_the_content( '' );

			//Delete all shortcode tags from the content.
			$text = strip_shortcodes( $text );
			$text = apply_filters( 'the_content', $text );
			$text = str_replace( ']]>', ']]&gt;', $text );
			$text = wp_kses_post( $text );

			$excerpt_word_count = 45;
			/*** change the excerpt word count to any integer you like.***/
			$excerpt_length = apply_filters( 'excerpt_length', $excerpt_word_count );

			$excerpt_end = '... <br /><a href="' . get_permalink( $post->ID ) . '" class="more-link">' . __( 'Read More', 'themewich' ) . '</a>';
			/*** change the excerpt endind to something else.***/
			$excerpt_more = apply_filters( 'excerpt_more', ' ' . $excerpt_end );

			$words = preg_split( "/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY );
			if ( count( $words ) > $excerpt_length ) {
				array_pop( $words );
				$text = implode( ' ', $words );
				$text = $text . $excerpt_more;
				$text = balanceTags( $text ); //close any unclosed tags
			} else {
				$text = implode( ' ', $words );
			}

			$output = $text;
		}

		return $output;
	}

	add_filter( 'get_the_excerpt', 'themewich_custom_excerpt_more' );
endif;

/**
 * Function that uses include locate template
 * to make sure global variables don't need to be
 * used (as in the case of get_template_part).
 */
if ( ! function_exists( 'tw_get_template' ) ) :
	function tw_get_template( $template_path ) {
		if ( locate_template( $template_path . '.php' ) ) {
			include( locate_template( $template_path . '.php' ) );
		} else {
			return false;
		}
	}
endif;

/**
 * Custom author link function
 * Allows author link to be overwritten by child theme
 */
if ( ! function_exists( 'tw_author_link' ) ) :
	function tw_author_link( $link ) {
		if ( $link == 'posts' ) {
			the_author_posts_link();
		} else {
			the_author_link();
		}
	}
endif;

/**
 * Readd styleselect dropdown to tinyMCE
 */
if ( ! function_exists( 'tw_mce_styleselect' ) ) :
	function tw_mce_styleselect( $buttons ) {
		array_unshift( $buttons, 'styleselect' );

		return $buttons;
	}

	add_filter( 'mce_buttons_2', 'tw_mce_styleselect' );
endif;

/**
 * Add additional style to dropdown
 */
if ( ! function_exists( 'tw_custom_tinymce' ) ) :
	function tw_custom_tinymce( $settings ) {

		$style_formats = array(
			array(
				'title'   => 'Left Aside',
				'block'   => 'aside',
				'classes' => 'aside-left',
				'wrapper' => true
			),
			array(
				'title'   => 'Right Aside',
				'block'   => 'aside',
				'classes' => 'aside-right',
				'wrapper' => true
			),
		);


		// We need the style formats in JSON format
		$settings['style_formats'] = json_encode( $style_formats );

		// Return the $settings variable,
		// now with our custom formats
		return $settings;

	}

	add_filter( 'tiny_mce_before_init', 'tw_custom_tinymce' );
endif;

/**
 * Display the post content. Optionally allows post ID to be passed
 * @uses the_content()
 *
 * @param int $post_id
 * @param bool $echo
 * @param string $more_link_text Optional. Content for when there is more text.
 * @param bool $stripteaser Optional. Strip teaser content before the more text. Default is false.
 *
 * @return mixed|string|void
 */
function tw_the_content_by_id( $post_id = 0, $echo = true, $more_link_text = null, $stripteaser = false ) {
	global $post;
	$post = get_post( $post_id );
	setup_postdata( $post, $more_link_text, $stripteaser );
	if ( $echo ) {
		the_content();
	} else {
		$content = get_the_content();
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );

		return $content;
	}
	wp_reset_postdata( $post );
}