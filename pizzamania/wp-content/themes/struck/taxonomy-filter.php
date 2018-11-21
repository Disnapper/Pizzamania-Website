<?php
/**
 * The template for displaying the filter page
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
get_header();

// check if acf is installed
global $fields_installed;

// get page options
$tw_page = tw_get_page_options( array(
	'pageID'         => get_queried_object()->term_id, // current term id
	'loop_template'  => 'filter-tax', // get only posts
	'filters'        => false, // don't show filters
	'posts_per_page' => false, // use settings posts per page
	'display'        => 'minimal' // display minimal template
) ); ?>

<div <?php post_class( $tw_page['classes'] ); ?>>

	<?php
		// page title template
		if ( locate_template( TW_TITLES_DIR . 'filter-title.php' ) ) {
			include( locate_template( TW_TITLES_DIR . 'filter-title.php' ) );
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

	</div><!-- .page-content -->

</div>

<?php
// Theme footer
get_footer();