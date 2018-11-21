<?php
/**
 * The template for displaying the video background
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// if it's a slide, use slide stuff instead
$tw_row = tw_issetor( $slidestuff ) ? $slidestuff : $tw_row;

$count = tw_issetor( $slidenumber ) ? $section_count . '-' . $slidenumber : $section_count;

if ( $tw_row['hosted_enabled'] ) : ?>

	<?php if ( tw_issetor( $tw_row['video_background_placeholder'] ) ) : ?>
		<style>
			video.hosted-video {
				background-image: url(<?php echo esc_url( $tw_row['video_background_placeholder'] ); ?>);
			}
		</style>
	<?php endif; ?>

	<video class="hosted-video" poster="<?php echo esc_url( get_template_directory_uri() . '/images/transparent.png' ); ?>" muted loop preload="auto">
		<?php if ( tw_issetor( $tw_row['video_mp4_url'] ) ) : ?>
			<source src="<?php echo esc_url( $tw_row['video_mp4_url'] ); ?>" type="video/mp4">
		<?php endif; ?>

		<?php if ( tw_issetor( $tw_row['video_webm_url'] ) ) : ?>
			<source src="<?php echo esc_url( $tw_row['video_webm_url'] ); ?>" type="video/webm">
		<?php endif; ?>
	</video>

<?php endif; ?>

<?php if ( $tw_row['youtube_enabled'] ) : ?>

	<div id="tubular-container-<?php echo esc_attr( $count ); ?>" class="tubular-container">
		<div id="tubular-player-<?php echo esc_attr( $count ); ?>" class="tubular-player"></div>
	</div>
	<div id="tubular-shield-<?php echo esc_attr( $section_count ); ?>" class="tubular-shield"></div>

<?php endif; ?>