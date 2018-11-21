<?php
/**
 * The template to display the theme footer
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

global $tw_options; ?>

<div class="clear"></div>

	<?php do_action('tw_above_footer'); ?>

	<!-- Footer -->
	<div id="footer">

		<?php do_action('tw_above_footer_content'); ?>

		<div class="container clearfix">

			<?php if ( $tw_options['footer-text-center'] ) : ?>
				<div class="col-md-12 center-footer tiny-details">
					<?php echo do_shortcode( sanitize_text_field( $tw_options['footer-text-center'] ) ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $tw_options['footer-text-left'] ) : ?>
				<div class="col-md-6 left-footer tiny-details">
					<?php echo do_shortcode( sanitize_text_field( $tw_options['footer-text-left'] ) ); ?>
				</div>
			<?php endif; ?>

			<?php if ( $tw_options['footer-text-right'] ) : ?>
				<div class="col-md-6 right-footer tiny-details">
					<?php echo do_shortcode( sanitize_text_field( $tw_options['footer-text-right'] ) ); ?>  
				</div>
			<?php endif; ?>

		</div>
		<div class="clear"></div>

		<?php do_action('tw_below_footer_content'); ?>

	</div>
	<!-- End Footer -->

	<?php do_action('tw_below_footer'); ?>

</div> <!-- site container -->

<?php wp_footer(); ?><!-- Theme Hook -->

</body>
</html>