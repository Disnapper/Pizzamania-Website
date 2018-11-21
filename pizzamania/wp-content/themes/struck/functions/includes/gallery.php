<?php
/**
 * Custom Gallery Functionality
 *
 * @package WordPress
 * @since 1.0
 */

/**
 * Custom gallery html
 *
 * @param  array $attr Stores all shortcode properties
 *
 * @return string Modified gallery html
 */
if ( ! function_exists( 'themewich_gallery_shortcode' ) ) :
	function themewich_gallery_shortcode( $attr ) {

		/**
		 * Initial default variables
		 */
		$post      = get_post();
		$type 	   = '';
		$posttype  = get_post_type( $post );
		$slidesize = 'gallery';
		$linked    = ( isset( $attr['link'] ) && $attr['link'] == 'none' ) ? false : true;

		/**
		 * Create output wrappings
		 */
		if ( isset( $attr['type'] ) ) :

			switch ( $attr['type'] ) :
				/**
				 * Slideshow Gallery
				 */
				case 'slideshow':

					// Get autoplay option
					if ( isset( $attr['autoplay'] ) && $attr['autoplay'] == 'yes' ) {
						$autoplay = 'autoplay';
					} else {
						$autoplay = 'no-autoplay';
					}

					// Get crop option
					if ( ( isset( $attr['crop'] ) && $attr['crop'] == 'nocrop' ) ) {
						$slidesize = 'contentslideshownc';
					} else {
						$slidesize = 'contentslideshow';
					}

					$type = "<div class='single-slideshow gallery-wrap info pager $autoplay'>";
					break;
			endswitch;

		else : // If no type is set, default to gallery
			$type = "<div class='single-gallery gallery-wrap fixed'>";
		endif;

		/**
		 * Start the creation of the gallery
		 * This is a modified version of WordPress'
		 * gallery function
		 */
		static $instance = 0;
		$instance ++;

		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) ) {
				$attr['orderby'] = 'post__in';
			}
			$attr['include'] = $attr['ids'];
		}

		// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
		if ( isset( $attr['orderby'] ) ) {
			$attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
			if ( ! $attr['orderby'] ) {
				unset( $attr['orderby'] );
			}
		}

		extract( shortcode_atts( array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'itemtag'    => 'div',
			'icontag'    => 'div',
			'captiontag' => 'div',
			'columns'    => 3,
			'size'       => $slidesize, // set our thumbnail size
			'include'    => '',
			'exclude'    => ''
		), $attr ) );

		$id = intval( $id );

		// Set random order if it's set to random
		if ( 'RAND' == $order ) {
			$orderby = 'none';
		}

		if ( ! empty( $include ) ) {

			$_attachments = get_posts(
				array(
					'include'        => $include,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => $order,
					'orderby'        => $orderby
				)
			);

			$attachments  = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[ $val->ID ] = $_attachments[ $key ];
			}

		} elseif ( ! empty( $exclude ) ) {
			$attachments = get_children(
				array(
					'post_parent'    => $id,
					'exclude'        => $exclude,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => $order,
					'orderby'        => $orderby
				)
			);
		} else {
			$attachments = get_children(
				array(
					'post_parent'    => $id,
					'post_status'    => 'inherit',
					'post_type'      => 'attachment',
					'post_mime_type' => 'image',
					'order'          => $order,
					'orderby'        => $orderby
				)
			);
		}

		// If there's nothing, return nothing
		if ( empty( $attachments ) ) {
			return '';
		}

		if ( is_feed() ) {
			$output = "\n";
			foreach ( $attachments as $att_id => $attachment ) {
				$output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
			}

			return $output;
		}

		$itemtag    = tag_escape( $itemtag );
		$captiontag = tag_escape( $captiontag );
		$icontag    = tag_escape( $icontag );
		$valid_tags = wp_kses_allowed_html( 'post' );

		// set item tag
		if ( ! isset( $valid_tags[ $itemtag ] ) ) {
			$itemtag = 'div';
		}

		// set caption tag
		if ( ! isset( $valid_tags[ $captiontag ] ) ) {
			$captiontag = 'div';
		}

		// set icon tag
		if ( ! isset( $valid_tags[ $icontag ] ) ) {
			$icontag = 'div';
		}

		// sanitize number of columns
		$columns = intval( $columns );

		// set float if rtl
		$float = is_rtl() ? 'right' : 'left';

		// set selector
		$selector = "gallery-{$instance}";

		$gallery_style = $gallery_div = '';

		// use default gallery style
		if ( apply_filters( 'use_default_gallery_style', true ) ) {
			$gallery_style = "
				<style type='text/css'>
					#{$selector} .gallery-item {
						float: {$float};
						margin-top: 10px;
					}
					#{$selector} .gallery-caption {
						margin-left: 0;
					}
				</style>";
		}

		// size class
		$size_class = sanitize_html_class( $size );

		// post type
		if ( $posttype == 'post' && $slidesize ) {
			$size_class = $slidesize;
		}

		// Set Slideshow Classes
		$slideshowclasses = 'pager nocaption nolink ';
		// Add type of slideshow class
		$slideshowclasses .= ( isset( $attr['type'] ) ) ? $attr['type'] . ' ' : '';
		// Add size and width classes too
		$slideshowclasses .= $slidesize . ' ';

		// Set wrapper
		if ( isset( $attr['type'] ) && ( $attr['type'] == 'slideshow' ) ) {
			$gallery_div = "$type <ul id='$selector' class='bxslider gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class} $slideshowclasses'>";
		} else {
			$gallery_div = "$type <div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
		}

		$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

		/**
		 * Slideshow Output
		 * @since 1.0
		 */
		if ( isset( $attr['type'] ) && ( $attr['type'] == 'slideshow' ) ) :
			foreach ( $attachments as $id => $attachment ) :

				$default_attr = array(
					'title' => apply_filters( 'the_title', $attachment->post_title ),
				);

				$image        = wp_get_attachment_image( $id, $size, false, $default_attr );
				$image        = preg_replace( '/(width|height)=\"\d*\"\s/', "", $image );
				$link         = wp_get_attachment_url( $id );

				$output .= "<li class='gallery-icon";
				$output .= ( $linked ) ? ' linked' : ' notlinked';
				$output .= "'>";
				$output .= ( $link && $linked ) ? "<a href='$link' class='lightbox-gallery no-ajaxy'>" : '';
				$output .= "$image";

				if ( $captiontag && trim( $attachment->post_excerpt ) ) {
					$output .= "
					<div class='wp-caption-text gallery-caption'>
					  <span>
					" . wptexturize( strip_tags( $attachment->post_excerpt ) ) . "
					  </span>
					</div>";
				}

				$output .= ( $link && $linked ) ? "</a>" : "";
				$output .= "</li>";

			endforeach;

		/**
		 * Regular Gallery Output
		 * @since 1.0
		 */
		else :

			foreach ( $attachments as $id => $attachment ) :

				$default_attr = array(
					'title' => apply_filters( 'the_title', $attachment->post_title ),
				);

				$image        = wp_get_attachment_image( $id, $size, false, $default_attr );
				$image        = preg_replace( '/(width|height)=\"\d*\"\s/', "", $image );
				$link         = wp_get_attachment_url( $id );

				$output .= "<{$itemtag} class='gallery-item gallery-icon'>";
				$output .= "<{$icontag}  class='gallery-icon";
				$output .= ( $linked ) ? ' linked' : ' notlinked';
				$output .= "'>";
				$output .= ( $link && $linked ) ? "<a href='$link' class='lightbox-gallery no-ajaxy'>" : '';
				$output .= $image;

				if ( $captiontag && trim( $attachment->post_excerpt ) ) {
					$output .= "
					<{$captiontag} class='wp-caption-text gallery-caption'>
					  <span>
					" . wptexturize( strip_tags( $attachment->post_excerpt ) ) . "
					  </span>
					</{$captiontag}>";
				}

				$output .= ( $link && $linked ) ? "</a>" : "";
				$output .= "</{$icontag}>";
				$output .= "</{$itemtag}>";

			endforeach;
		endif;

		// Add correct end
		$output .= ( isset( $attr['type'] ) && ( $attr['type'] == 'slideshow' ) ) ? '</ul><div class="clear"></div>' : '<div class="clear"></div></div>';

		// Close out container
		$output .= "</div>\n<div class='clear'></div>";

		return $output;
	}
