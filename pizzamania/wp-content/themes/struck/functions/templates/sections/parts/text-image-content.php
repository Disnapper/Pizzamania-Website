<?php 
/**
 * The template for displaying the text-image section
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// Check for section or slide
$tw_section = $slidestuff ? $slidestuff : $tw_row; ?>

<?php 
    if( $tw_section['text_layout'] ) {
        include( locate_template( TW_SECTION_PARTS_DIR . 'text-image-' . $tw_section['text_layout'] . '.php') );
    }
?>