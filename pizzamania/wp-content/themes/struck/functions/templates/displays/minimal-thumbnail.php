<?php
/**
 * This template file displays the thumbnail
 * of a post or portfolio item in the grid
 *
 * @package WordPress
 * @since   Struck 1.0
 */

global $fields_installed;
global $allowedposttags;

// defaults
$data_filters = array();
$thumbsize    = 'fullslideshownc';
$thumb_url    = false;
$post_type    = get_post_type();

// setup post classes
$post_classes = array(
	'isobrick', // class needed for isotope script
	'minimal',
	has_post_thumbnail() ? 'hasimages' : 'noimages' // image thumbnail class
);

/**
 * Add terms to post classes for filtering
 */
if ( $terms = get_the_terms( get_the_ID(), 'filter' ) ) {
	foreach ( $terms as $term ) {
		$data_filters[ $term->term_id ] = $term->name;
		$post_classes[] = sanitize_html_class( 'filter-' . $term->term_id );
	}
}

/**
 * Convert filters to string
 */
if ( ! empty( $data_filters ) ) {
	$data_filters = json_encode( $data_filters ); //convert array to a JSON string
	$data_filters = htmlspecialchars( $data_filters, ENT_QUOTES ); //convert any quotes into HTML entities so JSON string behaves as a proper HTML attribute.
} else {
	$data_filters = false;
}

/**
 * Get Featured Image URL
 */
$thumb_url_array = wp_get_attachment_image_src( get_post_thumbnail_id(), $thumbsize, false );
if ( isset( $thumb_url_array[0] ) ) {
	$thumb_url = $thumb_url_array[0];
} ?>

<!-- Minimal Item -->
<div <?php post_class( $post_classes ); ?> <?php if ( $data_filters ) { echo 'data-filter="' . esc_attr( $data_filters ) . '"'; } ?>>
	<a href="<?php the_permalink(); ?>" class="postlink">
		<span class="post-break">
			<span class="full-bg-image minimal-background" <?php if ( $thumb_url ) {
				echo "style='background-image: url(" . esc_url( $thumb_url ) . ")'";
			} ?>>
				<span class="overlay"></span>

				<div class="container">
					<div class="col-md-8 minimal-content">

						<?php if ( 'post' == $post_type ) : ?>
							<div class="date tiny-details">
								<?php themewich_date( 'human' ); ?>
							</div>
						<?php endif; ?>

						<?php if ( 'portfolio' == $post_type && $subtitle = get_field( 'subheadline' ) ) : ?>
							<div class="subheadline tiny-details">
								<?php echo wp_kses_post( $subtitle ); ?>
							</div>
						<?php endif; ?>

						<div class="title">
							<h2>
								<?php the_title(); ?>
							</h2>
						</div>

						<?php if ( 'post' == $post_type && get_the_author() ) : ?>
							<div class="author vcard tiny-details">
								<?php _e( 'By', 'themewich' ); ?>
								<span class="fn">
					                <?php the_author(); ?>
					            </span>
							</div>
						<?php endif; ?>

						<?php if ( 'page' == $post_type ) : ?>
							<?php if ( $fields_installed && get_field( 'subtitle' ) ) : ?>
								<div class="subtitle tiny-details">
									<?php echo wp_kses_post( get_field( 'subtitle' ) ); ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>

					</div>
				</div>
		</span>
	</a>
</div>
<!-- END Minimal Item -->