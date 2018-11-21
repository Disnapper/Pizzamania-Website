<?php
/**
 * The theme options config file
 *
 * @package WordPress
 * @since Struck 1.0
 */


/**
 * Custom CSS
 * @since v1.0
 */
if ( ! function_exists( 'tw_custom_css' ) ) :
	function tw_custom_css() {
		wp_register_style(
			'redux-custom-css',
			get_template_directory_uri() . '/theme-options/css/themewich-redux-custom.css',
			array( 'redux-admin-css' ), // Be sure to include redux-css so it's appended after the core css is applied
			time(),
			'all'
		);
		wp_enqueue_style( 'redux-custom-css' );
	}

	add_action( 'redux/page/tw_options/enqueue', 'tw_custom_css' );
endif;

if (!class_exists("Themewich_Options_Config")) {

    class Themewich_Options_Config {

	    public $args = array();
	    public $sections = array();
	    public $theme;
	    public $ReduxFramework;

        public function __construct() {

            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
	        if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
		        $this->initSettings();
	        } else {
		        add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
	        }
        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            // Function to test the compiler hook and demo CSS output.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
           // add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo "<h1>The compiler hook has run!";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
              require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
              $wp_filesystem->put_contents(
              $filename,
              $css,
              FS_CHMOD_FILE // predefined mode settings for WP files
              );
              }
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
	    function dynamic_section( $sections ) {
		    $sections[] = array(
			    'title'  => __( 'Section via hook', 'themewich' ),
			    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'themewich' ),
			    'icon'   => 'el-icon-paper-clip',
			    // Leave this as a blank section, no options just some intro text set above.
			    'fields' => array()
		    );

		    return $sections;
	    }

        /**

          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.

         * */
	    function change_arguments( $args ) {
		    //$args['dev_mode'] = true;

		    return $args;
	    }

        /**

          Filter hook for filtering the default value of any given field. Very useful in development mode.

         * */
	    function change_defaults( $defaults ) {
		    $defaults['str_replace'] = "Testing filter hook!";

		    return $defaults;
	    }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
	    function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::instance(), 'plugin_metalinks' ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
	            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );

            }
        }

	    /**
	     *
	     */
	    public function setSections() {

		    /**
		     * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
		     * */
		    // Background Patterns Reader
		    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
		    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
		    $sample_patterns      = array();

		    if ( is_dir( $sample_patterns_path ) ) :

			    if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
				    $sample_patterns = array();

				    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

					    if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
						    $name = explode( ".", $sample_patterns_file );
						    $name = str_replace( '.' . end( $name ), '', $sample_patterns_file );
						    $sample_patterns[] = array(
							    'alt' => $name,
							    'img' => $sample_patterns_url . $sample_patterns_file
						    );
					    }
				    }
			    endif;
		    endif;

		    ob_start();

		    $ct          = wp_get_theme();
		    $this->theme = $ct;
		    $item_name   = $this->theme->get( 'Name' );
		    $tags        = $this->theme->Tags;
		    $screenshot  = $this->theme->get_screenshot();
		    $class       = $screenshot ? 'has-screenshot' : '';

		    $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'themewich' ), $this->theme->display( 'Name' ) );
		    ?>
		    <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
			    <?php if ( $screenshot ) : ?>
				    <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
					    <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
					       title="<?php echo esc_attr( $customize_title ); ?>">
						    <img src="<?php echo esc_url( $screenshot ); ?>"
						         alt="<?php esc_attr_e( 'Current theme preview' ); ?>"/>
					    </a>
				    <?php endif; ?>
				    <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
				         alt="<?php esc_attr_e( 'Current theme preview' ); ?>"/>
			    <?php endif; ?>

			    <h4>
				    <?php echo esc_attr( $this->theme->display( 'Name' ) ); ?>
			    </h4>

			    <div>
				    <ul class="theme-info">
					    <li><?php printf( __( 'Version %s', 'themewich' ), $this->theme->display( 'Version' ) ); ?></li>
				    </ul>
				    <?php
					    if ( $this->theme->parent() ) {
						    printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'themewich' ), $this->theme->parent()->display( 'Name' ) );
					    }
				    ?>

			    </div>

		    </div>

            <?php
		    $item_info = ob_get_contents();

		    ob_end_clean();

		    $sampleHTML = '';
		    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
			    /** @global WP_Filesystem_Direct $wp_filesystem */
			    global $wp_filesystem;
			    if ( empty( $wp_filesystem ) ) {
				    require_once( ABSPATH . '/wp-admin/includes/file.php' );
				    WP_Filesystem();
			    }
			    $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
		    }


			$this->sections[] = array(
			'icon' => 'el-icon-cogs',
			'icon_class' => 'icon-large',
			'title' => __('General Settings', 'themewich'),
			'fields' => array(

				/* Custom Logo */
				array(
					'id'       => 'logo',
					'type'     => 'media',
					'url'      => true,
					'title'    => __( 'Dark Logo', 'themewich' ),
					'compiler' => 'true',
					'desc'     => __( 'Upload a dark colored logo to be shown on light backgrounds.', 'themewich' ),
					'subtitle' => __( 'Upload any logo file.', 'themewich' ),
				),
				array(
					'id'       => 'logo_light',
					'type'     => 'media',
					'url'      => true,
					'title'    => __( 'Light Logo', 'themewich' ),
					'compiler' => 'true',
					'desc'     => __( 'Upload a light colored logo to be shown on dark backgrounds.', 'themewich' ),
					'subtitle' => __( 'Upload any logo file.', 'themewich' ),
				),
				array(
					'id'       => 'retina-logo',
					'type'     => 'switch',
					'title'    => __( 'Retina Logo', 'themewich' ),
					'subtitle' => __( 'Turning this on will half the size of your logo for HDPI displays.', 'themewich' ),
					"default"  => 0,
				),
				/* Custom Favicon */
				array(
					'id'       => 'favicon',
					'type'     => 'media',
					'url'      => true,
					'title'    => __( 'Favicon', 'themewich' ),
					'compiler' => 'true',
					'desc'     => __( 'Recommended size is 16px x 16px.', 'themewich' ),
					'subtitle' => __( 'Upload a favicon image.', 'themewich' ),
				)
			)
			);

		    $this->sections[] = array(
			    'icon'       => 'el-icon-tasks',
			    'icon_class' => 'icon-large',
			    'title'      => __( 'Customize', 'themewich' ),
			    'desc'       => __( 'To customize your theme colors, don\'t forget to check out the', 'themewich' ) . ' <a href="' . get_admin_url() . 'customize.php">' . __( 'Theme Customizer', 'themewich' ) . '</a>.',
			    'fields'     => array(

				    array(
					    'id'       => 'header_spacing',
					    'type'     => 'spacing',
					    'output'   => array( '.top-nav, .altnav .top-nav-inner' ), // An array of CSS selectors to apply this font style to
					    'mode'     => 'padding', // absolute, padding, margin, defaults to padding
					    'right'    => false, // Disable the right
					    'left'     => false, // Disable the left
					    'units'    => 'px', // You can specify a unit value. Possible: px, em, %
					    'title'    => __( 'Header Margin', 'themewich' ),
					    'subtitle' => __( 'Choose the spacing want in your header.', 'themewich' ),
					    'default'  => array( 'padding-top' => '20px', 'padding-bottom' => '20px' )
				    ),
				    array(
					    'id'       => 'search-text',
					    'type'     => 'text',
					    'title'    => __( 'Search Box Default Text', 'themewich' ),
					    'subtitle' => __( 'Enter default text for your search box.', 'themewich' ),
					    'default'  => 'Search...',
					    'validate' => 'no_html'
				    ),
				    array(
					    'id'       => 'footer-text-center',
					    'type'     => 'textarea',
					    'title'    => __( 'Footer Center Text', 'themewich' ),
					    'subtitle' => __( 'You can use shortcodes in your footer text: [tw-site-title] [tw-site-tagline] [tw-current-year] [tw-social icon="twitter" url="" title=""] etc.', 'themewich' ),
					    'default'  => '',
					    'validate' => 'html'
				    ),
				    array(
					    'id'       => 'footer-text-left',
					    'type'     => 'textarea',
					    'title'    => __( 'Footer Left Text', 'themewich' ),
					    'subtitle' => __( 'You can use shortcodes in your footer text: [tw-site-title] [tw-site-tagline] [tw-current-year] [tw-social icon="twitter" url="" title=""] etc.', 'themewich' ),
					    'default'  => '&copy; Copyright [tw-current-year]',
					    'validate' => 'html'
				    ),
				    array(
					    'id'       => 'footer-text-right',
					    'type'     => 'textarea',
					    'title'    => __( 'Footer Right Text', 'themewich' ),
					    'subtitle' => __( 'You can use shortcodes in your footer text: [tw-site-title] [tw-site-tagline] [tw-current-year] [tw-social icon="twitter" url="" title=""] etc.', 'themewich' ),
					    'default'  => '[tw-social icon="twitter" url="http://twitter.com/ajgagnon" title="Follow Me on Twitter"] [tw-social icon="facebook" url="http://facebook.com/themewich" title="Follow Me on facebook"] [tw-social icon="dribbble" url="http://dribbble.com/ajgagnon" title="Follow Me on Dribbble"]',
					    'validate' => 'html'
				    ),
				    array(
					    'id'       => 'ajax-loading-image',
					    'type'     => 'image_select',
					    'title'    => __( 'Ajax Loading Image', 'themewich' ),
					    'subtitle' => __( 'Choose the loading image for your site.', 'themewich' ),
					    'options'  => array(
						    'puff'             => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/puff.svg'
						    ),
						    'audio'            => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/audio.svg'
						    ),
						    'ball-triangle'    => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/ball-triangle.svg'
						    ),
						    'bars'             => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/bars.svg'
						    ),
						    'circles'          => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/circles.svg'
						    ),
						    'grid'             => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/grid.svg'
						    ),
						    'hearts'           => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/hearts.svg'
						    ),
						    'oval'             => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/oval.svg'
						    ),
						    'rings'            => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/rings.svg'
						    ),
						    'spinning-circles' => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/spinning-circles.svg'
						    ),
						    'tail-spin'        => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/tail-spin.svg'
						    ),
						    'three-dots'       => array(
							    'title' => '',
							    'img'   => get_template_directory_uri() . '/images/loaders/three-dots.svg'
						    ),
					    ),
					    'default'  => 'puff'
				    ),
				    array(
					    'id'       => 'custom-css',
					    'type'     => 'ace_editor',
					    'title'    => __( 'Custom CSS', 'themewich' ),
					    'subtitle' => __( 'Quickly add some CSS to your theme by adding it to this block.', 'themewich' ),
					    'mode'     => 'css',
					    'theme'    => 'chrome',
					    'default'  => "",
					    'validate' => 'css' // only allow css to be stored
				    )
			    )
		    );

		    $this->sections[] = array(
			    'icon'       => 'el-icon-pencil',
			    'icon_class' => 'icon-large',
			    'title'      => __( 'Post &amp; Portfolio', 'themewich' ),
			    'fields'     => array(
				    array(
					    'id'       => 'sharing',
					    'type'     => 'switch',
					    'title'    => __( 'Default Sharing', 'themewich' ),
					    'subtitle' => __( 'Display sharing options at the end of the content.', 'themewich' ),
					    "default"  => 1,
				    ),
			    )
		    );

			$this->sections[] = array(
				'icon'       => 'el-icon-font',
				'icon_class' => 'icon-large',
				'title'      => __( 'Fonts', 'themewich' ),
				'fields'     => array(
					/**
					 * Page post, and portfolio section titles
					 */
					array(
						'id'			=> 'sections-titles',
						'type' 			=> 'typography',
						'title' 		=> __('Page, Post, Portfolio and Section Titles', 'themewich'),
						'google'		=> true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'	=> true,
						'text-align' 	=> false,
						'letter-spacing'=> true, // Defaults to false
					    'text-transform' => true,
						'color'			=> false,
						'output' 		=> array('#logo h1, #logo h2, .section h2, .title-container h1, .minimal-content h2, #share-box h2'), // An array of CSS selectors to apply this font style to dynamically
						'units'			=> 'em', // Defaults to px
						'subtitle'		=> __('Set your site titles, slide titles, and h1 font.', 'themewich'),
						'default'		=> array(
							'font-weight'=>'300',
							'font-family'=>'Lato',
					        'text-transform' => 'none',
							'google' => true,
							'font-size'=>'3.5em',
					        'line-height' => '1em',
					        'letter-spacing' => '0'
						),
					),

					/**
					 * Intro font
					 */
					array(
						'id'             => 'intro',
						'type'           => 'typography',
						'title'          => __( 'Post, Page and Portfolio Intros', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( '.intro h2' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set your intro font.', 'themewich' ),
						'default'        => array(
							'font-weight'    => '300',
							'font-family'    => 'Lato',
							'text-transform' => 'none',
							'google'         => true,
							'font-size'      => '1.75em',
							'line-height'    => '1.3em'
						),
					),

					/**
					 * Top Nav Font
					 */
					array(
						'id'=>'top-nav-font',
						'type' => 'typography',
						'title' => __('Dropdown Navigation Font', 'themewich'),
						'google'        => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'   => true,
						'text-align'    => false,
						'letter-spacing'=> true, // Defaults to false
						'text-transform' => true,
						'color'         => false,
						'output' => array('.sf-menu li > a'), // An array of CSS selectors to apply this font style to dynamically
						'units'=>'em', // Defaults to px
						'subtitle'=> __('Set your font choice for your top level site navigation and megamenu headings.', 'themewich'),
						'default'=> array(
							'font-weight'=>'700',
							'font-family'=>'Montserrat',
							'google' => true,
							'letter-spacing' => '0.15em',
							'font-size'=>'0.75em',
							'line-height' => '1em',
							'text-transform' => 'uppercase'),
					),

					/**
					 * Slide Out Nav Font
					 */
					array(
						'id'             => 'slide-out-font',
						'type'           => 'typography',
						'title'          => __( 'Slide Out Navigation Font', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( '#nb-popoutmenu a, .nb-back' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set your font choice for your top level site navigation and megamenu headings.', 'themewich' ),
						'default'        => array(
							'font-weight'    => '700',
							'font-family'    => 'Montserrat',
							'google'         => true,
							'letter-spacing' => '0.15em',
							'font-size'      => '0.75em',
							'line-height'    => '1em',
							'text-transform' => 'uppercase'
						),
					),

					/**
					 * Tiny Details
					 */
					array(
						'id'             => 'tiny-details',
						'type'           => 'typography',
						'title'          => __( 'Tiny Details Font', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( '.tiny-details, .badges a, a.button, a.more-link, input[type="submit"], label, .sidepostcontainer .date, cite, .tw-postshortcode a.more-link, a.tw-button, thead th' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set your font choice for the headers.', 'themewich' ),
						'default'        => array(
							'font-weight'    => '700',
							'font-family'    => 'Montserrat',
							'google'         => true,
							'letter-spacing' => '0.15em',
							'font-size'      => '0.75em',
							'line-height'    => '1.4em',
							'text-transform' => 'uppercase'
						),
					),
				)
			);

			$this->sections[] = array(
				'icon'       => 'el-icon-font',
				'icon_class' => 'icon-large',
				'title'      => __( 'Content Fonts', 'themewich' ),
				'subsection' => true,
				'fields'     => array(

					/**
					 * Headings
					 */
					array(
						'id'			=> 'heading-1',
						'type' 			=> 'typography',
						'title' 		=> __('Heading 1', 'themewich'),
						'google'		=> true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'	=> true,
						'text-align' 	=> false,
						'letter-spacing'=> true, // Defaults to false
						'text-transform' => true,
						'color'			=> false,
						'output' 		=> array('h1'), // An array of CSS selectors to apply this font style to dynamically
						'units'			=> 'em', // Defaults to px
						'subtitle'		=> __('Set your site titles, slide titles, and h1 font.', 'themewich'),
						'default'       => array(
							'font-weight'    => '400',
							'font-family'    => 'Lato',
							'text-transform' => 'none',
							'google'         => true,
							'font-size'      => '2.5em',
							'line-height'    => '1.4em',
							'letter-spacing' => '0'
						),
					),
					array(
						'id'             => 'heading-2',
						'type'           => 'typography',
						'title'          => __( 'Heading 2', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( 'h2' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set your h2 font.', 'themewich' ),
						'default'        => array(
							'font-weight'    => '400',
							'font-family'    => 'Lato',
							'text-transform' => 'none',
							'google'         => true,
							'font-size'      => '2em',
							'line-height'    => '1.4em'
						),
					),
					array(
						'id'             => 'heading-3',
						'type'           => 'typography',
						'title'          => __( 'Heading 3', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( 'h3, blockquote, blockquote p, .grid h2' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set your h3 font.', 'themewich' ),
						'default'        => array(
							'font-weight'    => '400',
							'font-family'    => 'Lato',
							'text-transform' => 'none',
							'google'         => true,
							'font-size'      => '1.5em',
							'line-height'    => '1.4em'
						),
					),
					array(
						'id'             => 'heading-4',
						'type'           => 'typography',
						'title'          => __( 'Heading 4', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( 'h4' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set your h4 font.', 'themewich' ),
						'default'        => array(
							'font-weight'    => '400',
							'font-family'    => 'Lato',
							'text-transform' => 'none',
							'google'         => true,
							'font-size'      => '1.25em',
							'line-height'    => '1.4em'
						),
					),
					array(
						'id'             => 'heading-5',
						'type'           => 'typography',
						'title'          => __( 'Heading 5', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( 'h5, .subtitle > h1, .subtitle > h2' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set your page subtitle and h5 font.', 'themewich' ),
						'default'        => array(
							'font-weight'    => '400',
							'font-family'    => 'Lato',
							'text-transform' => 'none',
							'google'         => true,
							'font-size'      => '1.15em',
							'line-height'    => '1.4em'
						),
					),
					array(
						'id'             => 'heading-6',
						'type'           => 'typography',
						'title'          => __( 'Heading 6', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( 'h6' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set h6 font.', 'themewich' ),
						'default'        => array(
							'font-weight'    => '400',
							'font-family'    => 'Lato',
							'text-transform' => 'none',
							'google'         => true,
							'font-size'      => '1.15em',
							'line-height'    => '1.4em'
						),
					),
					/**
					 * Paragraphs
					 */
					array(
						'id'             => 'paragraph-type',
						'type'           => 'typography',
						'title'          => __( 'Paragraph and Body Font', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( '.articleinner, .content, p, ul, ol, sf-menu li li a, input, textarea, .sidebar, dd, dt, table' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set your font choice for the site-wide page headers and main slideshow title.', 'themewich' ),
						'default'        => array(
							'color'       => "#777",
							'font-weight' => '400',
							'font-family' => 'Open Sans',
							'google'      => true,
							'font-size'   => '1em',
							'line-height' => '1.8em'
						),
					),
					/**
					 * Asides
					 */
					array(
						'id'             => 'aside-type',
						'type'           => 'typography',
						'title'          => __( 'Aside Font', 'themewich' ),
						'google'         => true, // Disable google fonts. Won't work if you haven't defined your google api key
						'line-height'    => true,
						'text-align'     => false,
						'letter-spacing' => true, // Defaults to false
						'text-transform' => true,
						'color'          => false,
						'output'         => array( 'aside' ), // An array of CSS selectors to apply this font style to dynamically
						'units'          => 'em', // Defaults to px
						'subtitle'       => __( 'Set your font choice for the site-wide page headers and main slideshow title.', 'themewich' ),
						'default'        => array(
							'color'       => "#777",
							'font-style'  => '400italic',
							'font-family' => 'Open Sans',
							'google'      => true,
							'font-size'   => '0.8em',
							'line-height' => '1.8em'
						),
					),

				),
			);

		    if ( function_exists( 'wp_get_theme' ) ) {
			    $theme_data  = wp_get_theme();
			    $theme_uri   = $theme_data->get( 'ThemeURI' );
			    $description = $theme_data->get( 'Description' );
			    $author      = $theme_data->get( 'Author' );
			    $version     = $theme_data->get( 'Version' );
			    $tags        = $theme_data->get( 'Tags' );
		    } else {
			    $theme_data  = wp_get_theme( trailingslashit( get_stylesheet_directory() ) . 'style.css' );
			    $theme_uri   = $theme_data['URI'];
			    $description = $theme_data['Description'];
			    $author      = $theme_data['Author'];
			    $version     = $theme_data['Version'];
			    $tags        = $theme_data['Tags'];
		    }

		    $theme_info = '<div class="redux-framework-section-desc">';
		    $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'themewich' ) . '<a href="' . $theme_uri . '" target="_blank">' . $theme_uri . '</a></p>';
		    $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'themewich' ) . $author . '</p>';
		    $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'themewich' ) . $version . '</p>';
		    $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $description . '</p>';
		    if ( ! empty( $tags ) ) {
			    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'themewich' ) . implode( ', ', $tags ) . '</p>';
		    }
		    $theme_info .= '</div>';

		    $this->sections[] = array(
			    'icon'   => 'el-icon-download',
			    'title'  => __( 'Updates', 'themewich' ),
			    'desc'   => __( '<p class="description">Get Automatic Theme Updates</p>', 'themewich' ),
			    'fields' => array(
				    array(
					    'id'       => 'tf_username',
					    'type'     => 'text',
					    'title'    => __( 'Themeforest Username', 'themewich' ),
					    'subtitle' => __( 'Enter your Themeforest Username that you used to purchase the this theme.', 'themewich' ),
					    'validate' => 'no_html'
				    ),
				    array(
					    'id'       => 'tf_api',
					    'type'     => 'text',
					    'title'    => __( 'Themeforest API Key', 'themewich' ),
					    'subtitle' => __( 'You can find your API key by Logging into Themeforest, visiting your Dashboard page then clicking the My Settings tab. At the bottom of the page you will find your account API key and a button to regenerate it as needed.', 'themewich' ),
					    'validate' => 'no_html'
				    ),
				    array(
					    'id'      => 'raw_new_info',
					    'title'   => __( 'Your Version', 'themewich' ),
					    'type'    => 'raw',
					    'content' => $item_info
				    )
			    ),
		    );

		    $this->sections[] = array(
			    'icon'   => 'el-icon-dashboard',
			    'title'  => __( 'Advanced', 'themewich' ),
			    'fields' => array(
				    array(
					    'id'       => 'ajax',
					    'type'     => 'switch',
					    'title'    => __( 'Use Ajax Page Load', 'themewich' ),
					    'subtitle' => __( 'You may need to turn this off to work with some plugins', 'themewich' ),
					    "default"  => 1,
				    ),
				    array(
					    'id'       => 'help_page',
					    'type'     => 'switch',
					    'title'    => __( 'Show Help Page', 'themewich' ),
					    'subtitle' => __( 'Turn this off to hide the help page.', 'themewich' ),
					    "default"  => 1,
				    ),
				    array(
					    'id'       => 'edit_custom_fields',
					    'type'     => 'switch',
					    'title'    => __( 'Edit Custom Fields', 'themewich' ),
					    'subtitle' => __( 'Turn this on to edit the custom fields for the theme. USE AT YOUR OWN RISK! Editing these fields could break theme functionality. We recommend backing up your database before turning this on.<img src="http://www.lolinez.com/sw.jpg">', 'themewich' ),
					    "default"  => 0,
				    ),
			    ),
		    );
		}

	    /**
	     * All the possible arguments for Redux.
	     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
	     */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'tw_options', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => esc_html( $theme->get('Name') ), // Name that appears at the top of your panel
                'display_version' => esc_html( $theme->get('Version') ), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Options', 'themewich'),
                'page' => __('Theme Options', 'themewich'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyBvTFqTI2TwUiB8SaDfHrZM3TnH_qsE4aw', // Must be defined to add google fonts to the typography module
                'admin_bar' => true, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
            'footer_credit' => 'Thank you for creating with <a href="http://tiny.cc/pyo3yx" target="_blank">Themewich</a>. Powered by the <a href="http://tiny.cc/pyo3yx" target="_blank">Redux Options Framework.</a>', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );
                // HINTS
                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => 'bootstrap',
                        ),
                    'tip_position'  => array(
                        'my' => 'bottom left',
                        'at' => 'top right',
                        ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'fade',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'fade',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                ),
            );


	        // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
	        $this->args['share_icons'][] = array(
		        'url'   => 'http://twitter.com/ajgagnon',
		        'title' => 'Visit me on Twitter',
		        'icon'  => 'el-icon-twitter'
		        // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
	        );
	        $this->args['share_icons'][] = array(
		        'url'   => 'http://dribbble.com/ajgagnon',
		        'title' => 'Find me on Dribbble',
		        'icon'  => ' el-icon-dribbble'
	        );
	        $this->args['share_icons'][] = array(
		        'url'   => 'http://themeforest.net/user/2winFactor',
		        'title' => 'Follow me on Themeforest',
		        'icon'  => 'el-icon-leaf'
	        );
	        $this->args['share_icons'][] = array(
		        'url'   => 'http://bit.do/ZYMg',
		        'title' => 'Get Support',
		        'icon'  => 'el-icon-group'
	        );

	        // Add content after the form.
	        $this->args['footer_text'] = __( '<p style="margin-top:20px;"><a class="icon-a icon-gallery" href="http://bit.do/ZYMg" target="_blank" style="font-size:14px; color:#777; text-decoration:none; margin-right:10px;"><i class="el-icon-website"></i> More Themes</a>
				<a class="icon-a icon-support" href="http://bit.do/ZYMg" target="_blank"  style="font-size:14px; color:#777; text-decoration:none; margin-right:10px;"><i class="el-icon-group"></i> Support Forum</a>
				<a class="icon-a icon-documentation" href="' . admin_url() . '?page=help-page" style="font-size:14px; color:#777; text-decoration:none; margin-right:10px;"><i class="el-icon-paper-clip"></i> Documentation</a>
			</p>', 'themewich' );
        }

    }

    new Themewich_Options_Config();
}


/**

  Custom function for the callback referenced above

 */
if (!function_exists('redux_my_custom_field')):

    function redux_my_custom_field($field, $value) {
        print_r($field);
        print_r($value);
    }

endif;

/**

  Custom function for the callback validation referenced above

 * */
if (!function_exists('redux_validate_callback_function')):

    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation

          if(something) {
          $value = $value;
          } elseif(something else) {
          $error = true;
          $value = $existing_value;
          $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }


endif;