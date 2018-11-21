<?php
/**
 * The template to display a minimal list of posts
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// if no custom loop, use regular query
if ( ! $loop ) {
	$loop = $wp_query;
} ?>

<div class="isotope-wrapper">

	<div class="container">
		<div class="col-md-12">
			<?php
				// filters
				if ( locate_template( TW_TEMPLATES_DIR . 'filters.php' ) ) {
					include( locate_template( TW_TEMPLATES_DIR . 'filters.php' ) );
				}
			?>

			<?php
				// Pagination
				if ( locate_template( TW_TEMPLATES_DIR . 'infinite-pagination-prev.php' ) ) {
					include( locate_template( TW_TEMPLATES_DIR . 'infinite-pagination-prev.php' ) );
				}
			?>
		</div>
	</div>

	<!-- Minimal Area -->
	<div class="isotopecontainer struckcontainer">

		<?php rewind_posts(); // prepare loop again ?>

		<?php
			//Loop through posts
			if ( $loop->have_posts() ) :
				while ($loop->have_posts()) : $loop->the_post();

					// thumbnail template
					if ( locate_template( TW_DISPLAYS_DIR . 'minimal-thumbnail.php' ) ) {
						include( locate_template( TW_DISPLAYS_DIR . 'minimal-thumbnail.php' ) );
					}

				endwhile;
			endif; // end loop
		?>

		<div class="clear"></div>
	</div>
	<!-- END Minimal Area -->

	<?php
		// Pagination
		if ( locate_template( TW_TEMPLATES_DIR . 'infinite-pagination.php' ) ) {
			include( locate_template( TW_TEMPLATES_DIR . 'infinite-pagination.php' ) );
		}
	?>

	<?php wp_reset_query();?>
</div>