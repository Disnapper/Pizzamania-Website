<?php
/**
 * Sections functionality for the theme
 *
 * @package WordPress
 * @since 1.0
 */

// Templates Folder Path
if ( ! defined( 'TW_SECTION_DIR' ) ) {
	define( 'TW_SECTION_DIR', 'functions/templates/sections/' );
}
// Template Partials Folder Path
if ( ! defined( 'TW_SECTION_PARTS_DIR' ) ) {
	define( 'TW_SECTION_PARTS_DIR', 'functions/templates/sections/parts/' );
}

/**
 * Strips out evil tags from acf
 *
 * @param $value   [mixed] the value which was loaded from the database
 * @param $post_id [mixed] the post ID from which the value was loaded
 * @param $field   [array] An array containing all the field settings for the field which was used to upload the attachment
 *
 * @return string
 */
if ( ! function_exists( 'tw_strip_evil_scripts_from_acf' ) ) :
	function tw_strip_evil_scripts_from_acf( $value, $post_id, $field ) {

		// we can do this on the front end without performance issues
		// because the field object will be stored in a transient.
		$value = wp_kses_post( $value );

		// return
		return $value;
	}
	add_filter('acf/format_value/type=text', 'tw_strip_evil_scripts_from_acf', 10, 3);
	add_filter('acf/format_value/type=wysiwyg', 'tw_strip_evil_scripts_from_acf', 10, 3);
endif;


/**
 * Add loading class for fullpage
 * @since  1.0
 */
if ( ! function_exists( 'tw_sections_body_class' ) ) :
	function tw_sections_body_class( $classes ) {
		global $post, $fields_installed, $tw_options;

		if ( $fields_installed && have_rows( 'sections' ) && get_field( 'scrolling_type' ) ) {
			$classes[] = 'hide-overflow-load';
		}
		if ( $tw_options['ajax'] == '1' ) {
			$classes[] = 'ajax-on';
		} else {
			$classes[] = 'ajax-off';
		}

		return $classes;
	}

	add_filter( 'body_class', 'tw_sections_body_class' );
endif;

/**
 * Disable acf updates
 *
 * @param $value
 *
 * @return
 */
if ( ! function_exists( 'tw_remove_plugin_updates' ) ) :
	function tw_remove_plugin_updates( $value ) {
		if ( isset( $value->response['advanced-custom-fields-pro/acf.php'] ) ) {
			unset( $value->response['advanced-custom-fields-pro/acf.php'] );
		}

		return $value;
	}

	add_filter( 'site_transient_update_plugins', 'tw_remove_plugin_updates' );
endif;

/**
 * Wrapper function to call class
 * @since 1.0
 *
 * @param $section_count
 * @param $total_sections
 * @param $field_object
 *
 * @return TW_Sections
 */
if ( ! function_exists( 'tw_get_sections' ) ) :
	function tw_get_sections( $section_count, $total_sections, $field_object ) {
		$sections = new TW_Sections( $section_count, $total_sections, $field_object );

		return $sections;
	}
endif;

/**
 * Checks if url is external or internal
 * @since 1.0
 *
 * @param $url
 *
 * @return bool
 */
if ( ! function_exists( 'tw_is_external' ) ) :
	function tw_is_external( $url ) {

		// Abort if parameter URL is empty
		if ( empty( $url ) ) {
			return false;
		}

		// Parse home URL and parameter URL
		$link_url = parse_url( $url );
		$home_url = parse_url( home_url() );

		// Decide on target
		if ( $link_url['host'] == $home_url['host'] ) {
			return false;
		} else {
			return true;
		}
	}
endif;

/**
 * Class to get section options and create
 * proper html output
 * @since 1.0
 */
