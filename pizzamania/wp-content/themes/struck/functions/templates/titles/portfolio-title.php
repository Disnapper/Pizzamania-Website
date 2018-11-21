<?php
/**
 * The template for displaying the page title area
 *
 * @package WordPress
 * @since Struck 1.0
 */

global $fields_installed; ?>

<div class="image-title-bg <?php if ( $tw_page['featured_image'] ) { echo 'loading'; } ?>">

	<?php if ( $tw_page['featured_image'] ) : ?>
		<div class="load-background-image" style="<?php echo 'background-image: url(' . esc_url( $tw_page['featured_image'] ) . ')'; ?>">
			<img src="<?php echo esc_url( $tw_page['featured_image'] ); ?>" class="zero-opacity" onLoad="jQuery(this).parent().addClass('fade-in');"/>
		</div>
	<?php endif; ?>

    <?php if ( $tw_page['featured_image'] ) : ?>
        <div class="overlay"></div>
    <?php endif; ?>

    <div class="container">
        <div class="col-md-10 title-container col-md-offset-1">

            <?php
	            if ( $fields_installed && $subtitle = get_field( 'subheadline' ) ) {
		            echo '<div class="subtitle"><h3 class="tiny-details">' . wp_kses_post( $subtitle ) . '</h3></div>';
	            }
            ?>

            <div class="title">
                <h1>
                    <?php the_title(); ?>
                </h1>
            </div>

        </div>
    </div>
</div>