<?php
/**
 * The template for displaying text image slides
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// get section properties
$section_data = tw_get_sections( $section_count, $total_sections, $field_object );
$tw_row       = $section_data->tw_row; 

// section tag
if ( locate_template( TW_SECTION_PARTS_DIR . 'section-tag.php' ) ) {
    include( locate_template( TW_SECTION_PARTS_DIR . 'section-tag.php' ) );
}

// if there are slides
if ( $tw_row['slides'] ) :

	// start with slide number 0
	$slidenumber = 0; 

	// each slide
	foreach( $tw_row['slides'] as $slide ) : 

		// get slide properties
		$slide_data = tw_get_sections( $slidenumber + 1, $total_sections, $field_object['value'][ $section_count - 1 ]['slides'] );
		$slidestuff = $slide_data->tw_row;

        // slide tag
	    if ( locate_template( TW_SECTION_PARTS_DIR . 'slide-tag.php' ) ) {
	        include( locate_template( TW_SECTION_PARTS_DIR . 'slide-tag.php' ) );
	    }

        // section overlay
        if ( locate_template( TW_SECTION_PARTS_DIR . 'overlay.php' ) ) {
            include( locate_template( TW_SECTION_PARTS_DIR . 'overlay.php' ) );
        }

        // video background
        if ( locate_template( TW_SECTION_PARTS_DIR . 'video-background.php' ) ) {
            include( locate_template( TW_SECTION_PARTS_DIR . 'video-background.php' ) );
        }

        // section text content
        if ( locate_template( TW_SECTION_PARTS_DIR . 'text-image-content.php' ) ) {
            include( locate_template( TW_SECTION_PARTS_DIR . 'text-image-content.php' ) );
        }

        // next button arrow
        if ( locate_template( TW_SECTION_PARTS_DIR . 'prev-next-buttons.php' ) ) {
            include( locate_template( TW_SECTION_PARTS_DIR . 'prev-next-buttons.php' ) );
        }

        // caption/credits
        if ( locate_template( TW_SECTION_PARTS_DIR . 'credits.php' ) ) {
            include( locate_template( TW_SECTION_PARTS_DIR . 'credits.php' ) );
        }

        // end slide tag
		echo '</div>';

    	// increment slide counter
        $slidenumber++; 

        // reset slide variable
        $slidestuff = false; 

    // end slides
    endforeach;

// end if slides
endif;

// end section tag
echo '</section>';