if ( ! class_exists( 'TW_Sections' ) ) {
	class TW_Sections {

		/**
		 * Stores all option outputs, classes, etc.
		 *
		 * @var array
		 * @since 1.0
		 */
		public $tw_row;

		/**
		 * Current section number
		 *
		 * @var int
		 * @since 1.0
		 */
		protected $section_count;

		/**
		 * Total number of sections
		 *
		 * @var int
		 * @since 1.0
		 */
		protected $total_sections;

		/**
		 * Custom fields object
		 *
		 * @var object
		 * @since 1.0
		 */
		protected $field_object;


		/**
		 * Get things going
		 *
		 * @since  1.0
		 */
		public function __construct( $section_count, $total_sections, $field_object ) {

			// store variables in class scope
			$this->section_count  = $section_count;
			$this->field_object   = $field_object;
			$this->total_sections = $total_sections;

			// get section info
			$this->get_section();

		}

		/**
		 * Run through functions
		 *
		 * Gets section variables, flags, processes options
		 * for output and creates inline elements
		 *
		 * @since  1.0
		 */
		private function get_section() {

			$this->get_section_fields();
			$this->get_section_flags();
			$this->process_fields();
			$this->section_inline_elements();
			$this->section_buttons();

		}

		/**
		 * Maps fields into array and set defaults to false
		 * use the field object so we don't have to worry about a global post variable
		 *
		 * @since  1.0
		 */
		private function get_section_fields() {

			// custom fields to retrieve
			$fields = array(
				'acf_fc_layout',
				'animations',
				'background',
				'background_image',
				'background_color',
				'text_color',
				'page_post_link',
				'buttons',
				'buttons_output',
				'scroll_arrow',
				'overlay',
				'overlay_opacity',
				'text_color',
				'text_layout',
				'images',
				'image_link',
				'custom_url_image',
				'image_link_class',
				'text_layout_class',
				'subtitle',
				'title',
				'content',
				'video_type',
				'youtube_video',
				'video_mp4_url',
				'slides',
				'video_image_placeholder',
				'custom-slides',
				'vertical_alignment',
				'credits'
			);

			foreach ( $fields as $field ) {
				// if it's a section or slide
				if ( isset( $this->field_object['value'] ) ) {
					// it's a section
					$this->tw_row[ $field ]   = tw_issetor( $this->field_object['value'][ $this->section_count - 1 ][ $field ] );
					$this->tw_row['is_slide'] = false;
				} else {
					// it's a slide
					$this->tw_row[ $field ]   = tw_issetor( $this->field_object[ $this->section_count - 1 ][ $field ] );
					$this->tw_row['is_slide'] = true;
				}
			}

			$this->tw_row['post_id'] = get_the_ID();

		}

		/**
		 * Sets flags for sections to find out
		 * what do display based on selections
		 *
		 * @since  1.0
		 */
		private function get_section_flags() {

			// set defaults
			$this->tw_row['youtube_enabled']  = false;
			$this->tw_row['hosted_enabled']   = false;
			$this->tw_row['overlay_enabled']  = false;
			$this->tw_row['bg_image_enabled'] = false;
			$this->tw_row['page_content']     = false;

			// If youtube requirements are met
			if ( 'video' == $this->tw_row['background'] && 'youtube' == $this->tw_row['video_type'] && $this->tw_row['youtube_video'] ) {
				$this->tw_row['youtube_enabled'] = true;
			}

			// If self hosted video requirements are met
			if ( $this->tw_row['background'] == 'video' && $this->tw_row['video_type'] == 'self' && ( $this->tw_row['video_mp4_url'] || $this->tw_row['video_webm_url'] ) ) {
				$this->tw_row['hosted_enabled'] = true;
			}

			// If overlay requirements are met
			if ( $this->tw_row['overlay'] && $this->tw_row['background'] != 'color' && $this->tw_row['overlay_opacity'] != 0 ) {
				$this->tw_row['overlay_enabled'] = true;
			}

			// If bg image requirements are met
			if ( $this->tw_row['background'] == 'image' && $this->tw_row['background_image'] ) {
				$this->tw_row['bg_image_enabled'] = true;
			}

			if ( ! is_page_template( 'template-sections-only.php' ) ) {
				$this->tw_row['page_content'] = true;
			}

		}

		/**
		 * Turns options into proper html output
		 *
		 * @since  1.0
		 */
		private function process_fields() {

			// convert youtube video to ID only
			if ( tw_issetor( $this->tw_row['youtube_video'] ) ) {
				$this->tw_row['youtube_video'] = get_yt_id_from_url( $this->tw_row['youtube_video'] );
			}

			// process button link
			if ( tw_issetor( $this->tw_row['button'] ) && tw_issetor( $this->tw_row['button_link'] ) ) {
				switch ( $this->tw_row['button_link'] ) {
					case 'page' :
						$this->tw_row['link'] = $this->tw_row['page_post_link'];
						break;
					case 'url' :
						$this->tw_row['link'] = $this->tw_row['button_url'];
						break;
					default :
						$this->tw_row['link'] = '#section-' . ( $this->section_count + 1 );
						break;
				}
			}

			// set specific layout for text post
			if ( tw_issetor( $this->tw_row['text_layout'] ) ) {

				// basic width
				$this->tw_row['text_layout_class'][] = 'text-cell td';

				switch ( $this->tw_row['text_layout'] ) {
					case 'center':
						$this->tw_row['text_layout_class'][] = 'col-md-8 col-md-offset-2';
						break;
					case 'right':
						// add offset if no images
						if ( ! $this->tw_row['images'] ) {
							$this->tw_row['text_layout_class'][] = 'col-md-6 col-md-offset-6';
						}
						break;
					default:
						$this->tw_row['text_layout_class'][] = 'col-md-6';
						break;
				}

				// convert classes to string
				$this->tw_row['text_layout_class'] = 'class="' . implode( ' ', $this->tw_row['text_layout_class'] ) . '"';
			}

			// animations on/off
			$this->tw_row['animations'] = ! $this->tw_row['animations'] ? '' : 'v-item';

			// image links
			switch ( $this->tw_row['image_link'] ) {

				case 'none':
					$this->tw_row['image_link'] = false;
					break;

				case 'custom' :
					if ( tw_is_external( $this->tw_row['custom_url_image'] ) ) {
						$this->tw_row['image_link_class'][] = 'no-ajaxy';
					}
					$this->tw_row['image_link'] = esc_url( $this->tw_row['custom_url_image'] );
					break;

				// default to lightbox
				default:
					if ( isset( $this->tw_row['images']['sizes']['fullslideshownc'] ) ) {
						$this->tw_row['image_link_class'][] = 'tw-lightbox';
						$this->tw_row['image_link_class'][] = 'no-ajaxy';
						$this->tw_row['image_link']         = $this->tw_row['images']['sizes']['fullslideshownc'];
					}
					break;

			}
			// convert classes to string
			$this->tw_row['image_link_class'] = is_array( $this->tw_row['image_link_class'] ) ? implode( ' ', $this->tw_row['image_link_class'] ) : false;
		}

		/**
		 * Process all inline elements needed
		 * for the sections
		 *
		 * @since  1.0
		 */
		private function section_inline_elements() {

			// get various inline elements
			$this->section_classes();
			$this->section_ids();
			$this->section_inline_styles();
			$this->data_attributes();

		}

		/**
		 * Creates proper classes for section
		 * based on options
		 *
		 * @since  1.0
		 */
		private function section_classes() {

			// initialize background classes
			$this->tw_row['classes'][] = $this->tw_row['is_slide'] ? 'slide' : 'section';
			$this->tw_row['classes'][] = $this->tw_row['is_slide'] ? '' : sanitize_html_class( $this->tw_row['acf_fc_layout'] ) . '-section';
			$this->tw_row['classes'][] = $this->tw_row['is_slide'] ? sanitize_html_class( 'slide-' . ( $this->section_count - 1 ) ) : sanitize_html_class( 'section-' . $this->section_count );


			// background video
			if ( $this->tw_row['background'] == 'video' ) {

				// basic video classes
				$this->tw_row['classes'][] = 'nav-overlay video-background';

				// youtube
				if ( $this->tw_row['video_type'] == 'youtube' ) {
					$this->tw_row['classes'][] = 'yt-video-section'; // add necessary class
				}

				// self-hosted
				if ( $this->tw_row['video_type'] == 'self' ) {
					$this->tw_row['classes'][] = 'hosted-video-section'; // add necessary class
				}
			}

			// background image
			if ( $this->tw_row['background'] == 'image' ) {
				// basic video classes
				$this->tw_row['classes'][] = 'nav-overlay image-background';
			}

			// text color
			if ( $this->tw_row['text_color'] == 'white' ) {
				$this->tw_row['classes'][] = 'dark-section';
			}

			// layout
			if ( $this->tw_row['text_layout'] ) {
				$this->tw_row['classes'][] = sanitize_html_class( 'layout-' . $this->tw_row['text_layout'] );
			} else {
				$this->tw_row['classes'][] = 'layout-left';
			}

			// image classes
			if ( $this->tw_row['images'] ) {
				$this->tw_row['classes'][] = 'has-image';
			} else {
				$this->tw_row['classes'][] = 'no-image';
			}

			// allow functions to hook and add additional classes
			if ( $this->tw_row['is_slide'] ) {
				$this->tw_row['classes'] = apply_filters( 'tw_slide_classes', $this->tw_row['classes'] );
			} else {
				$this->tw_row['classes'] = apply_filters( 'tw_section_classes', $this->tw_row['classes'] );
			}

			switch ( $this->tw_row['vertical_alignment'] ) {
				case 'top':
					$this->tw_row['classes'][] = 'vertical-top';
					break;
				case 'bottom':
					$this->tw_row['classes'][] = 'vertical-bottom';
					break;
			}

		}

		/**
		 * Creates proper ids for section
		 * based on options
		 *
		 * @since  1.0
		 */
		private function section_ids() {

			// section IDs - slide or section
			$this->tw_row['ids'][] = $this->tw_row['is_slide'] ? sanitize_html_class( 'slide-' . ( $this->section_count - 1 ) ) : sanitize_html_class( 'section-' . $this->section_count );

			// allow hook into ids
			if ( $this->tw_row['is_slide'] ) {
				$this->tw_row['ids'] = apply_filters( 'tw_slide_ids', $this->tw_row['ids'] );
			} else {
				$this->tw_row['ids'] = apply_filters( 'tw_section_ids', $this->tw_row['ids'] );
			}

		}

		/**
		 * Creates proper inline styles for section
		 * based on options
		 *
		 * @since  1.0
		 */
		private function section_inline_styles() {

			// Background image
			if ( $this->tw_row['bg_image_enabled'] ) {
				$background_image = 'url(' . esc_url( $this->tw_row['background_image']['sizes']['fullslideshownc'] ) . ')';
			}

			// Youtube image while loading video and for mobile devices
			if ( $this->tw_row['youtube_enabled'] ) {
				$background_image = 'url(http://img.youtube.com/vi/' . esc_html( $this->tw_row['youtube_video'] ) . '/maxresdefault.jpg)';
			}

			// Get placeholder image if video and it's set
			if ( $this->tw_row['youtube_enabled'] || $this->tw_row['hosted_enabled'] ) {
				if ( $this->tw_row['video_image_placeholder'] ) {
					$background_image = 'url(' . esc_url( $this->tw_row['video_image_placeholder'] ) . ')';
				}
			}

			if ( 'color' == $this->tw_row['background'] && $this->tw_row['background_color'] ) {
				$styles['background-color'] = esc_html( $this->tw_row['background_color'] );
			}

			// add background image
			if ( tw_issetor( $background_image ) ) {
				$styles['background-image'] = $background_image;
			}

			// allow hook into styles
			if ( tw_issetor( $styles ) ) {
				if ( tw_issetor( $this->tw_row['is_slide'] ) ) {
					$styles = apply_filters( 'tw_slide_styles', $styles );
				} else {
					$styles = apply_filters( 'tw_section_styles', $styles );
				}
			}

			// convert inline
			if ( tw_issetor( $styles ) ) {
				$this->tw_row['inline_section_styles'] =  $styles; 
			}

		}

		/**
		 * Adds data attribute elements for section
		 * based on options
		 */
		private function data_attributes() {

			// Inline styles
			if ( $this->tw_row['is_slide'] ) {
				$this->tw_row['data_attributes']['data-slide']  = $this->section_count - 1;
				$this->tw_row['data_attributes']['data-anchor'] = $this->section_count - 1;
			} else {
				$this->tw_row['data_attributes']['data-section'] = $this->section_count;
			}

			// add title and yt video
			$this->tw_row['data_attributes']['data-title']    = $this->tw_row['title'];
			$this->tw_row['data_attributes']['data-yt-video'] = $this->tw_row['youtube_enabled'] ? $this->tw_row['youtube_video'] : false;

			// convert to string and escape attributes
			// that could break the html
			/*$attributes = '';
			foreach ( $this->tw_row['data_attributes'] as $attribute => $value ) {
				if ( $value !== false ) {
					$attributes .= esc_attr( $attribute ) . '="' . esc_attr( $value ) . '" ';
				}
			}

			$this->tw_row['data_attributes'] = $attributes;*/

		}

		/**
		 * Puts all inline elements together
		 *
		 * @since 1.0
		 */
		public function section_attributes() {

			$output =
				tw_issetor( $this->tw_row['classes'] ) . ' ' .
				tw_issetor( $this->tw_row['inline_section_styles'] ) . ' ' .
				tw_issetor( $this->tw_row['ids'] ) . ' ' .
				tw_issetor( $this->tw_row['data_attributes'] );

			return $output;

		}

		/**
		 * Ouputs button html
		 *
		 * @since 1.0
		 */
		private function section_buttons() {
			global $post;

			if ( ! $this->tw_row['buttons'] ) {
				return false;
			}

			$button_count = sizeof( $this->tw_row['buttons'] );
			$i            = 1;
			$output       = '';

			/**
			 * Set button classes
			 */
			foreach ( $this->tw_row['buttons'] as $button ) :

				$button_classes = array();

				// next button link class
				if ( $button['button_link'] == 'next' ) {
					$button_classes[] = 'next-section-link';
				}

				if ( $button['button_link'] == 'nextslide' ) {
					$button_classes[] = 'next-slide-link';
				}

				// test for last section
				if ( $this->section_count == $this->total_sections && $this->tw_row['page_content'] ) {
					$button_classes[] = 'last-section';
				}

				// add button style class
				if ( $button['button_style'] ) {
					$button_classes[] = esc_attr( $button['button_style'] );
				}

				// special ajax cases
				if ( $button['button_link'] == 'url' || $button['button_link'] == 'lightbox' ) {
					$button_classes[] = 'no-ajaxy';
				}

				// add lightbox class
				if ( $button['button_link'] == 'lightbox' ) {
					$button_classes[] = 'themewich-lightbox';
				}

				if ( $button_count > 1 && $button_count != $i ) {
					$button_classes[] = 'button-margin';
				}

				$button_classes[] = 'tiny-details';
				$button_classes[] = 'button-' . (int) $i;


				// Get correct Button Links
				switch ( $button['button_link'] ) {
					case 'url':
					case 'lightbox':
						$link = $button['button_url'];
						break;
					case 'page':
						$link = $button['page_post_link'];
						break;
					default:
						$link = '#';
						break;
				}

				// check button text
				$button_text = isset( $button['button_text'] ) ? $button['button_text'] : false;

				// prepare output array
				$this->tw_row['buttons_output'][$i]['link'] = $link;
				$this->tw_row['buttons_output'][$i]['button_classes'] = $button_classes;
				$this->tw_row['buttons_output'][$i]['button_text'] = $button_text;
				$this->tw_row['buttons_output'][$i]['button_style'] = $button['button_style'];

				// increment counter
				$i ++;

			endforeach;

		}
	}
}

