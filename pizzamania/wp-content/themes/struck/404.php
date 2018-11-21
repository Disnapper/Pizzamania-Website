<?php
/**
 * The template for displays the blog index
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
get_header();

// cache blog page
$pageID = get_option('page_for_posts');

// get page options
$tw_page = tw_get_page_options(array(
	'pageID' => $pageID
));  ?>

<div <?php post_class( $tw_page['classes'] ); ?>>

	<?php
		// page title template
		if ( locate_template( TW_TITLES_DIR . 'page-title.php' ) ) {
			include( locate_template( TW_TITLES_DIR . 'page-title.php' ) );
		}
	?>

	<div class="page-content">
		<div class="container">
			<div class="col-md-12 content aligncenter">
				<h4>
					<?php _e('Search:', 'themewich'); ?>
				</h4>
				<p>
					<?php get_search_form(true); ?>
				</p>
			</div><!-- .col-md-8 -->
		</div><!-- .container -->
	</div><!-- .page-content -->

</div>

<?php get_footer(); // theme footer