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

<?php if ( get_next_posts_link( '', $loop->max_num_pages ) ) : ?>
	<!-- Pagination -->
	<div class="infinite-pagination" data-max="<?php echo esc_attr( $loop->max_num_pages ); ?>" data-current="<?php echo esc_attr( $paged ); ?>">
		<h3 class="more-posts tiny-details" data-next-page="<?php echo esc_attr( $paged + 1 ); ?>">
			<?php next_posts_link( __('Load More', 'framework') . ' <span class="more-plus">+</span>', $loop->max_num_pages ); ?>
		</h3>
		<div class="clear"></div>
	</div>
	<!-- END Pagination -->
<?php endif; ?>