/**
 * Sets images for radio buttons for better UI
 *
 * @since  1.0
 */
if ( ! function_exists( 'tw_acf_image_radio_text_layout' ) ) :
	function tw_acf_image_radio_text_layout( $field ) {

		$field['choices'] = array(
			'left'   => '<img src="' . get_template_directory_uri() . '/images/alignment/left-align.jpg" alt="Align Left" />',
			'center' => '<img src="' . get_template_directory_uri() . '/images/alignment/center-align.jpg"" alt="Align Center" />',
			'right'  => '<img src="' . get_template_directory_uri() . '/images/alignment/right-align.jpg"" alt="Align Right" />',
		);

		return $field;

	}

	add_filter( 'acf/load_field/name=text_layout', 'tw_acf_image_radio_text_layout' );
endif;

/**
 * Sets images for radio buttons for better UI
 *
 * @since  1.0
 */
if ( ! function_exists( 'tw_acf_image_radio_vertical_alignment' ) ) :
	function tw_acf_image_radio_vertical_alignment( $field ) {

		$field['choices'] = array(
			'top'    => '<img src="' . get_template_directory_uri() . '/images/alignment/top-align.jpg" alt="Align Top" />',
			'middle' => '<img src="' . get_template_directory_uri() . '/images/alignment/middle-align.jpg"" alt="Align Middle" />',
			'bottom' => '<img src="' . get_template_directory_uri() . '/images/alignment/bottom-align.jpg"" alt="Align Bottom" />',
		);

		return $field;

	}

	add_filter( 'acf/load_field/name=vertical_alignment', 'tw_acf_image_radio_vertical_alignment' );
