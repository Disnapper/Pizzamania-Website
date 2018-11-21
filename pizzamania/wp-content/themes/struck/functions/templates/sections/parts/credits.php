<?php
/**
 * The template for displaying the section credits
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// check for slide and localize
$row = $slidestuff ? $slidestuff : $tw_row; ?>

<?php if ( $row['credits'] ) : ?>
	<div class="credits tiny-details">
		<?php echo wp_kses_post( $row['credits'] ); ?>
	</div>
<?php endif; ?>