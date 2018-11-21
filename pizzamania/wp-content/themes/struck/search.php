<?php
/**
 * The template for displays the blog index
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
get_header();

global $fields_installed;

// cache blog page
$pageID = get_option('page_for_posts');

// get page options
$tw_page = tw_get_page_options(array(
	'pageID' 		=> $pageID,
	'loop_template' => 'posts'
));

// Get Current Page for Pagination
$pagething  = get_query_var('paged') ? get_query_var('paged') : get_query_var('page');
$paged      = $pagething ? $pagething : 1;  ?>

<div <?php post_class( $tw_page['classes'] ); ?>>

	<?php
		// page title template
		if ( locate_template( TW_TITLES_DIR . 'page-title.php' ) ) {
			include( locate_template( TW_TITLES_DIR . 'page-title.php' ) );
		}
	?>

	<div class="page-content-inner">

		<?php
			// display template
			if ( locate_template( TW_DISPLAYS_DIR . $tw_page['display'] . '.php' ) ) {
				include( locate_template( TW_DISPLAYS_DIR . $tw_page['display'] . '.php' ) );
			}
		?>

	</div>

</div>

<?php get_footer(); // Theme footer