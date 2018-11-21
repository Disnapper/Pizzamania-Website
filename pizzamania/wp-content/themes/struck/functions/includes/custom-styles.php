<?php

/**
 * Contains methods for customizing the theme customization screen.
 *
 * @since Struck 1.0
 */
class Themewich_Customize {

	/**
	 * This hooks into 'customize_register' (available as of WP 3.4) and allows
	 * you to add new sections and controls to the Theme Customize screen.
	 *
	 * Note: To enable instant preview, we have to actually write a bit of custom
	 * javascript. See live_preview() for more.
	 *
	 * @see add_action('customize_register',$func)
	 *
	 * @param \WP_Customize_Manager $wp_customize
	 *
	 * @since Struck 1.0
	 */
	public static function register( $wp_customize ) {

		// Define a new section to the Theme Customizer
		$wp_customize->add_section( 'themewich_options',
			array(
				'title'       => __( 'Color Options', 'themewich' ), // Visible title of section
				'priority'    => 35, // Determines what order this appears in
				'capability'  => 'edit_theme_options', // Capability needed to tweak
				'description' => __( 'Adjust the themes colors.', 'themewich' ), // Descriptive tooltip
			)
		);

		// Register new settings to the WP database...
		$wp_customize->add_setting( 'tw_highlight_color', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'           => '#00a498', // Default setting/value to save
				'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability'        => 'edit_theme_options', // Special permissions for accessing this setting.
				'transport'         => 'refresh', // Set to 'postMessage' for instant color change
				'sanitize_callback' => 'sanitize_hex_color' // sanitization
			)
		);

