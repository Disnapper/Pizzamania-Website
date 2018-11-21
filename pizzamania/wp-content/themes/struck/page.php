<?php
/**
 * Displays the default page
 *
 * The template for displaying the full width page
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
get_header();

// check if acf is installed
global $fields_installed;

// get page options
$tw_page = tw_get_page_options();

// Get Current Page for Pagination
$pagething  = get_query_var('paged') ? get_query_var('paged') : get_query_var('page');
$paged      = $pagething ? $pagething : 1;  ?>

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

	<div class="page-content">

		<div class="container with-sidebar">
			<div class="col-md-12">

				<div class="content">
	        		<?php the_content(); ?>
	        	</div>

	        	<div class="sidebar">
					<?php dynamic_sidebar('Page Sidebar'); ?>
				</div>

				<div class="clear"></div>

			</div>
  		</div>

	</div><!-- .page-content -->

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	?>

</div><!-- .page-content-wrapper -->

<?php get_footer(); // Theme footer