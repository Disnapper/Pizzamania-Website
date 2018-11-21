<?php

/*******************************************************
*
*	Custom News Widget
*	By: Andre Gagnon
*	http://www.designcirc.us
*
*******************************************************/

// Initialize widget
add_action( 'widgets_init', 'ag_news_widgets' );

// Register widget
function ag_news_widgets() {
	register_widget( 'AG_News_Widget' );
}

// Widget class
if ( ! class_exists( 'ag_news_widget' ) ) :
class ag_news_widget extends WP_Widget {

	/*----------------------------------------------------------*/
	/*	Set up the Widget
	/*----------------------------------------------------------*/
	function AG_News_Widget() {

		/* General widget settings */
		$widget_ops = array( 
			'classname' => 'ag_news_widget', 
			'description' => esc_html__('A widget that displays the latest post(s) from a category.', 'themewich') 
		);

		/* Widget control settings */
		$control_ops = array( 
			'width' => 400, 
			'height' => 350, 
			'id_base' => 'ag_news_widget' 
		);

		/* Create widget */
		$this->WP_Widget( 
			'ag_news_widget', 
			esc_html__('Custom News Widget', 'themewich'), 
			$widget_ops, 
			$control_ops 
		);
	}

	/*----------------------------------------------------------*/
	/*	Display The Widget
	/*----------------------------------------------------------*/

	function widget( $args, $instance ) {

		extract( $args );

		$title = apply_filters( 'widget_title', $instance['title'] );

		/* Variables from settings. */
		$postnum 	= $instance['postnum'] ;
		$category 	= $instance['category'] ;

		/* Before widget (defined in functions.php). */
		echo $before_widget;

		/* Display The Widget */
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}
				
		$the_query = new WP_Query( 'cat='.$category.'&showposts='.$postnum ); 
		
		while ($the_query->have_posts()) : $the_query->the_post();
			$tw_categories = themewich_get_cats_array(3);   // get all post categories ?>

				<div class="sidepost <?php if ( isset( $tw_categories[0]->term_id ) ) {
					echo 'highlight_category_' . $tw_categories[0]->term_id;
				} ?>">

					<div class="articleinner">
						<h3>
							<a href="<?php the_permalink(); ?>" title="<?php printf( __( 'Permanent Link to %s', 'themewich' ), get_the_title() ); ?>">
						       <?php the_title(); ?>
						    </a>
						</h3>

						<div class="tiny-details">
								<span class="author">
									<?php _e( 'By', 'themewich' ); ?>
									<span>
										<?php tw_author_link( 'posts' ); ?>
									</span>
								</span>
						</div>

						<?php if ( has_post_thumbnail() ) : ?>
							<div class="thumbnailarea">
								<a class="thumblink"
								   title="<?php printf( __( 'Permanent Link to %s', 'themewich' ), get_the_title() ); ?>"
								   href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'grid', array( 'class' => 'scale-with-grid' ) ); /* post thumbnail settings configured in functions.php */ ?>
								</a>
							</div>
						<?php endif; ?>

						<?php
							global $more; $more = 0;
							the_excerpt();
						?>

						<div class="clear"></div>
					</div>
				</div>

		    <?php endwhile;  wp_reset_query(); ?>

		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/*----------------------------------------------------------*/
	/*	Update the Widget
	/*----------------------------------------------------------*/
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		/* Remove HTML: */
		$instance['title'] 		= esc_html( $new_instance['title'] );
		$instance['postnum'] 	= (int) $new_instance['postnum'];
		$instance['category'] 	= esc_html( $new_instance['category'] );

		return $instance;
	}


/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/

	function form( $instance ) {

		/* Default widget settings */
		$defaults = array(
			'title'    => '',
			'postnum'  => '',
			'category' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_html_e( 'News Title (Optional):', 'themewich' ) ?>
			</label>
			<input class="widefat" id="<?php echo sanitize_html_class( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       value="<?php echo esc_attr( $instance['title'] ); ?>"/>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postnum' ) ); ?>">
				<?php esc_html_e( 'Number of Posts:', 'themewich' ) ?>
			</label>
			<input class="widefat" id="<?php echo sanitize_html_class( $this->get_field_id( 'postnum' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'postnum' ) ); ?>"
			       value="<?php echo esc_attr( $instance['postnum'] ); ?>"/>
		</p>

		<?php if ( $displaycatname = $instance['category'] ) {
			echo '<p>Current Category: ' . esc_html( get_cat_name( $displaycatname ) ) . '</p>';
		} ?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>">
				<?php esc_html_e( 'Choose a Category:', 'themewich' ); ?>
			</label>
			<?php wp_dropdown_categories( 'name=' . esc_html( $this->get_field_name( 'category' ) ) . '&id=' . esc_html( $this->get_field_id( 'category' ) ) . '&show_count=1' ); ?>
		</p>

		<hr>
	<?php
	}
}
endif;

?>