		// Register new settings to the WP database...
		$wp_customize->add_setting( 'tw_background_color', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'           => '#fff', // Default setting/value to save
				'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability'        => 'edit_theme_options', // Special permissions for accessing this setting.
				'transport'         => 'refresh', // Set to 'postMessage' for instant color change
				'sanitize_callback' => 'sanitize_hex_color' // sanitization
			)
		);

		// Register new settings to the WP database...
		$wp_customize->add_setting( 'tw_footer_color', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'           => '#f3f3f3', // Default setting/value to save
				'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability'        => 'edit_theme_options', // Special permissions for accessing this setting.
				'transport'         => 'refresh', // Set to 'postMessage' for instant color change
				'sanitize_callback' => 'sanitize_hex_color' // sanitization
			)
		);

		// Register new settings to the WP database...
		$wp_customize->add_setting( 'tw_footer_text_color', // No need to use a SERIALIZED name, as `theme_mod` settings already live under one db record
			array(
				'default'           => '#9e9e9e', // Default setting/value to save
				'type'              => 'theme_mod', // Is this an 'option' or a 'theme_mod'?
				'capability'        => 'edit_theme_options', // Special permissions for accessing this setting.
				'transport'         => 'refresh', // Set to 'postMessage' for instant color change
				'sanitize_callback' => 'sanitize_hex_color' // sanitization
			)
		);

		// Define the control itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
			$wp_customize, //Pass the $wp_customize object (required)
			'themewich_highlight_color', // Set a unique ID for the control
			array(
				'label'    => __( 'Highlight Color', 'themewich' ),	// Admin-visible name of the control
				'section'  => 'colors',	// ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'tw_highlight_color',	// Which setting to load and manipulate (serialized is okay)
				'priority' => 10, // Determines the order this control appears in for the specified section
			)
		) );

		// Define the control itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
			$wp_customize, //Pass the $wp_customize object (required)
			'themewich_background_color', // Set a unique ID for the control
			array(
				'label'    => __( 'Background Color', 'themewich' ), // Admin-visible name of the control
				'section'  => 'colors', // ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'tw_background_color', // Which setting to load and manipulate (serialized is okay)
				'priority' => 11, // Determines the order this control appears in for the specified section
			)
		) );

		// Define the control itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
			$wp_customize, //Pass the $wp_customize object (required)
			'themewich_footer_color', // Set a unique ID for the control
			array(
				'label'    => __( 'Footer Background Color', 'themewich' ),
				//Admin-visible name of the control
				'section'  => 'colors',
				//ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'tw_footer_color',
				//Which setting to load and manipulate (serialized is okay)
				'priority' => 12,
				//Determines the order this control appears in for the specified section
			)
		) );

		// Define the control itself (which links a setting to a section and renders the HTML controls)...
		$wp_customize->add_control( new WP_Customize_Color_Control( //Instantiate the color control class
			$wp_customize, //Pass the $wp_customize object (required)
			'themewich_footer_text_color', // Set a unique ID for the control
			array(
				'label'    => __( 'Footer Text Color', 'themewich' ),
				//Admin-visible name of the control
				'section'  => 'colors',
				//ID of the section this control should render in (can be one of yours, or a WordPress default section)
				'settings' => 'tw_footer_text_color',
				//Which setting to load and manipulate (serialized is okay)
				'priority' => 13,
				//Determines the order this control appears in for the specified section
			)
		) );

	}

	/**
	 * This will output the custom WordPress settings to the live theme's WP head.
	 *
	 * Used by hook: 'wp_head'
	 *
	 * @see add_action('wp_head',$func)
	 * @since Struck 1.0
	 */
	public static function header_output() {

		/**
		 * Site Background
		 * @var string
		 */
		$siteBackground =
			'#sitecontainer,
	        .page-content-wrapper,
	        .pagination .pagenumbers';

		/**
		 * Backgrounds
		 * @var string
		 */
		$backgrounds =
			'.badges a:hover,
	        .widget .tagcloud a:hover,
	        span.respond-link a:hover,
	        a.more-link:hover,
	        .button:hover,
	        .struck a.tw-button.shortcode:hover,
	        .struck .tw-postshortcode a.more-link,
	        a.button:hover,
	        a.more-link:hover,
	        #submit:hover,
	        input[type=submit]:hover,
	        .button:active,
	        .tw-button:active,
	        a.tw-button:active,
	        a.button:active,
	        a.more-link:active,
	        #submit:active,
	        .tw-postshortcode a.more-link:active,
	        input[type=submit]:active, *::selection,
	        .struck .mejs-controls .mejs-time-rail .mejs-time-buffering, .struck .mejs-controls .mejs-time-rail .mejs-time-current, .struck .mejs-controls .mejs-volume-button .mejs-volume-slider,
			.struck .mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current, .struck .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
			.struck .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current ';

		/**
		 * Border Colors
		 * @var string
		 */
		$borderColors =
			'a.more-link,
	        .regular-posts a.more-link,
	        .tw-button, a.tw-button,
	        .tw-postshortcode a.more-link,
	        .widget .tagcloud a:hover,
	        .widget .recent-project:hover,
	        .badges a:hover,
	        span.respond-link a:hover,
	        .button,
	        .tw-button,
	        a.tw-button,
	        a.button,
	        a.more-link,
	        #submit,
	        .tw-postshortcode a.more-link,
	        input[type=submit]';

		/**
		 * Colors styles
		 * @var string
		 */
		$colors =
			'a.more-link,
	        span.highlight,
	        .button,
	        .tw-button,
	        a.tw-button,
	        a.button,
	        a.more-link,
	        #submit,
	        .tw-postshortcode a.more-link,
	        input[type=submit],
	        .single .authorinfo.not-full a:hover,
	        .struck .tw-button, .struck a.tw-button, .struck .tw-postshortcode a.more-link';

		/**
		 * Hover background style
		 * @var string
		 */
		$hoverBackgrounds =
			'.badges a:hover,
	        .widget .tagcloud a:hover,
	        span.respond-link a:hover,
	        a.more-link:hover,
	        .button:hover,
	        .tw-button:hover,
	        a.tw-button:hover,
	        a.button:hover,
	        a.more-link:hover,
	        #submit:hover,
	        .tw-postshortcode a.more-link:hover,
	        input[type=submit]:hover,
	        .button:active,
	        .tw-button:active,
	        a.tw-button:active,
	        a.button:active,
	        a.more-link:active,
	        #submit:active,
	        .tw-postshortcode a.more-link:active,
	        input[type=submit]:active';

		/**
		 * Border Colors Pseudo Styles
		 * @var string
		 */
		$borders =
			'.pagetitleloading .pagercontainer .bx-slider-pager a.active,
	        .pagetitleloading .pagercontainer .bx-slider-pager a:hover,
	        .button,
	        .tw-button,
	        a.tw-button,
	        a.button,
	        a.more-link,
	        #submit,
	        .tw-postshortcode a.more-link,
	        input[type=submit],
	        .top-nav.altnav #menu > ul > li > a:hover,
	        .top-nav.altnav #menu > ul > li.sfHover > a,
	        .top-nav.altnav #menu > ul > li.current_page_item > a';

		/**
		 * Footer Background Color
		 * @var string
		 */
		$footerbg = 'html, #footer';

		/**
		 * Footer Text Color
		 * @var string
		 */
		$footer_text = '#footer';
	?>

		<!--Customizer CSS-->
		<style type="text/css">
			<?php self::generate_css($siteBackground, 'background', 'tw_background_color'); ?>
			<?php self::generate_css($backgrounds, 'background', 'tw_highlight_color'); ?>
			<?php self::generate_css($borderColors, 'border-color', 'tw_highlight_color'); ?>
			<?php self::generate_css($colors, 'color', 'tw_highlight_color'); ?>
			<?php self::generate_css($hoverBackgrounds, 'background', 'tw_highlight_color'); ?>
			<?php self::generate_css($borders, 'border-color', 'tw_highlight_color'); ?>
			<?php self::generate_css('*::selection', 'background', 'tw_highlight_color'); ?>
			<?php self::generate_css($footerbg, 'background', 'tw_footer_color'); ?>
			<?php self::generate_css($footer_text, 'color', 'tw_footer_text_color'); ?>
		</style>
		<!--Customizer CSS-->

	<?php
	}

	/**
	 * This outputs the javascript needed to automate the live settings preview.
	 * Also keep in mind that this function isn't necessary unless your settings
	 * are using 'transport'=>'postMessage' instead of the default 'transport'
	 * => 'refresh'
	 *
	 * Used by hook: 'customize_preview_init'
	 *
	 * @see add_action('customize_preview_init',$func)
	 * @since Struck 1.0
	 */
	public static function live_preview() {
		$themewich_theme_info = wp_get_theme();
		wp_enqueue_script(
			'themewich-themecustomizer',        //Give the script an ID
			get_template_directory_uri() . '/js/theme-customizer.js',  //Point to file
			array( 'jquery', 'customize-preview' ),  //Define dependencies
			$themewich_theme_info->Version,     //Define a version
			true                    //Put script in footer
		);
	}

	/**
	 * This will generate a line of CSS for use in header output. If the setting
	 * ($mod_name) has no defined value, the CSS will not be output.
	 *
	 * @uses get_theme_mod()
	 *
	 * @param string $selector CSS selector
	 * @param string $style The name of the CSS *property* to modify
	 * @param string $mod_name The name of the 'theme_mod' option to fetch
	 * @param string $prefix Optional. Anything that needs to be output before the CSS property
	 * @param string $postfix Optional. Anything that needs to be output after the CSS property
	 * @param bool $echo Optional. Whether to print directly to the page (default: true).
	 *
	 * @return string Returns a single line of CSS with selectors and a property.
	 * @since Struck 1.0
	 */
	public static function generate_css( $selector, $style, $mod_name, $prefix = '', $postfix = '', $echo = true ) {
		$return = '/* No CSS */';
		$mod    = get_theme_mod( $mod_name );
		if ( ! empty( $mod ) ) {
			$return = sprintf( '%s { %s:%s; }',
				$selector,
				$style,
				$prefix . $mod . $postfix
			);
			if ( $echo ) {
				echo esc_html( $return ); // no css sanitation available
			}
		}

		return $return;
	}
}

// Setup the Theme Customizer settings and controls...
add_action( 'customize_register', array( 'Themewich_Customize', 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head', array( 'Themewich_Customize', 'header_output' ) );