endif;

/**
 * Add custom gallery functionality via filter
 *
 * @param string $output gallery output
 * @param array  $atts   shortcode attributes
 *
 * @return string
 */
if ( ! function_exists( 'tw_gallery_shortcode_filter' ) ) :
	function tw_gallery_shortcode_filter( $output = '', $atts ) {
		$return = $output; // fallback

		// retrieve content of your own gallery function
		$tw_custom_result = themewich_gallery_shortcode( $atts );

		if ( ! empty( $tw_custom_result ) ) {
			$return = $tw_custom_result;
		}

		return $return;
	}
	add_filter( 'post_gallery', 'tw_gallery_shortcode_filter', 10, 4 );
endif;

/**
 * Class to add additional optinos to image gallery popup
 *
 * @since  Struck 1.0
 */
class Custom_Gallery_Setting {
	/**
	 * Stores the class instance.
	 *
	 * @var Custom_Gallery_Setting
	 */
	private static $instance = null;

	/**
	 * Returns the instance of this class.
	 *
	 * It's a singleton class.
	 *
	 * @return Custom_Gallery_Setting The instance
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Initialises the plugin.
	 */
	public function init_plugin() {
		$this->init_hooks();
	}

	/**
	 * Initialises the WP actions.
	 */
	private function init_hooks() {
		add_action( 'wp_enqueue_media', array( $this, 'wp_enqueue_media' ) );
		add_action( 'print_media_templates', array( $this, 'print_media_templates' ) );
	}

