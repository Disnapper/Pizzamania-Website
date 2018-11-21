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

<?php if ( $tw_section['images'] ) : ?>

	<div class="container">
	    <div class="section-entry table">
	        <div class="text-image-wrapper tr">

	            <div class="col-md-6 text-cell td verticalmiddle">
	                <?php include( locate_template( TW_SECTION_PARTS_DIR . 'text-image-text.php' ) );  ?>
	                <div class="clear"></div>
	            </div>

	            <div class="col-md-6 fit-this-image td image-cell verticalmiddle">
	                <?php include( locate_template( TW_SECTION_PARTS_DIR . 'text-image-image.php' ) );  ?>
	            </div>

	        </div>
	    </div>
	</div>

<?php else : ?>

	<div class="container">
	    <div class="section-entry">
	        <div class="text-image-wrapper">

	            <div class="col-md-6 text-cell">

	                <?php include( locate_template( TW_SECTION_PARTS_DIR . 'text-image-text.php' ) );  ?>

	                <div class="clear"></div>
	            </div>

	            <div class="clear"></div>
	        </div>
	    </div>
	</div>

<?php endif; ?>