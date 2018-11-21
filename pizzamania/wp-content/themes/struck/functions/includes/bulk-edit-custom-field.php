<?php
/**
 * Outputs a custom field value in the column and allows bulk
 * editing of the field across multiple posts
 *
 * @package WordPress
 * @since 1.0
 */

if ( ! function_exists( 'themewich_add_post_columns' ) ) :
	/**
	 * Add Column to Posts and Portfolio Admin Edit Screen
	 *
	 * @param  array $columns Array that stores the column number
	 *
	 * @return array          New array with added column
	 */
	function themewich_add_post_columns( $columns ) {
		$columns['featured'] = 'Featured';

		return $columns;
	}

	add_filter( 'manage_post_posts_columns', 'themewich_add_post_columns' );
	add_filter( 'manage_portfolio_posts_columns', 'themewich_add_post_columns' );
endif;

if ( ! function_exists( 'themewich_render_post_columns' ) ) :
	/**
	 * Render Custom Column
	 *
	 * @param  array $column_name Name of column
	 * @param  integer $id Id of the post
	 *
	 * @return echo                  Custom meta selection
	 */
	function themewich_render_post_columns( $column_name, $id ) {
		switch ( $column_name ) {
			case 'featured':
				// show widget set
				$featured = get_post_meta( $id, 'tw_featured', true );
				if ( $featured ) :
					echo '<div id="featured-' . $id . '">' . $featured . '</div>';
				else :
					echo '<div id="featured-' . $id . '">' . __( 'No', 'themewich' ) . '</div>';
				endif;
		}
	}

	add_action( 'manage_posts_custom_column', 'themewich_render_post_columns', 10, 2 );
	add_action( 'manage_portfolio_custom_column', 'themewich_render_post_columns', 10, 2 );
endif;

if ( ! function_exists( 'themewich_add_quick_edit' ) ) :
	/**
	 * Adds featured option to quick edit menu
	 *
	 * @param  string $column_name Name of the column
	 * @param  string $post_type Name of post type
	 *
	 * @return html                Dropdown html
	 */
	function themewich_add_quick_edit( $column_name, $post_type ) {
		if ( $column_name != 'featured' ) {
			return;
		} ?>
		<fieldset class="inline-edit-col-left">
			<div class="inline-edit-col">
				<span class="title"><?php _e( 'Featured', 'themewich' ); ?></span>
				<input type="hidden" name="themewich_featured_noncename" id="themewich_featured_noncename" value=""/>
				<select name='post_featured' id='post_featured'>
					<option class='featured-option' value=''>— <?php _e( 'No Change', 'themewich' ); ?> —</option>
					<option class='featured-option' value='No'><?php _e( 'No', 'themewich' ); ?></option>
					<option class='featured-option' value='Yes'><?php _e( 'Yes', 'themewich' ); ?></option>
				</select>
			</div>
		</fieldset>
	<?php
	}

	add_action( 'quick_edit_custom_box', 'themewich_add_quick_edit', 10, 2 );
	add_action( 'bulk_edit_custom_box', 'themewich_add_quick_edit', 10, 2 );
endif;

if ( ! function_exists( 'themewich_enqueue_edit_scripts' ) ) :
	/**
	 * Enqueue quickedit scripts
	 * @since 1.0
	 */
	function themewich_enqueue_edit_scripts() {
		wp_enqueue_script(
			'themewich-admin-edit',
			get_template_directory_uri() . '/functions/js/quick_edit.js',
			array(
				'jquery',
				'inline-edit-post'
			),
			'',
			true
		);
	}

	add_action( 'admin_print_scripts-edit.php', 'themewich_enqueue_edit_scripts' );
endif;

if ( ! function_exists( 'themewich_save_quick_edit_data' ) ) :
	/**
	 * Saves quickedit info
	 *
	 * @param  integer $post_id ID of the post being saved
	 *
	 * @return integer          ID of post with featured data
	 */
	function themewich_save_quick_edit_data( $post_id ) {
		// verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
		// to do anything
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}
		// Check permissions
		if ( isset( $_POST['post_type'] ) ) {
			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				}
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}
			}
		}
		// OK, we're authenticated: we need to find and save the data
		$post = get_post( $post_id );
		if ( isset( $_POST['post_featured'] ) && ( $post->post_type != 'revision' ) ) {
			$featured_id = esc_attr( $_POST['post_featured'] );
			if ( $featured_id ) {
				update_post_meta( $post_id, 'tw_featured', $featured_id );
			} else {
				delete_post_meta( $post_id, 'tw_featured' );
			}

			return $featured_id;
		}

	}

	add_action( 'save_post', 'themewich_save_quick_edit_data' );
endif;

if ( ! function_exists( 'themewich_save_bulk_edit' ) ) :
	/**
	 * Saves bulk edit data
	 * @since 1.0
	 */
	function themewich_save_bulk_edit() {
		// get our variables 
		$post_ids = ( isset( $_POST['post_ids'] ) && ! empty( $_POST['post_ids'] ) ) ? $_POST['post_ids'] : array();
		$featured = ( isset( $_POST['post_featured'] ) && ! empty( $_POST['post_featured'] ) ) ? $_POST['post_featured'] : null;
		// if everything is in order 
		if ( ! empty( $post_ids ) && is_array( $post_ids ) && ! empty( $featured ) ) {
			foreach ( $post_ids as $post_id ) {
				update_post_meta( $post_id, 'tw_featured', $featured );
			}
		}
	}

	add_action( 'wp_ajax_themewich_save_bulk_edit', 'themewich_save_bulk_edit' );
endif;
