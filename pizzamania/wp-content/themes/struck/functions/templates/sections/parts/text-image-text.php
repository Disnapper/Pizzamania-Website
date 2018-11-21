<?php
/**
 * The template for displaying text image section text.
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
?>

<div class="text-layout-inner">

    <?php if ( $tw_section['subtitle'] ) : ?>
        <div class="<?php echo sanitize_html_class( $tw_section['animations'] ); ?> subtitle tiny-details">
            <?php echo esc_html( $tw_section['subtitle'] ); ?>
        </div>
    <?php endif; ?>

    <?php if ( $tw_section['title'] ) : ?>
        <div class="<?php echo sanitize_html_class( $tw_section['animations'] ); ?> title">
           <h2><?php echo esc_html( $tw_section['title'] ); ?></h2>
        </div>
    <?php endif; ?>

    <?php if ( $tw_section['title'] && $tw_section['content'] ) : ?>
        <hr class="<?php echo sanitize_html_class( $tw_section['animations'] ); ?> title-divider" data-width="100px" />
    <?php endif; ?>

    <?php if ( $tw_section['content'] ) : ?>
        <div class="<?php echo sanitize_html_class( $tw_section['animations'] ); ?> content">
            <?php echo wp_kses_post( $tw_section['content'] ); ?>
        </div>
    <?php endif; ?>

    <?php    
        // buttons output
        if ( locate_template( TW_SECTION_PARTS_DIR . 'buttons.php' ) ) {
            include( locate_template( TW_SECTION_PARTS_DIR . 'buttons.php' ) );
        }
    ?>

</div>