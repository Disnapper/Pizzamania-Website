<?php
/**
 * Displays the regular post page
 *
 * @package WordPress
 * @since 1.0
 */
get_header();

// get global vars
global $fields_installed;

// get post options
$tw_page = tw_get_post_options( array( 
	'sections' => $fields_installed && have_rows( 'sections' ) 
) ); ?>

<?php
	// Include page sections
	if ( locate_template( TW_SECTIONS_DIR . 'sections.php' ) ) {
		include( locate_template( TW_SECTIONS_DIR . 'sections.php' ) );
	}
?>

<div <?php post_class($tw_page['classes']); ?>>

	<?php
		// post title template
		if ( locate_template( TW_TITLES_DIR . 'post-title.php' ) ) {
			include( locate_template( TW_TITLES_DIR . 'post-title.php' ) );
		}
	?>

	<div class="page-content">
		<div class="container">
			<div class="col-md-8 col-md-offset-2 regular-width">

				<?php if ( $fields_installed && $tw_page['intro'] ) : ?>
					<div class="intro">
						<h2>
							<?php echo wp_kses_post( $tw_page['intro'] ); // post intro ?>
						</h2>
					</div>
				<?php endif; ?>

				<div class="content">
					<?php the_content(); // post content ?>
				</div>

				<?php
					// pagination
					$page_args = array(
						'before'      => '<p class="link-pages"><span class="title">' . esc_html__( 'Page', 'themewich' ) . '</span>',
						'after'       => '</p>',
						'link_before' => '<span class="page-link">',
						'link_after'  => '</span>'
					);
					wp_link_pages( $page_args );
				?>

				<!-- Tags -->
				<?php the_tags( '<div class="tags badges">', ' ', '</div>' ); ?>

				<?php
					// sharing template
					if ( locate_template( TW_TEMPLATES_DIR . 'sharing.php' ) ) {
						include( locate_template( TW_TEMPLATES_DIR . 'sharing.php' ) );
					}
				?>

			</div><!-- .col-md-8 -->
		</div><!-- .container -->
	</div><!-- .page-content -->

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	?>

</div>

<?php get_footer(); // Theme footer