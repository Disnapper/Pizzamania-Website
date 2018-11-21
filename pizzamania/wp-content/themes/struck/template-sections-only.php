<?php
/**
 * Template Name: Sections-Only Page
 *
 * The template for displaying a page with only sections
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
get_header();

// get page options
$tw_page = tw_get_page_options();

// Include page sections
if ( locate_template( 'functions/templates/sections/sections.php' ) ) {
	include( locate_template( 'functions/templates/sections/sections.php' ) );
}

get_footer(); // Theme footer