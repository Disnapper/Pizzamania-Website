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
		<div class="load-background-image"  style="<?php echo 'background-image: url(' . esc_url( $tw_page['featured_image'] ) . ')'; ?>">
			<img src="<?php echo esc_url( $tw_page['featured_image'] ); ?>" class="zero-opacity" onLoad="jQuery(this).parent().addClass('fade-in');"/>
		</div>
	<?php endif; ?>

    <?php if ( $tw_page['featured_image'] ) : ?>
        <div class="overlay"></div>
    <?php endif; ?>

    <div class="container">
        <div class="col-md-10 title-container col-md-offset-1">

            <div class="categories badges">
                <?php echo themewich_get_cats(5); ?>
            </div>

            <div class="title">
                <h1>
                    <?php the_title(); ?>
                </h1>
            </div>

            <div class="post-details">
                <span class="date updated tiny-details">
                    <?php themewich_date('human'); ?>
                </span>

                <span class="tw-bullet bullet-1">&nbsp;&bull;&nbsp;</span>

                <span class="author vcard tiny-details">
                    <?php _e( 'By', 'themewich' );?>
                    <span class="fn">
                        <?php tw_author_link('posts'); ?>
                    </span>
                </span>

                <span class="tw-bullet bullet-2">&nbsp;&bull;&nbsp;</span>

                <span class="comment-count tiny-details">
                    <a href="#comments">
                        <i class="fa fa-comment"></i>
                        <?php echo get_comments_number(); ?>
                        <?php _e('Comments', 'Themewich'); ?>
                    </a>
                </span>

            </div>

        </div>
    </div>
</div>