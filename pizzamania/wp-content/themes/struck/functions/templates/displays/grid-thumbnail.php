<?php

/**
 * This template file displays the thumbnail
 * of a post or portfolio item in the grid
 *
 * @package WordPress
 * @since Struck 1.0
 */

global $fields_installed;

// set defaults
$grid = array(
	'data_filters' => array(),
	'thumb_url'    => false,
	'type'         => get_post_type()
);

/**
 * Get Featured Image URL
 */
$thumb_url_array = wp_get_attachment_image_src( get_post_thumbnail_id(), $tw_page['grid']['crop'], false );
if ( isset( $thumb_url_array[0] ) ) {
	$grid['thumb_url'] = $thumb_url_array[0];
}

/**
 * Setup post classes
 */
$post_classes = array(
	sanitize_html_class( 'type-' . $grid['type'] ),
	sanitize_html_class( $tw_page['grid']['crop'] ),
	'isobrick', // class needed for isotope script
	'grid',
	has_post_thumbnail() ? 'hasimages' : 'noimages' // image thumbnail class
);

/**
 * Grid Columns
 */
switch ( $tw_page['grid']['columns'] ) {
	case 4 :
		$post_classes[] = 'col-xs-12 col-sm-4 col-md-3';
		break;
	case 2 :
		$post_classes[] = 'col-xs-12 col-sm-6 col-md-6';
		break;
	default :
		$post_classes[] = 'col-xs-12 col-sm-6 col-md-4'; // extra small size full width
		break;
}

/**
 * Add terms to post classes for filtering
 */
if ( $terms = get_the_terms( get_the_ID(), 'filter' ) ) {
	foreach ( $terms as $term ) {
		$grid['data_filters'][ $term->term_id ] = $term->name;
		$post_classes[] = sanitize_html_class( 'filter-' . $term->term_id );
	}
}

/**
 * Convert filters to string
 */
if ( ! empty( $grid['data_filters'] ) ) {
	$grid['data_filters'] = json_encode( $grid['data_filters'] ); //convert array to a JSON string
	$grid['data_filters'] = htmlspecialchars( $grid['data_filters'], ENT_QUOTES ); //convert any quotes into HTML entities so JSON string behaves as a proper HTML attribute.
} else {
	$grid['data_filters'] = false;
} ?>

<!-- Grid Item -->
<div <?php post_class( $post_classes ); ?>  <?php if ( $grid['data_filters'] ) { echo 'data-filter="' . esc_attr( $grid['data_filters'] ) . '"'; } ?>>
	<a href="<?php the_permalink(); ?>" class="postlink" style="display:block;">

		<?php if ( $grid['thumb_url'] ): ?>
			<img src="<?php echo esc_url( $grid['thumb_url'] ); ?>" alt="<?php the_title_attribute(); ?>">
			<div class="overlay"></div>
		<?php endif; ?>

		<!-- Title -->
		<div class="title">

			<?php if ( 'post' == $grid['type'] ) : ?>
				<div class="date tiny-details">
					<?php themewich_date( 'human' ); ?>
				</div>
			<?php endif; ?>

			<h2>
				<span>
					<?php the_title(); ?>
				</span>
			</h2>

		</div>
		<!-- END title -->

	</a>
</div>
<!-- END Grid Item -->