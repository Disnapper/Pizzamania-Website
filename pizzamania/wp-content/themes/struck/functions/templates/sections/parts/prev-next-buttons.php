<?php
/**
 * The template for displaying the scroll arrows
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// Check for section or slide
$tw_section = $slidestuff ? $slidestuff : $tw_row;

// check if last section
$last_section = ( $section_count == $total_sections && $tw_section['page_content'] ) ? 'last-section' : false; ?>

<?php if ( $tw_section['scroll_arrow'] ) : ?>
	<?php if ( $section_count < $total_sections || $last_section ) : ?>
		<a href="#section-<?php echo (int)$section_count + 1; ?>"
		   class="nextbutton nobg scroll-animate next-section-link <?php echo sanitize_html_class( $last_section ); ?>">
            <span>
                <?php _e( 'Next Section', 'themewich' ); ?>
            </span>
		</a>
	<?php endif; ?>
<?php endif; ?>