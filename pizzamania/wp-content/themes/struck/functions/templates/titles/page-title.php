<?php
/**
 * The template for displaying the page title area
 *
 * @package WordPress
 * @since Struck 1.0
 */

global $fields_installed;

$just_archive = is_archive() && ! is_author() && ! is_category() && ! is_tag() && ! is_tax(); ?>

<?php if ( $tw_page['display_title'] !== false ) : ?>

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

	                <?php if ( $just_archive ) : ?>
	                    <div class="tiny-details">
	                        <?php
		                        if ( is_day() ) :
			                        esc_html_e( 'Daily Archives', 'themewich' );
		                        elseif ( is_month() ) :
			                        esc_html_e( 'Monthly Archives', 'themewich' );
		                        elseif ( is_year() ) :
			                        esc_html_e( 'Yearly Archives', 'themewich' );
		                        else :
			                        esc_html_e( 'Blog Archives', 'themewich' );
		                        endif;
	                        ?>
	                    </div>
	                <?php endif; ?>

	                <h1>
	                    <?php
		                    if ( is_category() ) {
			                    single_cat_title( "", true );
		                    } else if ( is_search() ) {
			                    esc_html_e( "Search Results for:", 'themewich' );
			                    echo '&nbsp;<span class="highlight">';
			                    echo esc_textarea( get_search_query() );
			                    echo '</span>';
		                    } else if ( is_tag() ) {
			                    single_tag_title( "", true );
		                    } else if ( is_author() ) {
			                    $author_id   = get_the_author_meta( 'ID' );
			                    $author_name = get_the_author_meta( 'display_name' );
			                    $author_url  = get_the_author_meta( 'user_url' );
			                    if ( get_the_author_meta( 'description' ) ) {
				                    echo esc_html__( 'About', 'themewich' ) . ' ' . esc_html( $author_name );
			                    } else {
				                    echo esc_html__( 'Posts By', 'themewich' ) . ' ' . esc_html( $author_name );
			                    }
		                    } else if ( is_404() ) {
			                    esc_html_e( "Error 404: Nothing Found", 'themewich' );
		                    } else if ( $just_archive ) {
			                    if ( is_day() ) :
				                    echo esc_html( get_the_date() );
			                    elseif ( is_month() ) :
				                    echo esc_html( get_the_date( _x( 'F Y', 'monthly archives date format', 'themewich' ) ) );
			                    elseif ( is_year() ) :
				                    echo esc_html( get_the_date( _x( 'Y', 'yearly archives date format', 'themewich' ) ) );
			                    else :
				                    esc_html_e( 'Blog Archives', 'themewich' );
			                    endif;
		                    } else {
		                    	if ( $tw_page['pageID'] ) {
		                    		echo get_the_title( $tw_page['pageID'] );
		                    	} else {
		                    		esc_html_e( 'Latest Posts', 'themewich' );
		                    	}
		                    }
	                    ?>
	                </h1>
	            </div>

	            <div class="subtitle">
	                <h2>
	                    <?php
		                    if ( is_category() ) {
			                    echo esc_html( strip_tags( category_description() ) );
		                    } else if ( is_tag() ) {
			                    echo esc_html( strip_tags( tag_description() ) );
		                    } else if ( $fields_installed && ! $just_archive ) {
			                    $subtitle = get_field( 'subtitle', $tw_page['pageID'] );
			                    $subtitle = tw_issetor( $subtitle );
			                    if ( $subtitle ) {
				                    echo esc_html( $subtitle );
			                    }
		                    }
	                    ?>
	                </h2>
	            </div>

	        </div>
	    </div>
	</div>

<?php endif; ?>