<?php
/**
 * The template for displaying the filter taxonomy title area
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

	<?php if ( $tw_page['opacity_styles']['opacity'] > 0 ) : ?>
		<div class="overlay" <?php tw_inline_style( array( 'styles' => $tw_page['opacity_styles'] ) ); ?>></div>
	<?php endif; ?>

    <div class="container">
	    <div class="col-md-8 title-container <?php echo ( $fields_installed && 'center' == get_field( 'title_alignment' ) ) ? 'col-md-offset-2' : ''; ?>">
		    <div class="title">
			    <h1>
				    <?php
					    $term = get_term_by( 'slug', get_query_var( 'filter' ), get_query_var( 'taxonomy' ) );
					    echo wp_kses_post( $term->name );
				    ?>
			    </h1>
		    </div>

		    <?php if ( $description = term_description() ) : ?>
			    <div class="subtitle">
				    <h2>
					    <?php echo sanitize_text_field( $description ); ?>
				    </h2>
			    </div>
		    <?php endif; ?>

        </div>
    </div>
</div>