<?php
/**
 * The template for displaying the category page
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
get_header();

// check if acf is installed
global $fields_installed;

// cache blog page
$pageID = get_option('page_for_posts');

// get page options
$tw_page = tw_get_page_options(array(
	'pageID' 			=> $pageID, // set page ID of blog page
	'loop_template' 	=> 'posts', // get only posts
	'filters' 			=> false, // don't show filters
	'posts_per_page' 	=> false, // use settings posts per page
	'display' 			=> 'minimal' // display minimal template
)); ?>

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

	</div><!-- .page-content -->

</div>

<?php
// Theme footer
get_footer();