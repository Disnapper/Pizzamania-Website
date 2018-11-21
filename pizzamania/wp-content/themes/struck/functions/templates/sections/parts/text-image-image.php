<?php
/**
 * The template for displaying text/image section images
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
?>

<div class="image-container <?php echo sanitize_html_class( $tw_section['animations'] ); ?> wp-caption">

		<?php if ( $tw_section['image_link'] ) { ?>
        	<a href="<?php echo esc_url( $tw_section['image_link'] ); ?>" class="<?php echo sanitize_html_class( $tw_section['image_link_class'] ); ?>">
        <?php } ?>

		        <img src="<?php echo esc_url( $tw_section['images']['sizes']['contentslideshownc'] ); ?>"
		             alt="<?php echo esc_attr( $tw_section['images']['alt'] ); ?>" class="scale-with-grid"/>

		<?php if ( $tw_section['image_link'] ) { ?>
        	</a>
        <?php } ?>

		<?php if ( $tw_section['images']['caption'] ) { ?>
			<p class="wp-caption-text caption-normal">
				<span><?php echo sanitize_text_field( $tw_section['images']['caption'] ); ?></span>
			</p>
		<?php } ?>

</div>