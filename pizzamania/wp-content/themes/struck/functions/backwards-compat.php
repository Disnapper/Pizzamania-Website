<?php
/**
 * Struck back compat functionality
 *
 * Prevents Struck from running on WordPress versions prior to 4.0,
 * since this theme is not meant to be backward compatible beyond that
 * and relies on many newer functions and markup changes introduced in 4.0.
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

/**
 * Prevent switching to Struck on old versions of WordPress.
 *
 * Switches to the default theme.
 *
 * @since Struck 1.0
 *
 * @return void
 */
function themewich_switch_theme() {
	switch_theme( WP_DEFAULT_THEME, WP_DEFAULT_THEME );
	unset( $_GET['activated'] );
	add_action( 'admin_notices', 'themewich_upgrade_notice' );
}

add_action( 'after_switch_theme', 'themewich_switch_theme' );

/**
 * Add message for unsuccessful theme switch.
 *
 * Prints an update nag after an unsuccessful attempt to switch to
 * Struck on WordPress versions prior to 4.0.
 *
 * @since Struck 1.0
 *
 * @return void
 */
function themewich_upgrade_notice() {
	$message = sprintf( __( 'Struck requires at least WordPress version 4.0. You are running version %s. Please upgrade and try again.', 'themewich' ), $GLOBALS['wp_version'] );
	printf( '<div class="error"><p>%s</p></div>', $message );
}

/**
 * Prevent the Theme Customizer from being loaded on WordPress versions prior to 4.0.
 *
 * @since Struck 1.0
 *
 * @return void
 */
function themewich_customizer() {
	wp_die( sprintf( __( 'Struck requires at least WordPress version 4.0. You are running version %s. Please upgrade and try again.', 'themewich' ), $GLOBALS['wp_version'] ), '', array(
		'back_link' => true,
	) );
}

add_action( 'load-customize.php', 'themewich_customizer' );

/**
 * Prevent the Theme Preview from being loaded on WordPress versions prior to 4.0.
 *
 * @since Struck 1.0
 *
 * @return void
 */
function themewich_preview() {
	if ( isset( $_GET['preview'] ) ) {
		wp_die( sprintf( __( 'Struck requires at least WordPress version 4.0. You are running version %s. Please upgrade and try again.', 'themewich' ), $GLOBALS['wp_version'] ) );
	}
}

add_action( 'template_redirect', 'themewich_preview' );