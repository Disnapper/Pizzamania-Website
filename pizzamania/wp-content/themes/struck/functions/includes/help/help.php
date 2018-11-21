<?php
/**
 * Functions to load and display the theme help document
 *
 * @package WordPress
 * @since 1.0
 */

// This will store the url of the current directory in WordPress
global $help_url;

/**
 * Utility function to clean file path and replace replace backward by forward slashes.
 * Adapted from the Redux Framework: http://reduxframework.com/
 * @since 1.0
 */
function themewich_clean_file_path( $path ) {
	$path = str_replace( '', '', str_replace( array( "\\", "\\\\" ), '/', $path ) );
	if ( $path[ strlen( $path ) - 1 ] === '/' ) {
		$path = rtrim( $path, '/' );
	}

	return $path;
}

/**
 * Get the url of the current help folder.
 * This allows you to include this in a plugin or theme easily.
 * Adapted from the Redux Framework: http://reduxframework.com/
 * @since  1.0
 */
$help_dir       = trailingslashit( themewich_clean_file_path( dirname( __FILE__ ) ) ); // get file path
$wp_content_dir = trailingslashit( themewich_clean_file_path( WP_CONTENT_DIR ) ); // get wp-content directory
$wp_content_dir = trailingslashit( str_replace( '//', '/', $wp_content_dir ) ); // replace double slashes
$relative_url   = str_replace( $wp_content_dir, '', $help_dir ); // remove anything before wp-content
$wp_content_url = trailingslashit( themewich_clean_file_path( ( is_ssl() ? str_replace( 'http://', 'https://', WP_CONTENT_URL ) : WP_CONTENT_URL ) ) ); // get wp_content url
$help_url       = $wp_content_url . $relative_url; // create final url with content url and relative url

/**
 * Create a help page
 * @since 1.0
 */
if ( ! function_exists( 'themewich_help_page' ) ) :
	function themewich_help_page() {

		global $tw_options;

		// if redux isn't activated or help page is enabled
		if ( ! isset( $tw_options['help_page'] ) || $tw_options['help_page'] ) :
			$help_page  = add_menu_page(
				 __( 'Theme Help', 'themewich' ),
				 __( 'Theme Help', 'themewich' ),
				'edit_theme_options',
				'help-page',
				'themewich_help_page_content',
				'dashicons-book',
				4
			);
		endif;
	}

	add_action( 'admin_menu', 'themewich_help_page' );
endif;

/**
 * Loads stylesheets for help page
 * @since 1.0
 */
if ( ! function_exists( 'themewich_help_styles' ) ) :
	function themewich_help_styles() {
		global $help_url;
		wp_enqueue_style( 'flatdoc-help-style', $help_url . 'css/style.css' );
	}

	if ( isset( $_GET['page'] ) && $_GET['page'] == 'help-page' ) {
		add_action( 'admin_enqueue_scripts', 'themewich_help_styles' );
	}
endif;

/**
 * Loads scripts for help page
 * @since 1.0
 */
if ( ! function_exists( 'themewich_help_scripts' ) ) :
	function themewich_help_scripts() {
		global $help_url;
		wp_enqueue_script( 'flatdoc-legacy', $help_url . 'js/legacy.js', array( 'jquery' ), '0.9.0', false );
		wp_enqueue_script( 'flatdoc', $help_url . 'js/flatdoc.js', array( 'jquery' ), '0.9.0', false );
		wp_enqueue_script( 'flatdoc-help-script', $help_url . 'js/script.js', array( 'jquery' ), '0.9.0', false );
	}

	if ( isset( $_GET['page'] ) && $_GET['page'] == 'help-page' ) {
		add_action( 'admin_enqueue_scripts', 'themewich_help_scripts' );
	}
endif;

/**
 * Adds help to admin bar
 * @since 1.0
 */
