<?php
/**
 * The template for displaying the section overlay
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// check for slide and localize
$overlays = tw_issetor( $slidestuff ) ? $slidestuff : $tw_row; ?>

<?php if ( $overlays['overlay_enabled'] ) : ?>
	<?php
		// create inline style attributes for
		$opacity = $overlays['overlay_opacity'] ? $overlays['overlay_opacity'] / 100 : '0.3';
		$style   = array(
			'background' => $overlays['overlay'],
			'opacity'    => $opacity,
			'filter'     => 'alpha(opacity=' . $opacity*100 . ')'
		);
	?>

	<div class="overlay" <?php tw_inline_style( array( 'styles' => $style ) ); ?>></div>
<?php endif; ?>