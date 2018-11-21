<?php

/**
 * This allows for the notification and installation of required
 * plugins for the theme.
 *
 * @package    TGM-Plugin-Activation
 * @version    2.3.6
 * @author     Thomas Griffin <thomas@thomasgriffinmedia.com>
 * @author     Gary Jones <gamajo@gamajo.com>
 * @copyright  Copyright (c) 2012, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

// Include the TGM_Plugin_Activation class.
if ( file_exists( dirname( __FILE__ ) . '/class-tgm-plugin-activation.php' ) ) {
	require_once( dirname( __FILE__ ) . '/class-tgm-plugin-activation.php' );
}

if ( ! function_exists( 'themewich_register_required_plugins' ) ) :
	/**
	 * Register the required plugins for the theme.
	 *
	 * The variable passed to tgmpa_register_plugins() should be an array of plugin
	 * arrays.
	 *
	 * This function is hooked into tgmpa_init, which is fired within the
	 * TGM_Plugin_Activation class constructor.
	 *
	 * @since 1.0
	 */
	function themewich_register_required_plugins() {
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			// Include Shortcodes Plugin
			array(
				'name'                  => 'Themewich Shortcodes', // The plugin name
				'slug'                  => 'themewich-shortcodes', // The plugin slug (typically the folder name)
				'source'                => get_template_directory_uri() . '/functions/plugins/themewich-shortcodes.zip', // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '1.3.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => 'https://bitbucket.org/themewich/themewich-shortcodes', // If set, overrides default API URL and points to an external URL
			),

			// Include Shortcodes Plugin
			array(
				'name'                  => 'Themewich Portfolio Items', // The plugin name
				'slug'                  => 'themewich-portfolio', // The plugin slug (typically the folder name)
				'source'                => get_template_directory_uri() . '/functions/plugins/themewich-portfolio.zip', // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => 'https://themewich.com', // If set, overrides default API URL and points to an external URL
			),

			// Include advanced custom fields plugin
			array(
				'name'                  => 'Advanced Custom Fields Pro', // The plugin name
				'slug'                  => 'advanced-custom-fields', // The plugin slug (typically the folder name)
				'source'                => get_template_directory_uri() . '/functions/plugins/advanced-custom-fields-pro.zip', // The plugin source
				'required'              => true, // If false, the plugin is only 'recommended' instead of required
				'version'               => '5.1.7.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
				'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url'          => 'http://www.advancedcustomfields.com/', // If set, overrides default API URL and points to an external URL
			),

			// Include redux framework
			array(
				'name'                  => 'Redux Framework', // The plugin name
				'slug'                  => 'redux-framework', // The plugin slug (typically the folder name)
				'required'              => false, // If false, the plugin is only 'recommended' instead of required
				'version'               => '3.2.9.13', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			),

			// Include ninja forms
			array(
				'name'      => 'Ninja Forms',
				'slug'      => 'ninja-forms',
				'version'	=> '2.6.1',
				'required'  => true,
			),

			// Include regenerate thumbnails
			array(
				'name'      => 'Regenerate Thumbnails',
				'slug'      => 'regenerate-thumbnails',
				'version'	=> '2.2.4',
				'required'  => false,
			),

			// Include Yoast SEO
			array(
				'name'      => 'Yoast SEO',
				'slug'      => 'wordpress-seo',
				'version'	=> '1.7.4',
				'required'  => false,
			),

			// Include ZenCache
			array(
				'name'     => 'ZenCache',
				'slug'     => 'zencache',
				'version'  => '150218',
				'required' => false,
			),

			// Include Better WordPress Minify
			array(
				'name'     => 'Better WordPress Minify',
				'slug'     => 'bwp-minify',
				'version'  => '1.3.3',
				'required' => false,
			),

			// Include Category and Taxonomy Order
			array(
				'name'		=> 'Category and Taxonomy Order',
				'slug'		=> 'taxonomy-terms-order',
				'version'	=> '1.3.6',
				'required'	=> false,
			)
		);

		// The theme text domain, used for internationalising strings
		$theme_text_domain = 'themewich';

		/**
		 * Array of configuration settings. Amend each line as needed.
		 */
		$config = array(
			'domain'            => $theme_text_domain,          // Text domain - likely want to be the same as your theme.
			'default_path'      => '',                          // Default absolute path to pre-packaged plugins
			'parent_menu_slug'  => 'themes.php',                // Default parent menu slug
			'parent_url_slug'   => 'themes.php',                // Default parent URL slug
			'menu'              => 'install-required-plugins',  // Menu slug
			'has_notices'       => true,                        // Show admin notices or not
			'is_automatic'      => true,                        // Automatically activate plugins after installation or not
			'message'           => '',                          // Message to output right before the plugins table
			'strings'           => array(
				'page_title'                                => __( 'Install Required Plugins', 'themewich' ),
				'menu_title'                                => __( 'Install Plugins', 'themewich' ),
				'installing'                                => __( 'Installing Plugin: %s', 'themewich' ), // %1$s = plugin name
				'oops'                                      => __( 'Something went wrong with the plugin API.', 'themewich' ),
				'notice_can_install_required'               => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_install_recommended'            => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_install'                     => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
				'notice_can_activate_required'              => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_can_activate_recommended'           => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_activate'                    => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
				'notice_ask_to_update'                      => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
				'notice_cannot_update'                      => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
				'install_link'                              => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
				'activate_link'                             => _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
				'return'                                    => __( 'Return to Required Plugins Installer', 'themewich' ),
				'plugin_activated'                          => __( 'Plugin activated successfully.', 'themewich' ),
				'complete'                                  => __( 'All plugins installed and activated successfully. %s', 'themewich' ), // %1$s = dashboard link
				'nag_type'                                  => 'updated' // Determines admin notice type - can only be 'updated' or 'error'
			)
		);
		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', 'themewich_register_required_plugins' );
endif;