endif;

/**
 * Sets an admin notice if the user isn't running the proper amount of memory
 * @since  1.0
 */
if ( ! function_exists( 'tw_memory_admin_notice' ) ):
	function tw_memory_admin_notice() {
		global $current_user;
		global $pagenow;
		global $fields_installed;

		// if we're on a post page and acf is installed
		if ( $pagenow == 'post.php' && $fields_installed ) {

			$user_id = $current_user->ID;

			//delete_user_meta( $user_id, 'tw_ignore_notice' ); // uncomment and visit a post.php admin page to reset

			$memory_limit = @ini_get( 'memory_limit' );

			$limit = rtrim( $memory_limit, "M" );
			$limit = intval( $limit );

			// if memory limit isn't at least 128M
			if ( $limit < 128 ) {

				/* Check that the user hasn't already clicked to ignore the message */
				if ( ! get_user_meta( $user_id, 'tw_ignore_notice' ) ) {
					echo '<div class="updated">';
					echo '<p>Your WordPress install only has a <strong>' . $memory_limit . '</strong> memory limit.</p>';
					echo '<p>In order to get the most out of your theme, it\'s recommended that you increase your memory limit to at least <strong>128M</strong> or you\'ll be limited to the number of sections you can add to each page.</p>';
					echo '<p>';
					printf( __( '<a href="%1$s">Hide Notice</a>' ), '?tw_memory_nag_ignore=0' );
					echo ' | <a href="http://support.themewich.com/kb/troubleshooting/increasing-the-wordpress-memory-limit" target="_blank">How to I increase my memory limit?</a></p>';
					echo '</div>';
				}
			}
		}
	}

	add_action( 'admin_notices', 'tw_memory_admin_notice' );
endif;

/**
 * Allows it to be dismissed
 * @since  1.0
 */
if ( ! function_exists( 'tw_memory_nag_ignore' ) ) :
	function tw_memory_nag_ignore() {
		global $current_user;
		$user_id = $current_user->ID;

		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset( $_GET['tw_memory_nag_ignore'] ) && '0' == $_GET['tw_memory_nag_ignore'] ) {
			add_user_meta( $user_id, 'tw_ignore_notice', 'true', true );
		}
	}

	add_action( 'admin_init', 'tw_memory_nag_ignore' );
endif;