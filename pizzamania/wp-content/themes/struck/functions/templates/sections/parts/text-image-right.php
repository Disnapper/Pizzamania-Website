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
    <div class="section-entry table">
        <div class="text-image-wrapper tr">

            <div class="col-md-6 fit-this-image td image-cell verticalmiddle">
                <?php 
                    if ( $tw_section['images'] ) : 
                        include( locate_template( TW_SECTION_PARTS_DIR . 'text-image-image.php' ) );  
                    endif; 
                ?>
            </div>

            <div class="col-md-6 text-cell td verticalmiddle">
                <?php include( locate_template( TW_SECTION_PARTS_DIR . 'text-image-text.php' ) );  ?>
                <div class="clear"></div>
            </div>

        </div>
    </div>
</div> 