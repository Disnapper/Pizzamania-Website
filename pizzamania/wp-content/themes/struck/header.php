<?php
/**
 * Theme Header
 *
 * Displays all of the <head> section and everything up till <div id="sitecontainer">
 *
 * @package WordPress
 * @since 1.0
 */

global $tw_options;

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div class="loading ajax-loader <?php if ( isset( $tw_options['ajax-loading-image'] ) ) { echo sanitize_html_class( $tw_options['ajax-loading-image'] ); } ?>"></div>

	<?php do_action('tw_above_navigation'); ?>

	<?php get_template_part( TW_TEMPLATES_DIR . '/navigation' ); ?>

	<?php do_action('tw_below_navigation'); ?>

	<div id="sitecontainer">