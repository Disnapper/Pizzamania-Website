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

	<!-- Grid Area -->
	<div class="container">

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

			<div class="isotopecontainer struckcontainer">
				<?php
					// prepare loop again
					rewind_posts();

					//Loop through posts
					if ( $loop->have_posts() ) :
						while ($loop->have_posts()) : $loop->the_post();

							// thumbnail template
							if ( locate_template( TW_DISPLAYS_DIR . 'classic-thumbnail.php' ) ) {
								include( locate_template( TW_DISPLAYS_DIR . 'classic-thumbnail.php' ) );
							}

						endwhile;
					endif; // end loop
				?>

				<div class="clear"></div>
			</div>

			<?php
				// Pagination
				if ( locate_template( TW_TEMPLATES_DIR . 'infinite-pagination.php' ) ) {
					include( locate_template( TW_TEMPLATES_DIR . 'infinite-pagination.php' ) );
				}
			?>

	</div>
	<!-- END Grid Area -->

	<?php wp_reset_query();?>
</div>