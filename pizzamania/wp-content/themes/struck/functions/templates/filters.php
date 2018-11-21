<?php
/**
 * The template to display a filter links
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
?>

<?php if ( $tw_page['filters'] ) : ?>

	<?php
		// Get only items in query
		$term_list = array();
		while ( $loop->have_posts() ) : $loop->the_post();
			$term_list = array_merge( $term_list, wp_get_post_terms( $post->ID, 'filter', array( "fields" => "ids" ) ) );
		endwhile;

		// reset the $post variable
		wp_reset_postdata();

		// Remove duplicates
		$term_list = array_unique( $term_list );
		// Allow filtering of terms list
		$term_list = apply_filters( 'tw_term_filters', $term_list );

		// Convert to string
		$term_list = implode( ',', $term_list );
	?>

	<!-- Filter -->
	<?php if ( $term_list ) : ?>
		<div class="filtercontainer">
			<ul class="filter tiny-details" id="filters">

				<li class="all-filter">
					<a href="#" data-filter="*" class="active no-ajaxy">
						<?php _e( 'All', 'framework' ); ?>
					</a>
				</li>

				<?php
					$filter_args = array(
						'title_li'         => '',
						'include'          => $term_list,
						'taxonomy'         => 'filter',
						'show_option_none' => '',
						'walker'           => new Themewich_Walker_Filter()
					);

					// allow filter by child themes
					wp_list_categories( apply_filters( 'tw_filters_query', $filter_args ) );
				?>

			</ul>
			<div class="clear"></div>
		</div>
	<?php endif; ?>
	<!-- END Filter -->
<?php endif; ?>