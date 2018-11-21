<?php
/**
 * The template for displaying right aligned 
 * text-image section.
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */ 
?>

<div class="container">
    <div class="section-entry">
        <div class="text-image-wrapper">

            <div class="col-md-8 col-md-offset-2 text-cell">

                <?php if ( $tw_section['images'] ) : ?>
                    <div class="fit-this-image">
                        <?php include( locate_template( TW_SECTION_PARTS_DIR . 'text-image-image.php' ) );  ?>
                    </div>
                <?php endif; ?>

                <?php include( locate_template( TW_SECTION_PARTS_DIR . 'text-image-text.php' ) );  ?>

                <div class="clear"></div>
            </div>
            
        <div class="clear"></div>
        </div>
    </div>
</div> 