	/**
	 * Enqueues the script.
	 */
	public function wp_enqueue_media() {
		if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' ) {
			return;
		}
		wp_enqueue_script(
			'custom-gallery-settings',
			get_template_directory_uri() . '/functions/js/custom-gallery-setting.js',
			array( 'media-views' )
		);
	}

	/**
	 * Outputs the view template with the custom setting.
	 */
	public function print_media_templates() {
		if ( ! isset( get_current_screen()->id ) || get_current_screen()->base != 'post' ) {
			return;
		}

		?>

		<script type="text/html" id="tmpl-custom-gallery-type">
			<label class="setting gallery-type">
				<span><?php _e( 'Gallery Type', 'themewich' ); ?></span>
				<select class="type gallery-type" name="type" data-setting="type">
					<?php
					$types = array(
						'gallery'   => __( 'Gallery', 'themewich' ),
						'slideshow' => __( 'Slideshow', 'themewich' ),
						//'carousel' => __( 'Carousel', 'themewich' )
					);
					foreach ( $types as $value => $name ) { ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, 'gallery' ); ?> >
							<?php echo esc_html( $name ); ?>
						</option>
					<?php } ?>
				</select>
			</label>
		</script>

		<script type="text/html" id="tmpl-custom-gallery-cropping">
			<label class="setting gallery-crop">
				<span><?php _e( 'Cropping', 'themewich' ); ?></span>
				<select class="type" name="crop" data-setting="crop">
					<?php
					$types = array(
						'crop'   => __( 'Crop Images', 'themewich' ),
						'nocrop' => __( 'Do Not Crop Images', 'themewich' )
					);
					foreach ( $types as $value => $name ) { ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, 'slideshow' ); ?>>
							<?php echo esc_html( $name ); ?>
						</option>
					<?php } ?>
				</select>
			</label>
		</script>

		<script type="text/html" id="tmpl-custom-gallery-width">
			<label class="setting gallery-width">
				<span><?php _e( 'Width', 'themewich' ); ?></span>
				<select class="type" name="width" data-setting="width">
					<?php
					$types = array(
						'normal' => __( 'Normal Width', 'themewich' )
					);
					foreach ( $types as $value => $name ) { ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, 'fixed' ); ?>>
							<?php echo esc_html( $name ); ?>
						</option>
					<?php } ?>
				</select>
			</label>
		</script>

		<script type="text/html" id="tmpl-custom-gallery-link">
			<label class="setting gallery-link">
				<span><?php _e( 'Link', 'themewich' ); ?></span>
				<select class="type" name="link" data-setting="link">
					<?php
					$types = array(
						'full' => __( 'Full Image', 'themewich' ),
						'none' => __( 'None', 'themewich' )
					);
					foreach ( $types as $value => $name ) { ?>
						<option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, 'link' ); ?>>
							<?php echo esc_html( $name ); ?>
						</option>
					<?php } ?>
				</select>
			</label>
		</script>

	<?php
	}
}

add_action( 'admin_init', array( Custom_Gallery_Setting::get_instance(), 'init_plugin' ), 20 );