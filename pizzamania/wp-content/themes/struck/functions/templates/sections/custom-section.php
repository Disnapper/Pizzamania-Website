<?php
/**
 * The template for displaying text/image sections
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// get section properties
$section_data   = tw_get_sections($section_count, $total_sections, $field_object);
$tw_row         = $section_data->tw_row; 

// section tag
if ( locate_template( TW_SECTION_PARTS_DIR . 'section-tag.php' ) ) {
    include( locate_template( TW_SECTION_PARTS_DIR . 'section-tag.php' ) );
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
if ( locate_template( TW_SECTION_PARTS_DIR . 'custom-content.php' ) ) {
    include( locate_template( TW_SECTION_PARTS_DIR . 'custom-content.php' ) );
}

// next button arrow
if ( locate_template( TW_SECTION_PARTS_DIR . 'prev-next-buttons.php' ) ) {
    include( locate_template( TW_SECTION_PARTS_DIR . 'prev-next-buttons.php' ) );
}

// caption/credits
if ( locate_template( TW_SECTION_PARTS_DIR . 'credits.php' ) ) {
    include( locate_template( TW_SECTION_PARTS_DIR . 'credits.php' ) );
}

// end section tag
echo '</section>';