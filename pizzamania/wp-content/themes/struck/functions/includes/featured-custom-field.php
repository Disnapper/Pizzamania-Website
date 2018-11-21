<?php
/**
 * Adds the featured field for portfolio and post items
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * add multipart encoding
 * @since 1.0
 */
if ( ! function_exists( 'tw_add_edit_form_multipart_encoding' ) ) :
	function tw_add_edit_form_multipart_encoding() {
		echo ' enctype="multipart/form-data"';
	}

	add_action( 'post_edit_form_tag', 'tw_add_edit_form_multipart_encoding' );
endif;

/**
 * Default variables
 */
global $metaboxes;
$prefix = 'tw_';

/**
 * Create feature metaboxes
 */
$metaboxes = array(
	'portfolio_featured_box' => array(
		'title'        => __( 'Featured', 'framework' ),
		'applicableto' => 'portfolio',
		'location'     => 'side',
		'priority'     => 'high',
		'fields'       => array(
			$prefix . 'featured' => array(
				'title'       => '',
				'type'        => 'radio',
				'description' => '',
				'std'         => 'No',
				'options'     => array( 'Yes', 'No' ),
			),
		)
	),
	'post_featured_box'      => array(
		'title'        => __( 'Featured', 'framework' ),
		'applicableto' => 'post',
		'location'     => 'side',
		'priority'     => 'high',
		'fields'       => array(
			$prefix . 'featured' => array(
				'title'       => '',
				'type'        => 'radio',
				'description' => '',
				'std'         => 'No',
				'options'     => array( 'Yes', 'No' ),
			),
		)
	)
);

/**
 * Add metabox on admin init filter
 * @since 1.0
 */
if ( ! function_exists( 'tw_add_post_format_metabox' ) ) :
	function tw_add_post_format_metabox() {
		global $metaboxes;
		if ( ! empty( $metaboxes ) ) {
			foreach ( $metaboxes as $id => $metabox ) {
				add_meta_box( $id, $metabox['title'], 'tw_show_metaboxes', $metabox['applicableto'], $metabox['location'], $metabox['priority'], $id );
			}
		}
	}

	add_action( 'admin_init', 'tw_add_post_format_metabox' );
endif;

/**
 * Display featured metabox
 * @since 1.0
 */
if ( ! function_exists( 'tw_show_metaboxes' ) ) :
	function tw_show_metaboxes( $post, $args ) {
		global $metaboxes;

		$fields = $tabs = $metaboxes[ $args['id'] ]['fields'];
		/** Nonce **/
		$output = '<style>.custom_preview_image { max-width:300px; } </style><input type="hidden" name="post_format_meta_box_nonce" value="' . wp_create_nonce( basename( __FILE__ ) ) . '" />';

		$output .= '<table class="form-table">';

		foreach ( $fields as $id => $field ) {

			// get current post meta data
			$meta = get_post_meta( $post->ID, $id, true );
			if ( ! $meta ) {
				$meta = '';
			}

			// do radio button
			if ( $field['type'] == 'radio' ) {

				// table row
				if ( isset( $field['hide'] ) && isset( $field['show'] ) ) {
					$output .= '<tr class="' . $id . ' ' . $field['hide'] . ' show-' . $field['show'] . '">';
				} else {
					$output .= '<tr class="' . $id . '">';
				}

				// title
				if ( $field['title'] && $field['title'] != '' ) {
					$output .= '<th style="width:200px"><label for="' . $id . '"><strong>' . $field['title'] . '</strong><span style=" display:block; color:#999; margin:5px 0 0 0;">' . $field['description'] . '</span></label></th>';
				}

				$output .= '<td>';

				// display field option selection
				foreach ( $field['options'] as $option ) {
					$output .= '<input style= "margin-right: 10px; margin-bottom: 5px;" type="radio"';
					if ( $meta == $option ) {
						$output .= 'checked ';
					} else if ( ! $meta && $option == $field['std'] ) {
						$output .= 'checked ';
					}

					$output .= ' name="' . $id . '" value="' . $option . '">' . $option . ' <br />';
				}
			}
		}

		$output .= '</table>';

		echo wp_kses_post( $output );
	}

	add_action( 'save_post', 'tw_save_metaboxes' );
endif;

/**
 * Save metabox
 * @since 1.0
 */
if ( ! function_exists( 'tw_save_metaboxes' ) ) :
	function tw_save_metaboxes( $post_id ) {
	global $metaboxes;
	// verify nonce
	if ( isset( $_POST['post_format_meta_box_nonce'] ) && ! wp_verify_nonce( $_POST['post_format_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}

	$post_type = get_post_type();
	// check permissions
	if ( 'page' == $post_type ) {
		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return $post_id;
		}
	} elseif ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	// loop through fields and save the data
	foreach ( $metaboxes as $id => $metabox ) {
		// check if metabox is applicable for current post type
		if ( $metabox['applicableto'] == $post_type ) {

			$fields = $metaboxes[ $id ]['fields'];
			foreach ( $fields as $id => $field ) {
				$old = get_post_meta( $post_id, $id, true );
				if ( isset( $_POST[ $id ] ) ) {
					$new = $_POST[ $id ];
				} else {
					$new = null;
				}
				if ( ( $new && $new != $old ) || ( $new && $new == 0 ) ) {
					update_post_meta( $post_id, $id, $new );
				} elseif ( '' == $new && $old || ! isset( $_POST[ $id ] ) ) {
					delete_post_meta( $post_id, $id, $old );
				}
			}
		}
	}
}
endif;