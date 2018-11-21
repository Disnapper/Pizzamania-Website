<?php
/**
 * The template for displaying the search form
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
global $tw_options;

// Set search placeholder default
$placeholder = __("Search", 'themewich') . '...';

// Get placeholder text option
if ( isset( $tw_options['search-text'] ) ) {
	$placeholder = $tw_options['search-text'];
} ?>

<!--Searchbox-->
<div class="search-form search">
	<form method="get" name="SearchForm" action="<?php echo esc_url( home_url() ); ?>/">
		<fieldset>
			<input type="text" name="s" id="s" placeholder="<?php echo esc_attr( $placeholder ); ?>"/>
		</fieldset>
	</form>
	<i class="fa fa-search searchbutton"></i>
</div>
<!--Searchbox-->