if ( ! function_exists( 'themewich_help_admin_bar' ) ) :
	function themewich_help_admin_bar( $wp_admin_bar ) {

		global $tw_options;

		// if redux isn't activated or help page is enabled
		if ( ! isset( $tw_options['help_page'] ) || $tw_options['help_page'] ) :

			// Top Level Help Link
			$args = array(
				'id'    => 'theme-help',
				'title' => __( 'Theme Help', 'themewich' ),
				'href'  => admin_url( 'admin.php?page=help-page' ),
				'meta'  => array( 'class' => 'tw-theme-help' )
			);
			$wp_admin_bar->add_node( $args );

			// Getting Started Submenu
			$started = array(
				'parent' => 'theme-help',
				'id'     => 'getting-started',
				'title'  => __( 'Getting Started', 'themewich' ),
				'href'   => admin_url( 'admin.php?page=help-page#getting-started' ),
				'meta'   => array( 'class' => 'tw-theme-help' )
			);
			$wp_admin_bar->add_node( $started );

			// Adding Content Submenu
			$content = array(
				'parent' => 'theme-help',
				'id'     => 'adding-content',
				'title'  => __( 'Adding Content', 'themewich' ),
				'href'   => admin_url( 'admin.php?page=help-page#adding-content' ),
				'meta'   => array( 'class' => 'tw-theme-help' )
			);
			$wp_admin_bar->add_node( $content );

			// Adding Content Submenu
			$customize = array(
				'parent' => 'theme-help',
				'id'     => 'customization',
				'title'  => __( 'Customization', 'themewich' ),
				'href'   => admin_url( 'admin.php?page=help-page#customization' ),
				'meta'   => array( 'class' => 'tw-theme-help' )
			);
			$wp_admin_bar->add_node( $customize );

			// Frequently Asked Questions
			$faq = array(
				'parent' => 'theme-help',
				'id'     => 'faq',
				'title'  => __( 'Frequently Asked Questions', 'themewich' ),
				'href'   => admin_url( 'admin.php?page=help-page#frequently-asked-questions' ),
				'meta'   => array( 'class' => 'tw-theme-help' )
			);
			$wp_admin_bar->add_node( $faq );

			// Extending
			$extend = array(
				'parent' => 'theme-help',
				'id'     => 'extending',
				'title'  => __( 'Altering and Extending', 'themewich' ),
				'href'   => admin_url( 'admin.php?page=help-page#altering-and-extending' ),
				'meta'   => array( 'class' => 'tw-theme-help' )
			);
			$wp_admin_bar->add_node( $extend );

			// Extending
			$extend = array(
				'parent' => 'theme-help',
				'id'     => 'support-forum',
				'title'  => __( 'Support Forum', 'themewich' ),
				'href'   => 'http://support.themewich.com/discussions',
				'meta'   => array( 'class' => 'support-forum', 'target' => '_blank' )
			);
			$wp_admin_bar->add_node( $extend );

		endif;
	}

	add_action( 'admin_bar_menu', 'themewich_help_admin_bar', 9999 );
endif;

/**
 * Initializes Flatdoc
 * @since 1.0
 */
if ( ! function_exists( 'themewich_flatdoc_init' ) ) :
	function themewich_flatdoc_init() {
		global $help_url;

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'help-page' ) { ?>

			<script type="text/javascript">
				Flatdoc.run({
					fetcher: Flatdoc.file('<?php echo esc_url( $help_url . "readme.md" ); ?>')
				});
			</script> <?php

		}
	}

	add_action( 'admin_footer', 'themewich_flatdoc_init' ); // Write our JS below here
endif;

/**
 * HTML output of page structure
 * @since 1.0
 */
if ( ! function_exists( 'themewich_help_page_content' ) ) :
	function themewich_help_page_content() {
		global $help_dir; ?>

		<div role='flatdoc' class="no-literate large-brief flatdoc-wrapper">

			<div class='header'>
				<div class='left'>
					<h1><?php _e( 'Theme Help', 'themewich' ); ?></h1>
					<ul>
						<li>
							<a target="_blank" href='http://support.themewich.com/discussions'>
								<?php _e( 'Support Forum', 'themewich' ); ?>
							</a>
						</li>
						<li>
							<a target="_blank" href='http://support.themewich.com/kb'>
								<?php _e( 'Knowledgebase', 'themewich' ); ?>
							</a>
						</li>
						<li>
							<a target="_blank" href='http://themewich.com/updates/struck'>
								<?php _e( 'Changelog', 'themewich' ); ?>
							</a>
						</li>
					</ul>
				</div>
				<div class='right'>
					<ul>
						<li>
							<a href="http://twitter.com/ajgagnon">
								<span class="dashicons dashicons-twitter"></span> <?php _e( 'Twitter', 'themewich' ); ?>
							</a>
						</li>
						<li>
							<a href="http://facebook.com/themewich">
								<span
									class="dashicons dashicons-facebook"></span> <?php _e( 'Facebook', 'themewich' ); ?>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class='content-root'>
				<div class='menubar'>
					<div class='menu section' role='flatdoc-menu'></div>
				</div>
				<div role='flatdoc-content' class='content'></div>
			</div>

		</div>

	<?php
	}
endif;