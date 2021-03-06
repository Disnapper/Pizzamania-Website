<?php
/**
 * Template Name: Posts - Classic
 * Displays posts, portfolio items and pages in a classic layout.
 *
 * @package WordPress
 * @since 1.0
 */
get_header();

// check if acf is installed
global $fields_installed;

// get page options
$tw_page = tw_get_page_options(array(
	'loop_template' => $fields_installed && get_field('item_type') ? get_field('item_type') : 'posts',
	'display' 		=> 'classic' // since we're on the classic layout template
)); ?>

<?php
	// Include page sections
	if ( locate_template( TW_SECTIONS_DIR . 'sections.php' ) ) {
		include( locate_template( TW_SECTIONS_DIR . 'sections.php' ) );
	}
?>

<div <?php post_class( $tw_page['classes'] ); ?>>

	<?php
		// page title template
		if ( locate_template( TW_TITLES_DIR . 'page-title.php' ) ) {
			include( locate_template( TW_TITLES_DIR . 'page-title.php' ) );
		}
	?>

	<div class="page-content-inner">

		<?php
			// loop template
			if ( locate_template( TW_LOOPS_DIR . $tw_page['loop_template'] . '.php' ) ) {
				include( locate_template( TW_LOOPS_DIR . $tw_page['loop_template'] . '.php' ) );
			}
		?>

		<?php
			// display template
			if ( locate_template( TW_DISPLAYS_DIR . $tw_page['display'] . '.php' ) ) {
				include( locate_template( TW_DISPLAYS_DIR . $tw_page['display'] . '.php' ) );
			}
		?>

		<?php if ( $content = tw_the_content_by_id( $tw_page['pageID'], false ) ) : ?>
			<div class="page-content">
				<div class="container">
					<div class="col-md-12">
						<?php echo wp_kses_post( $content ); ?>
					</div><!-- .col-md-7 -->
				</div><!-- .container -->
			</div><!-- .page-content -->
		<?php endif; ?>

	</div><!-- .page-content-inner -->

</div><!-- .page-content-wrapper -->

<?php get_footer(); // Theme footer