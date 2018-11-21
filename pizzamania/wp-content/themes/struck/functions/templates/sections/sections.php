<?php
/**
 * This template file displays the sections
 * added to a page, post or portfolio item
 *
 * @package WordPress
 * @since Struck 1.0
 */

global $fields_installed;

// Get Current Page for Pagination
$pagething = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
$paged     = $pagething ? $pagething : 1;

// check if the flexible content field has rows of data
if ( $fields_installed && have_rows( 'sections', $tw_page['pageID'] ) ) :

	// init section count
	$section_count = 1;

	// get sections transient
	$field_object = get_transient( 'themewich_sections_' . $tw_page['pageID'] );

	// allow hook to turn off transient
	$field_object = apply_filters( 'tw_sections_transient', $field_object );

	// if transient isn't set, run query
	if ( false === $field_object ) {
		$field_object = get_field_object( 'sections', $tw_page['pageID'] );

		// transient set to last for 1 hour
		set_transient( 'themewich_sections_' . $tw_page['pageID'], $field_object, 60 * 60 );
	}

	// count total amount of sections
	$total_sections = count( $field_object['value'] );

	// fullpage classes
	$fullpage_classes[] = ! get_field( 'scrolling_type', $tw_page['pageID'] ) ? ' scrolling-regular' : ' scrolling-auto';
	$fullpage_classes[] = ! get_field( 'section_animations', $tw_page['pageID'] ) ? ' animations-off' : ' animations-on';
	$fullpage_classes[] = $paged > 1 ? 'fullpage-hidden' : 'fullpage-show';

	// convert IDs to string
	$fullpage_classes = 'class="' . implode( ' ', $fullpage_classes ) . '"'; // these aren't dynamic

	// wrapper
	echo '<div id="fullpage-wrapper"><div id="fullpage" ' . $fullpage_classes . '>';

	// get each section
	while ( have_rows( 'sections', $tw_page['pageID'] ) ) : the_row();
		if ( locate_template( TW_SECTION_DIR . get_row_layout() . '.php' ) ) {
			include( locate_template( TW_SECTION_DIR . get_row_layout() . '.php' ) );
			$section_count ++;
		}
	endwhile;

	echo '</div></div>';

endif;