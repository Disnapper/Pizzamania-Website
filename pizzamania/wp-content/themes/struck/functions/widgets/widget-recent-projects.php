<?php

/*******************************************************
*
*	Custom Recent Project Widget
*	By: Andre Gagnon
*	http://www.designcirc.us
*
*******************************************************/

// Initialize widget
add_action( 'widgets_init', 'ag_recentprojects_widgets' );

// Register widget
function ag_recentprojects_widgets() {
	register_widget( 'AG_Recentprojects_Widget' );
}

// Widget class
class ag_recentprojects_widget extends WP_Widget {

/*----------------------------------------------------------*/
/*	Set up the Widget
/*----------------------------------------------------------*/

	function AG_Recentprojects_Widget() {

		/* General widget settings */
		$widget_ops = array( 
			'classname' => 'ag_recentprojects_widget', 
			'description' => esc_html__('A widget that displays small project thumbnails from recent portfolio items.', 'framework') 
		);

		/* Widget control settings */
		$control_ops = array( 
			'width' => 400, 
			'height' => 350, 
			'id_base' => 'ag_recentprojects_widget' 
		);

		/* Create widget */
		$this->WP_Widget( 
			'ag_recentprojects_widget', 
			esc_html__('Custom Recent Portfolio Items Widget', 'framework'), 
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
	$postnum = $instance['postnum'];

	/* Before widget (defined in functions.php). */
	echo $before_widget;

	/* Display the widget title & subtitle if one was input (before and after defined by themes). */
	if ( $title ) {
		echo $before_title . $title . $after_title;
	}

	// Check for cached transient to improve speed and reduce server load.
	$recent_projects = get_transient( 'themewich_portfolio_loop_widget' );

	// allow hook to turn off transient
	$recent_projects = apply_filters( 'tw_portfolio_widget_transient', $recent_projects );

	// if transient isn't set, run query
	if ( false === $recent_projects ) {

		// reset query
		wp_reset_query();

		$args = array(
			// Ignore Sticky Posts
			'ignore_sticky_posts' => 1,
			// Get post items
			'post_type'           => array( 'portfolio' ),
			// Sorted by Drag and Drop Order
			'orderby'             => 'menu_order',
			// Top to Bottom
			'order'               => 'ASC',
			// Get only the most recent
			'posts_per_page'      => (int) $postnum // Set posts per page,
		);

		$recent_projects = new WP_Query( apply_filters( 'tw_portfolio_widget_query', $args ) );

		// transient set to last for 1 hour
		set_transient( 'themewich_portfolio_loop_widget', $recent_projects, 60 * 60 );
	} ?>

	<div class="recent-projects">
		<?php while ( $recent_projects->have_posts() ) : $recent_projects->the_post(); ?>
			<?php if (has_post_thumbnail()) { ?>

		        <div class="recent-project">
		            <a href="<?php the_permalink(); ?>" class="hover">
		            	<?php the_post_thumbnail( 'tinyfeatured', array( 'class' => 'scale-with-grid' ) ); ?>
		            </a>
		        </div>

	        <?php } ?>
    	<?php endwhile;?>

    	<?php wp_reset_query(); // reset query ?>

	    <div class="clear"></div>
	</div>

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
	$instance['title'] 		= esc_html( $new_instance['title'] ); // escape html
	$instance['postnum'] 	= (int) ( $new_instance['postnum'] ); // force integer

	return $instance;
}


/*----------------------------------------------------------*/
/*	Widget Settings
/*----------------------------------------------------------*/

function form( $instance ) {

	/* Default widget settings */
	$defaults = array(
		'title'   => '',
		'postnum' => '',
	);
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<p>
	  <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
	        <?php esc_html_e( 'Projects Title (Optional): W.P.L.O.C.K.E.R...C.O.M', 'framework' ) ?>
	    </label>
	    <input class="widefat" id="<?php echo sanitize_html_class( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	</p>

	<p>
	    <label for="<?php echo esc_attr( $this->get_field_id( 'postnum' ) ); ?>">
	        <?php esc_html_e('Number of Posts:', 'framework') ?>
	    </label>
	    <input class="widefat" id="<?php echo sanitize_html_class( $this->get_field_id( 'postnum' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postnum' ) ); ?>" value="<?php echo esc_attr( $instance['postnum'] ); ?>" />
	</p>

<?php
	}
}
?>