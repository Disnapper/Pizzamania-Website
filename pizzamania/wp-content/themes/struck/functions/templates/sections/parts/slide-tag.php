<?php
/**
 * The template for sanitizing and displaying the Slide tag.
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */ 

/**
 * Prepare Slide attributes and sanitize on output
 */
echo '<div ';

/**
 * Slide ids
 */
if ( isset( $slidestuff['ids'] ) && is_array( $slidestuff['ids'] ) ) :

    // start class attribute
    echo 'id="';

    foreach ( $slidestuff['ids'] as $class ) :
        echo sanitize_html_class( $class ) . ' ';
    endforeach;

    // end id attribute
    echo '" ';
endif;

/**
 * Slide classes
 */
if ( isset( $slidestuff['classes'] ) && is_array( $slidestuff['classes'] ) ) :

    // start class attribute
    echo 'class="';

    foreach ( $slidestuff['classes'] as $class ) :
        echo sanitize_html_class( $class ) . ' ';
    endforeach;

    // end class attribute
    echo '" ';
endif;

/**
 * Slide data-attributes
 */
if ( isset( $slidestuff['data_attributes'] ) && is_array( $slidestuff['data_attributes'] ) ) :

    foreach ( $slidestuff['data_attributes'] as $attribute => $value ) :
        if ( $value !== false ) {
            echo esc_attr( $attribute ) . '="' . esc_attr( $value ) . '" ';
        }
    endforeach;

endif;

/**
 * Slide styles
 */
if ( isset( $slidestuff['inline_section_styles'] ) ) :
    tw_inline_style( array( 
        'styles' => $slidestuff['inline_section_styles'] 
    ) );
endif;

// end slide tag
echo '>'; 