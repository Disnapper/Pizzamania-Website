<?php
/**
 * Displays the portfolio item page
 *
 * @package WordPress
 * @since 1.0
 */
get_header();

// get portfolio page options defined in functions.php
$tw_page = tw_get_portfolio_options(); ?>

<?php
	// Include page sections
	if ( locate_template( TW_SECTIONS_DIR . 'sections.php' ) ) {
		include( locate_template( TW_SECTIONS_DIR . 'sections.php' ) );
	}
?>

<?php if ( $tw_page['show_content'] ) : // don't show if there's no content, intro or subtitle ?>

		<div <?php post_class( $tw_page['classes'] ); ?>>

			<?php
				if ( $tw_page['show_title'] ) {
					// page title template
					if ( locate_template( TW_TITLES_DIR . 'portfolio-title.php' ) ) {
						include( locate_template( TW_TITLES_DIR . 'portfolio-title.php' ) );
					}
				}
			?>

			<?php if ( $tw_page['has_content'] || $tw_page['intro'] ) : ?>

				<div class="page-content">
					<div class="container">
						<div class="col-md-8 col-md-offset-2 regular-width">

							<?php if ( $fields_installed && $tw_page['intro'] ) : ?>
								<div class="intro">
									<h2>
										<?php echo wp_kses_post( $tw_page['intro'] ); // portfolio intro ?>
									</h2>
								</div>
							<?php endif; ?>

							<div class="content">
								<?php the_content(); // portfolio content ?>
							</div>

							<?php
								// pagination
								$page_args = array(
									'before'      => '<p class="link-pages"><span class="title">' . __( 'Page', 'themewich' ) . '</span>',
									'after'       => '</p>',
									'link_before' => '<span class="page-link">',
									'link_after'  => '</span>'
								);
								wp_link_pages( $page_args );
							?>

							<?php
								// sharing template
								if ( locate_template( TW_TEMPLATES_DIR . 'sharing.php' ) ) {
									include( locate_template( TW_TEMPLATES_DIR . 'sharing.php' ) );
								}
							?>

						</div><!-- .col-md-8 -->
					</div><!-- .container -->
				</div><!-- .page-content -->

			<?php endif; ?>

			<?php
			// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
			?>

		</div>

	<?php endif; ?>

<?php get_footer(); // Theme footer