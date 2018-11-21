<?php
/**
 * The template for sanitizing and displaying the section tag.
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */ 

/**
 * Prepare section attributes and sanitize on output
 */
echo '<section ';

/**
 * Section ids
 */
if ( isset( $tw_row['ids'] ) && is_array( $tw_row['ids'] ) ) :

    // start class attribute
    echo 'id="';

    foreach ( $tw_row['ids'] as $class ) :
        echo sanitize_html_class( $class ) . ' ';
    endforeach;

    // end id attribute
    echo '" ';
endif;

/**
 * Section classes
 */
if ( isset( $tw_row['classes'] ) && is_array( $tw_row['classes'] ) ) :

    // start class attribute
    echo 'class="';

    foreach ( $tw_row['classes'] as $class ) :
        echo sanitize_html_class( $class ) . ' ';
    endforeach;

    // end class attribute
    echo '" ';
endif;

/**
 * Section data-attributes
 */
if ( isset( $tw_row['data_attributes'] ) && is_array( $tw_row['data_attributes'] ) ) :

    foreach ( $tw_row['data_attributes'] as $attribute => $value ) :
        if ( $value !== false ) {
            echo esc_attr( $attribute ) . '="' . esc_attr( $value ) . '" ';
        }
    endforeach;

endif;

/**
 * Section styles
 */
if ( isset( $tw_row['inline_section_styles'] ) ) :
    tw_inline_style( array( 
        'styles' => $tw_row['inline_section_styles'] 
    ) );
endif;

// end section tag
echo '>'; 