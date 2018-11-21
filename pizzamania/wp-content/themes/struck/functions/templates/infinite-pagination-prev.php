<?php
/**
 * The template to display a load more
 * button for infinte scroll
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */
?>

<?php if ( get_previous_posts_link( '', $loop->max_num_pages ) ) : ?>
	<!-- Pagination -->
	<div class="infinite-pagination" data-max="<?php echo esc_attr( $loop->max_num_pages ); ?>">
		<h3 class="prev-posts tiny-details">
			<?php previous_posts_link( __('Go To Previous Page', 'framework') . ' <span class="more-plus">+</span>', $loop->max_num_pages ); ?>
		</h3>
		<div class="clear"></div>
	</div>
	<!-- END Pagination -->
<?php endif; ?>