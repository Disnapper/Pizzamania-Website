<?php
/**
 * This template file displays the thumbnail
 * of a post or portfolio item in the grid
 *
 * @package WordPress
 * @since   Struck 1.0
 */

global $fields_installed;

// defaults
$data_filters = array();
$thumbsize    = $tw_page['alignment'] != 'align-left' ? 'contentslideshow' : 'fullslideshow';
$thumb_url    = false;
$post_type    = get_post_type();

// setup post classes
$post_classes = array(
	$tw_page['alignment'] != 'align-left' ? 'col-md-8 col-md-offset-2' : 'col-md-12',
	'isobrick', // class needed for isotope script
	'classic', // classic layout
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
$thumb_url_array = wp_get_attachment_image_src( get_post_thumbnail_id(), $thumbsize, false ); ?>

<!-- Minimal Item -->
<div <?php post_class( $post_classes ); ?> <?php if ( $data_filters ) { echo 'data-filter="' . esc_attr( $data_filters ) . '"'; } ?>>

	<?php if ( 'portfolio' == $post_type ) : ?>
		<?php if ( $fields_installed && get_field('subheadline') ) : ?>
			<div class="page-details">
				<div class="subtitle tiny-details">
					<?php echo esc_html( get_field('subheadline') ); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<div class="title">
		<h2>
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</h2>
	</div>

	<?php if ( 'post' == $post_type ) : ?>
		<div class="post-details">
			<div class="author vcard tiny-details">
	            <?php _e( 'By', 'themewich' );?>
	            <span class="fn">
	                <?php the_author(); ?>
	            </span>
	        </div>

	        <span class="tw-bullet">&nbsp;&bull;&nbsp;</span>

	        <div class="date updated tiny-details">
	        	<?php themewich_date('human'); ?>
	        </div>
	    </div>
	<?php endif; ?>

	<?php if ( 'page' == $post_type ) : ?>
		<?php if ( $fields_installed && get_field('subtitle') ) : ?>
			<div class="page-details">
				<div class="subtitle tiny-details">
					<?php echo esc_html( get_field('subtitle') ); ?>
				</div>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ( isset( $thumb_url_array[0] ) ) : ?>
		<div class="imagecontainer">
			<a href="<?php the_permalink(); ?>" class="postlink">
				<img src="<?php echo esc_url( $thumb_url_array[0] ); ?>" width="<?php echo esc_attr( $thumb_url_array[1] ); ?>" height="<?php echo esc_attr( $thumb_url_array[2] ); ?>" class="scale-with-grid"/>
			</a>
		</div>
	<?php endif; ?>

	<div class="content">
		<?php 
			// set read more
			global $more; $more = 0;
			// check for more tag then fallback
			if ( preg_match( '/<!--more/', $post->post_content ) ) {
				// if there's a more tag, show that
				echo apply_filters( 'the_content', get_the_content( esc_html__( 'Read More', 'themewich' ) ) );
			} else {
				if ( 'portfolio' == $post_type && ! has_excerpt() && $intro = get_field('intro_text') ) {
					// if it's a portfolio item without an excerpt, show the intro text if it exists
					echo '<p>' . esc_html( $intro ) . '<br /><a class="more-link" href="' . get_permalink() . '" >' . esc_html__( 'Read More', 'themewich' ) . '</a></p>';
				} else {
					// otherwise show excerpt
					the_excerpt();
				}	
			}
		?>
	</div>
</div>