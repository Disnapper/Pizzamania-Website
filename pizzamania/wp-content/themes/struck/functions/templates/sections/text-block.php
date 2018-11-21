<?php
/**
 * The template for displaying centered title section
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// get section properties
$tw_row = tw_get_section($section_count, $field_object); ?>

<!-- Section -->
<div <?php tw_section_attributes($tw_row); ?>>

    <?php
        // site overlay
        include( locate_template( 'functions/templates/sections/overlay.php' ) );
        // video background
        include( locate_template( 'functions/templates/sections/video-background.php' ) );
    ?>

    <div class="content-page content-section section-wrapper">
        <div class="section-entry">
            <div class="container">
                <div class="col-md-8">

                    <?php if ( $tw_row['subtitle'] || $tw_row['title'] ) : ?>
                        <div class="left-content">

                            <?php if ( $tw_row['title'] ) : ?>
                                <div class="v-item title">
                                    <?php echo esc_html( $tw_row['title'] ); ?>
                                </div>
                                <hr class="v-item title-divider" />
                            <?php endif; ?>

                            <?php if ( $tw_row['subtitle'] ) : ?>
                                <div class="v-item subtitle">
                                    <?php echo esc_html( $tw_row['subtitle'] ); ?>
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>

                    <?php if ( $tw_row['content'] ) : ?>
                        <div class="v-item content">
                            <?php echo wp_kses_post( $tw_row['content'] ); // double check sanitization ?>
                        </div>
                    <?php endif; ?>

                </div>

                <div class="clear"></div>
            </div>
        </div>
    </div>

   <?php include( locate_template( 'functions/templates/sections/prev-next-buttons.php' ) ); ?>

</div>