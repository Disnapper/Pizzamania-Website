<?php
/**
 * The template for sanitizing and displaying the buttons output.
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */ 

// if we have any buttons and is set correctly
if ( isset( $tw_row['buttons_output'] ) && is_array( $tw_row['buttons_output'] ) ) :

    // start wrapper
    echo '<div class="section-buttons ' . sanitize_html_class( $tw_row['animations'] ) . '">';

    // get each button
    foreach ( $tw_row['buttons_output'] as $button ) : 

        // start button link
        echo '<a href="' . esc_url( $button['link'] ) . '" '; 

        // link classes
        if ( tw_issetor( $button['button_classes'] ) ) :

                // start class attribute
                echo 'class="'; 

                // validate each class
                foreach ( $button['button_classes'] as $class ) :
                    echo sanitize_html_class( $class ) . ' ';
                endforeach;

                // end class attribute
                echo '" ';
        endif;

        // link title
        echo 'title="' . esc_attr( strip_tags( $button['button_text'] ) ) . '">';

        // play button icon
        if ( $button['button_style'] == 'play' ) {
            if ( tw_issetor( $button['button_text'] ) ) {
                echo '<span class="play-button has-text"></span>';
            } else {
                echo '<span class="play-button"></span>';
            }
        }

        // button text output
        echo wp_kses( 
            $button['button_text'], 
            // Only fontawesome icons
            array(
                'i' => array(
                'class' => array(),
                'title' => array()
                ),
            )
        );

        // end button link
        echo '</a>';

    endforeach;

    // end wrapper
    echo '</div>';
endif;